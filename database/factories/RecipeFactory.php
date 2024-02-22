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
            'author_email' => $this->faker->safeEmail(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
