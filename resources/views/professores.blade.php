<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
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
                            <a href="/editar-professor/<?php echo $user->id; ?>">Editar</a>
                            <a href="/excluir-professor/<?php echo $user->id; ?>">Excluir</a>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/dashboard">Principal</a>
    <br>
    <a href="/adicionar">Adicionar Cadastro</a>
</body>
</html>
