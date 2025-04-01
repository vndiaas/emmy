<?php
session_start();  // Inicia a sessão para armazenar informações do login

// Definindo as credenciais do administrador
$admin_username = "Administrador@123";
$admin_password = "adm123";

// Verifica se o formulário de login foi enviado
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica as credenciais
    if ($username == $admin_username && $password == $admin_password) {
        $_SESSION['logged_in'] = true;  // Marca o usuário como logado
        header("Location: home.php");   // Redireciona para a página principal
        exit;
    } else {
        $error_message = "Usuário ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gerenciamento de Horários</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFFFFF; /* Fundo branco */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: #00B4D8; /* Tela de login azul */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h2 {
            text-align: center;
            color: white; /* Texto branco para melhor contraste no fundo azul */
        }
        label {
            color: white; /* Labels brancas para melhor contraste no fundo azul */
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box; /* Garante que o padding não aumenta a largura do input */
        }
        .btn-login {
            background-color: #ADD8E6; /* Botão azul mais claro */
            color: #000; /* Texto preto para melhor contraste no botão claro */
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        .btn-login:hover {
            background-color: #B0E0E6; /* Um tom ligeiramente diferente ao passar o mouse */
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 10px;
        }

        h1{
            color: #00B4D8;
            text-align: center;
        }

    </style>
</head>

<body>

<header>
<h1> SISTEMA ESCOLAR INTELIGENTE <span> SEI</span></h1>
</header>

<div class="login-container">
    <h2>Login</h2>

    <?php if (isset($error_message)): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Usuário</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Senha</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="login" class="btn-login">Entrar</button>
    </form>
</div>

</body>
</html>