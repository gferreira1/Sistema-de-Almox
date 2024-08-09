<?php
include('protect.php');
include('pesquisa.php');
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $usuario = $_POST["usuario"];
    $sobrenome = $_POST["sobrenome"];
    $setor = $_POST["setor"];
    $senha = $_POST["senha"];
    $confirm_senha = $_POST["confirm_senha"];

    // Verificações de entrada
    if (empty($nome) || empty($sobrenome) || empty($setor) || empty($senha) || empty($confirm_senha) || empty($usuario)) {
        echo "Todos os campos são obrigatórios.";
    } elseif ($senha !== $confirm_senha) {
        echo "As senhas não coincidem.";
    } else {
        // Use hash nas senhas para maior segurança
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        

        // Inserir dados no banco de dados (usando consulta preparada)
        $stmt = $mysqli->prepare("INSERT INTO usuario (nome, sobrenome, usuario, setor, senha) 
                                VALUES (?, ?, ?, ?, ?)");

        if (!$stmt) {
            echo "Erro na preparação da consulta: " . $mysqli->error;
        } else {
            // Ajuste o tipo de dados no bind_param conforme necessário
            $stmt->bind_param("sssss", $nome, $sobrenome, $usuario, $setor, $senha);

            if ($stmt->execute()) {
                echo "Cadastro realizado com sucesso!";
            } else {
                echo "Erro ao cadastrar: " . $stmt->error;
            }

            $stmt->close(); // Fechar a consulta preparada
        }

        // Fechar a conexão com o banco de dados
        $mysqli->close();
    }
}
?>
