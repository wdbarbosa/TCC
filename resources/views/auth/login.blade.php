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
            <x-text-input  style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="email" class="focus:border-cyan-200 block mt-1 w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4" >
            <x-input-label for="password" :value="__('Senha')" />

            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="password" class="focus:border-cyan-200 block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input style="border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'"id="remember_me" type="checkbox" class="rounded h-4 w-4 text-cyan-400 transition duration-150 ease-in-out" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('lembrar-me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            

            <x-primary-button class="ms-3" style="background-color: #05abd2;">
                {{ __('Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
