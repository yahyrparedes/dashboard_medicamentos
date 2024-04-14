<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\District;
use App\Models\Gender;
use App\Models\Province;
use App\Models\User;
use App\Models\UserDoctor;
use App\Utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Dirape\Token\Token;

class AuthenticationController extends Controller
{

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {

        if ($request->type == Constants::ROLE_PATIENT) {
            $validatedData = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', /* 'confirmed', Rules\Password::defaults()*/],
                'gender_id' => ['required', 'integer',],
                'document' => ['required'],
                'birthday' => ['required'],
                'phone' => ['required'],
                'ubigeo' => ['required'],
            ]);
        } else {
            $validatedData = Validator::make($request->all(), [
                'cmp' => ['required', 'string', 'max:255'],
                'name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', /* 'confirmed', Rules\Password::defaults()*/],
                'gender_id' => ['required', 'integer',],
                'document' => ['required'],
                'birthday' => ['required'],
                'phone' => ['required'],
                'ubigeo' => ['required'],
            ]);
        }

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 400);
        }

        $token = (new Token())->Unique('users', 'token', 60);

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'token' => $token,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'gender_id' => $request->gender_id,
            'document_type_id' => 1,
            'document' => $request->document,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'ubigeo' => $request->ubigeo,
            'is_active' => true,
            'is_imported' => false,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($request->type == Constants::ROLE_DOCTOR) {
            $user->cmp = $request->cmp;
            $user->assignRole(Constants::ROLE_DOCTOR);
            $user->type = Constants::ROLE_DOCTOR;
        } else {
            $user->cmp = null;
            $user->assignRole(Constants::ROLE_PATIENT);
            $user->type = Constants::ROLE_PATIENT;
        }

        if ($request->type == Constants::ROLE_PATIENT) {

            $userDoctor = UserDoctor::create([
                'user_id' => $user->id,
                'doctor_id' => $request->doctor_id,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $user['doctor_id'] = $userDoctor->doctor_id;
        }

        return response()->json($user, 200);
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {

        $validatedData = Validator::make($request->all(), [
            'email' => ['required', 'string'],
            'password' => ['required',],
        ]);

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 400);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_active' => true])) {
            $user = Auth::user();

            if ($user->hasRole([Constants::ROLE_DOCTOR])) {
                $type = Constants::ROLE_DOCTOR;
            }

            if ($user->hasRole([Constants::ROLE_PATIENT])) {
                $type = Constants::ROLE_PATIENT;
            }

            if ($user->hasRole([Constants::ROLE_ADMIN])) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $user->token = (new Token())->Unique('users', 'token', 60);
            $user->save();

            $gender = Gender::where('id', $user->gender_id)->first();
            $user->gender = $gender->name;

            $user->type = $type;
            return response()->json($user);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function profile(Request $request): \Illuminate\Http\JsonResponse
    {

        $user = User::where('token', '=', $request->token)->first();

        if ($user == null) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $gender = Gender::where('id', $user->gender_id)->first();
        $user->gender = $gender->name;

        try {
            $district = District::where('ubigeo', '=', $user->ubigeo)->first();
            $user->district = $district->name;

            $province = Province::where('id', $district->province_id)->first();
            $user->province = $province->name;

            $department = Department::where('id', $province->department_id)->first();
            $user->department = $department->name;
        } catch (\Exception $e) {
            $user->district = '';
            $user->province = '';
            $user->department = '';
        }

        if ($user->hasRole([Constants::ROLE_ADMIN])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        } else {
            if ($user->hasRole([Constants::ROLE_DOCTOR])) {
                $user->type = Constants::ROLE_DOCTOR;
            } else {
                try {
                    $doctor = User::where('id', UserDoctor::where('user_id', $user->id)->where('is_active', true)->first()->doctor_id)->first();
                    $user->doctor = $doctor->name . ' ' . $doctor->last_name;
                } catch (\Exception $e) {
                    $user->doctor = "";
                }
                $user->type = Constants::ROLE_PATIENT;
            }
        }

        return response()->json($user);
    }
}
