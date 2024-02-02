<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'name'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    protected $hidden = [
        'is_active',
        'created_at',
        'updated_at',
    ];
}
