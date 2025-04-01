<?php
require_once "conexao.php";
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $disciplina = $_POST['disciplina'];

    $sql = "INSERT INTO professor (nome, disciplina) VALUES (:nome, :disciplina)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':disciplina', $disciplina);

    if ($stmt->execute()) {
        echo "<script>alert('Professor cadastrado com sucesso!'); window.location.href='menu.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar professor!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Professor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2>Cadastrar Professor</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Professor</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="disciplina" class="form-label">Disciplina</label>
            <input type="text" name="disciplina" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="menu.php" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>
