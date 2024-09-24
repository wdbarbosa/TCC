<x-guest-layout>
<h2 class="font-semibold text-xl text-gray-900 dark:text-gray-200 py-4 leading-tight text-center ">
    
            {{ __('Atualizar Professor') }}
</h2>
@section('title', 'Cursinho Primeiro de Maio')
    <form method="POST" action="/atualizar-professor/{{ $professor->id }}">
        @csrf
        @method('PUT')
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="name" class="block mt-1 w-full" type="text" name="name" :value="$professor->name" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Date -->
        <div class="mt-4">
            <x-input-label for="data_nasc" :value="__('Data de nascimento')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="data_nasc" class="block mt-1 w-full" type="date" name="data_nasc" :value="$professor->data_nasc" required autocomplete="data_nasc" max="{{ date('Y-m-d') }}" />
            <x-input-error :messages="$errors->get('data_nasc')" class="mt-2" />
        </div>

        <!-- CPF -->
        <div class="mt-4">
            <x-input-label for="cpf" :value="__('CPF')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="cpf" class="block mt-1 w-full" type="text" name="cpf" :value="$professor->cpf" placeholder="000.000.000-00" required autocomplete="cpf" maxlength="14" oninput="formatarCPF(this)" />
            <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
        </div>

        <!-- Telefone -->
        <div class="mt-4">
            <x-input-label for="telefone" :value="__('Telefone')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="telefone" class="block mt-1 w-full" type="text" name="telefone" :value="$professor->telefone" placeholder="(00) 0000-0000" required autocomplete="telefone" maxlength="15" oninput="formatarTelefone(this)" />
            <x-input-error :messages="$errors->get('telefone')" class="mt-2" /> 
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="email" class="block mt-1 w-full" type="email" name="email" :value="$professor->email" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="password" class="block mt-1 w-full" type="password" name="password" value="********" readonly />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
            <x-text-input style="background-color: #F4F4F4; border: 2px solid #d1d5db;" onfocus="this.style.borderColor='#66d6e3'" onblur="this.style.borderColor='#d1d5db'" id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" value="********" readonly />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Nível de acesso -->
        <!--
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
        -->
        <div class="flex items-center mt-2">
            <input id="professor" type="radio"
            class="form-radio h-4 w-4 text-cyan-600 transition duration-150 ease-in-out"
                name="nivel_acesso" value="professor" checked> <!-- Adicionei o atributo checked aqui -->
            <label for="professor" class="ml-2 block text-sm leading-5 text-gray-900">
                Professor
            </label>
        </div>
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

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-4" style="display: block; margin: 0 auto; background-color: #6bb6c0; text-align: center; width: fit-content;">
                {{ __('Atualizar') }}
            </x-primary-button>
        </div>
    </form>

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
</x-guest-layout>
