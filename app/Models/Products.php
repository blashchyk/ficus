<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $fillable = [
        'name',
        'type_id'
    ];

    public function type()
    {
        return $this->hasOne(ProductTypes::class);
    }

    public function attributes()
    {
        return $this->hasOne(ProductAttributes::class);
    }
}
