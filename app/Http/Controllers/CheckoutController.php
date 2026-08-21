<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\CheckoutController;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }

        $subtotal = 0;
        $iva = 0;
        $envio = 0;
        $total = 0;

        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $iva = $subtotal * 0.13;
        $envio = $subtotal > 50000 ? 0 : 3500;
        $total = $subtotal + $iva + $envio;

        return view('checkout.index', compact('cart', 'subtotal', 'iva', 'envio', 'total'));
    }

    public function process(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'El carrito está vacío');
        }
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'direccion' => 'required|string|max:500',
            'metodo_pago' => 'required|in:tarjeta,paypal,sinpe',
        ]);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $iva = $subtotal * 0.13;
        $envio = $subtotal > 50000 ? 0 : 3500;
        $total = $subtotal + $iva + $envio;

        $order = Order::create([
            'user_id' => auth()->id(),
            'tracking_number' => 'MNB-' . strtoupper(Str::random(8)),
            'total_amount' => $total,
            'status' => 'confirmado',
        ]);
        foreach ($cart as $productId => $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('checkout.confirmacion', $order);
    }

    public function confirmacion(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'No autorizado');
        }

        return view('checkout.confirmacion', compact('order'));
    }
}