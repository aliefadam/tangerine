<?php

namespace Database\Seeders;

use App\Models\TimeTable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TimeTable::create([
            'index' => 0,
            'course_id' => 1,
            'day' => 'Monday',
            'start_time' => '2025-03-02 23:00:00',
            'end_time' => '2025-03-03 00:00:00',
        ]);

        TimeTable::create([
            'index' => 0,
            'course_id' => 1,
            'day' => 'Sunday',
            'start_time' => '2025-03-02 23:00:00',
            'end_time' => '2025-03-03 00:00:00',
        ]);

        TimeTable::create([
            'index' => 0,
            'course_id' => 2,
            'day' => 'Wednesday',
            'start_time' => '2025-03-03 00:00:00',
            'end_time' => '2025-03-03 01:00:00',
        ]);

        TimeTable::create([
            'index' => 0,
            'course_id' => 3,
            'day' => 'Friday',
            'start_time' => '2025-03-03 01:00:00',
            'end_time' => '2025-03-03 02:00:00',
        ]);

        TimeTable::create([
            'index' => 1,
            'course_id' => 5,
            'day' => 'Tuesday',
            'start_time' => '2025-03-03 02:00:00',
            'end_time' => '2025-03-03 03:00:00',
        ]);

        TimeTable::create([
            'index' => 1,
            'course_id' => 6,
            'day' => 'Thursday',
            'start_time' => '2025-03-03 00:00:00',
            'end_time' => '2025-03-03 01:00:00',
        ]);

        TimeTable::create([
            'index' => 1,
            'course_id' => 7,
            'day' => 'Saturday',
            'start_time' => '2025-03-03 01:00:00',
            'end_time' => '2025-03-03 02:00:00',
        ]);
    }
}
