<?php

namespace Database\Seeders;

use App\Models\CategorySalon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySalonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                "name" => "Treatment",
                "slug" => "treatment",
                "image" => "treatment.jpg",
            ],
            [
                "name" => "Nails",
                "slug" => "nails",
                "image" => "nails.jpg",
            ],
            [
                "name" => "Haircut",
                "slug" => "hair-cut",
                "image" => "haircut.jpg",
            ],
            [
                "name" => "Hairstyle",
                "slug" => "hair-style",
                "image" => "jumbotron.jpg",
            ],
            [
                "name" => "Others",
                "slug" => "others",
                "image" => "makeup.jpg",
            ]
        ];

        foreach ($categories as $category) {
            CategorySalon::create($category);
        }
    }
}
