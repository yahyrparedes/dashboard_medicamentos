<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'medication_type_id', 'user_id', 'is_active', 'created_by'
    ];

    public function medicationsType() {
        return $this->belongsTo(MedicationType::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'id' => 'integer',
    ];
}
