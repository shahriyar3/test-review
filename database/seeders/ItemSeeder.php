<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::query()->insert([
            [
                'order_id' => 1,
                'product_id' => 1,
                'quantity' => 1,
                'price' => 100,
            ],
            [
                'order_id' => 2,
                'product_id' => 1,
                'quantity' => 1,
                'price' => 100,
            ],
            [
                'order_id' => 3,
                'product_id' => 1,
                'quantity' => 1,
                'price' => 100,
            ],
            [
                'order_id' => 4,
                'product_id' => 1,
                'quantity' => 1,
                'price' => 100,
            ],
        ]);
    }
}
