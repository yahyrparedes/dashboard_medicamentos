<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    use HasFactory;

    protected $table = 'reminders';

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
        'is_active',
        'reminder_details_id'
    ];

    public function reminderDetails()
    {
        return $this->belongsTo(ReminderDetail::class);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    protected $casts = [
        'id' => 'integer',
    ];

}
