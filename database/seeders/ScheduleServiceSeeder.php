<?php

namespace Database\Seeders;

use App\Models\ScheduleService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScheduleServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ScheduleService::create([
            "session" => "morning",
        ]);
        ScheduleService::create([
            "session" => "afternoon",
        ]);
        ScheduleService::create([
            "session" => "evening",
        ]);
    }
}
