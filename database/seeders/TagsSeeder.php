<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create([
            'name' => 'Laravel',
            'slug' => 'Laravel'
        ]);
        Tag::create([
            'name' => 'HTML',
            'slug' => 'HTML'
        ]);
        Tag::create([
            'name' => 'Node.js',
            'slug' => 'Node-js'
        ]);
        Tag::create([
            'name' => 'Wordpress',
            'slug' => 'Wordpress'
        ]);
    }
}
