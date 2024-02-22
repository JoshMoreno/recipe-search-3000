<?php

namespace Database\Factories;

use App\Models\Ingredient;
use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    protected $model = Ingredient::class;

    public function definition(): array
    {
        return [
            'recipe_id' => $this->faker->randomNumber(),
            'quantity' => $this->faker->numberBetween(1, 10 * 4) * 0.25,
            'unit' => $this->faker->randomElement([
                'tsp', 'tbsp', 'cup', 'oz', 'lb', 'g', 'kg', 'ml', 'l',
            ]),
            'name' => $this->faker->randomElement([
                'Bell peppers',
                'Garlic',
                'Onions',
                'Tomatoes',
                'Zucchini',
                'Spinach',
                'Asparagus',
                'Lemon',
                'Parsley',
                'Dill',
                'Black pepper',
                'Sea salt',
                'Paprika',
                'Red pepper flakes',
                'Thyme',
                'Sockeye Salmon',
                'Sablefish',
                'Pacific Cod',
                'Pacific Halibut',
                'Coho Salmon',
                'Cold Smoked Sockeye',
                'Wild Alaska Pollock Quick Cuts',
                'Rockfish Fillets',
                'Coho Captain Cuts',
                'Sockeye Captain Cuts',
            ]),
        ];
    }
}
