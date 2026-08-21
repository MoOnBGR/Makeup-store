<x-app-layout>
    <div class="bg-[#faf5f0] min-h-screen text-stone-800">

        <!-- Barra de Búsqueda y Filtros -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-10 pb-4">
            <div class="bg-white p-6 rounded-2xl border border-rose-100 shadow-sm">
                <form action="{{ route('products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                    
                    <!-- Búsqueda por palabra clave -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-600 mb-1">Buscar Producto</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Ej: Sérum, Labial..." class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm">
                    </div>

                    <!-- Filtro por Categorías -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-600 mb-1">Categoría</label>
                        <select name="category_id" class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm">
                            <option value="">Todas las categorías</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filtro por Precio Máximo -->
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-stone-600 mb-1">Precio Máximo (₡)</label>
                        <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Ej: 20000" class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm">
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-2">
                        <button type="submit" class="w-full bg-[#3b241c] text-white py-2.5 px-4 text-xs font-semibold uppercase tracking-widest rounded-lg hover:bg-[#b87355] transition">
                            Filtrar
                        </button>
                        @if(request()->hasAny(['search', 'category_id', 'max_price']))
                            <a href="{{ route('products.index') }}" class="py-2.5 px-3 bg-stone-100 text-stone-600 text-xs uppercase rounded-lg hover:bg-stone-200 transition text-center flex items-center justify-center">
                                Limpiar
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </section>

        <!-- Catálogo de Productos (Grid Dinámico) -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex justify-between items-end mb-8 border-b border-rose-200 pb-4">
                <div>
                    <span class="text-xs uppercase tracking-widest text-[#b87355] font-semibold">Nuestra Colección</span>
                    <h2 class="font-serif text-2xl md:text-3xl text-[#3b241c] uppercase">Catálogo de Productos</h2>
                </div>
                <span class="text-xs text-stone-500 font-semibold uppercase tracking-wider">
                    Mostrando {{ $products->count() }} producto(s)
                </span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                @forelse($products as $product)
                    <div class="bg-white rounded-xl border border-rose-100 p-5 flex flex-col justify-between hover:shadow-lg transition">
                        <div>
                            <div class="bg-[#faf2ee] h-52 rounded-lg flex flex-col items-center justify-center overflow-hidden mb-4 relative p-2 text-[#b87355]">
                                @php
                                    // Armamos la ruta relativa dentro de public/Imagen
                                    if ($product->image_url) {
                                        $rutaImg = str_starts_with($product->image_url, 'Imagen/')
                                            ? $product->image_url
                                            : 'Imagen/' . $product->image_url;
                                    } else {
                                        $rutaImg = 'Imagen/Producto' . $loop->iteration . '.jpeg';
                                    }

                                    // Verificamos si el archivo existe físicamente, si no, usamos placeholder
                                    $imgFinal = file_exists(public_path($rutaImg))
                                        ? asset($rutaImg)
                                        : asset('Imagen/placeholder.jpg');
                                @endphp

                                <img src="{{ $imgFinal }}" 
                                     alt="{{ $product->name }}" 
                                     class="h-full w-full object-cover rounded-lg">

                                @if($product->is_featured)
                                    <span class="absolute top-2 left-2 text-[10px] bg-[#3b241c] text-white px-2 py-0.5 rounded uppercase tracking-wider">Destacado</span>
                                @endif
                            </div>
                            <h3 class="font-serif text-base text-[#3b241c] font-semibold">{{ $product->name }}</h3>
                            <p class="text-xs text-stone-500 mt-1">{{ Str::limit($product->description, 60) }}</p>
                        </div>
                        <div class="mt-6 pt-3 border-t border-stone-100 flex items-center justify-between">
                            <span class="font-bold text-[#3b241c]">₡{{ number_format($product->price, 0, ',', '.') }}</span>
                            <a href="{{ route('products.show', $product->id) }}" class="bg-[#3b241c] text-white px-3 py-1.5 text-xs uppercase tracking-wider rounded hover:bg-[#b87355] transition">
                                Ver Detalle
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full bg-white p-12 text-center rounded-xl border border-rose-100 text-stone-500">
                        <p class="font-serif text-lg">No se encontraron productos con los criterios seleccionados.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 border-t border-rose-200 mt-12">
            <h3 class="font-serif text-2xl text-[#3b241c] mb-6"> Vistos Recientemente (Cookies)</h3>

            @php
                // Leemos la cookie según el estándar de tu guía
                $idsCrudos = json_decode(request()->cookie('ultimos_productos_vistos', '[]'), true) ?? [];
                
                // Consultamos los productos correspondientes a los IDs guardados
                $productosVistos = !empty($idsCrudos) 
                    ? \App\Models\Product::whereIn('id', $idsCrudos)->get()->keyBy('id')
                    : collect();
            @endphp

            @if(empty($idsCrudos) || $productosVistos->isEmpty())
                <p class="text-sm text-stone-500 bg-white p-4 rounded-lg border border-rose-100">
                    Aún no has explorado ningún producto individualmente. ¡Haz clic en <strong>Ver Detalle</strong> en alguno de los productos de arriba para probar la cookie!
                </p>
            @else
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
                    @foreach($idsCrudos as $id)
                        @if(isset($productosVistos[$id]))
                            @php 
                                $prod = $productosVistos[$id];

                                if ($prod->image_url) {
                                    $rutaImgVisto = str_starts_with($prod->image_url, 'Imagen/')
                                        ? $prod->image_url
                                        : 'Imagen/' . $prod->image_url;
                                } else {
                                    $rutaImgVisto = null;
                                }

                                $imgVistoFinal = ($rutaImgVisto && file_exists(public_path($rutaImgVisto)))
                                    ? asset($rutaImgVisto)
                                    : asset('Imagen/placeholder.jpg');
                            @endphp
                            <a href="{{ route('products.show', $prod->id) }}" class="bg-white p-3 rounded-lg border border-rose-100 hover:shadow-md transition text-center block">
                                <div class="bg-[#faf2ee] h-24 rounded flex items-center justify-center text-[#b87355] mb-2 overflow-hidden">
                                    <img src="{{ $imgVistoFinal }}" 
                                         alt="{{ $prod->name }}" 
                                         class="h-full w-full object-cover rounded">
                                </div>
                                <h4 class="font-serif text-xs font-semibold text-[#3b241c] truncate">{{ $prod->name }}</h4>
                                <span class="text-xs text-[#b87355] font-bold mt-1 block">₡{{ number_format($prod->price, 0, ',', '.') }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </section>

    </div>
</x-app-layout>