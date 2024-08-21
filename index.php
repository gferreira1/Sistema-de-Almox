<?php
session_start();

include('configsqlite.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['usuario']) || empty($_POST['senha'])) {
        $login_error = "Preencha seu usuário e senha.";
    } else {
        $usuario = $_POST['usuario'];
        $senha_digitada = $_POST['senha'];

        // Consulta SQL parametrizada para prevenir SQL Injection
        $sql_code = "SELECT id, usuario, setor, senha FROM usuario WHERE usuario = ?";
        $stmt = $pdo->prepare($sql_code);
        $stmt->execute([$usuario]);

        if ($stmt->rowCount() == 1) {
            $stmt->bindColumn(1, $id);
            $stmt->bindColumn(2, $usuario);
            $stmt->bindColumn(3, $setor);
            $stmt->bindColumn(4, $senha_no_banco);
            $stmt->fetch(PDO::FETCH_BOUND);

            // Verificar a senha usando password_verify
            $senha_verificada = password_verify($senha_digitada, $senha_no_banco);

            // Se a senha for válida, faça alguma coisa
            if ($senha_verificada) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['id'] = $id;
                $_SESSION['setor'] = $setor;

                // Redireciona com base no setor
                if (strcasecmp($setor, 'Compras') == 0) {
                    header("Location: compras.php");
                    exit();
                } elseif (strcasecmp($setor, 'Alme') == 0) {
                    header("Location: alme.php");
                    exit();
                } elseif (strcasecmp($setor, 'TI') == 0) {
                    header("Location: ti.php");
                    exit();
                } else {
                    // Adicione outras verificações de setor conforme necessário
                    $login_error = "Setor não reconhecido.";
                }
            } else {
                // Credenciais inválidas
                $login_error = "Credenciais inválidas. Verifique a senha.";
            }
        } else {
            // Usuário não encontrado
            $login_error = "Credenciaiss inválidas. Verifique o usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style.css" rel="stylesheet" />
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
