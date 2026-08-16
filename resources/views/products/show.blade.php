<x-app-layout>
    <div class="bg-[#faf5f0] min-h-screen text-stone-800">

        <!-- Top Header -->
        <header class="bg-white/80 backdrop-blur-md border-b border-rose-100 sticky top-0 z-50 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                <a href="{{ route('products.index') }}" class="text-xs font-semibold uppercase tracking-widest text-[#b87355] hover:underline flex items-center gap-1">
                    ← Volver al Catálogo
                </a>
                <h1 class="text-xl font-serif text-[#3b241c] uppercase">Aura & Botanica</h1>
                <div class="w-20"></div>
            </div>
        </header>

        <!-- Detalle del Producto -->
        <section class="max-w-5xl mx-auto px-4 py-12">
            <div class="bg-white rounded-2xl border border-rose-100 shadow-sm overflow-hidden grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                
                <!-- Imagen / Placeholder -->
                <div class="bg-[#faf2ee] h-80 md:h-full rounded-xl flex flex-col items-center justify-center text-[#b87355] p-6 text-center overflow-hidden relative">
                    @php
                        $rutaImg = $product->image_url ? 'Imagen/' . $product->image_url : null;
                        $imgFinal = ($rutaImg && file_exists(public_path($rutaImg)))
                            ? asset($rutaImg)
                            : asset('Imagen/placeholder.jpg');
                    @endphp

                    <img src="{{ $imgFinal }}" 
                         alt="{{ $product->name }}" 
                         class="h-full w-full object-cover rounded-xl">
                </div>

                <!-- Detalles e Información -->
                <div class="flex flex-col justify-between">
                    <div>
                        <span class="text-xs uppercase tracking-widest text-[#b87355] font-bold">{{ $product->category->name }}</span>
                        <h2 class="text-3xl font-serif text-[#3b241c] mt-1">{{ $product->name }}</h2>
                        
                        <div class="text-2xl font-bold text-[#3b241c] mt-4">
                            ₡{{ number_format($product->price, 0, ',', '.') }}
                        </div>

                        <div class="mt-6 border-t border-stone-100 pt-4">
                            <h3 class="text-xs font-semibold uppercase tracking-wider text-stone-600 mb-2">Descripción:</h3>
                            <p class="text-stone-600 text-sm leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <div class="mt-4 text-xs text-stone-500">
                            Disponibles en inventario: <strong class="text-stone-700">{{ $product->stock }} unidades</strong>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-stone-100 flex gap-4">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" class="w-full bg-[#3b241c] text-white py-3 text-xs uppercase tracking-widest rounded-lg hover:bg-[#b87355] transition">
                                Añadir al Carrito
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    </div>
</x-app-layout>