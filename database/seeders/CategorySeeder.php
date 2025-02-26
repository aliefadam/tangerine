<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            "name" => "Pilates Classes Director",
            "slug" => Str::slug("Pilates Classes Director"),
            "description" => "A high-level Pilates class led by an expert instructor, designed for individuals seeking advanced techniques and comprehensive training in core strength, flexibility, and posture alignment.",
            "image" => "classes-1.jpg",
        ]);
        Category::create([
            "name" => "Pilates Class Senior",
            "slug" => Str::slug("Pilates Classes Senior"),
            "image" => "classes-2.jpg",
            "description" => "An intermediate to advanced Pilates class focused on enhancing core stability, improving muscle control, and refining movement precision. Suitable for experienced participants looking to deepen their practice.",
        ]);
        Category::create([
            "name" => "Pilates Class Junior",
            "slug" => Str::slug("Pilates Classes Junior"),
            "description" => "A beginner-friendly Pilates class introducing fundamental exercises to build core strength, improve flexibility, and enhance body awareness. Perfect for those new to Pilates or looking for a solid foundation.",
            "image" => "classes-3.jpg",
        ]);
        Category::create([
            "name" => "Pilates Combo Class",
            "slug" => Str::slug("Pilates Classes Junior"),
            "description" => "A fusion Pilates class that blends traditional Pilates movements with elements of strength training and flexibility exercises. Ideal for those seeking a well-rounded workout experience.",
            "image" => "classes-4.jpg",
        ]);
        Category::create([
            "name" => "Yoga Classes",
            "slug" => Str::slug("Yoga Classes"),
            "description" => "A relaxing yet challenging class that incorporates breathing techniques, stretching, and mindfulness to promote flexibility, balance, and mental well-being. Suitable for all levels.",
            "image" => "classes-5.jpg",
        ]);
        Category::create([
            "name" => "Zumba Class",
            "slug" => Str::slug("Zumba Class"),
            "description" => "A high-energy dance workout combining Latin-inspired moves with aerobic fitness to improve cardiovascular health, coordination, and endurance. Perfect for those who love to move to the rhythm of music.",
            "image" => "classes-6.jpg",
        ]);
        Category::create([
            "name" => "Sweat Dance Classes",
            "slug" => Str::slug("Sweat Dance Classes"),
            "description" => "A fun and energetic dance-based workout designed to make you sweat while improving endurance, coordination, and overall fitness. Featuring dynamic choreography and upbeat music, this class is perfect for anyone looking to burn calories while having a great time!",
            "image" => "classes-7.jpg",
        ]);
    }
}
