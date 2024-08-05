@section('title', 'Cursinho Primeiro de Maio')
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Atualizar senha') }}
        </h2>

        <p class="background-color: #22d3ee; focus:border-cyan-200 mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Garanta que sua conta possua uma senha única e longa o suficiente') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="focus:border-cyan-200 mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Senha atual')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="focus:border-cyan-200 mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('Nova senha')" />
            <x-text-input id="update_password_password" name="password" type="password" class="focus:border-cyan-200 mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirme nova senha')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="focus:border-cyan-200 mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="focus:border-cyan-200 flex items-center gap-4">
            <x-primary-button>{{ __('Atualizar') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class=" focus:border-cyan-200 text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
