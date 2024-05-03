<?php

namespace App\Imports;

use App\Models\PharmaciesStoreStocks;
use App\Models\PharmacyStore;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MedicationClass implements ToModel /*, WithHeadingRow */
{


    public function model(array $row)
    {
        set_time_limit(720);
        ini_set('memory_limit', '2048M');

        if ($row[1] == '' || $row[1] == '*' || $row[1] == null) {
            return null;
        }

        $medications = DB::table('medications')->where('is_active', true)->get();
        $medicationId = null;

        foreach ($medications as $medication) {

            if (str_contains(strtolower($row[1]), strtolower($medication->name))) {
                $medicationId = $medication->id;
                break;
            }
        }

        if ($medicationId == null) {
            return null;
        }

        if ($row[0] == '' || $row[0] == '*' || $row[0] == null) {
            return null;
        }

        $pharmacyStore = PharmacyStore::where('code', $row[0])->first();

        if ($pharmacyStore == null) {
            return null;
        }

        $pharmacyStoreId = $pharmacyStore->id;

        print_r($pharmacyStoreId, $medicationId);
        $pharmacy = PharmaciesStoreStocks::updateOrCreate(
            ['pharmacies_store_id' => $pharmacyStoreId, 'medication_id' => $medicationId],
            [  'stock' => $row[2], 'is_active' => true]);

        return $pharmacy;
    }

    public function headingRow(): int
    {
        return 1;
    }
}
