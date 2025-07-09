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
        set_time_limit(720);
        ini_set('memory_limit', '2048M');

        if ($row['departamento'] != '' || $row['departamento'] != '*' || $row['departamento'] != null) {
            $department = DB::table('departments')->whereRaw("LOWER(name) = '" . Tools::basicCleanString($row['departamento']) . "'")->first();
            if ($department != null) {
                if ($row['provincia'] != '' || $row['provincia'] != '*' || $row['provincia'] != null) {
                    $province = DB::table('provinces')->whereRaw("LOWER(name) = '" . Tools::basicCleanString($row['provincia']) . "'")
                        ->orWhereRaw("LOWER(name) like '%" . Tools::cleanString($row['provincia']) . "%'")
                        ->where('department_id', $department->id)
                        ->first();
                    if ($province != null) {
                        if ($row['distrito'] != '' || $row['distrito'] != '*' || $row['distrito'] != null) {
                            $district = DB::table('districts')->whereRaw("LOWER(name) = '" . Tools::basicCleanString($row['distrito']) . "'")
                                ->orWhereRaw("LOWER(name) like '%" . Tools::cleanString($row['distrito']) . "%'")
                                ->where('province_id', $province->id)->first();
                        } else {
                            $district = null;
                        }
                    } else {
                        $district = null;
                    }
                } else {
                    $district = null;
                }
            } else {
                $district = null;
            }
        } else {
            $district = null;
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
            $name[$key] = json_decode(str_replace('\u00a0', "", json_encode($value)));
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

        if ($row['colegio_medico'] == '' || $row['colegio_medico'] == null) {
            $row['colegio_medico'] = '000000';
        }

        if(!isset($row['e_mail']) || $row['e_mail'] == '' || $row['e_mail'] == null) {
            $row['e_mail'] =  'empty_doctor_' . $row['colegio_medico'] .  '@lansier.com' ;
        }

        $data = [
            "cmp" => $row['colegio_medico'],
            "name" => $firstName,
            "last_name" => $lastName,
            "phone" => $phone,
            "ubigeo" => $district?->ubigeo,
            "email_verified_at" => now(),
            "password" => bcrypt('Lansier123456'),
            "is_active" => true,
            "is_imported" => true,
            "created_at" => now(),
            "updated_at" => now(),
            "email" => $row['e_mail']
        ];
        return User::updateOrCreate(['cmp' => $row['colegio_medico']], $data)->assignRole(Constants::ROLE_DOCTOR);
    }

    public function headingRow(): int
    {
        return 1;
    }
}
