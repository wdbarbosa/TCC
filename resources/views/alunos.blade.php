<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylealunosblade.css">
    <title>Alunos</title>
    
</head>
<body>
    <h2>Cadastros de Alunos</h2>
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
                <?php if($user->nivel_acesso === 'aluno'): ?>
                    <tr>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->email; ?></td>
                        <td><?php echo $user->data_nasc; ?></td>
                        <td><?php echo $user->cpf; ?></td>
                        <td><?php echo $user->telefone; ?></td>
                        <td>
                            <a class="button" href="/editar-aluno/<?php echo $user->id; ?>">Editar</a>
                            <a class="button" href="/excluir-aluno/<?php echo $user->id; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
        </table>
    <a class="button" href="/dashboard">Principal</a>
    <a class="button" href="/adicionarAluno">Adicionar Cadastro</a>
</body>
</html>
