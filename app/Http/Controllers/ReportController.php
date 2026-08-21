<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Muestra un listado en pantalla de las ventas (opcional, útil para revisar antes de exportar).
     */
    public function index(Request $request)
    {
        $orders = $this->ordersQuery($request)->latest()->paginate(20);

        return view('reports.index', compact('orders'));
    }

    /**
     * Genera y descarga el PDF con el reporte de ventas.
     * Acepta filtros opcionales por fecha vía query string: ?desde=2026-01-01&hasta=2026-01-31
     */
    public function ventasPdf(Request $request)
    {
        $orders = $this->ordersQuery($request)->latest()->get();

        $totalVentas = $orders->sum('total_amount');

        $pdf = Pdf::loadView('reports.ventas-pdf', [
            'orders' => $orders,
            'totalVentas' => $totalVentas,
            'desde' => $request->input('desde'),
            'hasta' => $request->input('hasta'),
        ])->setPaper('a4', 'portrait');

        $nombreArchivo = 'reporte-ventas-' . now()->format('Y-m-d_His') . '.pdf';

        return $pdf->download($nombreArchivo);
    }

    /**
     * Query reutilizable con filtros de fecha opcionales.
     */
    private function ordersQuery(Request $request)
    {
        $query = Order::with('details.product')->where('status', 'confirmado');

        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->input('desde'));
        }

        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->input('hasta'));
        }

        return $query;
    }
}