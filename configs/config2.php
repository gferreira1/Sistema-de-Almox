<?php

$usuario = 'root';
$senha = '';
//$database = 'login';
$database = 'material';
$host = 'localhost';

$mysqli = new mysqli($host, $usuario, $senha, $database);

if($mysqli->error) {
    die("Falha ao conectar ao banco de dados: " . $mysqli->error);
}

$database_material = 'material';
$mysqli->select_db($database_material);

// Agora você pode executar consultas relacionadas ao banco de dados "material"
$sql_material = "SELECT * FROM tabela_material";
$result_material = $mysqli->query($sql_material);

// ... Faça algo com os resultados do banco de dados "material"

// Voltar para o banco de dados "login"
$mysqli->select_db($database);

// Agora você pode executar consultas relacionadas ao banco de dados "login"
$sql_login = "SELECT * FROM tabela_login";
$result_login = $mysqli->query($sql_login);

// ... Faça algo com os resultados do banco de dados "login"

// Consulta para contar a quantidade de itens cadastrados
$countQuery = "SELECT COUNT(*) AS total FROM descricao";
$countResult = $mysqli->query($countQuery);

if ($countResult) {
    $row = $countResult->fetch_assoc();
    $totalItens = $row['total'];
} else {
    $totalItens = 0;
}
?>





