<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PharmacyController extends Controller
{
    public function list(Request $request): \Illuminate\Http\JsonResponse
    {
        $list = DB::table('pharmacies')
            ->select('id', 'name')
            ->where('pharmacies.is_active', '=', true)
            ->get();
        return response()->json($list);
    }


    public function stores(Request $request): \Illuminate\Http\JsonResponse
    {

        $pharmacies_list = [array("id" => 1, "name" => "Inkafarma"), array("id" => 2, "name" => "MiFarma")];

        if ($request->department_id == 0) {
            return response()->json([], 400);
        }

        $medications = $request->medications;
        $pharmacies = array();
        if ($request->pharmacies != null || $request->pharmacies != "") {
            $p = explode(',', $request->pharmacies);
            foreach ($pharmacies_list as $pharmacy) {
                foreach ($p as $ph) {
                    if ($pharmacy['id'] == $ph) {
                        array_push($pharmacies, $pharmacy['name']);
                    }
                }
            }
        }


        $department_id = $request->department_id;
        $province_id = $request->province_id;
        $district_id = $request->district_id;

        $query = DB::table('pharmacies_store')
            ->select('pharmacies_store.id', 'pharmacies_store.code', 'pharmacies_store.description',
                'pharmacies_store.format', 'pharmacies_store.address')
            ->where('pharmacies_store.is_active', '=', true)
            ->where('pharmacies_store.department_id', '=', $department_id);

        if ($province_id != 0) {
            $query->where('pharmacies_store.province_id', '=', $province_id);
        }

        if ($district_id != 0) {
            $query->where('pharmacies_store.district_id', '=', $district_id);
        }

        if (sizeof($pharmacies) > 0) {
            $query->whereIn('pharmacies_store.format', $pharmacies);
        }

        $list = $query->get();

//            ->where('users.name', '=', $name)
//            ->orWhere('users.name', 'like', '%' . $name . '%')
//            ->join('departments', function ($join) use ($department_id) {
//                $join->on('pharmacies_store.department_id', '=', 'departments.id')
//                    ->where('departments.is_active', '=', true);
//                if ($department_id != 0) {
//                  $join->where('departments.id', '=', $department_id);
//                }
//            })
//
//            ->join('provinces', function ($join) use ($province_id) {
//                $join->on('pharmacies_store.province_id', '=', 'provinces.id')
//                    ->where('provinces.is_active', '=', true);
//                if ($province_id != 0) {
//                    $join->where('provinces.id', '=', $province_id);
//                }
//            })

        return response()->json($list);
    }

}
//CREATE USER 'medicamentos'@'%' IDENTIFIED BY 'medicamentos';
