
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
            <?php foreach($user as $User): ?>
                <?php if($User->nivel_acesso === 'aluno'): ?>
                    <tr>
                        <td><?php echo $User->name; ?></td>
                        <td><?php echo $User->email; ?></td>
                        <td><?php echo $User->data_nasc; ?></td>
                        <td><?php echo $User->cpf; ?></td>
                        <td><?php echo $User->telefone; ?></td>
                        <td>
                            <a class="button" href="/editar-aluno/<?php echo $User->id; ?>">Editar</a>
                            <a class="button" href="/excluir-aluno/<?php echo $User->id; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
        </table>
        <a class="button" href="/dashboard">Voltar</a>
    <a class="button" href="/adicionarAluno">Adicionar</a>
</body>
</html>
