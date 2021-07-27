<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::query()->create([
            'id' => 1,
            'name' => 'محصول تست',
            'slug' => 'محصول-تست',
            'image' => '/image',
            'price' => 1000,
        ]);
    }
}
