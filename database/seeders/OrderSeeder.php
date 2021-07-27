<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::query()->insert([
            [
                'user_id' => 1,
                'order_number' => 1627333582,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'order_number' => 1627333583,
                'status' => 'failed',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'order_number' => 1627333584,
                'status' => 'success',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 1,
                'order_number' => 1627333585,
                'status' => 'success',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
