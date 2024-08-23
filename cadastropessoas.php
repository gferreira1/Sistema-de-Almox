<?php
$ROOT_PATH = './';
include("$ROOT_PATH/protect.php");
include("$ROOT_PATH/pesquisa.php");
include("$ROOT_PATH/configs/configsqlite.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $usuario = $_POST["usuario"];
    $sobrenome = $_POST["sobrenome"];
    $setor = $_POST["setor"];
    $senha = $_POST["senha"];
    $confirm_senha = $_POST["confirm_senha"];
    var_dump($_POST);
    // Verificações de entrada
    if (empty($nome) || empty($sobrenome) || empty($setor) || empty($senha) || empty($confirm_senha) || empty($usuario)) {
        echo "Todos os campos são obrigatórios.";
    } elseif ($senha !== $confirm_senha) {
        echo "As senhas não coincidem.";
    } else {
        // Use hash nas senhas para maior segurança
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        

        // Inserir dados no banco de dados (usando consulta preparada)
        $stmt = $pdo->prepare("INSERT INTO usuario(nome, sobrenome, usuario, setor, senha) 
                                VALUES (:nome, :sobrenome, :usuario, :setor, :senha)");

        if (!$stmt) {
            echo "Erro na preparação da consulta: " . $pdo->errorCode(); 
        } else {
            // Ajuste o tipo de dados no bind_param conforme necessário
            $stmt->bindParam(":nome", $nome);
            $stmt->bindParam(":sobrenome", $sobrenome);
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":setor", $setor);
            $stmt->bindParam(":senha", $senha);
            
            if ($stmt->execute()) {
                echo "Cadastro realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar: " . $stmt->errorCode();
            }
            // Fechar a consulta preparada
        }

    }
}
?>
