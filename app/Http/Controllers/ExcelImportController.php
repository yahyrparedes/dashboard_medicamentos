<?php

namespace App\Http\Controllers;

use App\Imports\PharmacyImportClass;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class ExcelImportController extends Controller
{
    public function index()
    {
        return view('imports.pharmacy');
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

        $headings = (new HeadingRowImport())->toArray($file);
        Excel::import(new PharmacyImportClass(), $file);

        return redirect()->back()->with('success', 'Excel file imported successfully!');
    }
}
