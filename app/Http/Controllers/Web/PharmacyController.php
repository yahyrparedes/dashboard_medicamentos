<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        $department = DB::table('pharmacies')
//            ->select('id', 'name',  'is_active')
//            ->paginate(50);
//        return view('pharmacy.pharmacy', compact('department'));
//
//    }

    public function index(Request $request)
    {
        $pharmacies = $this->getFilteredPharmacies($request);
        return view('pharmacy.pharmacy', ['department' => $pharmacies]);
    }

    private function getFilteredPharmacies(Request $request)
    {
        $query = \DB::table('pharmacies')->select('id', 'name', 'is_active');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('sort')) {
            $query->orderBy('name', $request->sort);
        } else {
            $query->orderBy('id', 'asc');
        }

        $perPage = $request->input('per_page', 50);

        return $query->paginate($perPage)->appends($request->all());
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

        $department = DB::table('pharmacies')
            ->where('id', '=', (int)$id)
            ->update(['is_active' => $request->get('is_active')]);

        return Redirect::back()->with('success', 'Contact updated! ' . $department);
    }

}

