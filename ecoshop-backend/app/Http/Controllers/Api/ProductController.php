<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
   // Récupérer tous les produits avec leur catégorie
   public function index()
   {
       $products = Product::with('category')->get();
       return response()->json($products, 200);
   }

   // Récupérer un produit par son slug
   public function show($slug)
   {
       $product = Product::where('slug', $slug)->with('category')->first();

       if (!$product) {
           return response()->json(['message' => 'Produit non trouvé'], 404);
       }

       return response()->json($product, 200);
   }

   // Ajouter un nouveau produit
public function store(Request $request)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:products',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'stock' => 'required|integer',
        'image' => 'nullable|string',
    ]);

    $product = Product::create($validated);
    return response()->json($product, 201);
}

// Mettre à jour un produit existant
public function update(Request $request, $id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Produit non trouvé'], 404);
    }

    $validated = $request->validate([
        'category_id' => 'sometimes|required|exists:categories,id',
        'name' => 'sometimes|required|string|max:255',
        'slug' => 'sometimes|required|string|max:255|unique:products,slug,' . $product->id,
        'description' => 'sometimes|required|string',
        'price' => 'sometimes|required|numeric',
        'stock' => 'sometimes|required|integer',
        'image' => 'nullable|string',
    ]);

    $product->update($validated);
    return response()->json($product, 200);
}

// Supprimer un produit
public function destroy($id)
{
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Produit non trouvé'], 404);
    }

    $product->delete();
    return response()->json(['message' => 'Produit supprimé'], 200);
}
}
