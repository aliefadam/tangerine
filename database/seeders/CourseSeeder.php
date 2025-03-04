<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newCourse = Course::create([
            "name" => "Pilates Classes Director",
            "slug" => Str::slug("Pilates Classes Director"),
            "description" => "A high-level Pilates class led by an expert instructor, designed for individuals seeking advanced techniques and comprehensive training in core strength, flexibility, and posture alignment.",
            "image" => "classes-1.jpg",
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Private Class",
            "drop_in_price" => 700000,
            "10_session_price" => 6500000,
            "20_session_price" => 12000000,
            "person_max" => 1,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Duet Class",
            "drop_in_price" => 1000000,
            "10_session_price" => 9000000,
            "20_session_price" => null,
            "person_max" => 2,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Class",
            "drop_in_price" => 1300000,
            "10_session_price" => 12000000,
            "20_session_price" => null,
            "person_max" => 4,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Open Group Class",
            "drop_in_price" => 450000,
            "10_session_price" => 4000000,
            "20_session_price" => null,
            "person_max" => 5,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Matwork Class",
            "drop_in_price" => null,
            "10_session_price" => 8000000,
            "20_session_price" => null,
            "person_max" => 10,
        ]);


        $newCourse = Course::create([
            "name" => "Pilates Class Senior",
            "slug" => Str::slug("Pilates Classes Senior"),
            "image" => "classes-2.jpg",
            "description" => "An intermediate to advanced Pilates class focused on enhancing core stability, improving muscle control, and refining movement precision. Suitable for experienced participants looking to deepen their practice.",
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Private Class",
            "drop_in_price" => 600000,
            "10_session_price" => 5500000,
            "20_session_price" => 10000000,
            "person_max" => 1,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Duet Class",
            "drop_in_price" => 900000,
            "10_session_price" => 8000000,
            "20_session_price" => null,
            "person_max" => 2,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Class",
            "drop_in_price" => 1200000,
            "10_session_price" => 11000000,
            "20_session_price" => null,
            "person_max" => 4,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Open Group Class",
            "drop_in_price" => 450000,
            "10_session_price" => 4000000,
            "20_session_price" => null,
            "person_max" => 5,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Matwork Class",
            "drop_in_price" => null,
            "10_session_price" => 7000000,
            "20_session_price" => null,
            "person_max" => 10,
        ]);


        $newCourse = Course::create([
            "name" => "Pilates Class Junior",
            "slug" => Str::slug("Pilates Classes Junior"),
            "description" => "A beginner-friendly Pilates class introducing fundamental exercises to build core strength, improve flexibility, and enhance body awareness. Perfect for those new to Pilates or looking for a solid foundation.",
            "image" => "classes-3.jpg",
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Private Class",
            "drop_in_price" => 450000,
            "10_session_price" => 4000000,
            "20_session_price" => 7000000,
            "person_max" => 1,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Duet Class",
            "drop_in_price" => 700000,
            "10_session_price" => 6000000,
            "20_session_price" => null,
            "person_max" => 2,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Class",
            "drop_in_price" => 900000,
            "10_session_price" => 8000000,
            "20_session_price" => null,
            "person_max" => 4,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Open Group Class",
            "drop_in_price" => 250000,
            "10_session_price" => 2000000,
            "20_session_price" => null,
            "person_max" => 5,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Matwork Class",
            "drop_in_price" => null,
            "10_session_price" => 6000000,
            "20_session_price" => null,
            "person_max" => 10,
        ]);


        $newCourse = Course::create([
            "name" => "Pilates Combo Class",
            "slug" => Str::slug("Pilates Combo Class"),
            "description" => "A fusion Pilates class that blends traditional Pilates movements with elements of strength training and flexibility exercises. Ideal for those seeking a well-rounded workout experience.",
            "image" => "classes-4.jpg",
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Combo Class",
            "drop_in_price" => 1000000,
            "10_session_price" => 9000000,
            "20_session_price" => null,
            "person_max" => 5,
        ]);


        $newCourse = Course::create([
            "name" => "Yoga Classes",
            "slug" => Str::slug("Yoga Classes"),
            "description" => "A relaxing yet challenging class that incorporates breathing techniques, stretching, and mindfulness to promote flexibility, balance, and mental well-being. Suitable for all levels.",
            "image" => "classes-5.jpg",
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Private Class",
            "drop_in_price" => 450000,
            "10_session_price" => 4000000,
            "20_session_price" => 7000000,
            "person_max" => 1,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Private Class",
            "drop_in_price" => 1000000,
            "10_session_price" => 8000000,
            "20_session_price" => null,
            "person_max" => 4,
        ]);

        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Private Small Group Class",
            "drop_in_price" => 850000,
            "10_session_price" => 5500000,
            "20_session_price" => null,
            "person_max" => 5,
        ]);

        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Personal Member",
            "drop_in_price" => 150000,
            "10_session_price" => 1400000,
            "20_session_price" => null,
            "person_max" => 1,
        ]);

        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Class",
            "drop_in_price" => null,
            "10_session_price" => 7000000,
            "20_session_price" => null,
            "person_max" => 4,
        ]);


        $newCourse = Course::create([
            "name" => "Zumba Class",
            "slug" => Str::slug("Zumba Class"),
            "description" => "A high-energy dance workout combining Latin-inspired moves with aerobic fitness to improve cardiovascular health, coordination, and endurance. Perfect for those who love to move to the rhythm of music.",
            "image" => "classes-6.jpg",
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Private Class",
            "drop_in_price" => 450000,
            "10_session_price" => 4000000,
            "20_session_price" => 7000000,
            "person_max" => 1,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Private Class",
            "drop_in_price" => 1000000,
            "10_session_price" => 8000000,
            "20_session_price" => null,
            "person_max" => 4,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Private Small Group Class",
            "drop_in_price" => 850000,
            "10_session_price" => 5500000,
            "20_session_price" => null,
            "person_max" => 5,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Personal Member",
            "drop_in_price" => 150000,
            "10_session_price" => 1400000,
            "20_session_price" => null,
            "person_max" => 1,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Class",
            "drop_in_price" => null,
            "10_session_price" => 7000000,
            "20_session_price" => null,
            "person_max" => 4,
        ]);


        $newCourse = Course::create([
            "name" => "Sweat Dance Classes",
            "slug" => Str::slug("Sweat Dance Classes"),
            "description" => "A fun and energetic dance-based workout designed to make you sweat while improving endurance, coordination, and overall fitness. Featuring dynamic choreography and upbeat music, this class is perfect for anyone looking to burn calories while having a great time!",
            "image" => "classes-7.jpg",
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Private Class",
            "drop_in_price" => 450000,
            "10_session_price" => 4000000,
            "20_session_price" => 7000000,
            "person_max" => 1,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Private Class",
            "drop_in_price" => 1000000,
            "10_session_price" => 8000000,
            "20_session_price" => null,
            "person_max" => 4,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Private Small Group Class",
            "drop_in_price" => 850000,
            "10_session_price" => 5500000,
            "20_session_price" => null,
            "person_max" => 5,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Personal Member",
            "drop_in_price" => 150000,
            "10_session_price" => 1400000,
            "20_session_price" => null,
            "person_max" => 1,
        ]);
        CourseDetail::create([
            "course_id" => $newCourse->id,
            "name" => "Company Class",
            "drop_in_price" => null,
            "10_session_price" => 7000000,
            "20_session_price" => null,
            "person_max" => 4,
        ]);
    }
}
