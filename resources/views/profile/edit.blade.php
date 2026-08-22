<x-app-layout>
    <div class="bg-[#faf5f0] min-h-screen text-stone-800 py-12">
        <div class="max-w-2xl mx-auto px-4 space-y-6">

            <h1 class="text-3xl font-serif text-[#3b241c] mb-2">Mi Cuenta</h1>
            <p class="text-sm text-stone-500 mb-8">Administra tu información personal y tu contraseña.</p>

            <div class="bg-white p-6 sm:p-8 rounded-xl border border-rose-100">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-xl border border-rose-100">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-white p-6 sm:p-8 rounded-xl border border-rose-100">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>