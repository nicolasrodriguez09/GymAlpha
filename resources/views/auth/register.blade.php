{{-- resources/views/auth/register.blade.php --}}
<x-guest-layout>
    {{-- Tarjeta (card) de registro con fondo azul oscuro --}}
    <div class="w-full sm:max-w-md bg-[#012D4A] rounded-xl shadow-lg px-6 py-8">

        {{-- Mensaje de estado --}}
        <x-auth-session-status class="mb-4 text-green-300" :status="session('status')" />

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- NOMBRE --}}
            <div class="mb-4">
                <x-input-label for="nombreUsu" :value="__('Nombre')" class="text-gray-200" />
                <x-text-input
                    id="nombreUsu"
                    type="text"
                    name="nombreUsu"
                    :value="old('nombreUsu')"
                    required
                    autofocus
                    autocomplete="name"
                    class="block mt-1 w-full
                           bg-[#014979]
                           text-white
                           placeholder-[#B0C4DE]
                           border border-[#01A287]
                           rounded
                           focus:ring-2 focus:ring-[#01A287] focus:border-transparent" />
                <x-input-error :messages="$errors->get('nombreUsu')" class="mt-2 text-red-400" />
            </div>

            {{-- APELLIDO --}}
            <div class="mb-4">
                <x-input-label for="apellidoUsu" :value="__('Apellido')" class="text-gray-200" />
                <x-text-input
                    id="apellidoUsu"
                    type="text"
                    name="apellidoUsu"
                    :value="old('apellidoUsu')"
                    required
                    autocomplete="apellidoUsu"
                    class="block mt-1 w-full
                           bg-[#014979]
                           text-white
                           placeholder-[#B0C4DE]
                           border border-[#01A287]
                           rounded
                           focus:ring-2 focus:ring-[#01A287] focus:border-transparent" />
                <x-input-error :messages="$errors->get('apellidoUsu')" class="mt-2 text-red-400" />
            </div>

            {{-- EMAIL --}}
            <div class="mb-4">
                <x-input-label for="emailUsu" :value="__('Email')" class="text-gray-200" />
                <x-text-input
                    id="emailUsu"
                    type="email"
                    name="emailUsu"
                    :value="old('emailUsu')"
                    required
                    autocomplete="username"
                    class="block mt-1 w-full
                           bg-[#014979]
                           text-white
                           placeholder-[#B0C4DE]
                           border border-[#01A287]
                           rounded
                           focus:ring-2 focus:ring-[#01A287] focus:border-transparent" />
                <x-input-error :messages="$errors->get('emailUsu')" class="mt-2 text-red-400" />
            </div>

            {{-- TELÉFONO --}}
            <div class="mb-4">
                <x-input-label for="telefonoUsu" :value="__('Teléfono')" class="text-gray-200" />
                <x-text-input
                    id="telefonoUsu"
                    type="text"
                    name="telefonoUsu"
                    :value="old('telefonoUsu')"
                    class="block mt-1 w-full
                           bg-[#014979]
                           text-white
                           placeholder-[#B0C4DE]
                           border border-[#01A287]
                           rounded
                           focus:ring-2 focus:ring-[#01A287] focus:border-transparent" />
                <x-input-error :messages="$errors->get('telefonoUsu')" class="mt-2 text-red-400" />
            </div>

            {{-- TIPO DE DOCUMENTO --}}
            <div class="mb-4">
                <x-input-label for="idTipoDoc" :value="__('Tipo de Documento')" class="text-gray-200" />
                <select id="idTipoDoc"
                        name="idTipoDoc"
                        required
                        class="block mt-1 w-full
                               bg-[#014979]
                               text-white
                               border border-[#01A287]
                               rounded
                               focus:ring-2 focus:ring-[#01A287] focus:border-transparent">
                    <option value="">Seleccione...</option>
                    @foreach($tiposDocumento as $tipo)
                        <option value="{{ $tipo->idTipoDoc }}"
                            {{ old('idTipoDoc') == $tipo->idTipoDoc ? 'selected' : '' }}>
                            {{ $tipo->nombreTipoDoc }}
                        </option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('idTipoDoc')" class="mt-2 text-red-400" />
            </div>

            {{-- NÚMERO DE IDENTIFICACIÓN --}}
            <div class="mb-4">
                <x-input-label for="numero_identificacion" :value="__('Número de Identificación')" class="text-gray-200" />
                <x-text-input
                    id="numero_identificacion"
                    type="text"
                    name="numero_identificacion"
                    :value="old('numero_identificacion')"
                    required
                    autocomplete="numero_identificacion"
                    class="block mt-1 w-full
                           bg-[#014979]
                           text-white
                           placeholder-[#B0C4DE]
                           border border-[#01A287]
                           rounded
                           focus:ring-2 focus:ring-[#01A287] focus:border-transparent" />
                <x-input-error :messages="$errors->get('numero_identificacion')" class="mt-2 text-red-400" />
            </div>

            {{-- CONTRASEÑA --}}
            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" class="text-gray-200" />
                <x-text-input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="new-password"
                    class="block mt-1 w-full
                           bg-[#014979]
                           text-white
                           placeholder-[#B0C4DE]
                           border border-[#01A287]
                           rounded
                           focus:ring-2 focus:ring-[#01A287] focus:border-transparent" />
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-400" />
            </div>

            {{-- CONFIRMAR CONTRASEÑA --}}
            <div class="mb-6">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-200" />
                <x-text-input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="block mt-1 w-full
                           bg-[#014979]
                           text-white
                           placeholder-[#B0C4DE]
                           border border-[#01A287]
                           rounded
                           focus:ring-2 focus:ring-[#01A287] focus:border-transparent" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-400" />
            </div>

            {{-- BOTÓN REGISTRAR + ENLACE A LOGIN --}}
            <div class="flex items-center justify-between">
                <a class="text-sm text-[#B0C4DE] hover:text-white underline"
                   href="{{ route('login') }}">
                    {{ __('¿Ya tienes una cuenta?') }}
                </a>

                <x-primary-button class="bg-green-500 hover:bg-green-600 text-black font-bold px-4 py-2 rounded">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
