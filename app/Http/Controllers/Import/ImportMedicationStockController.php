<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\MedicationClass;
use App\Imports\PharmacyStoreClass;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;

class ImportMedicationStockController extends Controller
{
    public function index()
    {
        return view('imports.medication-stock');
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

        Excel::import(new MedicationClass(), $file);

        return redirect()->back()->with('success', 'Importación completada correctamente.');
    }
}
