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
        $products = [
            //     [
            //         'name' => 'Watch',
            //         'slug' => 'watch',
            //         'price' => 250,
            //         'description' => 'Good watch',
            //         'image' => 'https://images.unsplash.com/image-1523275335684-37898b6baf30?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=989&q=80'
            //     ],
            //     [
            //         'name' => 'Bag',
            //         'slug' => 'bag',
            //         'price' => 350,
            //         'description' => 'Good Bag',
            //         'image' => 'https://images.unsplash.com/image-1491637639811-60e2756cc1c7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=669&q=80'
            //     ],
            //     [
            //         'name' => 'Perfume',
            //         'slug' => 'perfume',
            //         'price' => 100,
            //         'description' => 'Good Perfume',
            //         'image' => 'https://images.unsplash.com/image-1528740561666-dc2479dc08ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1868&q=80'
            //     ],
            //     [
            //         'name' => 'LG V10 H800',
            //         'slug' => 'lg-v10-h800',
            //         'description' => 'LG Brand',
            //         'image' => 'https://dummyimage.com/200x300/000/fff&text=LG',
            //         'price' => 200
            //     ],
            //     [
            //         'name' => 'PS5',
            //         'slug' => 'ps5',
            //         'description' => 'Playstation 5',
            //         'image' =>  'storage/images/ps5.jpg',
            //         'price' => 600
            //     ],
            //     [
            //         'name' => 'XBox',
            //         'slug' => 'xbox',
            //         'description' => 'X box console',
            //         'image' =>  'storage/images/xbox.jpg',
            //         'price' => 400
            //     ],
            //     [
            //         'name' => 'Hp Laptop',
            //         'slug' => 'hp-laptop',
            //         'description' => 'Hp Laptop Computer',
            //         'image' =>  'storage/images/hp_laptop.jpg',
            //         'price' => 700
            //     ],
            //     [
            //         'name' => 'Nikon Camera',
            //         'slug' => 'nikon-camera',
            //         'description' => 'Nikon Digital Camera',
            //         'image' =>  'storage/images/camera.jpg',
            //         'price' => 300
            //     ]
            // ];
            [
                'name' => 'Samsung Galaxy S9',
                'slug' => 'samsung-galaxy-s9',
                'description' => 'A brand new, sealed Lilac Purple Verizon Global Unlocked Galaxy S9 by Samsung. This is an upgrade. Clean ESN and activation ready.',
                'image' => 'https://i.ebayimg.com/00/s/ODY0WDgwMA==/z/9S4AAOSwMZRanqb7/$_35.JPG?set_id=89040003C1',
                'price' => 699.99
            ],
            [
                'name' => 'Apple iPhone X',
                'slug' => 'apple-iphone-x',
                'description' => 'GSM & CDMA FACTORY UNLOCKED! WORKS WORLDWIDE! FACTORY UNLOCKED. iPhone x 64gb. iPhone 8 64gb. iPhone 8 64gb. iPhone X with iOS 11.',
                'image' => 'https://i.ebayimg.com/00/s/MTYwMFg5OTU=/z/9UAAAOSwFyhaFXZJ/$_35.JPG?set_id=89040003C1',
                'price' => 983.00
            ],
            [
                'name' => 'Google Pixel 2 XL',
                'slug' => 'google-pixel-2-xl',
                'description' => 'New condition
 • No returns, but backed by eBay Money back guarantee',
                'image' => 'https://i.ebayimg.com/00/s/MTYwMFg4MzA=/z/G2YAAOSwUJlZ4yQd/$_35.JPG?set_id=89040003C1',
                'price' => 675.00
            ],
            [
                'name' => 'LG V10 H900',
                'slug' => 'lg-v10-h900',
                'description' => 'NETWORK Technology GSM. Protection Corning Gorilla Glass 4. MISC Colors Space Black, Luxe White, Modern Beige, Ocean Blue, Opal Blue. SAR EU 0.59 W/kg (head).',
                'image' => 'https://i.ebayimg.com/00/s/NjQxWDQyNA==/z/VDoAAOSwgk1XF2oo/$_35.JPG?set_id=89040003C1',
                'price' => 159.99
            ],
            [
                'name' => 'Huawei Elate',
                'slug' => 'huawei-elate',
                'description' => 'Cricket Wireless - Huawei Elate. New Sealed Huawei Elate Smartphone.',
                'image' => 'https://ssli.ebayimg.com/images/g/aJ0AAOSw7zlaldY2/s-l640.jpg',
                'price' => 68.00
            ],
            [
                'name' => 'HTC One M10',
                'slug' => 'htc-one-m10',
                'description' => 'The device is in good cosmetic condition and will show minor scratches and/or scuff marks.',
                'image' => 'https://i.ebayimg.com/images/g/u-kAAOSw9p9aXNyf/s-l500.jpg',
                'price' => 129.99
            ]
        ];

        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}
