<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
     protected $table = 'brands';
    protected $fillable = ['brand_name', 'description'];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id'); // getting products related to this brand
    }
}
