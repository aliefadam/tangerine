<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Administrator",
            "email" => "website@tangerine.my.id",
            "password" => bcrypt("123"),
            "role" => "admin",
            "email_verified_at" => now(),
        ]);

        User::create([
            "name" => "Alief adam",
            "email" => "aliefadam6@gmail.com",
            "password" => bcrypt("123"),
            "role" => "user",
            "email_verified_at" => now(),
        ]);
    }
}
