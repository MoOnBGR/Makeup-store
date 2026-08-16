<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $query = Product::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->get();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Request $request, $id)
    {
        // 1. Buscar el producto o fallar si no existe
        $product = Product::findOrFail($id);

        // Forzar el ID actual a entero para mantener consistencia
        $id = (int) $id;

        // 2. Obtener los IDs actuales de la cookie (por defecto un array vacío)
        $idsVistos = json_decode($request->cookie('ultimos_productos_vistos', '[]'), true) ?? [];

        // 3. Eliminar el ID si ya existía (convertido a enteros por seguridad)
        $idsVistos = array_map('intval', $idsVistos);
        $idsVistos = array_values(array_diff($idsVistos, [$id]));

        // 4. Agregar el nuevo ID al inicio del array
        array_unshift($idsVistos, $id);

        // 5. Limitar el historial a los últimos 5 elementos
        $idsVistos = array_slice($idsVistos, 0, 5);

        // 6. Guardar la cookie por 45,000 minutos (~30 días) y retornar la vista
        $cookie = cookie('ultimos_productos_vistos', json_encode($idsVistos), 45000);

        return response()->view('products.show', compact('product'))->cookie($cookie);
    }


    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Obtenemos el carrito actual de la sesión
        $cart = session()->get('cart', []);

        //aumentamos la cantidad
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', $product->name . ' fue agregado al carrito.');
    }

}