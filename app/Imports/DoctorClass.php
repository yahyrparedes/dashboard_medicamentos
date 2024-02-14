<?php

namespace App\Imports;

//use App\Models\Pharmacy;
use App\Models\Pharmacy;
use App\Models\PharmacyStore;
use App\Models\User;
use App\Utils\Constants;
use App\Utils\Tools;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DoctorClass implements ToModel, WithHeadingRow
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

        // validity phone number its contains 51 remove it
        $phone = $row['movil'];

        if (substr($phone, 0, 2) == '51') {
            $phone = substr($phone, 2);
        }

        // validity name its split by space

        $_name = $row['apellidos_y_nombre'];
        $name = explode(' ', $_name);

        foreach ($name as $key => $value) {
            $name[$key] =json_decode(str_replace( '\u00a0', "", json_encode($value) ));
        }


        if (count($name) == 4) {
            $lastName = trim($name[0]) . ' ' . trim($name[1]);
            $firstName = trim($name[2]) . ' ' . trim($name[3]);
        } else if (count($name) == 3) {
            $firstName = trim($name[2]);
            $lastName = trim($name[0]) . ' ' . trim($name[1]);
        } else {
            $firstName = implode(' ', $name);
            $lastName = '';
        }

        $pharmacy = User::updateOrCreate(
            ['email' => $row['e_mail']],
            [
                'cmp' => $row['colegio_medico'],
                'name' => $firstName,
                'last_name' => $lastName,
                'department_id' => $departmentId,
                'province_id' => $provinceId,
                'district_id' => $districtId,
                'phone' => $phone,
                'password' => bcrypt('Lansier123456'),
                'is_active' => true,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
                'ubigeo' => $district->ubigeo ?? null,
            ])->assignRole(Constants::ROLE_DOCTOR);

        return $pharmacy;
    }

    public function headingRow(): int
    {
        return 1;
    }
}
