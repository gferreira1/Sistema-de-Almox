<?php

include("protect.php");
include("pesquisa.php");
include("configs/config2.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylecompras.css./stylecompras.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Gerenciamento de Estoque ALME</title>
</head>

<body>
    <div class="buttonsair text-right">
        <button class="sair" onclick="window.location.href = 'index.php';">Sair</button>
    </div>

    <div class="container-fluid">
        <h1 class="textsoli">Setor de ALME</h1>
        <div class="row">
            <div class="col-md-3">
                <!-- Botões Laterais -->
                <div class="btn-group-vertical">
                    <h3>Gerenciamento de Estoque</h3>
                    <button type="button" class="btn btn-secondary" onclick="showForm('solicitacoes')">Separar Solicitação</button>
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

            if (formType === 'solicitacoes') {
    // Defina as solicitações manualmente
    const solicitacoes = [
        { id: 1, item: 'Item 1', quantidade: 5, requerente: 'Usuário 1', setor: 'Setor A' },
        { id: 2, item: 'Item 2', quantidade: 3, requerente: 'Usuário 2', setor: 'Setor B' },
        { id: 3, item: 'Item 3', quantidade: 2, requerente: 'Usuário 3', setor: 'Setor C' },
    ];

    // Agora, vamos gerar o HTML para listar as solicitações.
    formHTML = '<h2>Solicitações de Separação de Itens</h2>';

    if (solicitacoes.length > 0) {
        formHTML += '<table class="table">';
        formHTML += '<thead class="table-dark">';
        formHTML += '<tr>';
        formHTML += '<th>ID</th>';
        formHTML += '<th>Item</th>';
        formHTML += '<th>Quantidade</th>';
        formHTML += '<th>Requerente</th>';
        formHTML += '<th>Setor</th>';
        formHTML += '<th>Ação</th>';
        formHTML += '</tr>';
        formHTML += '</thead>';
        formHTML += '<tbody>';

        solicitacoes.forEach((solicitacao) => {
            formHTML += '<tr>';
            formHTML += `<td>${solicitacao.id}</td>`;
            formHTML += `<td>${solicitacao.item}</td>`;
            formHTML += `<td>${solicitacao.quantidade}</td>`;
            formHTML += `<td>${solicitacao.requerente}</td>`;
            formHTML += `<td>${solicitacao.setor}</td>`;
            formHTML += '<td><button class="btn btn-primary">Separar</button></td>';
            formHTML += '</tr>';
        });

        formHTML += '</tbody>';
        formHTML += '</table>';
    } else {
        formHTML += 'Nenhuma solicitação encontrada.';
    }
}

            formContainer.innerHTML = formHTML;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <script src="eyes.js"></script>
</body>

</html>
