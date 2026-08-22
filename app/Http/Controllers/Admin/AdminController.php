<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminController extends Controller
{
    /**
     * Muestra el formulario de creación y la lista de administradores actuales.
     */
    public function index(): View
    {
        $admins = User::where('is_admin', true)->orderBy('name')->get();

        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Crea un nuevo usuario que nace directamente con rol de administrador.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', "Se creó el administrador \"{$validated['name']}\" correctamente.");
    }
}