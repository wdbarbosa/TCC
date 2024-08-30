<x-guest-layout>
@section('title', 'Cursinho Primeiro de Maio')

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
    @csrf

    <link rel="stylesheet" href="stylelogin.css">

    <!-- Email Address -->
    <div class="login"> LOGIN </div>
    <hr>
    <div class="mt-4">
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input
            id="email"
            class="block mt-1 w-full rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50"
            type="email"
            name="email"
            :value="old('email')"
            required
            autofocus
            autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <x-input-label for="password" :value="__('Senha')" />
        <x-text-input
            id="password"
            class="block mt-1 w-full rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50"
            type="password"
            name="password"
            required
            autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input
                id="remember_me"
                type="checkbox"
                class="rounded h-4 w-4 text-cyan-400 transition duration-150 ease-in-out"
                name="remember">
            <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('lembrar-me') }}</span>
        </label>
    </div>

    <!-- Button -->
    <div class="flex items-center justify-center mt-4">
        <x-primary-button class="ms-3" style="background-color: #05abd2; padding: 10px 20px; font-size: 15px; border-radius: 6px;">
            {{ __('Login') }}
        </x-primary-button>
    </div>
</form>
</x-guest-layout>
