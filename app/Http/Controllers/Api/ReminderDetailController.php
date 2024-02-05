<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReminderDetailController extends Controller
{

    public function listByReminder(Request $request, $reminder): \Illuminate\Http\JsonResponse
    {
        $department = DB::table('reminder_details')
            ->select('reminder_details.id',
                'reminder_details.user_id',
                'reminder_details.reminder_id',
                'reminder_details.position',
                'reminder_details.horario',
                'reminder_details.dosis',
                'reminder_details.is_active')
            ->where('reminder_id', '=', $reminder)
            ->where('is_active', '=', true)
            ->orderBy('id')->get();

        return response()->json($department);
    }

    public function detail(Request $request, $id): \Illuminate\Http\JsonResponse
    {

        $department = DB::table('reminder_details')
            ->select('reminder_details.id',
                'reminder_details.user_id',
                'reminder_details.reminder_id',
                'reminder_details.position',
                'reminder_details.horario',
                'reminder_details.dosis',
                'reminder_details.is_active')
            ->where('id', '=', $id)
            ->where('is_active', '=', true)->first();

        return response()->json($department);
    }

    public function list(): \Illuminate\Http\JsonResponse
    {
        $department = DB::table('reminder_details')
            ->select('reminder_details.id',
                'reminder_details.user_id',
                'reminder_details.reminder_id',
                'reminder_details.position',
                'reminder_details.horario',
                'reminder_details.dosis',
                'reminder_details.is_active')
            ->where('is_active', '=', true)
            ->orderBy('id')->get();

        return response()->json($department);
    }


    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();

        $remainderDetailId = DB::table('reminder_details')
            ->insertGetId([
                'user_id' => $data['user_id'],
                'reminder_id' => $data['reminder_id'],
                'position' => $data['position'],
                'horario' => $data['horario'],
                'dosis' => $data['dosis'],
                'is_active' => true,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        $remainderDetail = DB::table('reminder_details')
            ->select('reminder_details.id',
                'reminder_details.user_id',
                'reminder_details.reminder_id',
                'reminder_details.position',
                'reminder_details.horario',
                'reminder_details.dosis',
                'reminder_details.is_active')
            ->where('id', '=', $remainderDetailId)
            ->first();


        return response()->json($remainderDetail);
    }

}
