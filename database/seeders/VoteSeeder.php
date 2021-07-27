<?php

namespace Database\Seeders;

use App\Models\Vote;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vote::query()->insert([
            [
                'user_id' => 1,
                'product_id' => 1,
                'vote' => 5,
                'approved' => 1,
            ],
            [
                'user_id' => 1,
                'product_id' => 1,
                'vote' => 4,
                'approved' => 1,
            ],
            [
                'user_id' => 1,
                'product_id' => 1,
                'vote' => 1,
                'approved' => 0,
            ]
        ]);
    }
}
