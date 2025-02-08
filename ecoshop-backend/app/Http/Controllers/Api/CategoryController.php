<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    // Récupérer toutes les catégories
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    // Récupérer une catégorie par son slug avec ses produits
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->with('products')->first();

        if (!$category) {
            return response()->json(['message' => 'Catégorie non trouvée'], 404);
        }

        return response()->json($category, 200);
    }

    // Ajouter une nouvelle catégorie
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:categories',
    ]);

    $category = Category::create($validated);
    return response()->json($category, 201);
}

// Mettre à jour une catégorie existante
public function update(Request $request, $id)
{
    $category = Category::find($id);

    if (!$category) {
        return response()->json(['message' => 'Catégorie non trouvée'], 404);
    }

    $validated = $request->validate([
        'name' => 'sometimes|required|string|max:255',
        'slug' => 'sometimes|required|string|max:255|unique:categories,slug,' . $category->id,
    ]);

    $category->update($validated);
    return response()->json($category, 200);
}

// Supprimer une catégorie
public function destroy($id)
{
    $category = Category::find($id);

    if (!$category) {
        return response()->json(['message' => 'Catégorie non trouvée'], 404);
    }

    $category->delete();
    return response()->json(['message' => 'Catégorie supprimée'], 200);
}
}
