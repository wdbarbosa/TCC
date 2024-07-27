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
                        <a class="button" href="/editar-turma/<?php echo $turma->id; ?>"><img width="24" height="24" src="https://img.icons8.com/material-sharp/24/FFFFFF/pencil--v1.png" alt="pencil--v1"/></a>
                        <a class="button" href="/excluir-turma/<?php echo $turma->id; ?>"><img width="24" height="24" src="https://img.icons8.com/material-rounded/24/FFFFFF/filled-trash.png" alt="filled-trash"/></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a class="button" href="/dashboard"><img width="22" height="22" src="https://img.icons8.com/sf-black-filled/64/FFFFFF/back.png" alt="back" alt="left2"/></a>
    <a class="button" href="/adicionarTurma"><img width="21" height="21" src="https://img.icons8.com/ios-glyphs/30/FFFFFF/plus-math.png" alt="plus-math"/></a>
</body>
</html>
