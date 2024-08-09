// JavaScript para lidar com a solicitação quando o modal é fechado
document.addEventListener("DOMContentLoaded", function () {
    var itemModals = document.querySelectorAll(".modal");

    for (var i = 0; i < itemModals.length; i++) {
        itemModals[i].addEventListener("hidden.bs.modal", function () {
            var quantidadeSolicitada = document.getElementById("quantidade-solicitada").value;
            var itemId = this.getAttribute("id").replace("itemModal", "");

            // Aqui você pode usar o ID do item e a quantidade escolhida
            console.log("Solicitando item com ID: " + itemId + " e quantidade: " + quantidadeSolicitada);
            // Adicione seu código para processar a solicitação com ID e quantidade aqui
        });
    }
});


// Variável para armazenar as solicitações
var solicitacoes = [];

// Função para adicionar uma solicitação à lista
function adicionarSolicitacao(idProduto, quantidadeDesejada) {
    solicitacoes.push({ id: idProduto, quantidade: quantidadeDesejada });
}

// Função para exibir a lista de solicitações
function exibirSolicitacoes() {
    var solicitacoesContainer = document.getElementById('solicitacoesContainer');
    solicitacoesContainer.innerHTML = ''; // Limpa o conteúdo anterior

    if (solicitacoes.length > 0) {
        var solicitacoesHTML = '<h2>Solicitações de Compra</h2><ul>';
        solicitacoes.forEach(function (solicitacao) {
            solicitacoesHTML += `<li>Produto ID ${solicitacao.id}, Quantidade: ${solicitacao.quantidade}</li>`;
        });
        solicitacoesHTML += '</ul>';
        solicitacoesContainer.innerHTML = solicitacoesHTML;
    } else {
        solicitacoesContainer.innerHTML = '<p>Nenhuma solicitação de compra.</p>';
    }
}

// Função para manipular o clique no botão "Solicitar" dentro do modal
function solicitarProduto(idProduto) {
    var quantidadeInput = document.getElementById('quantidade-solicitada-' + idProduto);
    var quantidadeDesejada = quantidadeInput.value;
    if (quantidadeDesejada > 0) {
        adicionarSolicitacao(idProduto, quantidadeDesejada);
        exibirSolicitacoes();
    }
}

// Adicionar um ouvinte de evento para exibir as solicitações ao carregar a página
window.addEventListener('load', function () {
    exibirSolicitacoes();
});
