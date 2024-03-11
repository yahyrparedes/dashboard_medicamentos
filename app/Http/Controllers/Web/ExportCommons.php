<?php

namespace App\Http\Controllers\Web;

use App\Exports\PatientsDoctorMedicamentExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportCommons extends Controller
{


    function patientDoctorAndMedication(Request $request)
    {
        $role = DB::table('roles')
            ->select('id')
            ->where('name', '=', Constants::ROLE_PATIENT)
            ->first();

        $query = DB::table('users')
            ->join('model_has_roles', function ($join) use ($role) {
                $join->on('model_has_roles.model_id', '=', 'users.id')
                    ->where('model_has_roles.role_id', '=', $role->id);
            })
            ->join('user_doctor', 'users.id', '=', 'user_doctor.user_id')
            ->join('medications', 'user_doctor.id', '=', 'medications.user_doctor_id')
            ->whereBetween('users.created_at', [$request->get('start_date'), $request->get('end_date')])
            ->where('users.is_active', '=', true)
            ->get();

        $filename = 'reporte_pacientes_' . Date::now()->getTimestamp() . '.csv';

        $data = new PatientsDoctorMedicamentExport($query);
        return Excel::download($data, $filename);

    }

}
