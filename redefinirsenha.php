<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Esqueceu a senha</title>
</head>
<body>
    <h1>Esqueceu a senha?</h1>
    <form method="post" action="enviar_email.php">
        <label for="email">Endereço de E-mail:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Enviar E-mail de Recuperação</button>
    </form>
</body>
</html>



<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    
    // Valide o e-mail e verifique se ele existe no banco de dados
    // Gere um token exclusivo para redefinição de senha e salve-o no banco de dados
    // Envie um e-mail para o usuário com um link para a página de redefinição de senha (incluindo o token)
    
    // Exemplo de envio de e-mail (substitua com sua própria lógica)
    $token = bin2hex(random_bytes(16)); // Gera um token aleatório
    $link = "http://seusite.com/redefinir_senha.php?token=$token";
    
    // Configurações de e-mail (substitua com suas configurações)
    $to = $email;
    $subject = "Redefinir Senha";
    $message = "Clique no link abaixo para redefinir sua senha:\n$link";
    $headers = "From: seuemail@seusite.com";
    
    // Envia o e-mail
    mail($to, $subject, $message, $headers);
    
    // Exiba uma mensagem de confirmação para o usuário
    echo "Um e-mail de redefinição de senha foi enviado para o seu endereço de e-mail.";
}
?>