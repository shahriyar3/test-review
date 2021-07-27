<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::query()->insert([
            [
                'user_id' => 1,
                'product_id' => 1,
                'subject' => 'test',
                'body' => 'test',
                'approved' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'product_id' => 1,
                'subject' => 'test',
                'body' => 'test',
                'approved' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'product_id' => 1,
                'subject' => 'test',
                'body' => 'test',
                'approved' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'product_id' => 1,
                'subject' => 'test',
                'body' => 'test',
                'approved' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
