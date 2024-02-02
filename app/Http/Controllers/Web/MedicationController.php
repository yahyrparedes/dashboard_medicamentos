<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MedicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $department = DB::table('medications')
            ->select('id', 'name',  'is_active')
            ->paginate(50);
        return view('commons.medication', compact('department'));

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

        $department = DB::table('medications')
            ->where('id', '=', (int)$id)
            ->update(['is_active' => $request->get('active')]);

        return Redirect::back()->with('success', 'Contact updated! ' . $department);
    }

}

