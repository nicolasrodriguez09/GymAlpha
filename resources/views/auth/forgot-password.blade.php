{{-- resources/views/auth/forgot-password.blade.php --}}
<x-guest-layout>
    {{-- CAJA (CARD) PARA “FORGOT PASSWORD” --}}
    <div class="w-full sm:max-w-md
                bg-[#012D4A]         {{-- Azul oscuro --}}
                rounded-xl
                shadow-lg
                px-6 py-8">

        {{-- (Opcional) Si quieres un pequeño título dentro de la tarjeta, aunque la cabecera ya diga “Bienvenido a Gym Alpha” --}}
        {{--
        <h2 class="text-center text-white text-xl font-semibold mb-6">
            Restablecer contraseña
        </h2>
        --}}

        {{-- Texto descriptivo (en gris claro) --}}
        <p class="text-gray-200 mb-6 text-sm">
            ¿Olvidaste tu contraseña? No hay problema. Ingresa tu correo electrónico y te enviaremos un enlace para restablecerla.
        </p>

        {{-- Mostrar mensajes de estado (por ejemplo: “Se envió el enlace a tu correo”) --}}
        <x-auth-session-status class="mb-4 text-green-300" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" class="text-gray-200" />
                <x-text-input
                    id="email"
                    class="block mt-1 w-full
                           bg-[#014979]           {{-- Azul medio para input --}}
                           text-white
                           placeholder-[#B0C4DE]
                           border border-[#01A287]  {{-- Borde verde-azulado --}}
                           rounded
                           focus:ring-2 focus:ring-[#01A287] focus:border-transparent"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
            </div>

            {{-- Botón “Email Password Reset Link” --}}
            <div class="flex items-center justify-end mt-6">
                <x-primary-button class="bg-green-500 hover:bg-green-600 text-black font-bold px-4 py-2 rounded">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
