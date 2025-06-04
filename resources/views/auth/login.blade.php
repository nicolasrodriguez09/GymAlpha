<x-guest-layout>
  {{-- CAJA (CARD) DEL FORMULARIO CON FONDO AZUL OSCURO --}}
  <div class="w-full sm:max-w-md
              bg-[#012D4A]         {{-- Azul oscuro --}}
              rounded-xl
              shadow-lg
              px-6 py-8">

    {{-- (Opcional) Si no quieres repetir “Bienvenido a Gym Alpha” aquí,
         puedes comentar este bloque. La cabecera general ya lo muestra. --}}
    {{--
    <h2 class="text-center text-white text-xl font-semibold mb-6">
      Inicia sesión en tu cuenta
    </h2>
    --}}

    {{-- Mensajes de estado --}}
    <x-auth-session-status class="mb-4 text-red-300" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
      @csrf

      {{-- Email --}}
      <div class="mb-4">
        <x-input-label for="emailUsu" :value="__('Email')" class="text-gray-200" />
        <x-text-input
          id="emailUsu"
          class="block mt-1 w-full
                 bg-[#014979]           {{-- Azul medio para inputs --}}
                 text-white
                 placeholder-[#B0C4DE]
                 border border-[#01A287]  {{-- Borde verde-azulado --}}
                 rounded
                 focus:ring-2 focus:ring-[#01A287] focus:border-transparent"
          type="email"
          name="emailUsu"
          :value="old('email')"
          required
          autofocus
          autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400" />
      </div>

      {{-- Password --}}
      <div class="mb-4">
        <x-input-label for="password" :value="__('Password')" class="text-gray-200" />
        <x-text-input
          id="password"
          class="block mt-1 w-full
                 bg-[#014979]
                 text-white
                 placeholder-[#B0C4DE]
                 border border-[#01A287]
                 rounded
                 focus:ring-2 focus:ring-[#01A287] focus:border-transparent"
          type="password"
          name="password"
          required
          autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
      </div>

      {{-- Remember me --}}
      <div class="flex items-center mb-4">
        <input
          id="remember_me"
          type="checkbox"
          class="h-4 w-4 rounded text-[#01A287] focus:ring-[#01A287] border-gray-300"
          name="remember" />
        <label for="remember_me" class="ml-2 text-sm text-gray-200">
          {{ __('Remember me') }}
        </label>
      </div>

      {{-- Forgot password + botón de login --}}
      <div class="flex items-center justify-between">
        @if (Route::has('password.request'))
          <a class="text-sm text-[#B0C4DE] hover:text-white underline"
             href="{{ route('password.request') }}">
            {{ __('¿Olvidaste tu contraseña?') }}
          </a>
        @endif

        <x-primary-button class="bg-green-500 hover:bg-green-600 text-black font-bold px-4 py-2 rounded">
          {{ __('Log in') }}
        </x-primary-button>
      </div>
    </form>
  </div>
</x-guest-layout>
