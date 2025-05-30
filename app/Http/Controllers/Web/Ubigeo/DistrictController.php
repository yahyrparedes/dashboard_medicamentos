<?php

namespace App\Http\Controllers\Web\Ubigeo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        $district = DB::table('districts')
//            ->select('id', 'province_id', 'name', 'ubigeo', 'is_active')
//            ->orderBy('name')
//            ->paginate(20);
//        return view('ubigeo.district', compact('district'));
//    }
    public function index(Request $request)
    {
        $district = $this->getFilteredDistricts($request);
        return view('ubigeo.district', compact('district'));
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        $district = DB::table('districts')
//            ->where('province_id', '=', (int)$id)
//            ->select('id', 'province_id', 'ubigeo', 'name', 'is_active')
//            ->orderBy('name')
//            ->simplePaginate(50);
//        return view('ubigeo.district', compact('district'));
//    }
    public function show($id, Request $request)
    {
        $district = $this->getFilteredDistricts($request, $id);
        // return view('ubigeo.district', compact('district'));
        return view('ubigeo.district', [
            'district' => $district,
            'provinceId' => $id
        ]);
    }


    private function getFilteredDistricts(Request $request, $provinceId = null)
    {
        $query = DB::table('districts')
            ->select('id', 'name', 'province_id', 'ubigeo', 'is_active');

        if ($provinceId !== null) {
            $query->where('province_id', '=', (int)$provinceId);
        }

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
        $district = DB::table('districts')
            ->where('id', '=', (int)$id)
            ->update(['is_active' => $request->get('is_active')]);

        return Redirect::back()->with('success', 'Contact updated! ' . $district);
    }


}

