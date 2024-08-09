<?php
// Função para buscar um usuário pelo nome de usuário no banco de dados
function buscarUsuarioPorUsuario($usuario) {
    // Conectar ao banco de dados (substitua os valores conforme necessário)
    $mysqli = new mysqli("127.0.0.1", "root", "", "login");

    // Verificar a conexão
    if ($mysqli->connect_error) {
        die("Erro de conexão: " . $mysqli->connect_error);
    }

    // Consulta SQL para buscar o usuário pelo nome de usuário
    $sql = "SELECT * FROM usuario WHERE usuario = ?";

    // Preparar a consulta
    $stmt = $mysqli->prepare($sql);

    // Verificar se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $mysqli->error);
    }

    // Vincular o parâmetro de nome de usuário à consulta
    $stmt->bind_param("s", $usuario);

    // Executar a consulta
    if ($stmt->execute()) {
        // Obter o resultado da consulta
        $result = $stmt->get_result();

        // Fechar a consulta
        $stmt->close();

        // Fechar a conexão
        $mysqli->close();

        // Retornar os resultados
        return $result->fetch_assoc();
    } else {
        die("Erro ao executar a consulta: " . $stmt->error);
    }
}

// Processar o formulário de redefinição de senha
if (isset($_POST['submit'])) {
    $usuario = $_POST['usuario'];
    $novaSenha = $_POST['nova_senha'];

    // Buscar usuário pelo nome de usuário
    $usuarioEncontrado = buscarUsuarioPorUsuario($usuario);

    if ($usuarioEncontrado) {
        // Atualizar a senha no banco de dados
        $hashSenha = password_hash($novaSenha, PASSWORD_DEFAULT);

        // Sua consulta SQL para atualizar a senha (substitua pelos detalhes do seu banco de dados)
        $mysqli = new mysqli("127.0.0.1", "root", "", "login");
        $sql = "UPDATE usuario SET senha = ? WHERE usuario = ?";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $hashSenha, $usuario);

        if ($stmt->execute()) {
            // Verificar se algum registro foi afetado
            if ($stmt->affected_rows > 0) {
                // Redirecionar para uma página de sucesso ou exibir uma mensagem de sucesso
                echo "Senha redefinida com sucesso!";
                header("refresh:3;url=index.php");
            } else {
                // Exibir uma mensagem de erro, pois nenhum registro foi afetado
                echo "Erro ao atualizar a senha. Nenhum registro foi afetado.";
            }
        } else {
            // Exibir uma mensagem de erro
            echo "Erro ao atualizar a senha: " . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    } else {
        echo "Usuário não encontrado.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style.css" rel="stylesheet" />
    <title>Redefinir senha </title>
</head>


<body>
    
    <div class="login-container">
    <h1>Redefinir Senha</h1>
    <form class="login-form"  method="post" action="">
        <label for="usuario">Nome de Usuário:</label>
        <input type="text" id="usuario" name="usuario" required>

        <label for="nova_senha">Nova Senha:</label>
        <input type="password" id="nova_senha" name="nova_senha" required>
        <div class="opcoes">
            <a class="senhaesqueceu" href="index.php">Acessar</a>
        </div>
        
        <p>
        <button type="submit" name="submit">Redefinir Senha</button>
        </p>
    </form>
    </div>
</body>

</html>
