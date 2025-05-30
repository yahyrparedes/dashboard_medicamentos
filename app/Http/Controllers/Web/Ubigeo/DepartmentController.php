<?php

namespace App\Http\Controllers\Web\Ubigeo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
//        $department = DB::table('departments')
//            ->select('id', 'name', 'ubigeo', 'is_active')
//            ->orderBy('ubigeo')
//            ->paginate(50);
//        return view('ubigeo.department', compact('department'));
//
//    }
    public function index(Request $request)
    {
        $query = DB::table('departments')
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

        return view('ubigeo.department', compact('department'));
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
        $department = DB::table('departments')
            ->where('id', '=', (int)$id)
            ->update(['is_active' => $request->get('is_active')]);

        return Redirect::back()->with('success', 'Contact updated! ' . $department);
    }

}

