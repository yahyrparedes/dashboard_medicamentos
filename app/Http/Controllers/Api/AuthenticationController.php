<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use App\Models\User;
use App\Utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

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
            ]);
        }

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 400);
        }

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'email_verified_at' => now(),
            'password' => Hash::make($request->password),
            'gender_id' => $request->gender_id,
            'document_type_id' => 1,
            'document' => $request->document,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
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

        return response()->json($user);
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

            $user->type = $type;

            $gender = Gender::where('id', $user->gender_id)->first();
            $user->gender = $gender->name;


            return response()->json($user);
        }
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function profile(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::find($request->id)->first();

        if ($user == null) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if ($user->hasRole([Constants::ROLE_DOCTOR])) {
            $user->type = Constants::ROLE_DOCTOR;
        } else {
            $user->type = Constants::ROLE_PATIENT;
        }

        return response()->json($user);
    }
}
