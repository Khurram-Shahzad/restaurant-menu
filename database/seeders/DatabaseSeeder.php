<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         //User::factory(10)->create();
         User::factory()->create([
             'name' => 'Khurram Shahzad',
             'email' => 'khurram_shahzad@icloud.com',
         ]);
         //Category::factory(10)->create();
    }
}
