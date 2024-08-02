
<x-app-layout>
@section('title', 'Cursinho Primeiro de Maio')
<x-slot name="header">
        <link rel="stylesheet" href="stylefooter.css">
        <link rel="stylesheet" href="stylealunosblade.css">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Professores') }}
            </h2>
    </x-slot>
    <!DOCTYPE html>
    <html lang="pt-br">
        <body>
            <main>
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h2>Cadastros de Professores</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Data de Nascimento</th>
                                            <th>CPF</th>
                                            <th>Telefone</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($user as $user): ?>
                                            <?php if($user->nivel_acesso === 'professor'): ?>
                                                <tr>
                                                    <td><?php echo $user->name; ?></td>
                                                    <td><?php echo $user->email; ?></td>
                                                    <td><?php echo $user->data_nasc; ?></td>
                                                    <td><?php echo $user->cpf; ?></td>
                                                    <td><?php echo $user->telefone; ?></td>
                                                    <td>
                                                    <a class="button" href="/editar-professor/<?php echo $user->id; ?>">Editar</a>
                                                    <a class="button" href="/excluir-professor/<?php echo $user->id; ?>">Excluir</a>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                    <a class="button" href="/dashboard">Voltar</a>
                                    <a class="button" href="/adicionarProfessor">Adicionar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts._rodape')
        </body>
    </html>
</x-app-layout>
