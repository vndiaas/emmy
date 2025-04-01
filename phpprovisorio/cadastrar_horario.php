<?php
require_once "conexao.php";
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $professor_id = $_POST['professor_id'];
    $horario_inicio = $_POST['horario_inicio'];
    $horario_fim = $_POST['horario_fim'];

    $sql = "INSERT INTO horario (professor_id, horario_inicio, horario_fim) VALUES (:professor_id, :horario_inicio, :horario_fim)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':professor_id', $professor_id);
    $stmt->bindParam(':horario_inicio', $horario_inicio);
    $stmt->bindParam(':horario_fim', $horario_fim);

    if ($stmt->execute()) {
        echo "<script>alert('Horário cadastrado com sucesso!'); window.location.href='menu.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar horário!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Horário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Cadastrar Novo Horário</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="professor_id" class="form-label">Professor</label>
            <select name="professor_id" class="form-control" required>
                <option value="">Selecione um professor</option>
                <?php
                $sql = "SELECT id, nome FROM professor";
                $stmt = $conn->query($sql);
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='" . $row['id'] . "'>" . $row['nome'] . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="horario_inicio" class="form-label">Horário de Início</label>
            <input type="time" name="horario_inicio" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="horario_fim" class="form-label">Horário de Fim</label>
            <input type="time" name="horario_fim" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="menu.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>
