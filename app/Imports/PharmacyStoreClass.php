<?php

namespace App\Imports;

//use App\Models\Pharmacy;
use App\Models\Pharmacy;
use App\Models\PharmacyStore;
use App\Utils\Tools;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PharmacyStoreClass implements ToModel, WithHeadingRow
{


    public function model(array $row)
    {
        set_time_limit(360);


        if ($row['departamento'] == '' || $row['departamento'] == '*' || $row['departamento'] == null) {
            $departmentId = null;
            $provinceId = null;
            $districtId = null;
        } else {
            $departmentId = DB::table('departments')->whereRaw("LOWER(name) = '" . Tools::basicCleanString($row['departamento']) . "'")->first();

            if ($departmentId != null) {
                $departmentId = $departmentId->id;
                if ($row['provincia'] == '' || $row['provincia'] == '*' || $row['provincia'] == null) {
                    $provinceId = null;
                    $districtId = null;
                } else {
                    $province = DB::table('provinces')->whereRaw("LOWER(name) = '" . Tools::basicCleanString($row['provincia']) . "'")
                        ->orWhereRaw("LOWER(name) like '%" . Tools::cleanString($row['provincia']) . "%'")
                        ->where('department_id', $departmentId)
                        ->first();
                    if ($province != null) {
                        $provinceId = $province->id;
                        if ($row['distrito'] == '' || $row['distrito'] == '*' || $row['distrito'] == null) {
                            $districtId = null;
                        } else {
                            $district = DB::table('districts')->whereRaw("LOWER(name) = '" . Tools::basicCleanString($row['distrito']) . "'")
                                ->orWhereRaw("LOWER(name) like '%" . Tools::cleanString($row['distrito']) . "%'")
                                ->where('province_id', $provinceId)->first();
                            if ($district != null) {
                                $districtId = $district->id;
                            } else {
                                $districtId = null;
                            }
                        }
                    } else {
                        $provinceId = null;
                        $districtId = null;
                    }
                }
            } else {
                $departmentId = null;
                $provinceId = null;
                $districtId = null;
            }
        }

        if ($row['formato'] != null || $row['formato'] != '') {
            $format = strtoupper($row['formato']);

            if ($format == 'ALBIS' || $format == 'BOTICAS DEL ORIENTE' || $format == 'ECKERD AMAZONIA' || $format == 'ECKERD PERU' || $format == 'FRANQUICIA' || $format == 'INKAFARMA') {
                $format = 1;
            } else if ($format == 'JORSA' || $format == 'MIFARMA') {
                $format = 2;
            } else {
                $format = null;
            }
        } else {
            $format = null;
        }

        $pharmacy = PharmacyStore::updateOrCreate(
            ['code' => $row['cod_local']],
            [
                'description' => json_decode(str_replace('\u00a0', "", json_encode($row['descripcion_local']))),
                'format' => $row['formato'],
                'pharmacy_id' => $format,
                'type' => $row['tipo'],
                'address' => json_decode(str_replace('\u00a0', "", json_encode($row['direccion']))),
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
