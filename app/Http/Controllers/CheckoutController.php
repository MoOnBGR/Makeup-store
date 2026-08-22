<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

            // Campos condicionales según el método de pago elegido
            'numero_tarjeta' => 'required_if:metodo_pago,tarjeta|nullable|string|min:13|max:19',
            'cvv' => 'required_if:metodo_pago,tarjeta|nullable|digits_between:3,4',
            'mes_expira' => 'required_if:metodo_pago,tarjeta|nullable|integer|between:1,12',
            'ano_expira' => 'required_if:metodo_pago,tarjeta|nullable|integer|min:' . date('Y'),

            'paypal_email' => 'required_if:metodo_pago,paypal|nullable|email',

            'sinpe_telefono' => 'required_if:metodo_pago,sinpe|nullable|string|max:20',
        ]);

        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $iva = $subtotal * 0.13;
        $envio = $subtotal > 50000 ? 0 : 3500;
        $total = $subtotal + $iva + $envio;

        // Simulación de procesamiento de pago (sin cobro real).
        // Aquí es donde, en un caso real, se llamaría a la pasarela correspondiente
        // (Stripe, PayPal SDK, etc.) según $request->metodo_pago.
        $pagoExitoso = $this->procesarPagoSimulado($request);

        if (! $pagoExitoso) {
            return back()->withInput()->with('error', 'No se pudo procesar el pago. Intenta de nuevo.');
        }

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

    /**
     * Simula el procesamiento de pago según el método elegido.
     * No realiza ningún cobro real ni llamada externa: es solo
     * la validación académica del flujo (punto 4 del enunciado).
     */
    private function procesarPagoSimulado(Request $request): bool
    {
        return match ($request->input('metodo_pago')) {
            'tarjeta' => $this->simularPagoTarjeta($request),
            'paypal' => $this->simularPagoPaypal($request),
            'sinpe' => $this->simularPagoSinpe($request),
            default => false,
        };
    }

    private function simularPagoTarjeta(Request $request): bool
    {
        // Validación básica tipo Luhn podría agregarse aquí si se requiere.
        // Por ahora, si los campos pasaron la validación del request, se acepta.
        return true;
    }

    private function simularPagoPaypal(Request $request): bool
    {
        // Aquí normalmente se redirigiría al SDK/checkout de PayPal
        // y se esperaría el callback de aprobación.
        return true;
    }

    private function simularPagoSinpe(Request $request): bool
    {
        return true;
    }
}