<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        $data = [
            [
                "category_salon_id" => 1,
                "name" => "Creambath",
                "slug" => "creambath",
                "image" => "creambath.jpg",
                "price" => 175000,
            ],
            [
                "category_salon_id" => 1,
                "name" => "Hair Spa",
                "slug" => "hair-spa",
                "image" => "hairspa.jpg",
                "price" => 190000,
            ],
            [
                "category_salon_id" => 2,
                "name" => "Manicure",
                "slug" => "manicure",
                "image" => "manicure.jpg",
                "price" => 125000,
            ],
            [
                "category_salon_id" => 2,
                "name" => "Pedicure",
                "slug" => "pedicure",
                "image" => "pedicure.jpg",
                "price" => 135000,
            ],
            [
                "category_salon_id" => 1,
                "name" => "Hair mask",
                "slug" => "hair-mask",
                "image" => "hairmask.jpg",
                "price" => 140000,
            ],
            [
                "category_salon_id" => 1,
                "name" => "Face massage",
                "slug" => "face-massage",
                "image" => "facemassage.jpg",
                "price" => 120000,
            ],
            [
                "category_salon_id" => 1,
                "name" => "Breast massage",
                "slug" => "breast-massage",
                "image" => "breastmassage.jpg",
                "price" => 120000,
            ],
            [
                "category_salon_id" => 1,
                "name" => "Back massage",
                "slug" => "back-massage",
                "image" => "backmassage.jpg",
                "price" => 150000,
            ],
            [
                "category_salon_id" => 1,
                "name" => "Chair massage",
                "slug" => "chair-massage",
                "image" => "chairmassage.jpg",
                "price" => 70000,
            ],
            [
                "category_salon_id" => 2,
                "name" => "foot massage",
                "slug" => "foot-massage",
                "image" => "footmassage.jpg",
                "price" => 120000,
            ],
            [
                "category_salon_id" => 1,
                "name" => "Reflexology",
                "slug" => "Reflexology",
                "image" => "Reflexology.jpg",
                "price" => 120000,
            ],
            [
                "category_salon_id" => 2,
                "name" => "Nails polish",
                "slug" => "nails-polish",
                "image" => "nailspolish.jpg",
                "price" => 65000,
            ],
            [
                "category_salon_id" => 2,
                "name" => "Russian manicure & gel polish",
                "slug" => "russian-manicure-Gel-polish\r\n",
                "image" => "rmgp.jpg",
                "price" => 180000,
            ],
            [
                "category_salon_id" => 2,
                "name" => "Russian manicure & easy nail",
                "slug" => "russian-manicure-easy-nail",
                "image" => "rmen.jpg",
                "price" => 195000,
            ],
            [
                "category_salon_id" => 2,
                "name" => "Russian manicure & medium nail art",
                "slug" => "russian-manicure-medium nail-art",
                "image" => "rmmn.jpg",
                "price" => 245000,
            ],
            [
                "category_salon_id" => 2,
                "name" => "Russian manicure & advance nail art",
                "slug" => "russian-manicure-advance-nail-art\r\n",
                "image" => "rman.jpg",
                "price" => 295000,
            ],
            [
                "category_salon_id" => 2,
                "name" => "Pedicure & gel polish",
                "slug" => "pedicure-gel-polish",
                "image" => "pgp.jpg",
                "price" => 200000,
            ],
            [
                "category_salon_id" => 3,
                "name" => "Women’s haircut",
                "slug" => "womens-haircut",
                "image" => "haircut.jpg",
                "price" => 200000,
            ],
            [
                "category_salon_id" => 3,
                "name" => "Man's haircut",
                "slug" => "mans-haircut",
                "image" => "hairmc.jpg",
                "price" => 130000,
            ],
            [
                "category_salon_id" => 3,
                "name" => "Children’s Haircut",
                "slug" => "childrens-haircut\r\n",
                "image" => "hairch.jpg",
                "price" => 85000,
            ],
            [
                "category_salon_id" => 3,
                "name" => "Haircut bang’s\r\n",
                "slug" => "haircut-bangs",
                "image" => "hairhb.jpg",
                "price" => 450000,
            ],
            [
                "category_salon_id" => 3,
                "name" => "BlowDry short\r\n",
                "slug" => "blowdry-short\r\n",
                "image" => "hairbs.jpg",
                "price" => 120000,
            ],
            [
                "category_salon_id" => 3,
                "name" => "Blowdry long",
                "slug" => "blowdry-long",
                "image" => "hairbl.jpg",
                "price" => 130000,
            ],
            [
                "category_salon_id" => 3,
                "name" => "Wash & dry + hairtonic",
                "slug" => "wash-dry-hairtonic",
                "image" => "treatment.jpg",
                "price" => 85000,
            ],
            [
                "category_salon_id" => 4,
                "name" => "Coloring men",
                "slug" => "coloring-men",
                "image" => "scmen.jpg",
                "price" => 450000,
            ],
            [
                "category_salon_id" => 4,
                "name" => "Coloring short",
                "slug" => "coloring-short",
                "image" => "scshort.jpg",
                "price" => 450000,
            ],
            [
                "category_salon_id" => 4,
                "name" => "Coloring medium",
                "slug" => "Coloring-medium",
                "image" => "scmedium.jpg",
                "price" => 500000,
            ],
            [
                "category_salon_id" => 4,
                "name" => "Coloring long",
                "slug" => "coloring-long",
                "image" => "sclong.jpg",
                "price" => 600000,
            ],
            [
                "category_salon_id" => 4,
                "name" => "Hair root touch up",
                "slug" => "hair-root-touch-up",
                "image" => "hrtu.jpg",
                "price" => 400000,
            ],
            [
                "category_salon_id" => 4,
                "name" => "Bleaching short",
                "slug" => "bleaching-short",
                "image" => "scbs.jpg",
                "price" => 300000,
            ],
            [
                "category_salon_id" => 4,
                "name" => "Bleaching long",
                "slug" => "bleaching-long",
                "image" => "scbl.jpg",
                "price" => 400000,
            ],
            [
                "category_salon_id" => 4,
                "name" => "Highlight long",
                "slug" => "highlight-long",
                "image" => "schl.jpg",
                "price" => 425000,
            ],
            [
                "category_salon_id" => 4,
                "name" => "Highlight medium",
                "slug" => "highlight-medium",
                "image" => "schm.jpg",
                "price" => 375000,
            ],
            [
                "category_salon_id" => 4,
                "name" => "Highlight short",
                "slug" => "highlight-short",
                "image" => "schs.jpg",
                "price" => 350000,
            ],
            [
                "category_salon_id" => 5,
                "name" => "Hairdo",
                "slug" => "hairdo",
                "image" => "hairdo.jpg",
                "price" => 150000,
            ],
            [
                "category_salon_id" => 5,
                "name" => "Make up",
                "slug" => "makeup",
                "image" => "makeup.jpg",
                "price" => 200000,
            ],
            [
                "category_salon_id" => 5,
                "name" => "Eyebrow",
                "slug" => "eyebrow",
                "image" => "eyebrow.jpg",
                "price" => 65000,
            ],
            [
                "category_salon_id" => 5,
                "name" => "Fake Eyelashes",
                "slug" => "fake-eyelashes",
                "image" => "eyelashes.jpg",
                "price" => 40000,
            ],
            [
                "category_salon_id" => 5,
                "name" => "Under arm waxing",
                "slug" => "under-arm-waxing",
                "image" => "underwax.jpg",
                "price" => 80000,
            ],
            [
                "category_salon_id" => 5,
                "name" => "Full arm Waxing",
                "slug" => "full-arm-waxing",
                "image" => "armwax.jpg",
                "price" => 100000,
            ],
            [
                "category_salon_id" => 5,
                "name" => "Half legs waxing",
                "slug" => "half-legs-waxing",
                "image" => "halfwax.jpg",
                "price" => 130000,
            ],
            [
                "category_salon_id" => 5,
                "name" => "Full legs waxing",
                "slug" => "full-legs-waxing",
                "image" => "fullwax.jpg",
                "price" => 185000,
            ]
        ];

        foreach ($data as $service) {
            Service::create($service);
        }
    }
}
