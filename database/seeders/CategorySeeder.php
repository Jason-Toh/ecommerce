<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_names = ['Laptops', 'Desktops', 'Phones', 'Consoles', 'Cameras', 'Tablets', 'TVs'];
        $category_slugs = ['laptops', 'desktops', 'phones', 'consoles', 'cameras', 'tablets', 'tvs'];

        for ($i = 0; $i < sizeof($category_names); $i++) {
            Category::create([
                'name' => $category_names[$i],
                'slug' => $category_slugs[$i]
            ]);
        }
    }
}
