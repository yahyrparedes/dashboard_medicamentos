<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Utils\Constants;
use Carbon\Carbon;
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
            ->whereRaw("CONCAT(users.name, ' ', users.last_name) like ?", ['%' . $name . '%'])
//            ->where('users.is_active', '=', true)
////            ->orWhere('users.name', '=', $name)
//            ->Where('users.name', 'like', '%' . $name . '%')
////            ->orWhere('users.last_name', '=', $name)
//            ->orWhere('users.last_name', 'like', '%' . $name . '%')
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

    public function filterPatients(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();

        $doctor = $data['doctor'];
        $date = $data['date'];

        if (!isset($doctor) || !isset($date)) {
            return response()->json(['message' => 'Invalid data'], 400);
        }

        $userIds = DB::table('user_doctor')
            ->select('user_id')
            ->where('is_active', '=', true)
            ->where('doctor_id', '=', $doctor)
            ->get();

        if ($userIds->isEmpty()) {
            return response()->json([], 200);
        }

        $weekMap = [0 => 'D', 1 => 'L', 2 => 'M', 3 => 'X', 4 => 'J', 5 => 'V', 6 => 'S'];
        $dayOfTheWeek = Carbon::parse()->dayOfWeek;
        $weekday = $weekMap[$dayOfTheWeek];

        $users = DB::table('users')
            ->select('id', 'name', 'last_name', 'email', 'document', 'birthday', 'phone',)
            ->whereIn('id', $userIds->pluck('user_id'))
            ->get();

        $_users = [];

        foreach ($users as $user) {
            $remainder = DB::table('reminders')
                ->join('users', 'reminders.user_id', '=', 'users.id')
                ->join('medications', 'reminders.medication_id', '=', 'medications.id')
                ->where('frequency', 'like', '%' . $weekday . '%')
                ->whereRaw('? between `start_date` and `end_date`', $date)
                ->where('reminders.is_active', '=', true)
                ->where('users.id', '=', $user->id)
                ->select(
//                    'reminders.id', 'medication_id', 'start_date', 'end_date', 'duration', 'frequency', 'count', 'frequency_daily',
                    'medications.name as medication_name')
                ->get();

            if ($remainder->isEmpty()) {
                continue;
            } else {
                $remainder = $remainder->pluck('medication_name')->toArray();
                $user->medications = $remainder;
                $_users[] = $user;
            }
        }
        return response()->json($_users);
    }

}
