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
            [
                'name' => 'Watch',
                'slug' => 'watch',
                'price' => 250,
                'description' => 'Good watch',
                'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=989&q=80'
            ],
            [
                'name' => 'Bag',
                'slug' => 'bag',
                'price' => 350,
                'description' => 'Good Bag',
                'image' => 'https://images.unsplash.com/photo-1491637639811-60e2756cc1c7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=669&q=80'
            ],
            [
                'name' => 'Perfume',
                'slug' => 'perfume',
                'price' => 100,
                'description' => 'Good Perfume',
                'image' => 'https://images.unsplash.com/photo-1528740561666-dc2479dc08ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1868&q=80'
            ],
            [
                'name' => 'LG V10 H800',
                'slug' => 'lg-v10-h800',
                'description' => 'LG Brand',
                'image' => 'https://dummyimage.com/200x300/000/fff&text=LG',
                'price' => 200
            ],
            [
                'name' => 'PS5',
                'slug' => 'ps5',
                'description' => 'Playstation 5',
                'image' =>  'storage/images/ps5.jpg',
                'price' => 600
            ],
            [
                'name' => 'XBox',
                'slug' => 'xbox',
                'description' => 'X box console',
                'image' =>  'storage/images/xbox.jpg',
                'price' => 400
            ],
            [
                'name' => 'Hp Laptop',
                'slug' => 'hp-laptop',
                'description' => 'Hp Laptop Computer',
                'image' =>  'storage/images/hp_laptop.jpg',
                'price' => 700
            ],
            [
                'name' => 'Nikon Camera',
                'slug' => 'nikon-camera',
                'description' => 'Nikon Digital Camera',
                'image' =>  'storage/images/camera.jpg',
                'price' => 300
            ]
        ];

        foreach ($products as $key => $value) {
            Product::create($value);
        }
    }
}
