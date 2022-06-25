<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => '1',
            'name' => 'User 1',
            'email' => 'user1@gmail.com',
            'password' => bcrypt("password")
        ]);

        User::create([
            'id' => '2',
            'name' => 'User 2',
            'email' => 'user2@gmail.com',
            'password' => bcrypt("password")
        ]);

        User::create([
            'id' => '3',
            'name' => 'User 3',
            'email' => 'user3@gmail.com',
            'password' => bcrypt("password")
        ]);
    }
}
