<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReminderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'reminder_id',
        'position',
        'horario',
        'dosis',
        'is_active'
    ];

    protected $casts = [
        'id' => 'integer',
//        'user_id' => 'integer',
//        'reminder_id' => 'integer',
//        'position' => 'integer',
//        'horario' => 'string',
//        'dosis' => 'string',
//        'is_active' => 'boolean'
    ];

}
