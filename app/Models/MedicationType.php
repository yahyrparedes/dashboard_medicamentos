<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function medications()
    {
        return $this->hasMany( Medication::class, 'medication_type_id' );
    }

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];

}
