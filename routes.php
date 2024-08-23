<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['usuario']) || empty($_POST['senha'])) {
        $login_error = "Preencha seu usuário e senha.";
    } else {
        $usuario = $_POST['usuario'];
        $senha_digitada = $_POST['senha'];

        // Consulta SQL parametrizada para prevenir SQL Injection
        $sql_code = "SELECT id, usuario, setor, senha FROM usuario WHERE usuario = ?";
        $stmt = $pdo->prepare($sql_code);
        $stmt->execute([$usuario]);

        if ($stmt) {
            $stmt->bindColumn(1, $id);
            $stmt->bindColumn(2, $usuario);
            $stmt->bindColumn(3, $setor);
            $stmt->bindColumn(4, $senha_no_banco);
            $stmt->fetch(PDO::FETCH_BOUND);

            // Verificar a senha usando password_verify
            $senha_verificada = password_verify($senha_digitada, $senha_no_banco);

            // Se a senha for válida, faça alguma coisa
            if ($senha_verificada) {
                $_SESSION['usuario'] = $usuario;
                $_SESSION['id'] = $id;
                $_SESSION['setor'] = $setor;

                // Redireciona com base no setor
                if (strcasecmp($setor, 'Compras') == 0) {
                    header("Location: compras.php");
                    exit();
                } elseif (strcasecmp($setor, 'Alme') == 0) {
                    header("Location: alme.php");
                    exit();
                } elseif (strcasecmp($setor, 'TI') == 0) {
                    header("Location: /ti.php");
                    exit();
                } else {
                    // Adicione outras verificações de setor conforme necessário
                    $login_error = "Setor não reconhecido.";
                }
            } else {
                // Credenciais inválidas
                $login_error = "Credenciais inválidas. Verifique a senha.";
            }
        } else {
            // Usuário não encontrado
            $login_error = "Credenciaiss inválidas. Verifique o usuário.";
        }
    }
}