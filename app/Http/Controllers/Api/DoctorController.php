<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{

    public function list(Request $request): \Illuminate\Http\JsonResponse
    {
        $name = $request->input('name');

        $role_doctor = DB::table('roles')
            ->select('id')
            ->where('name', '=', Constants::ROLE_DOCTOR)
            ->first();

        $list = DB::table('users')
            ->select('users.id', 'users.name', 'users.last_name')
            ->join('model_has_roles', function ($join) use ($role_doctor) {
                $join->on('model_has_roles.model_id', '=', 'users.id')
                    ->where('model_has_roles.role_id', '=', $role_doctor->id);
            })
            ->where('users.is_active', '=', true)
            ->where('users.name', '=', $name)
            ->orWhere('users.name', 'like', '%' . $name . '%')
            ->get();

        return response()->json($list);
    }

    public function addPatientToDoctor(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();

        if (!isset($data['user']) || !isset($data['doctor'])) {
            return response()->json(['message' => 'Invalid data'], 400);
        }

        $user_id = $data['user'];
        $doctor_id = $data['doctor'];

        $userDoctor = DB::table('user_doctor')
            ->select('id')
            ->where('is_active', '=', true)
            ->where('user_id', '=', $user_id)
            ->where('doctor_id', '=', $doctor_id)
            ->first();

        if ($userDoctor == null) {
            DB::table('user_doctor')->insert([
                'user_id' => $user_id,
                'doctor_id' => $doctor_id,
                'is_active' => true
            ]);
            return response()->json(['message' => 'Patient added to doctor'], 201);
        } else {
            return response()->json(['message' => 'Patient already added to doctor'], 200);
        }
    }

}
