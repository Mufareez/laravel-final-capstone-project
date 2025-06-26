<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'customer_id',
        'sale_date',
        'invoice_number',
        'total',
        'final_discount',
        'final_total',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }
}
