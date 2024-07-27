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
