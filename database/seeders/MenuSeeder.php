<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin
        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "menu",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "dashboard",
            "route" => "admin.dashboard",
            "icon" => "fa-regular fa-home",
        ]);

        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "users",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "member",
            "route" => "admin.member.index",
            "icon" => "fa-regular fa-users",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "trainer",
            "route" => "admin.trainer.index",
            "icon" => "fa-regular fa-people-robbery",
        ]);

        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "master data",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "class",
            "route" => "admin.course.index",
            "icon" => "fa-regular fa-dumbbell",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "class detail",
            "route" => "admin.course-detail.index",
            "icon" => "fa-regular fa-dumbbell",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "room",
            "route" => "admin.room.index",
            "icon" => "fa-regular fa-door-open",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "schedule",
            "route" => "admin.schedule.index",
            "icon" => "fa-regular fa-calendar-days",
        ]);
    }
}
