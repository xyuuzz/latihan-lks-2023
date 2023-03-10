<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $field = collect([
            [
                "name" => "admin1",
                "username" => "admin1",
                "email" => "admin1@gmail.com",
                "password" => Hash::make("admin1"),
                "role" => "admin"
            ],
            [
                "name" => "admin2",
                "username" => "admin2",
                "email" => "admin2@gmail.com",
                "password" => Hash::make("admin2"),
                "role" => "admin"
            ],
            [
                "name" => "user1",
                "username" => "user1",
                "email" => "user1@gmail.com",
                "password" => Hash::make("user1"),
                "role" => "user"
            ],
            [
                "name" => "user2",
                "username" => "user2",
                "email" => "user2@gmail.com",
                "password" => Hash::make("user2"),
                "role" => "user"
            ]
        ]);

        $field->each( fn($data) => User::create($data) );
    }
}
