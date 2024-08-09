<?php
include('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['usuario']) || empty($_POST['senha'])) {
        $login_error = "Preencha seu usuário e senha.";
    } else {
        $usuario = $mysqli->real_escape_string($_POST['usuario']);
        $senha_digitada = $mysqli->real_escape_string($_POST['senha']);

        // Consulta SQL parametrizada para prevenir SQL Injection
        $sql_code = "SELECT id, usuario, setor, senha FROM usuario WHERE usuario = ?";
        $stmt = $mysqli->prepare($sql_code);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $usuario, $setor, $senha_no_banco);
            $stmt->fetch();

            // Verificar a senha usando password_verify
            $senha_verificada = password_verify($senha_digitada, $senha_no_banco);

            // Se a senha for válida, faça alguma coisa
            if ($senha_verificada) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['id'] = $id;
                $_SESSION['setor'] = $setor;

                // Redireciona com base no setor
                if (strcasecmp($setor, 'Compras') == 0 or strcasecmp($setor, 'compras') == 0) {
                    header("Location: compras.php");
                    exit();
                    
                } elseif ($setor == 'Alme') {
                    header("Location: alme.php");
                    exit();
                } elseif ($setor == 'TI') {
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

            $stmt->close();
        } else {
            // Usuário não encontrado
            $login_error = "Credenciais inválidas. Verifique o usuário.";
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
