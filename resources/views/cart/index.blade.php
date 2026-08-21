<x-app-layout>
    <div class="bg-[#faf5f0] min-h-screen text-stone-800 py-12">
        <div class="max-w-5xl mx-auto px-4">
            <h1 class="text-3xl font-serif text-[#3b241c] mb-8"> Mi Carrito</h1>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 border border-green-200">
                      {{ session('success') }}
                </div>
            @endif

            @if(empty($cart))
                <div class="bg-white p-12 text-center rounded-xl border border-rose-100">
                    <p class="text-lg text-stone-500">Tu carrito está vacío</p>
                    <a href="{{ route('products.index') }}" class="inline-block mt-4 bg-[#3b241c] text-white px-6 py-2 rounded-lg hover:bg-[#b87355] transition">
                        Seguir comprando
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2 space-y-4">
                        @foreach($cart as $id => $item)
                            <div class="bg-white p-4 rounded-xl border border-rose-100 flex items-center gap-4">
                                <div class="w-20 h-20 bg-[#faf2ee] rounded-lg flex items-center justify-center overflow-hidden">
                                    @php
                                        $rutaImg = $item['image_url'] ? 'Imagen/' . $item['image_url'] : null;
                                        $imgFinal = ($rutaImg && file_exists(public_path($rutaImg)))
                                            ? asset($rutaImg)
                                            : asset('Imagen/placeholder.jpg');
                                    @endphp
                                    <img src="{{ $imgFinal }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                </div>

                                <div class="flex-1">
                                    <h3 class="font-serif text-[#3b241c] font-semibold">{{ $item['name'] }}</h3>
                                    <p class="text-sm text-[#b87355] font-bold">₡{{ number_format($item['price'], 0, ',', '.') }}</p>
                                </div>

                                <div class="flex items-center gap-2">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="flex items-center gap-1">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-14 border-rose-200 rounded-lg text-center text-sm">
                                        <button type="submit" class="text-xs bg-[#3b241c] text-white px-2 py-1 rounded hover:bg-[#b87355] transition">✓</button>
                                    </form>

                                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 text-sm">✕</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach

                        <div class="flex justify-between">
                            <a href="{{ route('products.index') }}" class="text-[#b87355] hover:underline text-sm">← Seguir comprando</a>
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Vaciar carrito</button>
                            </form>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl border border-rose-100 h-fit">
                        <h3 class="font-serif text-lg text-[#3b241c] mb-4">Resumen del pedido</h3>

                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-stone-500">Subtotal</span>
                                <span class="font-semibold">₡{{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-stone-500">IVA (13%)</span>
                                <span class="font-semibold">₡{{ number_format($iva, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-stone-500">Envío</span>
                                <span class="font-semibold">{{ $envio > 0 ? '₡' . number_format($envio, 0, ',', '.') : '0' }}</span>
                            </div>
                            <div class="border-t border-stone-200 pt-2 mt-2">
                                <div class="flex justify-between font-bold text-[#3b241c] text-lg">
                                    <span>Total</span>
                                    <span>₡{{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                                @if($subtotal > 50000)
                                    <p class="text-xs text-green-600 mt-1"> Envío gratis por compras mayores a ₡50,000</p>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('checkout') }}" class="block w-full bg-[#3b241c] text-white text-center py-3 rounded-lg hover:bg-[#b87355] transition mt-4 text-sm font-semibold uppercase tracking-wider">
                            Proceder al pago
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>