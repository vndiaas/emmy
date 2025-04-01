<?php
require_once "conexao.php";

$sql = "SELECT p.nome, p.disciplina, h.horario_inicio, h.horario_fim 
        FROM horario h
        JOIN professor p ON h.professor_id = p.id
        ORDER BY p.nome, h.horario_inicio";
$stmt = $conn->query($sql);
$horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cronograma</title>
</head>
<body>
    <h2>Cronograma de Professores</h2>
    <table border="1">
        <tr>
            <th>Professor</th>
            <th>Disciplina</th>
            <th>Horário de Início</th>
            <th>Horário de Fim</th>
        </tr>
        <?php foreach ($horarios as $horario): ?>
            <tr>
                <td><?= $horario['nome'] ?></td>
                <td><?= $horario['disciplina'] ?></td>
                <td><?= $horario['horario_inicio'] ?></td>
                <td><?= $horario['horario_fim'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="menu.php">Voltar</a>
</body>
</html>
