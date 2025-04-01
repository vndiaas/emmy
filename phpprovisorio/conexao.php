<?php
try {
    // Conectar ao MySQL sem especificar o banco de dados
    $conn = new PDO("mysql:host=localhost;port=3306;charset=utf8", "root", "@emmycruz15");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar o banco de dados caso não exista
    $conn->exec("CREATE DATABASE IF NOT EXISTS gerenciamento_horarios");

    // Selecionar o banco de dados
    $conn->exec("USE gerenciamento_horarios");
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>
