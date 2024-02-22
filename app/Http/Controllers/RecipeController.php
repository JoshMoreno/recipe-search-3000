<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        $validated = $request->validate([
            'email' => 'nullable|string',
            'keyword' => 'nullable|string',
            'ingredient' => 'nullable|string',
        ]);

        if ($validated['email'] ?? '') {
            $query->where('author_email', $validated['email']);
        }

        if ($validated['keyword'] ?? '') {
            $searchValue = "%{$validated['keyword']}%";

            $query->where(function (Builder $query) use ($searchValue) {
                return $query->where('name', 'LIKE', $searchValue)
                    ->orWhere('description', 'LIKE', $searchValue)
                    ->orWhereRelation('ingredients', 'name', 'LIKE', $searchValue)
                    ->orWhereRelation('steps', 'description', 'LIKE', $searchValue);
            });
        }

        if ($validated['ingredient'] ?? '') {
            $query->whereRelation('ingredients', 'name', 'LIKE', "%{$validated['ingredient']}%");
        }

        return $query->paginate(10);
    }

    public function show(Recipe $recipe)
    {
        return $recipe->load([
            'steps' => function (HasMany $query) {
                $query->orderBy('order');
            },
            'ingredients',
        ]);
    }
}
