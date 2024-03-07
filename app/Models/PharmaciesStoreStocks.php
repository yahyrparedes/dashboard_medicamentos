<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmaciesStoreStocks extends Model
{
    use HasFactory;

    protected $table = 'pharmacies_store_stock';

    protected $fillable = [
        'medication_id',
        'pharmacies_store_id',
        'stock',
        'is_active'
    ];
    protected $casts = [
        'id' => 'integer',
    ];
}
