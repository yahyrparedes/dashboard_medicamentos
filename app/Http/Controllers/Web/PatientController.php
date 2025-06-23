<?php

namespace App\Http\Controllers\Web;

use App\Exports\PatientsDoctorMedicamentExport;
use App\Http\Controllers\Controller;
use App\Utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller
{
    public function index(Request $request)
    {
        $patients = $this->getFilteredPatients($request);
        return view('users.patient', compact('patients'));
    }


    private function getFilteredPatients(Request $request)
    {
        $role = DB::table('roles')
            ->where('name', '=', Constants::ROLE_PATIENT)
            ->first();

        $query = DB::table('users')
            ->join('model_has_roles', function ($join) use ($role) {
                $join->on('model_has_roles.model_id', '=', 'users.id')
                    ->where('model_has_roles.role_id', '=', $role->id);
            })
            ->select('users.*');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('users.name', 'like', '%' . $request->search . '%')
                    ->orWhere('users.last_name', 'like', '%' . $request->search . '%')
                    ->orWhere('users.email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('sort')) {
            $query->orderBy('users.name', $request->sort);
        } else {
            $query->orderBy('users.id', 'asc');
        }

        $perPage = $request->input('per_page', 50);

        return $query->paginate($perPage)->appends($request->all());
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'active' => 'required',
        ]);

        $department = DB::table('users')
            ->where('id', '=', (int)$id)
            ->update(['is_active' => $request->get('active')]);

        return Redirect::back()->with('success', 'Contact updated! ' . $department);
    }

    public function reports(Request $request, $id)
    {
        $filename = 'paciente_' . $id . '_' . Date::now()->getTimestamp() . '.csv';
        return Excel::download(new PatientsDoctorMedicamentExport($id), $filename);
    }

    public function resetPassword($id)
    {
        $newPassword = Str::random(8);
        DB::table('users')
            ->where('id', $id)
            ->update(['password' => Hash::make($newPassword)]);
        return back()->with('success', 'Contraseña reseteada: ' . $newPassword);
    }
}

