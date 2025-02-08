<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            ['name' => 'Vêtements Écologiques', 'slug' => 'vetements-ecologiques'],
            ['name' => 'Accessoires Durables', 'slug' => 'accessoires-durables'],
            ['name' => 'Produits de Beauté Naturels', 'slug' => 'produits-beaute-naturels'],
            ['name' => 'Maison Écologique', 'slug' => 'maison-ecologique'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
