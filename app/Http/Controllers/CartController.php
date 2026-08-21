<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
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

        return view('cart.index', compact('cart', 'subtotal', 'iva', 'envio', 'total'));
    }

    public function add(Request $request, $productId)
    {
        $product = Product::findOrFail($productId);
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image_url' => $product->image_url,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', '✅ ' . $product->name . ' agregado al carrito');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', '🗑️ Producto eliminado del carrito');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', '🔄 Cantidad actualizada');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', '🧹 Carrito vaciado');
    }
}