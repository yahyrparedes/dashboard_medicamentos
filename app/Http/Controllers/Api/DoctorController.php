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

}
