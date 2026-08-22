<?php

use App\Http\Middleware\EnsureUserIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'admin' => EnsureUserIsAdmin::class,
        ]);

        $middleware->redirectGuestsTo(function ($request) {
            session()->flash('open_auth_panel', true);

            $previous = url()->previous();

            if (!$previous || $previous === $request->fullUrl()) {
                return route('dashboard');
            }

            return $previous;
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();