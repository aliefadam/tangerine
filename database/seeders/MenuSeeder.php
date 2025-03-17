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

        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "membership",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "member plan",
            "route" => "admin.member-plan.index",
            "icon" => "fa-regular fa-screen-users",
        ]);

        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "master data • Wellness",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "trainer",
            "route" => "admin.trainer.index",
            "icon" => "fa-regular fa-people-robbery",
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
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "time table",
            "route" => "admin.time-table.index",
            "icon" => "fa-regular fa-table",
        ]);

        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "master data • Salon",
        ]);

        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "beautician",
            "route" => "admin.beautician.index",
            "icon" => "fa-solid fa-person-chalkboard",
        ]);

        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "service",
            "route" => "admin.service.index",
            "icon" => "fa-solid fa-scissors",
        ]);

        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "product",
            "route" => "admin.product.index",
            "icon" => "fa-solid fa-cart-shopping",
        ]);

        $newMenu = Menu::create([
            "role" => "admin",
            "name" => "transaction",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "wellness",
            "route" => "admin.transaction.index",
            "icon" => "fa-regular fa-bag-shopping",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "rent room",
            "route" => "admin.rent-transaction.index",
            "icon" => "fa-regular fa-bag-shopping",
        ]);
        MenuDetail::create([
            "menu_id" => $newMenu->id,
            "name" => "booking salon",
            "route" => "admin.booking-salon.index",
            "icon" => "fa-regular fa-bag-shopping",
        ]);
    }
}
