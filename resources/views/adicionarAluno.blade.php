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
        </div>
    </x-slot>
<main>
    <div class="py-12 flex justify-center">
        <div class="w-full max-w-2xl bg-white border border-gray-200 rounded-lg shadow-lg p-8"> 
            <form method="POST" action="{{ route('cadastrar-aluno') }}">
                @csrf
                <h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-4 leading-tight text-center">
                    {{ __('Adicionar Aluno') }}
                </h2>
                <hr>
                <div>
                    <x-input-label class="mt-4" for="name" :value="__('Nome')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Data de Nascimento -->
                <div class="mt-4">
                    <x-input-label for="data_nasc" :value="__('Data de nascimento')" />
                    <x-text-input id="data_nasc" class="block mt-1 w-full" type="date" name="data_nasc" :value="old('data_nasc')" required max="{{ date('Y-m-d') }}" />
                    <x-input-error :messages="$errors->get('data_nasc')" class="mt-2" />
                </div>

                <!-- CPF -->
                <div class="mt-4">
                    <x-input-label for="cpf" :value="__('CPF')" />
                    <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="old('cpf')" placeholder="000.000.000-00" required maxlength="14" oninput="formatarCPF(this)" />
                    <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                </div>

                <!-- Telefone -->
                <div class="mt-4">
                    <x-input-label for="telefone" :value="__('Telefone')" />
                    <x-text-input id="telefone" class="block mt-1 w-full" type="text" name="telefone" :value="old('telefone')" placeholder="(00) 0000-0000" required maxlength="15" oninput="formatarTelefone(this)" />
                    <x-input-error :messages="$errors->get('telefone')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Senha -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Senha')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required maxlength="32" pattern=".{5,}" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <p class="mt-2 text-sm text-gray-600">A senha deve conter pelo menos 8 caracteres.</p>
                </div>

                <!-- Confirmar Senha -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirmar senha')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Nível de acesso -->
                <div class="mt-4">
                    <x-input-label :value="__('Nível de acesso')" />
                    <div class="flex items-center mt-2">
                        <input id="aluno" type="radio" class="form-radio h-4 w-4 text-cyan-400" name="nivel_acesso" value="aluno" checked>
                        <label for="aluno" class="ml-2 block text-sm leading-5 text-gray-900">Aluno</label>
                    </div>
                    <x-input-error :messages="$errors->get('tipo_usuario')" class="mt-2" />
                </div>

                <div class="flex justify-center mt-4">
                    <x-primary-button>
                        {{ __('Cadastrar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</main>
@include('layouts._rodape')
        <script>
            function formatarCPF(campo) {
                var cpf = campo.value.replace(/\D/g, '');
                cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2').replace(/(\d{3})(\d)/, '$1.$2').replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                campo.value = cpf;
            }

            function formatarTelefone(campo) {
                var telefone = campo.value.replace(/\D/g, '');
                telefone = telefone.length > 5 ? telefone.replace(/(\d{2})(\d)/, '($1) $2').replace(/(\d{5})(\d)/, '$1-$2') : telefone.replace(/(\d{2})(\d)/, '($1) $2');
                campo.value = telefone;
            }
        </script>
</x-app-layout>
