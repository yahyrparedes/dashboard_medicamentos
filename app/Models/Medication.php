<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name', 'medication_type_id'
    ];

    public function medicationsType() {
        return $this->belongsTo(MedicationType::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
