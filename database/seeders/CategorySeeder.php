<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Labiales',
            'Cuidado Facial',
            'Sombras & Ojos',
            'Sets de Regalo',

            //Nara Apartado
            'Cuidado Corporal',
            'Cuidado de Uñas',
            'Cuidado Capilar',
        ];

        foreach ($categories as $name) {
            Category::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'description' => 'Productos seleccionados de la categoría ' . $name,
            ]);
        }
    }
}