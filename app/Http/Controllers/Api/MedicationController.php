<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Medication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicationController extends Controller
{

    public function list(): \Illuminate\Http\JsonResponse
    {
//        $department = Medication::all();
        $department = DB::table('medications')
            ->select('medications.id', 'medications.name', 'medication_types.id as medication_type_id', 'medication_types.name as medication_type_name')
            ->join('medication_types', function ($join)   {
                $join->on('medications.medication_type_id', '=', 'medication_types.id')
                ->where('medication_types.is_active', '=', true);
            })
            ->where('medications.is_active', '=', true)
            ->where('medications.created_by', '=', null)
            ->orderBy('medications.id')->get();

        return response()->json($department);
    }

    public function types(): \Illuminate\Http\JsonResponse
    {
        $department = DB::table('medication_types')
            ->select('id', 'name')
            ->where('is_active', '=', true)
            ->orderBy('id')->get();

        return response()->json($department);
    }

    public function units(): \Illuminate\Http\JsonResponse
    {
        $department = DB::table('medication_units')
            ->select('id', 'name', )
            ->where('is_active', '=', true)
            ->orderBy('id')->get();

        return response()->json($department);
    }

}
