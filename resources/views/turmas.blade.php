<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }
        h2 {
            color: #6c63ff;
            text-align: center;
            margin-top: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #6c63ff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: #6c63ff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        a.button:hover {
            background-color: #5a4adf;
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
                    <td><?php echo $turma->descricao; ?></td>
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
