<?php
try {
    // Conectar ao banco de dados SQLite
    $pdo = new PDO('sqlite:databasedogio.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar a tabela se não existir
    $sql = "CREATE TABLE IF NOT EXISTS usuario (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        usuario TEXT NOT NULL UNIQUE,
        setor TEXT NOT NULL,
        senha TEXT NOT NULL
    )";
    $pdo->exec($sql);
    echo "Tabela criada com sucesso.<br>";

    // Dados do usuário
    $usuario = 'admin';
    $setor = 'TI';
    $senha_plain = 'admin1234';
    $senha_hash = password_hash($senha_plain, PASSWORD_DEFAULT);

    // Verificar se o usuário já existe
    $checkUserSql = "SELECT COUNT(*) FROM usuario WHERE usuario = ?";
    $stmt = $pdo->prepare($checkUserSql);
    $stmt->execute([$usuario]);
    $userExists = $stmt->fetchColumn();

    if ($userExists) {
        echo "O usuário já existe.<br>";
    } else {
        // Adicionar um usuário com senha criptografada
        $sql = "INSERT INTO usuario (usuario, setor, senha) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        // Executar a inserção
        $stmt->execute([$usuario, $setor, $senha_hash]);
        echo "Usuário adicionado com sucesso.";
    }

    $sql = "CREATE TABLE IF NOT EXISTS descricao (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            descricao VARCHAR(255) NOT NULL ,
            localizacao VARCHAR(255) NOT NULL,
            item INTEGER NOT NULL,
            categoria VARCHAR(255) NOT NULL
    
    )";

    $pdo->exec($sql);
    echo 'Tabela Descricao criada com sucesso';

} catch (PDOException $e) {
    // Exibir mensagem de erro se a conexão falhar
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit();
}
?>
