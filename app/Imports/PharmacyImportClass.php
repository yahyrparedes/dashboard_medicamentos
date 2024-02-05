<?php

namespace App\Imports;

//use App\Models\Pharmacy;
use App\Models\Pharmacy;
use App\Models\PharmacyStore;
use App\Utils\Tools;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PharmacyImportClass implements ToModel, WithHeadingRow
{


    public function model(array $row)
    {
        set_time_limit(360);

        if ($row['departamento'] == '' || $row['departamento'] == '*' || $row['departamento'] == null) {
            $departmentId = null;
            $provinceId = null;
            $districtId = null;
        } else {
            $departmentId = DB::table('departments')->whereRaw("LOWER(name) = '" . Tools::basicCleanString($row['departamento']) . "'")->first()->id;

            if ($row['provincia'] == '' || $row['provincia'] == '*' || $row['provincia'] == null) {
                $provinceId = null;
                $districtId = null;
            } else {

                $provinceId = DB::table('provinces')->whereRaw("LOWER(name) = '" . Tools::basicCleanString($row['provincia']) . "'")
                    ->orWhereRaw("LOWER(name) like '%" . Tools::cleanString($row['provincia']) . "%'")
                    ->where('department_id', $departmentId)
                    ->first()->id;

                if ($row['distrito'] == '' || $row['distrito'] == '*' || $row['distrito'] == null) {
                    $districtId = null;
                } else {

                    $districtId = DB::table('districts')->whereRaw("LOWER(name) = '" . Tools::basicCleanString($row['distrito']) . "'")
                        ->orWhereRaw("LOWER(name) like '%" . Tools::cleanString($row['distrito']) . "%'")
                        ->where('province_id', $provinceId)->first()->id;

                }
            }
        }
//        $pharmacy = new Pharmacy::([
        $pharmacy = PharmacyStore::updateOrCreate(
            ['code' => $row['cod_local']],
            [
//            'code' => $row['cod_local'],
                'description' => $row['descripcion_local'],
                'format' => $row['formato'],
                'type' => $row['tipo'],
                'address' => $row['direccion'],
                'is_active' => $row['estado'] == 'Activo',
                'department_id' => $departmentId,
                'province_id' => $provinceId,
                'district_id' => $districtId,
                'opening_date' => $row['fecha_apertura'],
            ]);

        return $pharmacy;
    }

    public function headingRow(): int
    {
        return 1;
    }
}
