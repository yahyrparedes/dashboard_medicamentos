<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GenderController extends Controller
{

    public function list(): \Illuminate\Http\JsonResponse
    {
        $department = DB::table('genders')
            ->select('id', 'name')
            ->where('is_active', '=', true)
            ->orderBy('id')->get();

        return response()->json($department);
    }

}
