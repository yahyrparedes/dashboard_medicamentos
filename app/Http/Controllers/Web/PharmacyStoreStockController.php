<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PharmacyStoreStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = DB::table('pharmacies_store_stock')
            ->join('medications', 'pharmacies_store_stock.medication_id', '=', 'medications.id')
            ->join('pharmacies_store', 'pharmacies_store_stock.pharmacies_store_id', '=', 'pharmacies_store.id')
            ->select('pharmacies_store_stock.id','pharmacies_store.code', 'pharmacies_store.description', 'medications.name', 'pharmacies_store_stock.stock', 'pharmacies_store_stock.is_active')
            ->paginate(50);
        return view('pharmacy.pharmacy-store-stock', compact('department'));
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

        $department = DB::table('pharmacies_store_stock')
            ->where('id', '=', (int)$id)
            ->update(['is_active' => $request->get('is_active')]);

        return Redirect::back()->with('success', 'Contact updated! ' . $department);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $department = DB::table('pharmacies_store_stock')
            ->select('pharmacies_store_stock.id', 'pharmacies_store.description', 'medications.name',  'pharmacies_store.code', 'pharmacies_store_stock.stock', 'pharmacies_store_stock.is_active')
            ->join('medications', 'pharmacies_store_stock.medication_id', '=', 'medications.id')
            ->join('pharmacies_store', 'pharmacies_store_stock.pharmacies_store_id', '=', 'pharmacies_store.id')
            ->where('pharmacies_store_id', '=', DB::raw($id))
            ->simplePaginate(50);

        return view('pharmacy.pharmacy-store-stock', compact('department'));
    }

}

