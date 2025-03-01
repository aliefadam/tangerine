<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\MemberPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::create([
            "user_id" => 2,
        ]);
        MemberPlan::create([
            "member_id" => 1,
            "trainer_id" => 1,
            "room_id" => 1,
            "plan" => "Pilates Class Senior - Private Class - 10 Session",
            // "date" => "Sunday",
            // "time" => "09.00",
            "subscribed_date" => "2025-02-28 05:02:37",
            "expired_date" => "2025-06-28 05:02:37",
            "remaining_session" => 10,
            "status" => "active",
        ]);
    }
}
