<?php
require_once "conexao.php";
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Busca os horários cadastrados
$sql = "SELECT h.dia_semana, h.horario_inicio, h.horario_fim, p.nome AS professor, p.disciplina
        FROM horario h
        INNER JOIN professor p ON h.professor_id = p.id
        ORDER BY h.dia_semana, h.horario_inicio";

$stmt = $conn->query($sql);
$horarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cronograma de Professores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Cronograma de Disponibilidade</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Professor</th>
                <th>Disciplina</th>
                <th>Dia da Semana</th>
                <th>Horário de Início</th>
                <th>Horário de Fim</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($horarios as $horario): ?>
                <tr>
                    <td><?= $horario['professor']; ?></td>
                    <td><?= $horario['disciplina']; ?></td>
                    <td><?= $horario['dia_semana']; ?></td>
                    <td><?= $horario['horario_inicio']; ?></td>
                    <td><?= $horario['horario_fim']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
