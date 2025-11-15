<?php
session_start();

// SE a sessão 'id' NÃO existir, o usuário não logou.
if (!isset ($_SESSION['id'])) {
    
    // Opcional: Salva a mensagem de erro
    $_SESSION ['mensagem'] = "Faça o Login";
    
    // Envia o usuário de volta para o LOGIN.
    header('Location: index.html');
    exit();
}

// SE o 'if' acima não rodou, significa que o usuário ESTÁ logado.
// Então, redireciona para a página principal.
header('Location: pagina.php');
exit();
?>