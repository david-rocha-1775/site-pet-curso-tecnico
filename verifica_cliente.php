<?php
include 'conexão.php' ;

session_start();
    if (!isset ($_SESSION['id'])) {
        $_SESSION ['mensagem'] = "Faça o Login";
        header('Location: pagina.php');

        exit();
    }
    echo"Você está logado";
    ?>