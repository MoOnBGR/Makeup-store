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
        //Nara Apartado
        $corporal = Category::where('slug', 'cuidado-corporal')->first();
        $unas = Category::where('slug', 'cuidado-de-unas')->first();
        $capilar = Category::where('slug', 'cuidado-capilar')->first();


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
            //NARA APARTADO
            [
                'category_id' => $labiales->id,
                'name' => 'Gloss Labial Brillante',
                'description' => 'Gloss con acabado brillante y efecto voluminizador. Textura no pegajosa con aroma a vainilla.',
                'price' => 8200,
                'stock' => 30,
                'is_featured' => false,
                'image_url' => 'gloss.jpg',
            ],
            [
                'category_id' => $labiales->id,
                'name' => 'Labial Líquido Nude',
                'description' => 'Labial líquido de larga duración en tono nude. Acabado mate y confortable.',
                'price' => 12800,
                'stock' => 25,
                'is_featured' => false,
                'image_url' => 'labial-liquido.jpg',
            ],

            [
                'category_id' => $facial->id,
                'name' => 'Mascarilla Facial Hidratante',
                'description' => 'Mascarilla con ácido hialurónico. Hidratación profunda y rejuvenecimiento celular.',
                'price' => 12500,
                'stock' => 25,
                'is_featured' => false,
                'image_url' => 'mascarilla.jpg',
            ],
            [
                'category_id' => $facial->id,
                'name' => 'Crema Hidratante de Día SPF 30',
                'description' => 'Crema ligera con protección solar. Hidratación de larga duración y protección contra rayos UV.',
                'price' => 18500,
                'stock' => 20,
                'is_featured' => false,
                'image_url' => 'crema-dia.jpg',
            ],
            [
                'category_id' => $facial->id,
                'name' => 'Tónico Facial Refrescante',
                'description' => 'Tónico con agua de rosas y aloe vera. Equilibra el pH y refresca la piel.',
                'price' => 9500,
                'stock' => 30,
                'is_featured' => false,
                'image_url' => 'tonico.jpg',
            ],

            [
                'category_id' => $ojos->id,
                'name' => 'Delineador Líquido Black',
                'description' => 'Delineador líquido de alta precisión. Trazo intenso y resistente al agua.',
                'price' => 9500,
                'stock' => 40,
                'is_featured' => false,
                'image_url' => 'delineador.jpg',
            ],
            [
                'category_id' => $ojos->id,
                'name' => 'Paleta de Sombras Frías',
                'description' => '8 tonos en acabados satinados y mates. Colores fríos para looks sofisticados.',
                'price' => 21500,
                'stock' => 15,
                'is_featured' => false,
                'image_url' => 'paleta-fria.jpg',
            ],

            [
                'category_id' => $sets->id,
                'name' => 'Set Mini Viaje',
                'description' => 'Set de viaje con sérum facial, crema hidratante y bálsamo labial. Ideal para llevar a cualquier parte.',
                'price' => 28000,
                'stock' => 10,
                'is_featured' => false,
                'image_url' => 'set-viaje.jpg',
            ],
            [
                'category_id' => $sets->id,
                'name' => 'Set de Brochas Profesionales',
                'description' => 'Set de 12 brochas profesionales. Cerdas suaves y mangos ergonómicos para un maquillaje perfecto.',
                'price' => 32000,
                'stock' => 8,
                'is_featured' => false,
                'image_url' => 'set-brochas.jpg',
            ],

            [
                'category_id' => $labiales->id, 
                'name' => 'Bálsamo Labial con Color',
                'description' => 'Bálsamo labial con color natural. Hidratación y un toque de color para tus labios.',
                'price' => 7500,
                'stock' => 35,
                'is_featured' => false,
                'image_url' => 'balsamo-color.jpg',
            ],

            [
                'category_id' => $labiales->id,
                'name' => 'Labial Mate Frambuesa',
                'description' => 'Labial mate en tono frambuesa. Larga duración y textura sedosa.',
                'price' => 13800,
                'stock' => 20,
                'is_featured' => false,
                'image_url' => 'labial-frambuesa.jpg',
            ],
            [
                'category_id' => $ojos->id,
                'name' => 'Paleta de Sombras Neutrales',
                'description' => 'Paleta con 10 tonos neutros. Para looks de día y noche.',
                'price' => 19800,
                'stock' => 12,
                'is_featured' => false,
                'image_url' => 'paleta-neutral.jpg',
            ],
            [
                'category_id' => $ojos->id,
                'name' => 'Delineador en Gel Black',
                'description' => 'Delineador en gel de larga duración. Trazo preciso y resistente al agua.',
                'price' => 8900,
                'stock' => 30,
                'is_featured' => false,
                'image_url' => 'delineador-gel.jpg',
            ],
            [
                'category_id' => $sets->id,
                'name' => 'Set de Maquillaje Natural',
                'description' => 'Set con base, corrector y polvo traslúcido. Para un acabado natural.',
                'price' => 38000,
                'stock' => 8,
                'is_featured' => false,
                'image_url' => 'set-maquillaje-natural.jpg',
            ],
            [
                'category_id' => $sets->id,
                'name' => 'Set de Cuidado Facial Completo',
                'description' => 'Set con sérum, crema de día y crema de noche. Para una rutina completa.',
                'price' => 42000,
                'stock' => 6,
                'is_featured' => false,
                'image_url' => 'set-cuidado-facial.jpg',
            ],
            [
                'category_id' => $sets->id,
                'name' => 'Set de Regalo Lujo',
                'description' => 'Set de lujo con productos exclusivos. Ideal para regalar.',
                'price' => 55000,
                'stock' => 4,
                'is_featured' => false,
                'image_url' => 'set-lujo.jpg',
            ],
            [
                'category_id' => $corporal->id,
                'name' => 'Crema Hidratante para Manos',
                'description' => 'Hidratación profunda para manos secas. Textura ligera y de rápida absorción.',
                'price' => 7200,
                'stock' => 35,
                'is_featured' => false,
                'image_url' => 'crema-manos.jpg',
            ],
            [
                'category_id' => $corporal->id,
                'name' => 'Crema Reparadora para Pies',
                'description' => 'Repara y suaviza la piel de los pies. Fórmula con urea y manteca de karité.',
                'price' => 8500,
                'stock' => 30,
                'is_featured' => false,
                'image_url' => 'crema-pies.jpg',
            ],
            [
                'category_id' => $corporal->id,
                'name' => 'Exfoliante Corporal de Azúcar',
                'description' => 'Exfolia y suaviza la piel de todo el cuerpo. Elimina células muertas.',
                'price' => 7500,
                'stock' => 25,
                'is_featured' => false,
                'image_url' => 'exfoliante-corporal.jpg',
            ],
            [
                'category_id' => $corporal->id,
                'name' => 'Loción Corporal de Almendras',
                'description' => 'Hidratación suave y nutritiva para todo el cuerpo. Aroma a almendras dulces.',
                'price' => 10000,
                'stock' => 25,
                'is_featured' => false,
                'image_url' => 'locion-almendras.jpg',
            ],
            [
                'category_id' => $corporal->id,
                'name' => 'Aceite Corporal de Coco',
                'description' => 'Aceite nutritivo para la piel. Hidratación profunda y aroma tropical.',
                'price' => 12000,
                'stock' => 20,
                'is_featured' => false,
                'image_url' => 'aceite-coco.jpg',
            ],
            [
                'category_id' => $corporal->id,
                'name' => 'Crema Corporal de Manteca de Karité',
                'description' => 'Crema rica y nutritiva. Ideal para pieles muy secas.',
                'price' => 11000,
                'stock' => 22,
                'is_featured' => false,
                'image_url' => 'crema-karite.jpg',
            ],
            [
                'category_id' => $unas->id,
                'name' => 'Aceite de Cutículas',
                'description' => 'Nutre y fortalece las uñas. Previene la formación de padrastros.',
                'price' => 5500,
                'stock' => 40,
                'is_featured' => false,
                'image_url' => 'aceite-cuticulas.jpg',
            ],
            [
                'category_id' => $unas->id,
                'name' => 'Esmalte Fortalecedor',
                'description' => 'Fortalecer uñas débiles y quebradizas. Fórmula con calcio.',
                'price' => 6800,
                'stock' => 35,
                'is_featured' => false,
                'image_url' => 'esmalte-fortalecedor.jpg',
            ],
            [
                'category_id' => $unas->id,
                'name' => 'Base de Uñas Protectora',
                'description' => 'Protege las uñas de manchas y pigmentación. Aplicar antes del esmalte.',
                'price' => 6200,
                'stock' => 30,
                'is_featured' => false,
                'image_url' => 'base-unas.jpg',
            ],
            [
                'category_id' => $unas->id,
                'name' => 'Esmalte de Secado Rápido',
                'description' => 'Esmalte de secado rápido. Acabado brillante y duradero.',
                'price' => 7200,
                'stock' => 25,
                'is_featured' => false,
                'image_url' => 'esmalte-secado.jpg',
            ],
            [
                'category_id' => $unas->id,
                'name' => 'Limpiador de Uñas',
                'description' => 'Limpiador para preparar las uñas antes de aplicar el esmalte.',
                'price' => 5000,
                'stock' => 40,
                'is_featured' => false,
                'image_url' => 'limpiador-unas.jpg',
            ],
            [
                'category_id' => $unas->id,
                'name' => 'Set de Cuidado de Uñas',
                'description' => 'Set completo con aceite de cutículas, base, esmalte y limpiador.',
                'price' => 22000,
                'stock' => 10,
                'is_featured' => false,
                'image_url' => 'set-unas.jpg',
            ],
            [
                'category_id' => $capilar->id,
                'name' => 'Shampoo Hidratante',
                'description' => 'Limpia suavemente el cabello. Hidratación profunda y aroma floral.',
                'price' => 8500,
                'stock' => 30,
                'is_featured' => true,
                'image_url' => 'shampoo-hidratante.jpg',
            ],
            [
                'category_id' => $capilar->id,
                'name' => 'Acondicionador Nutritivo',
                'description' => 'Desenreda y nutre el cabello. Deja el cabello suave y manejable.',
                'price' => 9200,
                'stock' => 28,
                'is_featured' => true,
                'image_url' => 'acondicionador-nutritivo.jpg',
            ],
            [
                'category_id' => $capilar->id,
                'name' => 'Mascarilla Capilar Reparadora',
                'description' => 'Repara el cabello dañado. Nutrición intensiva y brillo.',
                'price' => 15000,
                'stock' => 18,
                'is_featured' => false,
                'image_url' => 'mascarilla-capilar.jpg',
            ],
            [
                'category_id' => $capilar->id,
                'name' => 'Aceite de Argan',
                'description' => 'Aceite nutritivo para el cabello. Brillo, suavidad y protección.',
                'price' => 12500,
                'stock' => 20,
                'is_featured' => false,
                'image_url' => 'aceite-argan.jpg',
            ],
            [
                'category_id' => $capilar->id,
                'name' => 'Sérum Capilar Sin Encrespamiento',
                'description' => 'Controla el encrespamiento. Deja el cabello liso y brillante.',
                'price' => 11000,
                'stock' => 22,
                'is_featured' => false,
                'image_url' => 'serum-encrespamiento.jpg',
            ],
            [
                'category_id' => $capilar->id,
                'name' => 'Spray Protector de Calor',
                'description' => 'Protege el cabello del calor de planchas y secadores.',
                'price' => 9800,
                'stock' => 25,
                'is_featured' => false,
                'image_url' => 'spray-proteccion.jpg',
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