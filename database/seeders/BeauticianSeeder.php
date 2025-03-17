<?php

namespace Database\Seeders;

use App\Models\Beautician;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeauticianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $beauticians = [
            [
                "name" => "Elizabeth Nelson",
                "image" => "ther1.jpg",
                "description" => "Therapist",
            ],
            [
                "name" => "Scarlet Torres",
                "image" => "ther2.jpg",
                "description" => "Therapist",
            ],
            [
                "name" => "Victoria Wight",
                "image" => "styl1.jpg",
                "description" => "Hairstylist",
            ],
            [
                "name" => "Stella Perry",
                "image" => "styl2.jpg",
                "description" => "Hairstylist",
            ],
        ];

        foreach ($beauticians as $beautician) {
            Beautician::create($beautician);
        }
    }
}
