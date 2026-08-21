<x-guest-layout>
    <div x-data="{ open: false }" x-init="setTimeout(() => open = true, 20)" class="relative min-h-screen bg-[#3b241c]/40">

        <!-- Fondo con imagen/tienda oscurecida (opcional, decorativo) -->
        <div class="absolute inset-0 bg-[#faf5f0]"></div>

        <!-- Backdrop oscuro, aparece con fade -->
        <div x-show="open"
             x-transition:enter="transition-opacity ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             class="fixed inset-0 bg-[#1a100c]/50 backdrop-blur-[2px]"
             @click="open = false; setTimeout(() => window.location = '{{ route('products.index') }}', 200)">
        </div>

        <!-- Panel lateral que se desliza desde la derecha -->
        <div x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="translate-x-full"
             x-transition:enter-end="translate-x-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="translate-x-0"
             x-transition:leave-end="translate-x-full"
             class="fixed top-0 right-0 h-full w-full sm:w-[440px] bg-white shadow-2xl overflow-y-auto">

            <div class="p-8 sm:p-10">

                <!-- Botón cerrar -->
                <div class="flex justify-end mb-2">
                    <a href="{{ route('products.index') }}" class="text-stone-400 hover:text-[#3b241c] transition text-2xl leading-none">
                        &times;
                    </a>
                </div>

                <div class="text-center mb-8">
                    <span class="inline-block bg-[#faf2ee] text-[#b87355] text-[10px] uppercase tracking-widest font-semibold px-3 py-1 rounded-full mb-3">
                        Aura &amp; Botánica
                    </span>
                    <h1 class="text-2xl font-serif text-[#3b241c]">Bienvenida de vuelta</h1>
                    <p class="text-sm text-stone-500 mt-1">Inicia sesión para continuar comprando</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-stone-600 mb-1">
                            {{ __('Correo Electrónico') }}
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}"
                               class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                               required autofocus autocomplete="username">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block text-sm font-semibold text-stone-600 mb-1">
                            {{ __('Contraseña') }}
                        </label>
                        <input id="password" type="password" name="password"
                               class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                               required autocomplete="current-password">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                   class="rounded border-rose-300 text-[#b87355] shadow-sm focus:ring-[#b87355]"
                                   name="remember">
                            <span class="ms-2 text-sm text-stone-600">{{ __('Recordarme') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-[#b87355] hover:underline"
                               href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                            class="w-full bg-[#3b241c] text-white text-center py-3 rounded-lg hover:bg-[#b87355] transition mt-6 text-sm font-semibold uppercase tracking-wider">
                        {{ __('Iniciar Sesión') }}
                    </button>
                </form>

                @if (Route::has('register'))
                    <div class="mt-6 pt-6 border-t border-stone-100 text-center">
                        <p class="text-sm text-stone-500 mb-3">¿Aún no tienes una cuenta?</p>
                        <a href="{{ route('register') }}"
                           class="inline-block w-full border border-[#3b241c] text-[#3b241c] text-center py-3 rounded-lg hover:bg-[#faf2ee] transition text-sm font-semibold uppercase tracking-wider">
                            {{ __('Registrarse') }}
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-guest-layout>