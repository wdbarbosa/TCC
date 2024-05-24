<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleturmas.css">
    <title>Turmas</title>
    <style>
        .descricao {
            word-wrap: break-word;
            overflow-wrap: break-word;
        }
        body {
            overflow-x: hidden;
        }
    </style>
</head>
<body>
    <h2>Cadastros de Turmas</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($turmas as $turma): ?>
                <tr>
                    <td><?php echo $turma->nome; ?></td>
                    <td class="descricao"><?php echo $turma->descricao; ?></td>
                    <td>
                        <a class="button" href="/editar-turma/<?php echo $turma->id; ?>">Editar</a>
                        <a class="button" href="/excluir-turma/<?php echo $turma->id; ?>">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a class="button" href="/dashboard">Principal</a>
    <a class="button" href="/adicionarTurma">Adicionar Cadastro</a>
</body>
</html>
