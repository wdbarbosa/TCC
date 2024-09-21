@section('title', 'Cursinho Primeiro de Maio')
<section>
    <header>

        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Informações do Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Atualize as informações de sua conta se necessário:") }}
        </p>
    </header>
    <link rel="stylesheet" href="styleperfil.css">
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div class="borda-hover">
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="focus:border-cyan-200 mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="borda-hover">
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input id="cpf" name="cpf" type="text" class="focus:border-cyan-200 mt-1 block w-full" :value="old('cpf', $user->cpf)" required autofocus autocomplete="cpf" />
            <x-input-error class="mt-2" :messages="$errors->get('cpf')" />
        </div>

        <div class="borda-hover">
            <x-input-label for="data_nasc" :value="__('Data de nascimento')" />
            <x-text-input id="data_nasc" name="data_nasc" type="date" class="focus:border-cyan-200 mt-1 block w-full" :value="old('data_nasc', $user->data_nasc)" required autofocus autocomplete="data_nasc" />
            <x-input-error class="mt-2" :messages="$errors->get('data_nasc')" />
        </div>

        <div class="borda-hover">
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input id="telefone" name="telefone" type="text" class="focus:border-cyan-200 mt-1 block w-full" :value="old('telefone', $user->telefone)" required autofocus autocomplete="telefone" />
            <x-input-error class="mt-2" :messages="$errors->get('telefone')" />
        </div>

        <div class="borda-hover">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="focus:border-cyan-200 mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                        {{ __('Seu email não foi verificado.') }}

                        <button form="send-verification" class="underline text-sm text-blue-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-800 dark:focus:ring-offset-gray-800">
                            {{ __('Clique aqui para reenviar o link ao email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('Um novo link foi enviado ao email') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button class="bg-[#6bb6c0] text-white py-2 px-4 rounded inline-block hover:bg-[#8ab3b6] transition duration-150">{{ __('Atualizar') }}</button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="focus:border-cyan-200 text-sm text-gray-600 dark:text-gray-400 background-color-cyan-200"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
