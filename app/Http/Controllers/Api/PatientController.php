<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserDoctor;
use App\Utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{

    public function list(Request $request): \Illuminate\Http\JsonResponse
    {
        $name = $request->input('name');


        $role_patient = DB::table('roles')
            ->select('id')
            ->where('name', '=', Constants::ROLE_PATIENT)
            ->first();

        $list = DB::table('users')
            ->select('users.id', 'users.name', 'users.last_name', 'users.email', 'users.document', 'users.phone', 'users.is_active',
                'users.ubigeo', 'districts.name as district', 'provinces.name as province', 'departments.name as department', 'users.birthday', 'genders.name as gender')
            ->join('model_has_roles', function ($join) use ($role_patient) {
                $join->on('model_has_roles.model_id', '=', 'users.id')
                    ->where('model_has_roles.role_id', '=', $role_patient->id);
            })
            ->join('districts', 'districts.ubigeo', '=', 'users.ubigeo')
            ->join('provinces', 'provinces.id', '=', 'districts.province_id')
            ->join('departments', 'departments.id', '=', 'provinces.department_id')
            ->join('genders', 'genders.id', '=', 'users.gender_id')
            ->where('users.is_active', '=', true)
            ->where('users.name', '=', $name)
            ->orWhere('users.name', 'like', '%' . $name . '%')
            ->get();

        foreach ($list as $item) {
            $medicament = DB::select('select name from medications where id in (select distinct (medication_id) from reminders where user_id = ? and is_active = 1)', [$item->id]);
            $medicament = array_map(function ($value) {
                return $value->name;
            }, $medicament);
            $item->medications = $medicament;
        }
        return response()->json($list);
    }

    public function patientsByDoctor(Request $request, $id): \Illuminate\Http\JsonResponse
    {

        $userDoctor = DB::table('user_doctor')
            ->select('user_id')
            ->where('is_active', '=', true)
            ->where('doctor_id', '=', $id)
            ->get();

        $list = DB::table('users')
            ->select('users.id', 'users.name', 'users.last_name', 'users.email', 'users.document', 'users.phone', 'users.is_active',
                'users.ubigeo', 'districts.name as district', 'provinces.name as province', 'departments.name as department', 'users.birthday', 'genders.name as gender')
            ->join('districts', 'districts.ubigeo', '=', 'users.ubigeo')
            ->join('provinces', 'provinces.id', '=', 'districts.province_id')
            ->join('departments', 'departments.id', '=', 'provinces.department_id')
            ->join('document_types', 'document_types.id', '=', 'users.document_type_id')
            ->join('genders', 'genders.id', '=', 'users.gender_id')
            ->where('users.is_active', '=', true)
            ->whereIn('users.id', $userDoctor->pluck('user_id'))
            ->get();

        foreach ($list as $item) {
            $medicament = DB::select('select name from medications where id in (select distinct (medication_id) from reminders where user_id = ? and is_active = 1)', [$item->id]);
            $medicament = array_map(function ($value) {
                return $value->name;
            }, $medicament);
            $item->medications = $medicament;
            unset($item->cmp);
            unset($item->password);
            unset($item->created_at);
            unset($item->updated_at);
        }

        return response()->json($list);
    }

    public function deletePatientByDoctor(Request $request, $doctor, $patient): \Illuminate\Http\JsonResponse
    {
        $userDoctor = DB::table('user_doctor')
            ->where('user_id', $patient)
            ->where('doctor_id', $doctor)
            ->update([
                'is_active' => false,
                'updated_at' => date('Y-m-d H:i:s')
            ]);


        return response()->json(['message' => 'Record deleted successfully', 'status' => 200, 'data' => $userDoctor]);
    }


}
