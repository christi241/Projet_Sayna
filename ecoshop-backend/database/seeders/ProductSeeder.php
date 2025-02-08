<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = Category::all();

        foreach ($categories as $category) {
            // Créer 5 produits par catégorie
            for ($i = 1; $i <= 5; $i++) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $category->name . " Produit " . $i,
                    'slug' => strtolower(str_replace(' ', '-', $category->name)) . "-produit-" . $i,
                    'description' => "Description détaillée du " . $category->name . " produit " . $i . ".",
                    'price' => rand(10, 100),
                    'stock' => rand(0, 50),
                    'image' => 'https://via.placeholder.com/150', // URL d'image placeholder
                ]);
            }
        }
    }
}
