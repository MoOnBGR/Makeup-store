<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Panel de administración: listado de usuarios con su rol actual.
     */
    public function index(): View
    {
        $users = User::orderBy('name')->paginate(15);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Otorga o quita el rol de administrador a un usuario.
     */
    public function toggleAdmin(User $user): RedirectResponse
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'No puedes quitarte el rol de administrador a ti mismo.');
        }

        $user->is_admin = ! $user->is_admin;
        $user->save();

        $mensaje = $user->is_admin
            ? "{$user->name} ahora es administrador."
            : "{$user->name} ya no es administrador.";

        return back()->with('success', $mensaje);
    }
}