<?php
session_start();

if (!isset($_SESSION["id"])) {
    $_SESSION['mensagem'] = "Faça o login primeiro";
    header("Location: index.html");
    exit;
}
$nome = $_SESSION['nome'];
$id = $_SESSION['id']
?>