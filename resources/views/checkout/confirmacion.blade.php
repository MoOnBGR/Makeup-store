<x-app-layout>
    <div class="bg-[#faf5f0] min-h-screen text-stone-800 py-12">
        <div class="max-w-2xl mx-auto px-4">
            <div class="bg-white p-8 rounded-xl border border-rose-100 text-center">
                <div class="text-6xl mb-4"></div>
                <h1 class="text-3xl font-serif text-[#3b241c] mb-4">¡Pedido Confirmado!</h1>
                <p class="text-stone-500 mb-2">Tu pedido ha sido procesado exitosamente.</p>

                <div class="bg-[#faf2ee] p-6 rounded-lg my-6 text-left">
                    <p class="text-sm text-stone-600"><strong>Número de seguimiento:</strong></p>
                    <p class="text-xl font-bold text-[#b87355]">{{ $order->tracking_number }}</p>
                    <p class="text-sm text-stone-600 mt-2"><strong>Total:</strong> ₡{{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    <p class="text-sm text-stone-600"><strong>Estado:</strong> <span class="text-green-600 font-semibold">{{ ucfirst($order->status) }}</span></p>
                    <p class="text-sm text-stone-600"><strong>Fecha:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <a href="{{ route('products.index') }}" class="inline-block bg-[#3b241c] text-white px-6 py-3 rounded-lg hover:bg-[#b87355] transition text-sm font-semibold uppercase tracking-wider">
                    Seguir comprando
                </a>
            </div>
        </div>
    </div>
</x-app-layout>