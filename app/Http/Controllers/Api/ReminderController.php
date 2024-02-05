<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReminderController extends Controller
{
    public function detail(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $department = DB::table('reminders')
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
            ->where('id', '=', $id)
            ->orderBy('id')->get();

        return response()->json($department);
    }

    public function list(): \Illuminate\Http\JsonResponse
    {
        $department = DB::table('reminders')
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
            ->orderBy('id')->get();

        return response()->json($department);
    }

    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();

        if (strlen($data['medication_id']) > 1) {
            $medicationId = DB::table('medication_types')
                 ->where('name', 'like', '%'.$data['medication_id'].'%')->first();
            $data['medication_id'] = $medicationId->id;
        }

        $remainderId = DB::table('reminders')
            ->insertGetId([
                'user_id' => $data['user_id'],
                'medication_id' => $data['medication_id'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'duration' => $data['duration'],
                'frequency' => $data['frequency'],
                'count' => $data['count'],
                'frequency_daily' => $data['frequency_daily'],
                'is_active' => $data['is_active'] == 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

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
            ->where('id', '=', $remainderId)
            ->first();
        return response()->json($remainder);
    }

    public function filter(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $weekMap = [ 0 => 'D',1 => 'L',2 => 'M',3 => 'X',4 => 'J',5 => 'V',6 => 'S',];

        $dayOfTheWeek = Carbon::parse($data['date'])->dayOfWeek;
        $weekday = $weekMap[$dayOfTheWeek];

        $remainder = DB::table('reminder_details')
            ->select(
                'reminder_details.id',
                'reminder_details.user_id',
                'reminder_details.reminder_id',
                'reminder_details.position',
                'reminder_details.horario',
                'reminder_details.dosis',
                'reminder_details.is_active',
                'reminders.medication_id',
                'medications.name as medication',
                'reminders.start_date',
                'reminders.end_date',
                'reminders.duration',
                'reminders.frequency',
                'reminders.count',
                'reminders.frequency_daily')
            ->join('reminders', function ($join) use ($data, $weekday) {
                $join->on('reminder_details.reminder_id', '=', 'reminders.id')
                    ->where('reminders.frequency' ,  'like' , '%' . $weekday . '%')
                    ->whereRaw('? between `reminders`.`start_date` and `reminders`.`end_date`', $data['date'])
                    ->where('reminders.user_id', '=', $data['user_id'])
                    ->where('reminders.is_active', '=', true);
            })
            ->join('medications', 'reminders.medication_id', '=', 'medications.id')
            ->where('reminder_details.user_id', '=', $data['user_id'])
            ->where('reminder_details.is_active', '=', true)
//            ->orderBy('reminder_details.position')
            ->get();

        return response()->json($remainder );
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $data = $request->all();
        $remainder = DB::table('reminders')
            ->where('id', $id)
            ->update([
                'user_id' => $data['user_id'],
                'medication_id' => $data['medication_id'],
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'duration' => $data['duration'],
                'frequency' => $data['frequency'],
                'count' => $data['count'],
                'frequency_daily' => $data['frequency_daily'],
                'is_active' => $data['is_active'] == 1,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

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
            ->where('id', '=', $id)
            ->first();
        return response()->json($remainder);
    }

    public function delete(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $remainder = DB::table('reminders')
            ->where('id', $id)
            ->update([
                'is_active' => false,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        $remainderDetail = DB::table('reminder_details')
            ->where('reminder_id', $id)
            ->update([
                'is_active' => false,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return response()->json(['remainder' => $remainder, 'remainder-detail' => $remainderDetail, 'message' => 'Record deleted successfully']);
    }

}
