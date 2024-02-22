<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Recipe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Recipe::factory(50)
            ->hasIngredients(rand(5, 10))
            ->hasSteps(rand(5, 10))
            ->create();
    }
}
