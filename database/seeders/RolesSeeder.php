<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //user
        Role::create([
            'name' => 'user'
        ]);
        //moderator
        Role::create([
            'name' => 'moderator'
        ]);
        //administrator
        Role::create([
            'name' => 'administrator'
        ]);
    }
}
