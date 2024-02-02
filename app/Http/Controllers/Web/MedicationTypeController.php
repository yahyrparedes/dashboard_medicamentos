<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MedicationTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = DB::table('medication_types')
            ->select('id', 'name',  'is_active')
            ->paginate(50);
        return view('commons.medication_type', compact('department'));

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

        $department = DB::table('medication_types')
            ->where('id', '=', (int)$id)
            ->update(['is_active' => $request->get('active')]);

        return Redirect::back()->with('success', 'Contact updated! ' . $department);
    }

}

