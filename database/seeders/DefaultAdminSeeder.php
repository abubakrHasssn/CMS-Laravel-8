<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'name' => 'Admin',
            'avatar' => 'avatars/default_user_avatar.png',
            'role_name' => 'administrator',
            'email_verified_at' => now(),
        ]);

        User::create([
            'username' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'name' => 'User',
            'avatar' => 'avatars/default_user_avatar.png',
            'role_name' => 'user',
            'email_verified_at' => now(),
        ]);
    }
}
