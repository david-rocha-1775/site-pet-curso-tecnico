<?php
session_start(); // Inicia a sessão para poder destruí-la

// Remove todas as variáveis da sessão
session_unset();

// Destrói a sessão
session_destroy();

// Redireciona para a página de login
header('Location: index.html');
exit;
?>