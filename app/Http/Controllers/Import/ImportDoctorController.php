<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\DoctorClass;
use App\Imports\PharmacyStoreClass;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class ImportDoctorController extends Controller
{
    public function index()
    {
        return view('imports.doctor');
    }

    /**
     * Import Excel file into the database
     *
     * @param Request $request
     * @return void
     */

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Get the uploaded file
        $file = $request->file('file');

        Excel::import(new DoctorClass(), $file);

        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }
}
