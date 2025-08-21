<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Brand;
use App\Models\Category;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

         User::updateOrCreate(
            [
                'email' => 'admin@developer.com',
            ],
            [
                'name' => 'admin',
                'role' => 'admin',
                'password' => Hash::make('Pass@786'),
            ]
        );


    }
}
