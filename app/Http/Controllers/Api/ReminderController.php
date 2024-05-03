<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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

        if ($data['medication_id'] == 5 || $data['medication_id'] == '5') {
            $medicationId = DB::table('medications')
                ->insertGetId([
                    'name' => $data['medication_name'],
                    'medication_type_id' =>  $data['medication_id'],
                    'is_active' => true,
                    'created_by' => $data['user_id'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            $data['medication_id'] = $medicationId;
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
        $weekMap = [0 => 'D', 1 => 'L', 2 => 'M', 3 => 'X', 4 => 'J', 5 => 'V', 6 => 'S',];
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
                    ->where('reminders.frequency', 'like', '%' . $weekday . '%')
                    ->whereRaw('? between `reminders`.`start_date` and `reminders`.`end_date`', $data['date'])
                    ->where('reminders.user_id', '=', $data['user_id'])
                    ->where('reminders.is_active', '=', true);
            })
            ->join('medications', 'reminders.medication_id', '=', 'medications.id')
            ->where('reminder_details.user_id', '=', $data['user_id'])
            ->where('reminder_details.is_active', '=', true)
            ->get();


        foreach ($remainder as $key => $value) {
            $remainder[$key]->status = DB::table('reminder_status')
                ->select('type')
                ->where('reminder_id', '=', $value->reminder_id)
                ->where('reminder_detail_id', '=', $value->id)
                ->where('position', '=', $remainder[$key]->position)
                ->where('schedule', '=', $remainder[$key]->horario)
                ->whereDate('date', '=', $data['date'])
                ->first()->type ?? 'pending';
        }

        return response()->json($remainder);
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

    public function status(Request $request): \Illuminate\Http\JsonResponse
    {
        $validatedData = Validator::make($request->all(), [
            'id' => ['required', 'integer'],
            'detail_id' => ['required', 'integer'],
            'type' => ['required', 'string', 'max:255'],
            'description' => ['string', 'max:255'],
            'date' => ['required'],
        ]);

        $weekMap = [0 => 'D', 1 => 'L', 2 => 'M', 3 => 'X', 4 => 'J', 5 => 'V', 6 => 'S',];
        $dayOfTheWeek = Carbon::parse($request->date)->dayOfWeek;
        $weekday = $weekMap[$dayOfTheWeek];

        if ($validatedData->fails()) {
            return response()->json($validatedData->errors(), 400);
        }

        $remainderDetail = DB::table('reminder_details')->where('id', $request->detail_id)->first();

        $data = [
            'reminder_id' => $request->id,
            'reminder_detail_id' => $request->detail_id,
            'type' => $request->type,
            'date' => $request->date,
            'position' => $remainderDetail->position,
            'is_active' => true,
            'schedule' => $remainderDetail->horario,
            'frequency' => $weekday,
            'created_at' => now(),
        ];

        if ($request->description) {
            $data['description'] = $request->description;
        }

        $reminderStatus = DB::table('reminder_status')->insert($data);

        return response()->json(
            ['reminder_status' => $reminderStatus,
                'status' => $request->type,
                'message' => 'Record deleted successfully']);
    }

    public function fullDetail(Request $request,  $id): \Illuminate\Http\JsonResponse
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
                'reminders.is_active',
                'medications.name as medication',
                'medications.medication_type_id',
                'medications.is_active as medication_is_active')
            ->join('medications', 'reminders.medication_id', '=', 'medications.id')
            ->where('reminders.id', '=', $id)
            ->first();

        if ($remainder == null) {
            return  response()->json([], 404);
        }

        $remainder->details = DB::table('reminder_details')
            ->select(
                'reminder_details.id',
                'reminder_details.user_id',
                'reminder_details.reminder_id',
                'reminder_details.position',
                'reminder_details.horario',
                'reminder_details.dosis',
                'reminder_details.is_active')
            ->where('reminder_details.reminder_id', '=', $id)
            ->where('reminder_details.is_active', '=', true)
            ->get();

        return response()->json($remainder);
    }

}
