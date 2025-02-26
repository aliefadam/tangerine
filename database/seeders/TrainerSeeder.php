<?php

namespace Database\Seeders;

use App\Models\Trainer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trainer::create([
            "name" => "Elizabeth Nelson",
            "description" => "Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.",
            "image" => "TRAINER_IMAGE_20250226121753.jpg",
        ]);
        Trainer::create([
            "name" => "Scarlet Torres",
            "description" => "Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.",
            "image" => "TRAINER_IMAGE_20250226120639.jpg",
        ]);
        Trainer::create([
            "name" => "Victoria Wight",
            "description" => "Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.",
            "image" => "TRAINER_IMAGE_20250226122446.jpg",
        ]);
        Trainer::create([
            "name" => "Stella Perry",
            "description" => "Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.",
            "image" => "TRAINER_IMAGE_20250226122425.jpg",
        ]);
    }
}
