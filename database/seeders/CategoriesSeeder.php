<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Laravel',
            'slug' => 'Laravel'
        ]);
        Category::create([
            'name' => 'Node.js',
            'slug' => 'Node-js'
        ]);
        Category::create([
            'name' => 'Vue.js',
            'slug' => 'Vue-js'
        ]);
        Category::create([
            'name' => 'Angular',
            'slug' => 'Angular'

        ]);
    }
}
