<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Date -->
        <div class="mt-4">
            <x-input-label for="data_nasc" :value="__('Data de nascimento')" />
            <x-text-input id="data_nasc" class="block mt-1 w-full" type="date" name="data_nasc"
                :value="old('data_nasc')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('data_nasc')" class="mt-2" />
        </div>

        <!-- CPF -->
        <div class="mt-4">
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')"
                placeholder="000.000.000-00" required autocomplete="cpf" />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="mt-4">
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" :value="old('telefone')"
                placeholder="(00) 0000-0000" required autocomplete="telefone" />
            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Nível de acesso -->
        <div class="mt-4">
            <x-input-label :value="__('Nível de acesso')" />
            <div class="flex items-center mt-2">
                <input id="aluno" type="radio"
                    class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="nivel_acesso"
                    value="aluno" checked>
                <label for="aluno" class="ml-2 block text-sm leading-5 text-gray-900">
                    Aluno
                </label>
            </div>
            <div class="flex items-center mt-2">
                <input id="professor" type="radio"
                    class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="nivel_acesso"
                    value="professor">
                <label for="professor" class="ml-2 block text-sm leading-5 text-gray-900">
                    Professor
                </label>
            </div>
            <div class="flex items-center mt-2">
                <input id="admin" type="radio"
                    class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out" name="nivel_acesso"
                    value="admin">
                <label for="admin" class="ml-2 block text-sm leading-5 text-gray-900">
                    Administrador
                </label>
            </div>
            <x-input-error :messages="$errors->get('tipo_usuario')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>