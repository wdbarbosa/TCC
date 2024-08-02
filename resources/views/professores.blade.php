<<<<<<< HEAD
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylealunosblade.css">
    <title>Professores</title>
    
</head>
<body>
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
</body>
</html>
=======
<x-app-layout>
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
                                                        <a class="button" href="/editar-professor/<?php echo $user->id; ?>"><img width="24" height="24" src="https://img.icons8.com/material-sharp/24/FFFFFF/pencil--v1.png" alt="pencil--v1"/></a>
                                                        <a class="button" href="/excluir-professor/<?php echo $user->id; ?>"><img width="24" height="24" src="https://img.icons8.com/material-rounded/24/FFFFFF/filled-trash.png" alt="filled-trash"/></a>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </tbody>
                                    </table>
                                    <a class="button" href="/dashboard"><img width="22" height="22" src="https://img.icons8.com/sf-black-filled/64/FFFFFF/back.png" alt="back" alt="left2"/></a>
                                <a class="button" href="/adicionarProfessor"><img width="21" height="21" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/plus-math.png" alt="plus-math"/></a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            @include('layouts._rodape')
        </body>
    </html>
</x-app-layout>
>>>>>>> 309ddc23ab04dc8deb73fd8ac9544a6881e144e3
