<?php

namespace Database\Factories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    protected $model = Recipe::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->text(),
            'author_email' => $this->generateEmail(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function generateEmail(): string
    {
        return $this->faker->randomElement([
            'gourmetGenius@example.com',
            'spicySensation@example.com',
            'sweetSavant@example.com',
            'bakingBard@example.com',
            'umamiUnicorn@example.com',
            'flavorVoyager@example.com',
            'pastryPioneer@example.com',
            'sushiSculptor@example.com',
            'coffeeConnoisseur@example.com',
            'veganVirtuoso@example.com',
            'cheeseChampion@example.com',
            'grillGuru@example.com',
            'pastaPatron@example.com',
            'dessertDesigner@example.com',
            'fusionFanatic@example.com',
        ]);
    }
}
