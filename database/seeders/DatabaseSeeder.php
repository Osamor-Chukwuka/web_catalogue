<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Website;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Insert 20 rows of data from the Website Factory
        Website::factory(20)->create();

        // Insert 10 rows of data from the Category factory
        Category::factory(10)->create();

    }
}
