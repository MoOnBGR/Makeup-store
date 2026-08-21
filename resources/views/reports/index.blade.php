<x-app-layout>
    <div class="bg-[#faf5f0] min-h-screen text-stone-800 py-12">
        <div class="max-w-5xl mx-auto px-4">

            <div class="flex items-center justify-between mb-8">
                <h1 class="text-3xl font-serif text-[#3b241c]">Reporte de Ventas</h1>
                <a href="{{ route('reports.ventas.pdf', request()->query()) }}"
                   class="bg-[#3b241c] text-white px-6 py-2.5 rounded-lg hover:bg-[#b87355] transition text-sm font-semibold uppercase tracking-wider">
                    Descargar PDF
                </a>
            </div>

            <form method="GET" class="bg-white p-4 rounded-xl border border-rose-100 mb-6 flex gap-4 items-end">
                <div>
                    <label class="block text-xs text-stone-500 mb-1">Desde</label>
                    <input type="date" name="desde" value="{{ request('desde') }}"
                           class="border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm">
                </div>
                <div>
                    <label class="block text-xs text-stone-500 mb-1">Hasta</label>
                    <input type="date" name="hasta" value="{{ request('hasta') }}"
                           class="border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm">
                </div>
                <button type="submit"
                        class="bg-stone-700 text-white px-4 py-2 rounded-lg hover:bg-stone-800 transition text-sm">
                    Filtrar
                </button>
            </form>

            <div class="bg-white rounded-xl border border-rose-100 overflow-hidden">
                <table class="w-full text-sm">
                    <thead class="bg-[#3b241c] text-white text-xs uppercase tracking-wider">
                        <tr>
                            <th class="text-left p-3">Seguimiento</th>
                            <th class="text-left p-3">Fecha</th>
                            <th class="text-left p-3">Cliente</th>
                            <th class="text-right p-3">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr class="border-b border-stone-100">
                                <td class="p-3">{{ $order->tracking_number }}</td>
                                <td class="p-3">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="p-3">{{ $order->user->name ?? 'N/A' }}</td>
                                <td class="p-3 text-right font-semibold">₡{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-stone-400">No hay ventas registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $orders->links() }}
            </div>

        </div>
    </div>
</x-app-layout>