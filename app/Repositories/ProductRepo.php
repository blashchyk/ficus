<?php


namespace App\Repositories;


use App\Models\Products;
use App\Repositories\Contract\ProductRepoInterface;

class ProductRepo extends AbstractRepository implements ProductRepoInterface
{
    protected $class = Products::class;

    public function all($columns = ['*'])
    {
        return parent::all($columns); // TODO: Change the autogenerated stub
    }
}

