<?php

namespace Database\Factories;

use App\Models\Step;
use Illuminate\Database\Eloquent\Factories\Factory;

class StepFactory extends Factory
{
    protected $model = Step::class;

    public function definition(): array
    {
        return [
            'recipe_id' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
        ];
    }
}
