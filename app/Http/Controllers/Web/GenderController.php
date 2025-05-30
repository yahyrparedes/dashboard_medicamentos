<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $query = DB::table('genders')
            ->select('id', 'name', 'is_active');

        // Filtro de búsqueda
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Orden
        if ($request->filled('sort')) {
            $query->orderBy('name', $request->sort);
        } else {
            $query->orderBy('id', 'asc');
        }

        // Cantidad por página
        $perPage = $request->input('per_page', 50);

        $department = $query->paginate($perPage)->appends($request->all());

        return view('commons.gender', compact('department'));
    }

//    public function index()
//    {
//        $department = DB::table('genders')
//            ->select('id', 'name',  'is_active')
//            ->paginate(50);
//        return view('commons.gender', compact('department'));
//
//    }

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

        $department = DB::table('genders')
            ->where('id', '=', (int)$id)
            ->update(['is_active' => $request->get('active')]);

        return Redirect::back()->with('success', 'Contact updated! ' . $department);
    }

}

