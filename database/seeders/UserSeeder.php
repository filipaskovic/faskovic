<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(['name' => 'Admin', 'email' => 'admin@pwa.rs', 'password' => 'admin' , 'role' => 'admin']);
        User::create(['name' => 'Editor', 'email' => 'editor@pwa.rs', 'password' => 'editor' , 'role' => 'editor']);
        User::create(['name' => 'User', 'email' => 'user@pwa.rs', 'password' => 'user' , 'role' => 'registered']);
        User::create(['name' => 'Marko Marković', 'email' => 'marko@pwa.rs', 'password' => 'marko' , 'role' => 'registered']);
        User::create(['name' => 'Jovana Jovanović', 'email' => 'jovana@pwa.rs', 'password' => 'jovana' , 'role' => 'registered']);
    }
}
