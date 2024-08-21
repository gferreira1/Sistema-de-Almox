<?php
try {
    $pdo = new PDO("sqlite:databasematerial.db");

    $query = 'CREATE TABLE IF NOT EXISTS tabela_material(
        id INTEGER PRIMARY KEY AUTOINCREMENT
    )';

    $pdo->exec($query);

    $query = 'SELECT * FROM tabela_material';
    $result_material = $pdo->exec($query);

    $query = 'CREATE TABLE IF NOT EXISTS tabela_login(
        id INTEGER PRIMARY KEY AUTOINCREMENT
    )';

    $pdo->exec($query);


    $query = 'SELECT * FROM tabela_login';
    $result_login = $pdo->exec($query);

    $query = 'CREATE TABLE IF NOT EXISTS descricao(
        id INTEGER PRIMARY KEY AUTOINCREMENT
    )';

    $pdo->exec($query);

    $query = "SELECT COUNT(*) AS total FROM descricao";
    $countResult = $pdo->query($query);

    if($countResult->rowCount() > 0){
        $row = $countResult->fetchAll();
        $totalItens = $row['total'];
    }else{
        $totalItens = 0;
    }

} catch (PDOException $e) {
    // Exibir mensagem de erro se a conexão falhar
    echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    exit();
}
?>
