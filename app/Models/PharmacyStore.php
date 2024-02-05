<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyStore extends Model
{
    use HasFactory;

    protected $table = 'pharmacies_store';

    protected $fillable = [
        'id', 'code', 'description',
        'format', 'type', 'address',
        'department_id', 'province_id', 'district_id', 'opening_date'
    ];

    protected $hidden = [
        'is_active',
        'created_at',
        'updated_at',
    ];
}
