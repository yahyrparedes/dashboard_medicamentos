<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medication;
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
        if ($request->department_id == 0) {
            return response()->json([], 400);
        }

        $medications = $request->productos;
        $pharmacies = $request->pharmacies;
        $department_id = $request->department_id;
        $province_id = $request->province_id;
        $district_id = $request->district_id;

        $query = DB::table('pharmacies_store')
            ->select('pharmacies_store.id', 'pharmacies_store.code', 'pharmacies_store.description',
                'pharmacies_store.address', 'pharmacies.name as format')
            ->where('pharmacies_store.is_active', '=', true)
            ->where('pharmacies_store.department_id', '=', $department_id);

        if (trim($medications) != "") {
            $m = explode(',', trim($medications));
            $query->join('pharmacies_store_stock', function ($join) use ($m) {
                $join->on('pharmacies_store_stock.pharmacies_store_id', '=', 'pharmacies_store.id')
                    ->whereIn('pharmacies_store_stock.medication_id', $m);
            });
        }

        if ($province_id != 0) {
            $query->where('pharmacies_store.province_id', '=', $province_id);
        }

        if ($district_id != 0) {
            $query->where('pharmacies_store.district_id', '=', $district_id);
        }

        if (trim($pharmacies) != "") {
            $p = explode(',', trim($pharmacies));
            $query->join('pharmacies', function ($join) use ($p) {
                $join->on('pharmacies_store.pharmacy_id', '=', 'pharmacies.id')
                    ->whereIn('pharmacies.id', $p);
            });
        } else {
            $query->join('pharmacies', 'pharmacies_store.pharmacy_id', '=', 'pharmacies.id');
        }

        $list = $query->get();

        if ($list->count() == 0) {
            return response()->json([], 200);
        }

        return response()->json($list);
    }

    public function detail(Request $request, $id): \Illuminate\Http\JsonResponse
    {

        $detail = DB::table('pharmacies_store')
            ->select('pharmacies_store.id', 'pharmacies_store.code', 'pharmacies_store.description',
                'pharmacies.name as format', 'pharmacies_store.address', 'pharmacies_store.department_id',
//                'departments.name as department', 'provinces.name as province', 'districts.name as district'
            )
            ->join('pharmacies', 'pharmacies_store.pharmacy_id', '=', 'pharmacies.id')
//            ->join('departments', 'pharmacies_store.department_id', '=', 'departments.id')
//            ->join('provinces', 'pharmacies_store.province_id', '=', 'provinces.id')
//            ->join('districts', 'pharmacies_store.district_id', '=', 'districts.id')
            ->where('pharmacies_store.is_active', '=', true)
            ->where('pharmacies_store.id', '=', $id)
            ->first();

        if ($detail == null) {
            return response()->json([], 400);
        }
        if ($detail->description != null) {
            $exp = explode(" ", $detail->description);
            if (count($exp) > 0) {
                unset($exp[0]);
                $detail->description = implode(" ", $exp);
            }
        }

        if ($detail->format == 'Inkafarma') {
            if ($detail->department_id == 15) {
                $detail->phone = '(01) 3142020';
                $detail->web = 'www.inkafarma.pe';
            } else {
                $detail->phone = '';
                $detail->web = '';
            }
        } else if ($detail->format == 'Mifarma') {
            if ($detail->department_id == 15) {
                $detail->phone = '(01) 6125000';
                $detail->web = 'www.mifarma.com.pe';
            } else {
                $detail->phone = '';
                $detail->web = '';
            }
        } else {
            $detail->phone = '';
            $detail->web = '';
        }

        $detail->medications = DB::table('pharmacies_store_stock')
            ->select('medications.id', 'medications.name', 'pharmacies_store_stock.stock')
            ->join('medications', 'pharmacies_store_stock.medication_id', '=', 'medications.id')
            ->where('pharmacies_store_stock.pharmacies_store_id', '=', $id)
            ->where('pharmacies_store_stock.stock', '>', 0)
            ->where('medications.is_active', '=', true)
            ->get();

//        $detail->medications = DB::table('medications')
//            ->select('medications.id', 'medications.name')
//            ->where('medications.is_active', '=', true)
//            ->get();


        return response()->json($detail);
    }

}

