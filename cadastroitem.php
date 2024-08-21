<?php
include('protect.php');
include('pesquisa.php');
include('../configs/config2.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $quantidade = $_POST["quantidade"];
    $descricao = $_POST["descricao"];
    $item = $_POST["item"];
    $categoria = $_POST["categoria"];
    $localizacao = $_POST["localizacao"];
    $valor = $_POST["valor"];

    // Verificações de entrada
    if (empty($quantidade) || empty($descricao) || empty($item) || empty($localizacao) || empty($valor) || empty($categoria)) {
        echo "Todos os campos são obrigatórios.";
    } else {
        // Verifique se um arquivo de imagem foi enviado
        if (isset($_FILES["caminho_imagem"]) && $_FILES["caminho_imagem"]["error"] == 0) {
            $targetDir = "uploads/"; // Diretório onde as imagens serão armazenadas
            $targetFile = $targetDir . basename($_FILES["caminho_imagem"]["name"]);

            // Verifique se o arquivo é uma imagem válida
            $imageInfo = getimagesize($_FILES["caminho_imagem"]["tmp_name"]);
            if ($imageInfo !== false) {
                // É uma imagem, então mova o arquivo para o diretório de destino
                if (move_uploaded_file($_FILES["caminho_imagem"]["tmp_name"], $targetFile)) {
                    $imagem = $targetFile;

                    // Inserir dados no banco de dados (usando consulta preparada)
                    $stmt = $mysqli->prepare("INSERT INTO descricao (caminho_imagem, quantidade, categoria, descricao, item, localizacao, valor) 
                                             VALUES (?, ?, ?, ?, ?, ?, ?)");

                    if (!$stmt) {
                        echo "Erro na preparação da consulta: " . $mysqli->error;
                    } else {
                        $stmt->bind_param("ssssssd", $imagem, $quantidade, $categoria, $descricao, $item, $localizacao, $valor);

                        if ($stmt->execute()) {
                            echo "Cadastro realizado com sucesso!";
                            header("refresh:3;url=compras.php");
                        } else {
                            echo "Erro ao cadastrar: " . $stmt->error;
                        }

                        $stmt->close(); // Fechar a consulta preparada
                    }
                } else {
                    echo "Erro ao mover a imagem para a pasta.";
                }
            } else {
                echo "O arquivo não é uma imagem válida.";
            }
        } else {
            echo "Nenhum arquivo de imagem enviado ou ocorreu um erro.";
        }
    }

    $mysqli->close(); // Fechar a conexão com o banco de dados
}
?>
