<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;


    protected $fillable = [
        'id', 'name',
    ];

    protected $hidden = [
        'is_active',
        'created_at',
        'updated_at',
    ];
}
