<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'sku',
        'product_name',
        'product_image',
        'category_id',
        'brand_id',
        'cost_price',
        'selling_price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');//getting category details from categories table using category_id
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id'); //getting brand details from brands table using brand_id
    }
}
