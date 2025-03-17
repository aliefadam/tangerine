<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\CategorySalon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            MenuSeeder::class,
            TrainerSeeder::class,
            CourseSeeder::class,
            RoomSeeder::class,
            CategorySeeder::class,
            CategorySalonSeeder::class,
            MemberSeeder::class,
            TimeTableSeeder::class,
            ScheduleServiceSeeder::class,
            BeauticianSeeder::class,
            ServiceSeeder::class,
        ]);
    }
}
