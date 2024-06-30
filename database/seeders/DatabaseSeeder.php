<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoomSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'master aziz',
            'email' => 'axnvee18@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'blue doorz',
            'email' => 'bluedoorz@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'guest',
            'email' => 'guest@gmail.com',
            'role' => 'guest',
            'password' => bcrypt('password'),
        ]);

        $this->call([
            RoomSeeder::class,
            CategorySeeder::class
        ]);
    }
}
