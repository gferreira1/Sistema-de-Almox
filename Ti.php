<?php
include('protect.php');
include('pesquisa.php');
include('configsqlite.php');
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./stylecompras.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Gerenciamento de Estoque Compras</title>
</head>

<body>
    <div class="buttonsair text-right">
        <button class="sair" onclick="window.location.href = 'index.php';">Sair</button>
    </div>

    <div class="container-fluid">
        <h1 class="textsoli">Setor de TI</h1>
        <div class="row">
            <div class="col-md-3">
                <!-- Botões Laterais -->
                <div class="btn-group-vertical">
                    <h3>Gerenciamento de Estoque</h3>
                    <button type="button" class="btn btn-secondary" onclick="showForm('cadastrar')">Cadastro de Usuario</button>
                    <button type="button" class="btn btn-secondary" onclick="showForm('consultar')">Consulta de Estoque</button>
                    <button type="button" class="btn btn-secondary" onclick="showForm('#')">Solicitaçoes de Compra</button>
                </div>
            </div>
            <div class="col-md-9">


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
                                    <input type="number" class="form-control" name="item" placeholder="Item" aria-label="Item" aria-describedby="basic-addon1">
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

                <div class="container text-center">
                    <?php
                    $result = $pdo->query($sql);

                    if (!$result) {
                        die("Erro na consulta: " . $mysqli->error);
                    } else {
                        if ($result) {
                            echo '<div class="container">';
                            echo '<h2>Resultados da Pesquisa</h2>';
                            echo '<table class="table">';
                            echo '<thead class="table-dark">';
                            echo '<tr>';
                            echo '<th>Imagem</th>';
                            echo '<th>Quantidade</th>';
                            echo '<th>Descrição</th>';
                            echo '<th>Item</th>';
                            echo '<th>Localização</th>';
                            echo '<th>Valor Unitário</th>';
                            echo '<th>Valor Total</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            while ($row = $result->fetchAll()) {
                                echo '<tr class="table-row" data-bs-toggle="modal" data-bs-target="#itemModal' . $row['id'] . '">';
                                echo '<td><img class="zoomable-image"src="' . $row['caminho_imagem'] . '" alt="Imagem do Produto" width="50" height="50"></td>';
                                echo '<td>' . $row['quantidade'] . '</td>';
                                echo '<td>' . $row['descricao'] . '</td>';
                                // echo '<td>' . $row['categoria'] . '</td>';
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
                                echo '<p>Quantidade: ' . $row['quantidade'] . '</p>';
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

                    ?>
                </div>
                `;
            } else if (formType === 'cadastrar') {
                formHTML = `
                <h2>Cadastro de usuario </h2>
                <form method="POST" action="cadastropessoas.php" enctype="multipart/form-data">
                    <!-- Seus campos de cadastro aqui -->
                    
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome">
                    </div>
                    <div class="mb-3">
                        <label for="quantidade" class="form-label">Sobrenome </label>
                        <input type="text" class="form-control" id="sobrenome" name="sobrenome">
                    </div>
                    <div class="mb-3">
                        <label for="usuario" class="form-label">E-mail</label>
                        <input type="text" class="form-control" id="usuario" name="usuario">
                    </div>
                    <div class="mb-3">
                        <select name="setor" id="setor">
                        <option value="setor">Setor</option>
                            <option value="ti">TI</option>
                            <option value="compras">Compras</option>
                            <option value="alme">ALME</option>
                            <option value="alms">ALMS</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha">
                    </div>

                    <div class="mb-3">
                        <label for="confirm_senha" class="form-label">Confirmar Senha</label>
                        <input type="password" class="form-control" id="confirm_senha" name="confirm_senha">
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="file" id="avatar" name="caminho_imagem" accept="image/png, image/jpeg" class="form-control">
                            <button type="button" class="btn btn-secondary" id="showImagePreview"><i class="bi bi-eye-fill"></i></button>
                        </div>
                    </div>
                    <div id="mensagemCadastro"></div>
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
    <script src="eyes.js"></script>
</body>
<footer>
        <p>&copy; 2023 Nome da Sua Empresa</p>
    </footer>
</html>