<?php

namespace Tests\Feature;

use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecipeDetailTest extends TestCase
{
    use RefreshDatabase;

    public function testItGetsRecipeBySlug(): void
    {
        Recipe::factory(10)
            ->hasIngredients(3)
            ->hasSteps(3)
            ->create();

        $recipe = Recipe::factory()
            ->hasIngredients(3)
            ->hasSteps(3)
            ->create([
                'slug' => 'test-123',
            ]);

        $response = $this->getJson('/api/recipes/test-123');

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $recipe->id,
                'slug' => 'test-123',
            ]);
    }
}
