<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $labiales = Category::where('slug', 'labiales')->first();
        $facial = Category::where('slug', 'cuidado-facial')->first();
        $ojos = Category::where('slug', 'sombras-ojos')->first();
        $sets = Category::where('slug', 'sets-de-regalo')->first();

        $products = [
            // Labiales
            [
                'category_id' => $labiales->id,
                'name' => 'Labial Velvet Matte Rose',
                'description' => 'Acabado sedoso en tono mate duradero con pigmentos naturales.',
                'price' => 14500,
                'stock' => 15,
                'is_featured' => true,
                'image_url' => 'labial.jpg',
            ],
            [
                'category_id' => $labiales->id,
                'name' => 'Bálsemo Hidratante Nude Botanica',
                'description' => 'Enriquecido con manteca de karité y vitamina E para labios suaves.',
                'price' => 12000,
                'stock' => 20,
                'is_featured' => false,
                'image_url' => 'balsamo.jpg',
            ],

            // Cuidado Facial
            [
                'category_id' => $facial->id,
                'name' => 'Sérum Facial Rosa Mosqueta',
                'description' => 'Regeneración y nutrición profunda de 30 ml con extracto orgánico.',
                'price' => 22500,
                'stock' => 10,
                'is_featured' => true,
                'image_url' => 'serum2.jpg',
            ],
            [
                'category_id' => $facial->id,
                'name' => 'Polvo Traslúcido Fijador',
                'description' => 'Sella el maquillaje sin recargar la piel ni dejar residuos blancos.',
                'price' => 19000,
                'stock' => 12,
                'is_featured' => true,
                'image_url' => 'polvo2.jpg',
            ],
            [
                'category_id' => $facial->id,
                'name' => 'Corrector Contorno de Ojos',
                'description' => 'Fórmula despigmentante y tonificante que ilumina la mirada.',
                'price' => 26000,
                'stock' => 8,
                'is_featured' => true,
                'image_url' => 'correcotr.jpg',
            ],

            // Sombras & Ojos
            [
                'category_id' => $ojos->id,
                'name' => 'Paleta de Sombras Doradas',
                'description' => '9 tonos satinados y mates ultra pigmentados para cualquier ocasión.',
                'price' => 21500,
                'stock' => 14,
                'is_featured' => true,
                'image_url' => 'SombraOjos.jpg',
            ],
            [
                'category_id' => $ojos->id,
                'name' => 'Mascara de Pestañas Volumen Botánico',
                'description' => 'Volumen extremo y definición sin grumos a base de aceites naturales.',
                'price' => 15000,
                'stock' => 25,
                'is_featured' => false,
                'image_url' => 'mascara.jpg',
            ],

            // Sets de Regalo
            [
                'category_id' => $sets->id,
                'name' => 'Set Ritual Botánico Completo',
                'description' => 'Incluye sérum facial, bálsamo labial y paleta de sombras esencial.',
                'price' => 45000,
                'stock' => 5,
                'is_featured' => true,
                'image_url' => 'set.jpg',
            ],
        ];

        foreach ($products as $item) {
            Product::create([
                'category_id' => $item['category_id'],
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'description' => $item['description'],
                'price' => $item['price'],
                'stock' => $item['stock'],
                'image_url' => $item['image_url'],
                'is_featured' => $item['is_featured'],
            ]);
        }
    }
}