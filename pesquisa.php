<?php
include('configsqlite.php');

if (isset($_GET['descricao'])) {
    $descricao = $_GET['descricao'];
} else {
    $descricao = "";
}
if (isset($_GET['categoria'])) {
    $categoria = $_GET['categoria'];
} else {
    $categoria = "";
}
if (isset($_GET['localizacao'])) {
    $localizacao = $_GET['localizacao'];
} else {
    $localizacao = "";
}
if (isset($_GET['item'])) {
    $item = $_GET['item'];
} else {
    $item = "";
}
//var_dump("Resultados da consulta:",$descricao, $localizacao, $item); // Adicione esta linha para depurar os valores  aqui apagar
// Consulta SQL para pesquisa
$sql = "SELECT * FROM descricao WHERE descricao LIKE '%$descricao%' AND localizacao LIKE '%$localizacao%' AND item LIKE '%$item%'AND categoria LIKE '%$categoria%' ";
//var_dump($sql); // Adicione esta linha para depurar a consulta SQL
$result = $pdo->exec($sql);
?>

<!DOCTYPE html>
<html>
<head>


</head>
<body>
    <!--h1>Resultados da Pesquisa</h1>-->

    <?php
    
    ?>
</body>
</html>




