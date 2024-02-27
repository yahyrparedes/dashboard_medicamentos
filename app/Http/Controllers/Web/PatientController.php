<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class PatientController extends Controller
{
    public function index()
    {
        $role = DB::table('roles')
            ->where('name', '=', Constants::ROLE_PATIENT)
            ->first();

        $patients = DB::table('users')
            ->join('model_has_roles', function ($join) use ($role) {
                $join->on('model_has_roles.model_id', '=', 'users.id')
                    ->where('model_has_roles.role_id', '=', $role->id);
            })
            ->where('users.is_active', '=', true)
            ->paginate(50);

        return view('users.patient', compact('patients'));
    }

    public function update(Request $request, $id): \Illuminate\Http\Response
    {
        $request->validate([
            'active' => 'required',
        ]);

        $department = DB::table('users')
            ->where('id', '=', (int)$id)
            ->update(['is_active' => $request->get('active')]);

        return Redirect::back()->with('success', 'Contact updated! ' . $department);
    }

}

