<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PharmacyStoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = DB::table('pharmacies_store')
            ->join('pharmacies', 'pharmacies_store.pharmacy_id', '=', 'pharmacies.id')
            ->join('departments', 'pharmacies_store.department_id', '=', 'departments.id')
            ->join('provinces', 'pharmacies_store.province_id', '=', 'provinces.id')
            ->join('districts', 'pharmacies_store.district_id', '=', 'districts.id')
            ->select('pharmacies_store.*', 'pharmacies.name as pharmacy_name', 'departments.name as department_name', 'provinces.name as province_name', 'districts.name as district_name')
            ->orderBy('department_id')
            ->orderBy('province_id')
            ->orderBy('district_id')
            ->paginate(50);
        return view('pharmacy.pharmacy-store', compact('department'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'is_active' => 'required',
        ]);

        $department = DB::table('pharmacies_store')
            ->where('id', '=', (int)$id)
            ->update(['is_active' => $request->get('is_active')]);

        return Redirect::back()->with('success', 'Contact updated! ' . $department);
    }

}

