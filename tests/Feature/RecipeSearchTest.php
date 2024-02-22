<?php

namespace Tests\Feature;

use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $response->assertOk();
        $response->assertJsonCount(1, 'data');
        $response->assertJsonFragment(['author_email' => $email]);
    }
}
