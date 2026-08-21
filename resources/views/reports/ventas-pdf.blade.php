<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: 'Helvetica', sans-serif; font-size: 12px; color: #3b241c; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        .subtitulo { color: #888; font-size: 11px; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th { background-color: #3b241c; color: #fff; text-align: left; padding: 8px; font-size: 11px; text-transform: uppercase; }
        td { padding: 8px; border-bottom: 1px solid #eee; font-size: 11px; }
        .text-right { text-align: right; }
        .total-row td { font-weight: bold; font-size: 13px; border-top: 2px solid #3b241c; }
    </style>
</head>
<body>

    <h1>Aura &amp; Botánica — Reporte de Ventas</h1>
    <p class="subtitulo">
        Generado el {{ now()->format('d/m/Y H:i') }}
        @if($desde || $hasta)
            &nbsp;|&nbsp; Periodo:
            {{ $desde ? \Carbon\Carbon::parse($desde)->format('d/m/Y') : 'Inicio' }}
            —
            {{ $hasta ? \Carbon\Carbon::parse($hasta)->format('d/m/Y') : 'Hoy' }}
        @endif
    </p>

    <table>
        <thead>
            <tr>
                <th>Seguimiento</th>
                <th>Fecha</th>
                <th>Cliente</th>
                <th class="text-right">Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
                <tr>
                    <td>{{ $order->tracking_number }}</td>
                    <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td class="text-right">₡{{ number_format($order->total_amount, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align:center; padding: 20px;">No hay ventas registradas en este periodo.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3">Total General</td>
                <td class="text-right">₡{{ number_format($totalVentas, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

</body>
</html>