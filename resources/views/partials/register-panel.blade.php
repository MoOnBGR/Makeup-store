
@guest
<div x-data
     x-init="@if(session('open_register_panel')) $store.registerPanel.open = true; @endif"
     x-show="$store.registerPanel.open"
     x-cloak
     class="relative z-50">
 
    <!-- Backdrop -->
    <div x-show="$store.registerPanel.open"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-[#1a100c]/50 backdrop-blur-[2px]"
         @click="$store.registerPanel.open = false">
    </div>
 
    <!-- Panel deslizante -->
    <div x-show="$store.registerPanel.open"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full"
         @click.outside="$store.registerPanel.open = false"
         class="fixed top-0 right-0 h-full w-full sm:w-[440px] bg-white shadow-2xl overflow-y-auto">
 
        <div class="p-8 sm:p-10">
 
            <div class="flex justify-end mb-2">
                <button @click="$store.registerPanel.open = false"
                        class="text-stone-400 hover:text-[#3b241c] transition text-2xl leading-none">
                    &times;
                </button>
            </div>
 
            <div class="text-center mb-8">
                <span class="inline-block bg-[#faf2ee] text-[#b87355] text-[10px] uppercase tracking-widest font-semibold px-3 py-1 rounded-full mb-3">
                    Aura &amp; Botánica
                </span>
                <h1 class="text-2xl font-serif text-[#3b241c]">Únete a nosotras</h1>
                <p class="text-sm text-stone-500 mt-1">Crea tu cuenta para empezar a comprar</p>
            </div>
 
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
 
                <div>
                    <label for="panel_name" class="block text-sm font-semibold text-stone-600 mb-1">
                        Nombre Completo
                    </label>
                    <input id="panel_name" type="text" name="name" value="{{ old('name') }}"
                           class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                           required autocomplete="name">
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
 
                <div class="mt-4">
                    <label for="panel_reg_email" class="block text-sm font-semibold text-stone-600 mb-1">
                        Correo Electrónico
                    </label>
                    <input id="panel_reg_email" type="email" name="email" value="{{ old('email') }}"
                           class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                           required autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
 
                <div class="mt-4">
                    <label for="panel_reg_password" class="block text-sm font-semibold text-stone-600 mb-1">
                        Contraseña
                    </label>
                    <input id="panel_reg_password" type="password" name="password"
                           class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                           required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
 
                <div class="mt-4">
                    <label for="panel_reg_password_confirmation" class="block text-sm font-semibold text-stone-600 mb-1">
                        Confirmar Contraseña
                    </label>
                    <input id="panel_reg_password_confirmation" type="password" name="password_confirmation"
                           class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                           required autocomplete="new-password">
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
 
                <button type="submit"
                        class="w-full bg-[#3b241c] text-white text-center py-3 rounded-lg hover:bg-[#b87355] transition mt-6 text-sm font-semibold uppercase tracking-wider">
                    Registrarme
                </button>
            </form>
 
            <div class="mt-6 pt-6 border-t border-stone-100 text-center">
                <p class="text-sm text-stone-500 mb-3">¿Ya tienes una cuenta?</p>
                <button @click="$store.registerPanel.open = false; $store.authPanel.open = true"
                        class="inline-block w-full border border-[#3b241c] text-[#3b241c] text-center py-3 rounded-lg hover:bg-[#faf2ee] transition text-sm font-semibold uppercase tracking-wider">
                    Iniciar Sesión
                </button>
            </div>
 
        </div>
    </div>
</div>
@endguest
