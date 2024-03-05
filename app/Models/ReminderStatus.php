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

}
