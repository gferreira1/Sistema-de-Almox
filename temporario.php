<main>
    <input type="text" placeholder="Texto" id="text-input"/>
    <input type="file" accept="image/png, image/jpeg" id="meme-insert">
    <div id="meme-image-container">
      <p id="meme-text"></p>
      <img src="" id="meme-image" />
    </div>
  </main>

<?php

$usuario = 'root';
$senha = '';
$database_login = 'login';
$database_material = 'material';
$host = 'localhost';

// Conectar ao banco de dados "login"
$mysqli_login = new mysqli($host, $usuario, $senha, $database_login);

if ($mysqli_login->error) {
    die("Falha ao conectar ao banco de dados 'login': " . $mysqli_login->error);
}

// Conectar ao banco de dados "material"
$mysqli_material = new mysqli($host, $usuario, $senha, $database_material);

if ($mysqli_material->error) {
    die("Falha ao conectar ao banco de dados 'material': " . $mysqli_material->error);
}

// Agora você pode executar consultas relacionadas ao banco de dados "material"
$sql_material = "SELECT * FROM material";
$result_material = $mysqli_material->query($sql_material);

// ... Faça algo com os resultados do banco de dados "material"

// Não se esqueça de fechar as conexões quando terminar
$mysqli_login->close();
$mysqli_material->close();

?>






<?
// Consulta para contar a quantidade de itens cadastrados

//$countQuery = "SELECT COUNT(*) AS total FROM quantidade";
//$countResult = $mysqli->query($countQuery);

//if ($countResult) {
  //  $row = $countResult->fetch_assoc();
   // $valortotal = $row['total'];
//} else {
  //  $valortotal = 0;
//}
?>

