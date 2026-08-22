<nav x-data="{ open: false }" class="bg-white/80 backdrop-blur-md border-b border-rose-100 sticky top-0 z-50 shadow-sm">
    <!-- Top Announcement Bar -->
    <div class="bg-[#2d221e] text-[#e2b897] text-xs text-center py-2.5 px-4 tracking-widest uppercase font-semibold">
        🌸 ENVÍO GRATIS EN COSTA RICA EN COMPRAS MAYORES A ₡35.000 🌸
    </div>

    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20 gap-6">

            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <h1 class="text-2xl md:text-3xl font-serif text-[#3b241c] tracking-wider uppercase whitespace-nowrap">
                        Aura <span class="text-[#b87355] font-light">&</span> Botanica
                    </h1>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden md:flex items-center space-x-8 text-xs font-semibold tracking-widest uppercase text-stone-700">
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'text-[#b87355]' : 'hover:text-[#b87355]' }} transition">
                    Ofertas y de Temporada
                </a>
                <a href="{{ route('products.index') }}" class="{{ request()->routeIs('products.*') ? 'text-[#b87355]' : 'hover:text-[#b87355]' }} transition">
                    Catálogo Completo
                </a>
            </div>

            <!-- Enlace al Carrito -->
            <a href="{{ route('cart.index') }}" 
               class="{{ request()->routeIs('cart.*') ? 'text-[#b87355]' : 'hover:text-[#b87355]' }} transition flex items-center gap-1 text-xs font-semibold tracking-widest uppercase text-stone-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span>Carrito</span>
                @php
                    $cartCount = array_sum(session()->get('cart', []));
                @endphp
                @if($cartCount > 0)
                    <span class="bg-[#b87355] text-white text-[10px] rounded-full px-2 py-0.5 ml-1">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>

            <!-- Buscador -->
            <form action="{{ route('products.index') }}" method="GET" class="hidden lg:flex flex-1 max-w-xs">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar producto..."
                       class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm py-2">
            </form>

            <!-- Sección de Usuario / Autenticación -->
            <div class="hidden sm:flex sm:items-center gap-2">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="p-2 text-[#3b241c] hover:text-[#b87355] transition" title="Mi cuenta">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.4c-3.3 0-9.8 1.6-9.8 4.9v2.5h19.6v-2.5c0-3.3-6.5-4.9-9.8-4.9z"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                Personal
                            </x-dropdown-link>

                            @if(auth()->user()->is_admin)
                                <x-dropdown-link :href="route('reports.index')">
                                    Pedidos
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('admin.admins.index')">
                                    Administrativos
                                </x-dropdown-link>
                            @endif
                        </x-slot>
                    </x-dropdown>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="inline-flex items-center px-3.5 py-1.5 border border-[#b87355] text-[#b87355] text-xs uppercase tracking-widest rounded hover:bg-[#b87355] hover:text-white transition">
                            Cerrar Sesión
                        </button>
                    </form>
                @else
                    {{-- Invitado: ícono que abre el panel de login (sin recargar) --}}
                    <button @click="$store.authPanel.open = true"
                            class="p-2 text-[#3b241c] hover:text-[#b87355] transition"
                            title="Iniciar sesión">
                        <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 12c2.7 0 4.9-2.2 4.9-4.9S14.7 2.2 12 2.2 7.1 4.4 7.1 7.1 9.3 12 12 12zm0 2.4c-3.3 0-9.8 1.6-9.8 4.9v2.5h19.6v-2.5c0-3.3-6.5-4.9-9.8-4.9z"/>
                        </svg>
                    </button>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-stone-500 hover:text-stone-700 hover:bg-stone-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Móvil) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden border-t border-rose-100">
        <!-- Buscador móvil -->
        <form action="{{ route('products.index') }}" method="GET" class="px-4 pt-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar producto..."
                   class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm py-2">
        </form>

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('products.index')" :active="request()->routeIs('products.*')">
                {{ __('Catálogo Completo') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Mi Cuenta') }}
                    </x-responsive-nav-link>

                    @if(auth()->user()->is_admin)
                        <x-responsive-nav-link :href="route('reports.index')">
                            {{ __('Pedidos') }}
                        </x-responsive-nav-link>
                        <x-responsive-nav-link :href="route('admin.admins.index')">
                            {{ __('Administrativos') }}
                        </x-responsive-nav-link>
                    @endif

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Cerrar Sesión') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="px-4 py-2">
                    <button @click="$store.authPanel.open = true" 
                            class="w-full text-left font-medium text-base text-[#b87355]">
                        {{ __('Iniciar Sesión / Registrarse') }}
                    </button>
                </div>
            @endauth
        </div>
    </div>
</nav>