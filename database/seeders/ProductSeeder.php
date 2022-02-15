<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $laptops = [
            [
                'name' => 'Hp Pavilion',
                'slug' => 'hp-pavilion',
                'description' => 'HP Pavilion is a line of consumer-oriented laptop and desktop computers produced by HP Inc.',
                'image' => 'images/hp_pavilion_1.jpg',
                'images' => '[
                    "images/hp_pavilion_2.jpg",
                    "images/hp_pavilion_3.jpg",
                    "images/hp_pavilion_4.jpg"
                ]',
                'price' => 700
            ]
        ];

        foreach ($laptops as $laptop) {
            Product::create($laptop)->categories()->attach(1);
        }

        $desktops = [];
        foreach ($desktops as $desktop) {
            Product::create($desktop)->categories()->attach(2);
        }

        $phones = [
            [
                'name' => 'Samsung Galaxy S9',
                'slug' => 'samsung-galaxy-s9',
                'description' => 'A brand new, sealed Lilac Purple Verizon Global Unlocked Galaxy S9 by Samsung. This is an upgrade. Clean ESN and activation ready.',
                'image' => 'images/samsung_galaxy_s9.jpg',
                'price' => 699.99
            ],
            [
                'name' => 'Apple iPhone X',
                'slug' => 'apple-iphone-x',
                'description' => 'GSM & CDMA FACTORY UNLOCKED! WORKS WORLDWIDE! FACTORY UNLOCKED. iPhone x 64gb. iPhone 8 64gb. iPhone 8 64gb. iPhone X with iOS 11.',
                'image' => 'images/iphone_x.jpg',
                'price' => 983.00
            ],
            [
                'name' => 'Google Pixel 2 XL',
                'slug' => 'google-pixel-2-xl',
                'description' => 'New condition • No returns, but backed by eBay Money back guarantee',
                'image' => 'images/google_pixel_2_xl.jpg',
                'price' => 675.00
            ],
            [
                'name' => 'LG V10 H900',
                'slug' => 'lg-v10-h900',
                'description' => 'NETWORK Technology GSM. Protection Corning Gorilla Glass 4. MISC Colors Space Black, Luxe White, Modern Beige, Ocean Blue, Opal Blue. SAR EU 0.59 W/kg (head).',
                'image' => 'images/lg_v10_h900.jpg',
                'price' => 159.99
            ],
            [
                'name' => 'Huawei Elate',
                'slug' => 'huawei-elate',
                'description' => 'Cricket Wireless - Huawei Elate. New Sealed Huawei Elate Smartphone.',
                'image' => 'images/huawei_elate.jpg',
                'price' => 68.00
            ],
            [
                'name' => 'HTC One M10',
                'slug' => 'htc-one-m10',
                'description' => 'The device is in good cosmetic condition and will show minor scratches and/or scuff marks.',
                'image' => 'images/htc_one_m10.jpg',
                'price' => 129.99
            ],
            [
                'name' => 'Xiaomi Pocophone',
                'slug' => 'xiaomi-pocophone',
                'description' => 'The device is available globally in limited numbers, except for India where it enjoys wide availability.',
                'image' => 'images/xiaomi_pocophone.jpg',
                'price' => 240
            ]
        ];

        foreach ($phones as $phone) {
            Product::create($phone)->categories()->attach(3);
        }

        $consoles = [
            [
                'name' => 'PS5',
                'slug' => 'ps5',
                'description' => 'Latest Sony Playstation that is powered by an eight-core AMD Zen 2 CPU and custom AMD Radeon GPU',
                'image' =>  'images/ps5.jpg',
                'price' => 600
            ],
            [
                'name' => 'XBox',
                'slug' => 'xbox',
                'description' => 'Xbox is a gaming console brand developed and owned by Microsoft. The game console is capable of connecting to a television or other display media.',
                'image' =>  'images/xbox.jpg',
                'price' => 400
            ],
            [
                'name' => 'Nintendo Switch',
                'slug' => 'nintendo-switch',
                'description' => 'Nintendo Switch systems transform from home console to handheld, letting you play your favorite games at home or on the go.',
                'image' => 'images/nintendo_switch.jpg',
                'price' => 299.99
            ]
        ];

        foreach ($consoles as $console) {
            Product::create($console)->categories()->attach(4);
        }

        $cameras = [
            [
                'name' => 'Nikon Camera',
                'slug' => 'nikon-camera',
                'description' => 'Combining outstanding optics with sophisticated design and features, Nikon compact digital cameras capture your everyday precious moments.',
                'image' =>  'images/nikon_camera.jpg',
                'price' => 300
            ]
        ];

        foreach ($cameras as $camera) {
            Product::create($camera)->categories()->attach(5);
        }

        $tablets = [];
        foreach ($tablets as $tablet) {
            Product::create($tablet)->categories()->attach(6);
        }

        $tvs = [];
        foreach ($tvs as $tv) {
            Product::create($tv)->categories()->attach(7);
        }
    }
}
