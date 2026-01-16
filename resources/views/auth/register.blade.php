<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Nombre de barberia -->
        <div class="mt-4">
            <x-input-label for="barberia_nombre" value="Nombre de la barbería *" />
            <x-text-input id="barberia_nombre" name="barberia_nombre" type="text" class="mt-1 block w-full" required />
            <x-input-error :messages="$errors->get('barberia_nombre')" />
        </div>
        
        <!-- Telefono Barbería -->

        <div class="mt-4">
            <x-input-label for="barberia_telefono" value="Teléfono *" />
            <x-text-input id="barberia_telefono" name="barberia_telefono" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('barberia_telefono')" />
        </div>

        <!-- Dirección Barbería -->

        <div class="mt-4">
            <x-input-label for="barberia_direccion" value="Dirección" />
            <x-text-input id="barberia_direccion" name="barberia_direccion" type="text" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('barberia_direccion')" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
