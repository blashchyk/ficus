<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    protected $fillable = [
        'product_id',
        'weight',
        'height',
        'price'
    ];

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
