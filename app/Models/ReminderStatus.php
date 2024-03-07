<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReminderStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'reminder_id',
        'reminder_detail_id',
        'position',
        'horario',
        'type',
        'is_active',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
        'reminder_id' => 'integer',
        'reminder_detail_id' => 'integer',
//        'position' => 'integer',
//        'horario' => 'string',
//        'type' => 'string',
//        'is_active' => 'boolean',
    ];

}
