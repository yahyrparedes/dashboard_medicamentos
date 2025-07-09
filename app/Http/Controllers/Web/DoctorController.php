<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Utils\Constants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DoctorController extends Controller
{


//    public function index()
//    {
//        $role = DB::table('roles')
//            ->select('id')
//            ->where('name', '=', Constants::ROLE_DOCTOR)
//            ->first();
//
//        $doctors = DB::table('users')
//            ->join('model_has_roles', function ($join) use ($role) {
//                $join->on('model_has_roles.model_id', '=', 'users.id')
//                    ->where('model_has_roles.role_id', '=', $role->id);
//            })
////            ->where('users.is_active', '=', true)
//            ->paginate(50);
//
//        return view('users.doctor', compact('doctors'));
//
//    }

    public function index(Request $request)
    {
        $doctors = $this->getFilteredDoctors($request);
        return view('users.doctor', compact('doctors'));
    }

    private function getFilteredDoctors(Request $request)
    {
        $role = DB::table('roles')
            ->where('name', '=', Constants::ROLE_DOCTOR)
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
                    ->orWhere('users.cmp', 'like', '%' . $request->search . '%')
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

}

