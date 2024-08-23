<?php
include("protect.php");
include("pesquisa.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    
    <title>Tela principal </title>
</head>
<body>
    <div class="buttonsair"><button class="sair" onclick="window.location.href = 'index.php';">Sair</button></div>

    <h1 class="textsoli">Solicite seu material <?php echo $_SESSION['nome']; ?></h1>
    <div class="container text-center">
        <form method="GET" action="">
            <!-- ... Seu formulário de pesquisa ... -->
            <div class="row align-items-center">
                <div class="col">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="item" placeholder="Item" aria-label="Item" aria-describedby="basic-addon1">

                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="descricao" placeholder="Descrição" aria-label="Descrição" aria-describedby="basic-addon2">
                    </div>
                </div>
                <div class="col">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="localizacao" placeholder="Localização" aria-label="Localização" aria-describedby="basic-addon3">
                    </div>
                </div>
            </div>
            <div class="container text-center">
                <div class="row">
                    <button type="submit" class="btn btn-success">Pesquisar</button>
                </div>
            </div>
        </form>
    </div>
    <script src="solicitar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    
    <div class="container text-center">
        <?php
        $result = $mysqli->query($sql);

        if (!$result) {
            die("Erro na consulta: " . $mysqli->error);
        } else {
            if ($result->num_rows > 0) {
                echo '<div class="container">';
                echo '<h2>Resultados da Pesquisa</h2>';
                echo '<table class="table">';
                echo '<thead class="table-dark">';
                echo '<tr>';
               // echo '<th>ID</th>';
                echo '<th>Quantidade</th>';
                echo '<th>Descrição</th>';
                echo '<th>Item</th>';
                echo '<th>Localização</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';

                while ($row = $result->fetch_assoc()) {
                    echo '<tr class="table-row" data-bs-toggle="modal" data-bs-target="#itemModal' . $row['id'] . '">';
                    //echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['quantidade'] . '</td>';
                    echo '<td>' . $row['descricao'] . '</td>';
                    echo '<td>' . $row['item'] . '</td>';
                    echo '<td>' . $row['localizacao'] . '</td>';
                    echo '</tr>';

                    // Modal for each item
                    echo '<div class="modal fade" id="itemModal' . $row['id'] . '" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">';
                    echo '<div class="modal-dialog">';
                    echo '<div class="modal-content">';
                    echo '<div class="modal-header">';
                    echo '<h5 class="modal-title" id="itemModalLabel">' . $row['item'] . '</h5>';
                    echo '<h5 class="modal-title descricaoh5 " id="itemModalLabel-descricao">' . $row['descricao'] . '</h5>';
                    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                    echo '</div>';
                    echo '<div class="modal-body">';
                    echo '<p>Quantidade: ' . $row['quantidade'] . '</p>';
                    echo '<p>Descrição: ' . $row['descricao'] . '</p>';
                    echo '<p>Localização: ' . $row['localizacao'] . '</p>';
                    echo '<button type="button" onclick="solicitarItem(' . $row['id'] . ');" class="btn btn-primary">Solicitar</button>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }

                echo '</tbody>';
                echo '</table>';
                echo '</div>';
            } else {
                echo "Nenhum resultado encontrado.";
            }
        }
        
        $mysqli->close();
        ?>
        
    </div>
    
</body>
</html>
