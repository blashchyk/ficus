<?php

use Illuminate\Database\Seeder;
use App\Models\ProductTypes;
use Carbon\Carbon;

class ProductTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Phone',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Laptop',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'Pad',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'name' => 'TV',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];
        ProductTypes::insert($data);
    }
}
