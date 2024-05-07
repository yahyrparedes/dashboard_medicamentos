<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UbigeoController extends Controller
{
    public function departments(): \Illuminate\Http\JsonResponse
    {
        $department = DB::table('departments')
            ->select('id', 'name', 'ubigeo')
            ->where('is_active', '=', true)
            ->orderBy('ubigeo')->get();

        return response()->json($department);
    }

    public function provincesByDepartmentID(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $department = DB::table('provinces')
            ->select('id', 'name', 'ubigeo')
            ->where('is_active', '=', true)
            ->where('department_id', '=', (int)$id)
            ->orderBy('ubigeo')->get();


        return response()->json($department);
    }

    public function districtsByProvinceID(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $department = DB::table('districts')
            ->select('id', 'name', 'ubigeo')
            ->where('is_active', '=', true)
            ->where('province_id', '=', (int)$id)
            ->orderBy('ubigeo')->get();


        return response()->json($department);
    }
}
