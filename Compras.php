<?php
include('protect.php');
include('pesquisa.php');
//include('config2.php');
include('configsqlite2.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylecompras.css">
    <script src="./compras.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Gerenciamento de Estoque Compras</title>

<style>

</style>
</head>

<body>
    <div class="buttonsair text-right">
        <button class="sair" onclick="window.location.href = 'index.php';">Sair</button>
    </div>

    <div class="container-fluid">
        <h1 class="textsoli">Gerenciamento de Estoque Compras</h1>
        <div class="row">
            <div class="col-md-3">
                <!-- Botões Laterais -->
                <div class="btn-group-vertical">
                    <h3>Gerenciamento de Estoque</h3>
                    <button type="button" class="btn btn-secondary" onclick="showForm('cadastrar')">Cadastro de Produto</button>
                    <button type="button" class="btn btn-secondary" onclick="showForm('consultar')">Consulta de Estoque</button>
                    <button type="button" class="btn btn-secondary" onclick="showForm('#')">Solicitaçoes de Compra</button>
                </div>
            </div>
            <div class="col-md-9">
                <!-- Caixas de Informações -->
                <div class="balance-boxes">
                    <div class="balance-box">
                        <!-- Exibe o saldo total -->
                        <?php
                        $saldoTotal = 0; // Variável para armazenar o saldo total

                        echo '<div class="balance-box">';
                        echo '<h3>Saldo</h3>';
                        // Calcula o saldo total somando os valores calculados (quantidade * valor)
                        if($result){
                            while ($row = $result->fetchAll()) {
                                $valorTotal = $row['quantidade'] * $row['valor'];
                                $saldoTotal += $valorTotal;
                            }
                        }
                        // Exibe o saldo total formatado como moeda
                        echo '<p class="balance-value">R$ ' . number_format($saldoTotal, 2, ',', '.') . '</p>';
                        echo '</div>';
                        ?>
                    </div>
                    <div class="balance-box">
                        <div class="balance-box">
                            <h3>Quantidade de Itens Cadastrados</h3>
                            <p class="balance-value"><?php echo $totalItens; ?> itens</p>
                        </div>
                    </div>
                </div>

                <div id="formContainer">
                    <!-- O formulário será exibido aqui -->
                </div>
            </div>
        </div>
    </div>

    <script>
        function showForm(formType) {
            var formContainer = document.getElementById('formContainer');
            formContainer.innerHTML = ''; // Limpa o conteúdo anterior

            var formHTML = '';

            if (formType === 'consultar') {
                formHTML = `
                <div class="container text-center">
                    <form method="GET" action="" enctype="multipart/form-data">
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
                                    <input type="text" class="form-control" name="categoria" placeholder="Categoria" aria-label="Categoria" aria-describedby="basic-addon3">
                                </div>
                            </div>

                            <div class="col">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" name="localizacao" placeholder="Localização" aria-label="Localização" aria-describedby="basic-addon4">
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

                <div class="container text-center">
                    <?php
                    $result = $mysqli->query($sql);

                    if (!$result) {
                        die("Erro na consulta: " . $mysqli->error);
                    } else {
                        $numResultados = $result->num_rows; // Conta o número de resultados
                        if ($result->num_rows > 0) {
                            echo '<div class="container">';
                            echo '<h2>Resultados da Pesquisa</h2>';
                            echo '<table class="table">';
                            echo '<thead class="table-dark">';
                            echo '<tr>';
                            echo '<th>Imagem</th>';
                            echo '<th>Quantidade</th>';
                            echo '<th>Descrição</th>';
                            echo '<th>Categoria</th>';
                            echo '<th>Item</th>';
                            echo '<th>Localização</th>';
                            echo '<th>Valor Unitário</th>';
                            echo '<th>Valor Total</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            while ($row = $result->fetch_assoc()) {
                                echo '<tr class="table-row" data-bs-toggle="modal" data-bs-target="#itemModal' . $row['id'] . '">';
                                echo '<td><img class="zoomable-image"src="' . $row['caminho_imagem'] . '" alt="Imagem do Produto" width="50" height="50"></td>';


                                echo '<td>' . $row['quantidade'] . '</td>';
                                echo '<td>' . $row['descricao'] . '</td>';
                                echo '<td>' . $row['categoria'] . '</td>';
                                echo '<td>' . $row['item'] . '</td>';
                                echo '<td>' . $row['localizacao'] . '</td>';
                                echo '<td>R$ ' . $row['valor'] . '</td>';
                                $valorTotal = $row['quantidade'] * $row['valor'];
                                echo '<td>R$ ' . $valorTotal . '</td>';
                                echo '</tr>';

                                // Modal for each item
                                echo '<div class="modal fade" id="itemModal' . $row['id'] . '" tabindex="-1" aria-labelledby="itemModalLabel" aria-hidden="true">';
                                echo '<div class="modal-dialog">';
                                echo '<div class="modal-content">';
                                echo '<div class="modal-header">';
                                echo '<h5 class="modal-title" id="itemModalLabel">' . $row['item'] . '</h5>';
                                echo '<h5 class="modal-title descricaoh5" id="itemModalLabel-descricao">' . $row['descricao'] . '</h5>';
                                echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
                                echo '</div>';
                                echo '<div class="modal-body">';
                                // Adicione um campo de entrada de quantidade
                                echo '<label for="quantidade-solicitada">Quantidade desejada:</label>';
                                echo '<input type="number" id="quantidade-solicitada" name="quantidade-solicitada" min="1" max="' . $row['quantidade'] . '" value="1">';
                                echo '<p>Descrição: ' . $row['descricao'] . '</p>';
                                echo '<p>Localização: ' . $row['localizacao'] . '</p>';
                                echo '<button type="button" data-bs-dismiss="modal" aria-label="Close">Solicitar</button>';
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
                `;
            } else if (formType === 'cadastrar') {
                formHTML = `
                <h2>Cadastro de Produto</h2>
                <form method="POST" action="cadastroitem.php" enctype="multipart/form-data">
                    <!-- Seus campos de cadastro aqui -->
                    
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="descricao" name="descricao">
                    </div>
                    <div class="mb-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="quantidade" name="quantidade">
                    </div>
                    <div class="mb-3">
                        <label for="categoria" class="form-label">Categoria</label>
                        <select class="form-control" id="categoria" name="categoria">
                            <option value="informatica">Informática</option>
                            <option value="escritorio">Escritório</option>
                            <option value="ferreamentas">Ferramentas</option>
                            <option value="eletrica">Elétrica</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for "item" class="form-label">Item</label>
                        <input type="text" class="form-control" id="item" name="item">
                    </div>
                    <div class="mb-3">
                        <label for="localizacao" class="form-label">Localização</label>
                        <input type="text" class="form-control" id="localizacao" name="localizacao">
                    </div>
                    <div class="mb-3">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="number" class="form-control" id="valor" name="valor">
                    </div>
                    <div class="mb-3">
                        <label for="caminho_imagem" class="form-label">Imagem:</label>
                        <input type="file" id="caminho_imagem" name="caminho_imagem" accept="image/png, image/jpeg" />
                    </div>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </form>
                `;
            }

            formContainer.innerHTML = formHTML;
        }

        // Chamada para exibir o formulário de cadastro ao carregar a página
        showForm('cadastrar');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
  <!-- Conteúdo principal do seu site vai aqui -->

  <footer>
        <p>&copy; 2023 Nome da Sua Empresa</p>
    </footer>

</html>
