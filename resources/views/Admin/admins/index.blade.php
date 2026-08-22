<x-app-layout>
    <div class="bg-[#faf5f0] min-h-screen text-stone-800 py-12">
        <div class="max-w-4xl mx-auto px-4">

            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-serif text-[#3b241c]">Administrativos</h1>
                    <p class="text-sm text-stone-500 mt-1">Crea nuevas cuentas con acceso administrativo.</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.users.index') }}"
                       class="border border-[#3b241c] text-[#3b241c] px-5 py-2.5 rounded-lg hover:bg-[#faf2ee] transition text-sm font-semibold uppercase tracking-wider">
                        Todos los usuarios
                    </a>
                    <a href="{{ route('reports.index') }}"
                       class="border border-[#3b241c] text-[#3b241c] px-5 py-2.5 rounded-lg hover:bg-[#faf2ee] transition text-sm font-semibold uppercase tracking-wider">
                        Reportes
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6 border border-green-200 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Formulario para crear un nuevo administrador -->
            <div class="bg-white p-6 sm:p-8 rounded-xl border border-rose-100 mb-8">
                <h2 class="font-serif text-xl text-[#3b241c] mb-6">Crear Nuevo Administrador</h2>

                <form method="POST" action="{{ route('admin.admins.store') }}">
                    @csrf

                    <div class="grid sm:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-stone-600 mb-1">Nombre Completo</label>
                            <input id="name" type="text" name="name" value="{{ old('name') }}"
                                   class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                                   required autocomplete="name">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-stone-600 mb-1">Correo Electrónico</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                   class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                                   required autocomplete="username">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-stone-600 mb-1">Contraseña</label>
                            <input id="password" type="password" name="password"
                                   class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                                   required autocomplete="new-password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-stone-600 mb-1">Confirmar Contraseña</label>
                            <input id="password_confirmation" type="password" name="password_confirmation"
                                   class="w-full border-rose-200 focus:border-[#b87355] focus:ring-[#b87355] rounded-lg text-sm"
                                   required autocomplete="new-password">
                        </div>
                    </div>

                    <button type="submit"
                            class="mt-6 bg-[#3b241c] text-white px-6 py-3 rounded-lg hover:bg-[#b87355] transition text-sm font-semibold uppercase tracking-wider">
                        Crear Administrador
                    </button>
                </form>
            </div>

            <!-- Lista de administradores actuales -->
            <div class="bg-white rounded-xl border border-rose-100 overflow-hidden">
                <div class="p-4 border-b border-stone-100">
                    <h2 class="font-serif text-lg text-[#3b241c]">Administradores Actuales</h2>
                </div>
                <table class="w-full text-sm">
                    <thead class="bg-[#3b241c] text-white text-xs uppercase tracking-wider">
                        <tr>
                            <th class="text-left p-3">Nombre</th>
                            <th class="text-left p-3">Correo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($admins as $admin)
                            <tr class="border-b border-stone-100">
                                <td class="p-3 font-semibold text-[#3b241c]">
                                    {{ $admin->name }}
                                    @if($admin->id === auth()->id())
                                        <span class="text-xs text-stone-400 italic">(tú)</span>
                                    @endif
                                </td>
                                <td class="p-3 text-stone-500">{{ $admin->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="p-6 text-center text-stone-400">No hay administradores registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>