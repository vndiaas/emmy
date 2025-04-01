<?php
require_once "conexao.php";
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

// Verifica se o ID do horário foi passado na URL
if (!isset($_GET['id'])) {
    echo "<script>alert('ID do horário não encontrado!'); window.location.href='menu.php';</script>";
    exit;
}

$id = $_GET['id'];

// Busca os dados do horário pelo ID
$sql = "SELECT * FROM horario WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$horario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$horario) {
    echo "<script>alert('Horário não encontrado!'); window.location.href='menu.php';</script>";
    exit;
}

// Atualizar o horário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $professor_id = $_POST['professor_id'];
    $dia_semana = $_POST['dia_semana'];
    $horario_inicio = $_POST['horario_inicio'];
    $horario_fim = $_POST['horario_fim'];

    $sql_update = "UPDATE horario SET professor_id = :professor_id, dia_semana = :dia_semana, horario_inicio = :horario_inicio, horario_fim = :horario_fim WHERE id = :id";
    $stmt = $conn->prepare($sql_update);
    $stmt->bindParam(':professor_id', $professor_id);
    $stmt->bindParam(':dia_semana', $dia_semana);
    $stmt->bindParam(':horario_inicio', $horario_inicio);
    $stmt->bindParam(':horario_fim', $horario_fim);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        echo "<script>alert('Horário atualizado com sucesso!'); window.location.href='menu.php';</script>";
    } else {
        echo "<script>alert('Erro ao atualizar horário!');</script>";
    }
}

// Busca todos os professores para exibir no select
$sql_professores = "SELECT * FROM professor";
$stmt = $conn->query($sql_professores);
$professores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Disponibilidade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Editar Disponibilidade</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="professor_id" class="form-label">Professor</label>
            <select name="professor_id" class="form-control" required>
                <?php foreach ($professores as $professor): ?>
                    <option value="<?= $professor['id']; ?>" <?= ($horario['professor_id'] == $professor['id']) ? 'selected' : ''; ?>>
                        <?= $professor['nome']; ?> - <?= $professor['disciplina']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="dia_semana" class="form-label">Dia da Semana</label>
            <select name="dia_semana" class="form-control" required>
                <option value="Segunda-feira" <?= ($horario['dia_semana'] == 'Segunda-feira') ? 'selected' : ''; ?>>Segunda-feira</option>
                <option value="Terça-feira" <?= ($horario['dia_semana'] == 'Terça-feira') ? 'selected' : ''; ?>>Terça-feira</option>
                <option value="Quarta-feira" <?= ($horario['dia_semana'] == 'Quarta-feira') ? 'selected' : ''; ?>>Quarta-feira</option>
                <option value="Quinta-feira" <?= ($horario['dia_semana'] == 'Quinta-feira') ? 'selected' : ''; ?>>Quinta-feira</option>
                <option value="Sexta-feira" <?= ($horario['dia_semana'] == 'Sexta-feira') ? 'selected' : ''; ?>>Sexta-feira</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="horario_inicio" class="form-label">Horário de Início</label>
            <input type="time" name="horario_inicio" class="form-control" value="<?= $horario['horario_inicio']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="horario_fim" class="form-label">Horário de Fim</label>
            <input type="time" name="horario_fim" class="form-control" value="<?= $horario['horario_fim']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="menu.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>
