<?php
session_start();

include('configsqlite.php');
include('routes.php');

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./styles/style.css" rel="stylesheet" />
    <title>Login</title>
</head>
<body>
<div class="login-container">
    <h1>Acesse sua conta</h1>
    <form class="login-form" action="" method="POST">
        <p>
            <label>Usuário</label>
            <input type="text" name="usuario" maxlength="45">
        </p>
        <p>
            <label for="senha">Senha</label>
            <input type="password" name="senha" minlength="4" maxLength="16">
        </p>
        <div class="opcoes">
            <a class="senhaesqueceu" href="redefinir_senha.php">Esqueceu a senha?</a>
        </div>

        <p>
            <button type="submit">Entrar</button>
        </p>
        <?php
            // Display error message if login error occurred
            if (isset($login_error)) {
                echo "<div class='error-message'>$login_error</div>";
            }
        ?>
    </form>
</div>
</body>
</html>
