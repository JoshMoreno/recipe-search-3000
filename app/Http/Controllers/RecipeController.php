<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        if ($request->has('email')) {
            $query->where('author_email', $request->email);
        }

        if ($request->has('keyword')) {
            $searchValue = "%{$request->keyword}%";

            $query->where(function (Builder $query) use ($searchValue) {
                return $query->where('name', 'LIKE', $searchValue)
                    ->orWhere('description', 'LIKE', $searchValue)
                    ->orWhereRelation('ingredients', 'name', 'LIKE', $searchValue)
                    ->orWhereRelation('steps', 'description', 'LIKE', $searchValue);
            });
        }

        if ($request->has('ingredient')) {
            $query->whereRelation('ingredients', 'name', 'LIKE', "%{$request->ingredient}%");
        }

        return $query->paginate(10);
    }
}
