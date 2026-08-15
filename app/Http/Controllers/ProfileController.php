<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Order;

class ProfileController extends Controller
{

    public function edit(Request $request): View
    {
        $user = $request->user();
        
        // Carga los pedidos del usuario con sus detalles (Módulo de Babs)
        // Usamos eager-loading para optimizar la consulta
        $orders = $user->orders()->with('details.product')->get();

        return view('profile.edit', [
            'user' => $user,
            'orders' => $orders,
        ]);
    }

    /**
     * Actualiza la información personal del perfil
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        // Asignación validada (incluyendo teléfono y dirección)
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Elimina la cuenta del usuario
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}