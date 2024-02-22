<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        if ($request->has('email')) {
            $query->where('author_email', $request->email);
        }

        return $query->paginate(10);
    }
}
