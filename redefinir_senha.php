<?php

include("configs/configsqlite.php");
// Função para buscar um usuário pelo nome de usuário no banco de dados
function buscarUsuarioPorUsuario($usuario) {
    
    global $pdo;

    // Consulta SQL para buscar o usuário pelo nome de usuário
    $sql = "SELECT * FROM usuario WHERE usuario = ?";

    // Preparar a consulta
    $stmt = $pdo->prepare($sql);

    // Verificar se a preparação da consulta foi bem-sucedida
    if ($stmt === false) {
        die("Erro na preparação da consulta: " . $pdo->errorCode());
    }

    // Vincular o parâmetro de nome de usuário à consulta
    $stmt->bindParam("s", $usuario);

    // Executar a consulta
    if ($stmt->execute()) {
        // Obter o resultado da consulta
        $result = $stmt->fetchAll();

        // Retornar os resultados
        return $result;
    } else {
        die("Erro ao executar a consulta: " . $stmt->errorCode());
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

 
        $sql = "UPDATE usuario SET senha = ? WHERE usuario = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam("ss", $hashSenha, $usuario);

        if ($stmt->execute()) {
            // Verificar se algum registro foi afetado
            if ($stmt->rowCount() > 0) {
                // Redirecionar para uma página de sucesso ou exibir uma mensagem de sucesso
                echo "Senha redefinida com sucesso!";
                header("refresh:3;url=index.php");
            } else {
                // Exibir uma mensagem de erro, pois nenhum registro foi afetado
                echo "Erro ao atualizar a senha. Nenhum registro foi afetado.";
            }
        } else {
            // Exibir uma mensagem de erro
            echo "Erro ao atualizar a senha: " . $stmt->errorCode();
        }

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
    <link href="./styles/style.css" rel="stylesheet" />
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
