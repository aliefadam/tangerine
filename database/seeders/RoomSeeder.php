<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Room::create([
        //     "name" => "Room A",
        //     "capacity" => 9,
        // ]);
        // Room::create([
        //     "name" => "Room B",
        //     "capacity" => 9,
        // ]);
        // Room::create([
        //     "name" => "Room C",
        //     "capacity" => 9,
        // ]);

        $rooms = [
            [
                "id" => 1,
                "name" => "Room A",
                "image" => "ROOM_IMAGE_20250227091321.jpg",
                "used_for" => "All Classes",
                "capacity" => 10,
                "can_be_rent" => true,
                "rent_price_under_10" => [
                    "without_bath" => 350_000,
                    "with_bath" => 450_000,
                ],
                "rent_price_over_10" => [
                    "without_bath" => 450_000,
                    "with_bath" => 600_000,
                ],
                // "rent_price_under_10" => json_encode([
                //     "without_bath" => 350_000,
                //     "with_bath" => 450_000,
                // ]),
                // "rent_price_over_10" => json_encode([
                //     "without_bath" => 450_000,
                //     "with_bath" => 600_000,
                // ]),
            ],
            [
                "id" => 2,
                "name" => "Room B",
                "image" => "ROOM_IMAGE_20250227091159.jpg",
                "used_for" => "Pilates Only",
                "capacity" => 10,
            ]
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}
