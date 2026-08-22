<x-app-layout>
    <div class="bg-[#faf5f0] min-h-screen text-stone-800 py-12">
        <div class="max-w-5xl mx-auto px-4">
            <h1 class="text-3xl font-serif text-[#3b241c] mb-8">Finalizar Compra</h1>

            @if(session('error'))
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 border border-red-200">
                    {{ session('error') }}
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
                    <div class="lg:col-span-2">
                        <div class="bg-white p-6 rounded-xl border border-rose-100" x-data="{ metodo: 'tarjeta' }">
                            <h2 class="font-serif text-xl text-[#3b241c] mb-6">Datos de Pago</h2>

                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-stone-600 mb-1">Nombre Completo</label>
                                    <input type="text" name="nombre" value="{{ old('nombre', Auth::user()->name) }}"
                                           class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                                           required>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-stone-600 mb-1">Correo Electrónico</label>
                                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                                           class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                                           required>
                                </div>
                                <div class="mb-4">
                                    <label class="block text-sm font-semibold text-stone-600 mb-1">Dirección de Envío</label>
                                    <input type="text" name="direccion" value="{{ old('direccion') }}" placeholder="Calle, número, ciudad, provincia"
                                           class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                                           required>
                                </div>

                                <div class="border-t border-stone-200 my-6 pt-4">
                                    <h3 class="font-serif text-lg text-[#3b241c] mb-4">Método de Pago</h3>

                                    <div class="space-y-3">
                                        <label class="flex items-center gap-3 p-3 border border-rose-100 rounded-lg cursor-pointer hover:bg-[#faf2ee] transition">
                                            <input type="radio" name="metodo_pago" value="tarjeta" x-model="metodo">
                                            <span class="text-sm font-semibold">Tarjeta de Crédito/Débito</span>
                                        </label>
                                        <label class="flex items-center gap-3 p-3 border border-rose-100 rounded-lg cursor-pointer hover:bg-[#faf2ee] transition">
                                            <input type="radio" name="metodo_pago" value="paypal" x-model="metodo">
                                            <span class="text-sm font-semibold">PayPal</span>
                                        </label>
                                        <label class="flex items-center gap-3 p-3 border border-rose-100 rounded-lg cursor-pointer hover:bg-[#faf2ee] transition">
                                            <input type="radio" name="metodo_pago" value="sinpe" x-model="metodo">
                                            <span class="text-sm font-semibold">SINPE Móvil</span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Datos de Tarjeta: solo visible si metodo === 'tarjeta' -->
                                <div x-show="metodo === 'tarjeta'" x-cloak class="border-t border-stone-200 my-6 pt-4">
                                    <h4 class="text-sm font-semibold text-stone-600 mb-3">Datos de la Tarjeta</h4>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-xs text-stone-500 mb-1">Número de Tarjeta</label>
                                            <input type="text" name="numero_tarjeta" placeholder="1234 5678 9012 3456" maxlength="19"
                                                   class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                                                   oninput="this.value = this.value.replace(/\s/g, '').replace(/(.{4})/g, '$1 ').trim()">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-stone-500 mb-1">CVV</label>
                                            <input type="text" name="cvv" placeholder="123" maxlength="4"
                                                   class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm">
                                        </div>
                                        <div>
                                            <label class="block text-xs text-stone-500 mb-1">Mes Expiración</label>
                                            <select name="mes_expira" class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm">
                                                @for($i=1; $i<=12; $i++)
                                                    <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-xs text-stone-500 mb-1">Año Expiración</label>
                                            <select name="ano_expira" class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm">
                                                @for($i=date('Y'); $i<=date('Y')+10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Datos de PayPal: solo visible si metodo === 'paypal' -->
                                <div x-show="metodo === 'paypal'" x-cloak class="border-t border-stone-200 my-6 pt-4">
                                    <h4 class="text-sm font-semibold text-stone-600 mb-3">Datos de PayPal</h4>
                                    <div class="bg-[#faf2ee] border border-rose-100 rounded-lg p-4 text-xs text-stone-500 mb-3">
                                        Serás redirigido a PayPal para autorizar el pago de forma segura.
                                        (Simulación académica — no se procesa un cobro real.)
                                    </div>
                                    <label class="block text-xs text-stone-500 mb-1">Correo asociado a tu cuenta PayPal</label>
                                    <input type="email" name="paypal_email" placeholder="tucuenta@paypal.com"
                                           class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm">
                                </div>

                                <!-- Datos de SINPE: solo visible si metodo === 'sinpe' -->
                                <div x-show="metodo === 'sinpe'" x-cloak class="border-t border-stone-200 my-6 pt-4">
                                    <h4 class="text-sm font-semibold text-stone-600 mb-3">Datos de SINPE Móvil</h4>
                                    <div class="bg-[#faf2ee] border border-rose-100 rounded-lg p-4 text-xs text-stone-500 mb-3">
                                        Recibirás un mensaje de confirmación a este número.
                                        (Simulación académica — no se procesa un cobro real.)
                                    </div>
                                    <label class="block text-xs text-stone-500 mb-1">Número de teléfono</label>
                                    <input type="text" name="sinpe_telefono" placeholder="8888-8888"
                                           class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm">
                                </div>

                                <button type="submit" class="w-full bg-[#3b241c] text-white text-center py-3 rounded-lg hover:bg-[#b87355] transition mt-4 text-sm font-semibold uppercase tracking-wider">
                                    Confirmar Pago
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl border border-rose-100 h-fit">
                        <h3 class="font-serif text-lg text-[#3b241c] mb-4">Resumen del Pedido</h3>

                        <div class="space-y-2 text-sm max-h-60 overflow-y-auto">
                            @foreach($cart as $id => $item)
                                <div class="flex justify-between border-b border-stone-100 py-2">
                                    <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                                    <span class="font-semibold">₡{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="border-t border-stone-200 pt-4 mt-4 space-y-2 text-sm">
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
                                <span class="font-semibold">{{ $envio > 0 ? '₡' . number_format($envio, 0, ',', '.') : 'Gratis' }}</span>
                            </div>
                            <div class="border-t border-stone-200 pt-2 mt-2">
                                <div class="flex justify-between font-bold text-[#3b241c] text-lg">
                                    <span>Total</span>
                                    <span>₡{{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('cart.index') }}" class="block w-full text-center text-[#b87355] hover:underline text-sm mt-4">
                            ← Volver al carrito
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>