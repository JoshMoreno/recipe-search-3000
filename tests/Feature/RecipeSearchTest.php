<?php

namespace Tests\Feature;

use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class RecipeSearchTest extends TestCase
{
    use RefreshDatabase;

    public function testItSearchesByAuthorEmail(): void
    {
        $email = 'bob@example.com';

        Recipe::factory()
            ->hasIngredients(3)
            ->hasSteps(3)
            ->create([
                'author_email' => $email,
            ]);

        Recipe::factory()
            ->hasIngredients(3, ['name' => $email])
            ->hasSteps(3, ['description' => $email])
            ->create([
                'author_email' => 'test@example.com',
            ]);

        Recipe::factory()
            ->hasIngredients(3)
            ->hasSteps(3)
            ->create([
                'author_email' => 'fuzzyTest' . $email,
            ]);

        $response = $this->getJson("/api/recipes?email=$email");

        $response->assertOk()
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('data', 1)
                ->where('data.0.author_email', $email)
                ->etc()
            );
    }

    public function testItSearchesByKeywordInNameDescriptionIngredientsAndSteps(): void
    {
        $recipe1 = Recipe::factory()
            ->hasIngredients(3)
            ->hasSteps(3)
            ->create([
                'name' => 'Scallop Salad',
            ]);

        $recipe2 = Recipe::factory()
            ->hasIngredients(3)
            ->hasSteps(3)
            ->create([
                'description' => 'This is the best scallop recipe ever!',
            ]);

        // inserting in the middle just to rule out ordering leading to false positives
        Recipe::factory(10, [
            'name' => 'Not a match',
            'description' => 'Not a match',
        ])
            ->hasIngredients(3, ['name' => 'Not a match'])
            ->hasSteps(3, ['description' => 'Not a match'])
            ->create();

        $recipe3 = Recipe::factory()
            ->hasIngredients(3, ['name' => 'large scallops'])
            ->hasSteps(3)
            ->create();

        $recipe4 = Recipe::factory()
            ->hasIngredients(3)
            ->hasSteps(3, ['description' => 'Boil the scallops'])
            ->create();

        $response = $this->getJson('/api/recipes?keyword=scallop');

        $response
            ->assertOk()
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('data', 4)
                ->where('data.0.id', $recipe1->id)
                ->where('data.0.name', 'Scallop Salad')
                ->where('data.1.id', $recipe2->id)
                ->where('data.1.description', 'This is the best scallop recipe ever!')
                ->where('data.2.id', $recipe3->id)
                ->where('data.3.id', $recipe4->id)
                ->etc()
            );
    }

    public function testItSearchesByIngredient(): void
    {
        $recipe1 = Recipe::factory()
            ->hasIngredients(3, ['name' => 'large potatoes'])
            ->hasSteps(3)
            ->create();

        // inserting in the middle just to rule out ordering leading to false positives
        Recipe::factory(10, [
            'name' => 'Not a match - potato',
            'description' => 'Not a match - potato',
        ])
            ->hasIngredients(3, ['name' => 'Not a match'])
            ->hasSteps(3, ['description' => 'Not a match - potato'])
            ->create();

        $recipe2 = Recipe::factory()
            ->hasIngredients(3, ['name' => 'potato'])
            ->hasSteps(3)
            ->create();

        $response = $this->getJson('/api/recipes?ingredient=potato');

        $response
            ->assertOk()
            ->assertJson(fn(AssertableJson $json) => $json
                ->has('data', 2)
                ->where('data.0.id', $recipe1->id)
                ->where('data.1.id', $recipe2->id)
                ->etc()
            );
    }

    public function testItDoesNotSearchWithoutArguments(): void
    {
        Recipe::factory(10)
            ->hasIngredients(3)
            ->hasSteps(3)
            ->create();

        $response = $this->getJson('/api/recipes');

        $response->assertJsonCount(10, 'data');
    }

    public function testItPaginatesBy10(): void
    {
        Recipe::factory(20)
            ->hasIngredients(3)
            ->hasSteps(3)
            ->create();

        $response = $this->getJson('/api/recipes');

        $response->assertJson(function (AssertableJson $json) {
            return $json
                ->count('data', 10)
                ->where('per_page', 10)
                ->has('links')
                ->has('current_page')
                ->etc();
        }
        );
    }
}
