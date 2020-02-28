<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTypes extends Model
{
    protected $fillable = [
        'name'
    ];
    public $timestamps = true;

    public function products()
    {
        return $this->hasMany(Products::class);
    }
}
