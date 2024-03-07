<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'medication_id',
        'start_date',
        'end_date',
        'duration',
        'frequency',
        'horario',
        'count',
        'frequency_daily',
        'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function medication()
    {
        return $this->belongsTo(Medication::class);
    }

    public function reminderDetails()
    {
        return $this->hasMany(ReminderDetail::class);
    }

    protected $casts = [
        'id' => 'integer',
//        'user_id' => 'integer',
//        'medication_id' => 'integer',
//        'start_date' => 'date',
//        'end_date' => 'date',
//        'duration' => 'integer',
//        'frequency' => 'integer',
//        'horario' => 'string',
//        'count' => 'integer',
//        'frequency_daily' => 'integer',
//        'is_active' => 'boolean'
    ];

}
