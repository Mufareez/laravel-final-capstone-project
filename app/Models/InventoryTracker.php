<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTracker extends Model
{

    protected $fillable = [
        'product_id',
        'inventory_type',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}


