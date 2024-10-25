<x-app-layout>
    
@section('title', 'Cursinho Primeiro de Maio')
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight flex items-center">
                <a href="{{ route('alunos.index') }}" class="mr-4" alt="Voltar">
                    <img src="{{ asset('img/voltar.png') }}" alt="Voltar" class="w-6 h-6 hover:scale-125">
                </a>
                {{ __('Alunos') }}
            </h2>

            <link rel="stylesheet" href="{{ asset('stylefooter.css') }}">
            <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
            <link rel="stylesheet" type="text/css" href="{{ asset('styleturmas.css') }}">
        </div>
        </x-slot>
<main>
    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow-lg p-8"> 
<h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-4 leading-tight text-center ">
    {{ __('Atualizar Aluno') }}
</h2>
<hr>
    <form method="POST" action="/atualizar-aluno/{{ $aluno->id }}">
        @csrf
        @method('PUT')
        <!-- Name -->
        <div>
            <x-input-label class="mt-4" for="name" :value="__('Nome:')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$aluno->name" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Date -->
        <div class="mt-4">
            <x-input-label for="data_nasc" :value="__('Data de nascimento:')" />
            <x-text-input id="data_nasc" class="block mt-1 w-full" type="date" name="data_nasc" :value="$aluno->data_nasc" required autocomplete="data_nasc" max="{{ date('Y-m-d') }}" />
            <x-input-error :messages="$errors->get('data_nasc')" class="mt-2" />
        </div>

        <!-- CPF -->
        <div class="mt-4">
            <x-input-label for="cpf" :value="__('CPF:')" />
            <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="$aluno->cpf" placeholder="000.000.000-00" required autocomplete="cpf" maxlength="14" oninput="formatarCPF(this)" />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="mt-4">
            <x-input-label for="telefone" :value="__('Telefone:')" />
            <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" :value="$aluno->telefone" placeholder="(00) 0000-0000" required autocomplete="telefone" maxlength="15" oninput="formatarTelefone(this)" />
            <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email:')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$aluno->email" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha:')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" value="********" readonly />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha:')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" value="********" readonly />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Nível de acesso -->

        <div class="mt-4">
            <x-input-label :value="__('Nível de acesso:')" />
            <div class="flex items-center mt-2">
                <input id="aluno" type="radio"
                class="form-radio h-4 w-4 text-cyan-600 transition duration-150 ease-in-out" name="nivel_acesso" value="aluno" checked>
                <label for="aluno" class="ml-2 block text-sm leading-5 text-gray-900">
                    Aluno
                </label>
            </div>

        <!--
        <div class="flex items-center mt-2">
            <input id="professor" type="radio"
                class="form-radio h-4 w-4 text-indigo-600 transition duration-150 ease-in-out"
                name="nivel_acesso" value="professor" checked>
            <label for="professor" class="ml-2 block text-sm leading-5 text-gray-900">
                Professor
            </label>
        </div>
        -->
        <!--
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
        -->

        <div class="flex justify-center mt-4">
            <x-primary-button>
                {{ __('Atualizar') }}
            </x-primary-button>
            </form>
        </div>
    </div>
</main>
    @include('layouts._rodape')


    <script>
        function formatarCPF(campo) {
            // Remove qualquer caractere que não seja um número
            var cpf = campo.value.replace(/\D/g, '');

            // Adiciona os pontos e o traço no CPF conforme o usuário digita
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');

            // Atualiza o valor do campo de entrada
            campo.value = cpf;

            // Verifica se o placeholder precisa ser removido
            if (cpf.length == 0) {
                campo.placeholder = "CPF";
            } else {
                campo.placeholder = "";
            }
        }

        function formatarTelefone(campo) {
            // Remove qualquer caractere que não seja um número
            var telefone = campo.value.replace(/\D/g, '');

            // Adiciona os parênteses e o traço no telefone conforme o usuário digita
            if (telefone.length > 5) {
                telefone = telefone.replace(/(\d{2})(\d)/, '($1) $2');
                telefone = telefone.replace(/(\d{5})(\d)/, '$1-$2');
            } else {
                telefone = telefone.replace(/(\d{2})(\d)/, '($1) $2');
            }

            // Atualiza o valor do campo de entrada
            campo.value = telefone;

            // Verifica se o placeholder precisa ser removido
            if (telefone.length == 0) {
                campo.placeholder = "(00) 00000-0000";
            } else {
                campo.placeholder = "";
            }
        }
    </script>
</x-app-layout>