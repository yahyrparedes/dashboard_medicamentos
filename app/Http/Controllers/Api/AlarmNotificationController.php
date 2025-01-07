<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AlarmNotificationController extends Controller
{
    public function notification(Request $request, $user_id ): \Illuminate\Http\JsonResponse
    {
        $remainder = DB::table('reminders')
            ->select('reminders.id',
                'reminders.user_id',
                'reminders.medication_id',
                'reminders.start_date',
                'reminders.end_date',
                'reminders.duration',
                'reminders.frequency',
                'reminders.count',
                'reminders.frequency_daily',
                'reminders.is_active')
            ->where('is_active', '=', true)
            ->where('user_id', '=', $user_id)
            ->orderBy('id')->get();



        return response()->json($department);



    }

}
