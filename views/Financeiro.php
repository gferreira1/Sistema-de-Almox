<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylefinanceiro.css"> <!-- Link para seu arquivo CSS personalizado -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <title>Gerenciamento de Estoque</title>
</head>

<body>
    <header>
        <div class="logo">Sua Logo</div>
        <div class="buttonsair">
            <nav>
                <ul>
                    <li><a href="#">Início</a></li>
                    <li><a href="#">Cadastro de Setor</a></li>
                    <li><a href="#">Consulta de Estoque</a></li>
                </ul>
            </nav>
            <button class="sair" onclick="window.location.href = 'index.php';">Sair</button>
        </div>
    </header>

    <main>
        <section class="saldo">
            <h2>Saldo Geral </h2>
            <p class="saldo-valor">R$ 5.000,00</p>
        </section>

        <section class="itens">
            <div class="setores">
                <h2>Orçamento do Setores</h2>
                <ul class="setores-lista">
                    <li class="setor-item">
                        <h3>TI</h3>
                        
                        <div class="balance-boxes">
                            <div class="balance-box">
                                <h3>Valor projetado</h3>
                                <p class="balance-value">R$1500</p>
                            </div>
                            <div class="balance-box">
                                <h3>Valor gasto</h3>
                                <p class="balance-value valor-vermelho">R$ 227,92</p>
                            </div>
                            <div class="balance-box">
                                <h3>Total</h3>
                                <p class="balance-value">R$1.272,08</p>
                            </div>
                        </div>
                        <table>
                            <!-- Tabela de Gasto de Pessoal do Setor TI -->
                            <tr>
                                <th><h2>Gasto de Material</h2></th>
                            </tr>
                          
                        </table>
                        <table>
                            <!-- Tabela de Gasto de Material do Setor TI -->
                            <tr>
                                <th>Item</th>
                                <th>Data</th>
                                <th>Valor Unitário</th>
                                <th>Valor Total</th>
                            </tr>
                            <tr>
                                <td>Ssd 240gb Kingston Sata A 400 2.5 PC</td>
                                <td>02/09/23</td>
                                <td>R$ 179,99</td>
                                <td>R$ 179,99</td>
                            </tr>
                            <tr>
                                <td>Chamex Papel A4, 210 x 297 mm, 90g, Pacote 500 Folhas, Branco Sulfite</td>
                                <td>02/09/23</td>
                                <td>R$ 34,03</td>
                                <td>R$ 34,03</td>
                            </tr>
                            <tr>
                                <td>Fita Adesiva Transparente 48mmx45m Qualitape 1 Rolo Adelbras</td>
                                <td>02/09/23</td>
                                <td>R$ 13,90</td>
                                <td>R$ 13,90</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                                <th class="valor-vermelho">R$ 227,92</th>
                            </tr>
                        </table>
                    </li>
                    <!-- Repita a estrutura para os outros setores -->
                </ul>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023 Nome da Sua Empresa</p>
    </footer>
</body>

</html>