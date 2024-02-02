<?php

namespace App\Http\Controllers\Web\Ubigeo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $province = DB::table('provinces')
            ->select('id', 'department_id', 'ubigeo', 'name', 'is_active')
            ->orderBy('name')
            ->paginate(50);


        return view('ubigeo.province', compact('province'));

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
            'active' => 'required',
        ]);
        $department = DB::table('provinces')
            ->where('id', '=', (int)$id)
            ->update(['active' => $request->get('is_active')]);

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
        $province = DB::table('provinces')
            ->where('department_id', '=', (int)$id)
            ->select('id', 'department_id', 'ubigeo', 'name', 'is_active')
            ->orderBy('name')
            ->simplePaginate(50);
        return view('ubigeo.province', compact('province'));
    }


}

