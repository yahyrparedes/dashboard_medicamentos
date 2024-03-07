<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DocumentType extends Model
{
    use HasFactory;

    protected $fillable = [
         'id', 'name', 'is_active'
    ];

    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
    ];


    // 1 => DNI
    // 2 => CARNE DE EXTRANJERIA

}
