<x-app-layout>
    <div class="bg-[#faf5f0] min-h-screen text-stone-800">

        <!-- Banner Principal Hero -->
        <section class="relative bg-gradient-to-r from-[#f4e8e1] via-[#ebd9cd] to-[#dfc4b3] py-16 px-6 sm:px-12">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 items-center gap-12">
                <div class="space-y-6">
                    <span class="inline-block bg-[#3b241c] text-[#f4e8e1] text-[10px] uppercase tracking-widest font-semibold px-3 py-1 rounded-full">
                        Formulación Artesanal
                    </span>
                    <h2 class="text-4xl sm:text-5xl font-serif text-[#3b241c] leading-tight">
                        Resalta tu luz natural todos los días
                    </h2>
                    <p class="text-stone-600 text-sm sm:text-base leading-relaxed">
                        Cosmética infusionada con botánicos nutritivos, diseñados para cuidar tu piel y brindarte un acabado luminoso y duradero.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('products.index') }}" class="inline-block bg-[#3b241c] text-white px-8 py-3.5 text-xs font-semibold uppercase tracking-widest rounded hover:bg-[#b87355] transition shadow-md">
                            Ver Productos
                        </a>
                    </div>
                </div>

                <!-- Card de Producto Destacado en Hero -->
                <div class="relative flex justify-center">
                    <div class="w-full max-w-sm bg-white/90 backdrop-blur border border-rose-100 p-6 rounded-2xl shadow-xl text-center">
                        <span class="text-xs uppercase tracking-widest text-[#b87355] font-bold">Lanzamiento Estrella</span>
                        <div class="my-4 h-56 flex items-center justify-center overflow-hidden rounded-lg">
                            <img src="{{ asset('Imagen/serum.jpeg') }}" alt="Sérum Rosa Mosqueta" class="max-h-full object-contain hover:scale-105 transition duration-300">
                        </div>
                        <h3 class="font-serif text-xl text-[#3b241c]">Sérum Facial Rosa Mosqueta</h3>
                        <p class="text-xs text-stone-500 mt-1">Regeneración y nutrición profunda de 30 ml.</p>
                        <div class="mt-4 flex items-center justify-between border-t border-stone-100 pt-3">
                            <span class="text-lg font-bold text-[#3b241c]">₡22.500</span>
                            <a href="{{ route('products.index') }}" class="bg-[#b87355] text-white px-4 py-2 text-xs uppercase tracking-wider rounded hover:bg-[#3b241c] transition inline-block">
                                Añadir al Carrito
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sección de Categorías -->
        <section id="catalogo" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center mb-12">
                <span class="text-xs uppercase tracking-widest text-[#b87355] font-semibold">Explora la Tienda</span>
                <h3 class="font-serif text-3xl text-[#3b241c] uppercase tracking-wide mt-1">Categorías Principales</h3>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Categoría 1 -->
                <a href="{{ route('products.index') }}" class="bg-white p-4 text-center rounded-xl border border-rose-100 shadow-sm hover:shadow-md transition block">
                    <div class="h-32 mb-3 rounded-lg overflow-hidden flex items-center justify-center bg-[#faf2ee]">
                        <img src="{{ asset('Imagen/labial.jpg') }}" alt="Labiales Nude" class="h-full object-contain">
                    </div>
                    <h4 class="font-serif text-base text-[#3b241c] font-semibold">Labiales Nude</h4>
                    <p class="text-xs text-stone-500 mt-0.5">Desde ₡12.000</p>
                </a>

                <!-- Categoría 2 -->
                <a href="{{ route('products.index') }}" class="bg-white p-4 text-center rounded-xl border border-rose-100 shadow-sm hover:shadow-md transition block">
                    <div class="h-32 mb-3 rounded-lg overflow-hidden flex items-center justify-center bg-[#faf2ee]">
                        <img src="{{ asset('Imagen/cuidado.jpeg') }}" alt="Cuidado Facial" class="w-full h-full object-cover">
                    </div>
                    <h4 class="font-serif text-base text-[#3b241c] font-semibold">Cuidado Facial</h4>
                    <p class="text-xs text-stone-500 mt-0.5">Desde ₡18.500</p>
                </a>

                <!-- Categoría 3 -->
                <a href="{{ route('products.index') }}" class="bg-white p-4 text-center rounded-xl border border-rose-100 shadow-sm hover:shadow-md transition block">
                    <div class="h-32 mb-3 rounded-lg overflow-hidden flex items-center justify-center bg-[#faf2ee]">
                        <img src="{{ asset('Imagen/sombras.webp') }}" alt="Sombras & Ojos" class="w-full h-full object-cover">
                    </div>
                    <h4 class="font-serif text-base text-[#3b241c] font-semibold">Sombras & Ojos</h4>
                    <p class="text-xs text-stone-500 mt-0.5">Desde ₡15.000</p>
                </a>

                <!-- Categoría 4 -->
                <a href="{{ route('products.index') }}" class="bg-white p-4 text-center rounded-xl border border-rose-100 shadow-sm hover:shadow-md transition block">
                    <div class="h-32 mb-3 rounded-lg overflow-hidden flex items-center justify-center bg-[#faf2ee]">
                        <img src="{{ asset('Imagen/regalo.jpg') }}" alt="Sets de Regalo" class="w-full h-full object-cover">
                    </div>
                    <h4 class="font-serif text-base text-[#3b241c] font-semibold">Sets de Regalo</h4>
                    <p class="text-xs text-stone-500 mt-0.5">Desde ₡30.000</p>
                </a>
            </div>
        </section>

        <!-- Productos Destacados en Colones -->
        <section id="bestsellers" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 mb-12">
            <div class="flex justify-between items-end mb-8 border-b border-rose-200 pb-4">
                <div>
                    <span class="text-xs uppercase tracking-widest text-[#b87355] font-semibold">Colección Favorita</span>
                    <h3 class="font-serif text-2xl md:text-3xl text-[#3b241c] uppercase">Más Vendidos</h3>
                </div>
                <a href="{{ route('products.index') }}" class="text-xs font-semibold uppercase tracking-widest text-[#b87355] hover:underline">
                    Ver catálogo →
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                <!-- Producto 1 -->
                <div class="bg-white rounded-xl border border-rose-100 p-5 flex flex-col justify-between hover:shadow-lg transition">
                    <div>
                        <div class="bg-[#faf2ee] h-52 rounded-lg flex items-center justify-center overflow-hidden mb-4 relative p-2">
                            <img src="{{ asset('Imagen/vlevet.jpeg') }}" alt="Labial Velvet Matte" class="max-h-full object-contain">
                            <span class="absolute top-2 left-2 text-[10px] bg-[#3b241c] text-white px-2 py-0.5 rounded uppercase tracking-wider">Popular</span>
                        </div>
                        <h4 class="font-serif text-base text-[#3b241c] font-semibold">Labial Velvet Matte Rose</h4>
                        <p class="text-xs text-stone-500 mt-1">Acabado sedoso en tono mate duradero.</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-stone-100 flex items-center justify-between">
                        <span class="font-bold text-[#3b241c]">₡14.500</span>
                        <a href="{{ route('products.index') }}" class="bg-[#3b241c] text-white px-3 py-1.5 text-xs uppercase tracking-wider rounded hover:bg-[#b87355] transition inline-block">
                            Comprar
                        </a>
                    </div>
                </div>

                <!-- Producto 2 -->
                <div class="bg-white rounded-xl border border-rose-100 p-5 flex flex-col justify-between hover:shadow-lg transition">
                    <div>
                        <div class="bg-[#faf2ee] h-52 rounded-lg flex items-center justify-center overflow-hidden mb-4 p-2">
                            <img src="{{ asset('Imagen/polvo.jpg') }}" alt="Polvo Traslúcido" class="max-h-full object-contain">
                        </div>
                        <h4 class="font-serif text-base text-[#3b241c] font-semibold">Polvo Traslúcido Fijador</h4>
                        <p class="text-xs text-stone-500 mt-1">Sella el maquillaje sin recargar la piel.</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-stone-100 flex items-center justify-between">
                        <span class="font-bold text-[#3b241c]">₡19.000</span>
                        <a href="{{ route('products.index') }}" class="bg-[#3b241c] text-white px-3 py-1.5 text-xs uppercase tracking-wider rounded hover:bg-[#b87355] transition inline-block">
                            Comprar
                        </a>
                    </div>
                </div>

                <!-- Producto 3 -->
                <div class="bg-white rounded-xl border border-rose-100 p-5 flex flex-col justify-between hover:shadow-lg transition">
                    <div>
                        <div class="bg-[#faf2ee] h-52 rounded-lg flex items-center justify-center overflow-hidden mb-4 p-2">
                            <img src="{{ asset('Imagen/contorno.jpg') }}" alt="Contorno de Ojos" class="max-h-full object-contain">
                        </div>
                        <h4 class="font-serif text-base text-[#3b241c] font-semibold">Corrector Contorno de Ojos</h4>
                        <p class="text-xs text-stone-500 mt-1">Fórmula despigmentante y tonificante.</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-stone-100 flex items-center justify-between">
                        <span class="font-bold text-[#3b241c]">₡26.000</span>
                        <a href="{{ route('products.index') }}" class="bg-[#3b241c] text-white px-3 py-1.5 text-xs uppercase tracking-wider rounded hover:bg-[#b87355] transition inline-block">
                            Comprar
                        </a>
                    </div>
                </div>

                <!-- Producto 4 -->
                <div class="bg-white rounded-xl border border-rose-100 p-5 flex flex-col justify-between hover:shadow-lg transition">
                    <div>
                        <div class="bg-[#faf2ee] h-52 rounded-lg flex items-center justify-center overflow-hidden mb-4 p-2">
                            <img src="{{ asset('Imagen/paleta.jpg') }}" alt="Paleta de Sombras" class="max-h-full object-contain">
                        </div>
                        <h4 class="font-serif text-base text-[#3b241c] font-semibold">Paleta de Sombras Doradas</h4>
                        <p class="text-xs text-stone-500 mt-1">9 tonos satinados y mates ultra pigmentados.</p>
                    </div>
                    <div class="mt-6 pt-3 border-t border-stone-100 flex items-center justify-between">
                        <span class="font-bold text-[#3b241c]">₡21.500</span>
                        <a href="{{ route('products.index') }}" class="bg-[#3b241c] text-white px-3 py-1.5 text-xs uppercase tracking-wider rounded hover:bg-[#b87355] transition inline-block">
                            Comprar
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer / Beneficios -->
        <footer class="bg-white border-t border-rose-100 py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8 text-center text-stone-600 text-xs">
                <div>
                    <span class="text-xl">🚚</span>
                    <p class="font-semibold text-[#3b241c] uppercase mt-2">Envíos Rápidos</p>
                    <p class="mt-1">Entrega por Correos de Costa Rica o mensajería privada.</p>
                </div>
                <div>
                    <span class="text-xl">🌱</span>
                    <p class="font-semibold text-[#3b241c] uppercase mt-2">Libre de Crueldad</p>
                    <p class="mt-1">Todos nuestros cosméticos son 100% veganos y éticos.</p>
                </div>
                <div>
                    <span class="text-xl">💳</span>
                    <p class="font-semibold text-[#3b241c] uppercase mt-2">Pagos Seguros</p>
                    <p class="mt-1">Aceptamos SINPE Móvil y tarjetas de crédito/débito.</p>
                </div>
            </div>
        </footer>

    </div>
</x-app-layout>