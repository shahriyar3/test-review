<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::query()->create([
            'id' => 1,
            'name' => 'test user',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
