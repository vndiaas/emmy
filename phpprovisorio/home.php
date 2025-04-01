<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");  // Redireciona para a página de login se não estiver logado
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal - Gerenciamento de Horários</title>
    <!-- Adicionando o link para o Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEJv3Lwz3v7Bz5Z2h1hzThu4GqIs3JlYrlF2PaHZ6lk3gYHzVbbGeRlQy52ha" crossorigin="anonymous">
    <style>
        /* Personalizando o estilo da barra lateral */
        .sidebar {
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #00B4D8;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color:rgb(11, 100, 117);
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

<!-- Barra lateral -->
<div class="sidebar">
    <h4 class="text-white text-center">Menu</h4>
    <a href="home.php">Exibir Cronograma</a>
    <a href="cadastrar_horario.php">Cadastrar Novo Horário</a>
    <a href="editar_horario.php">Editar Horário</a>
    <a href="cadastrar_professor.php">Cadastrar Professor</a>
    <!-- Logout na parte inferior -->
    <a href="logout.php" class="mt-auto">Sair</a>
</div>

<!-- Conteúdo principal -->
<div class="content">
    <h1>Bem-vindo ao Sistema de Gerenciamento de Horários</h1>
    <p>Selecione uma das opções do menu lateral para gerenciar os horários e professores.</p>
</div>

<!-- Adicionando o script do Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-vhZn2RbL6sJEiqxM2gI5i5z0dO1t6hrqwv1i4BcItUpgTLgtWz/sy7/hnuw5sxJm" crossorigin="anonymous"></script>

</body>
</html>
