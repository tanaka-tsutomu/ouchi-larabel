<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function ProductCategory(){
        return $this->belongsTo(ProductCategory::class);
    }
}