<?php
session_start();
include 'conexão.php';

class UserAuthenticator {
    private $conexao;
    
    public function __construct($conexao){
        $this->conexao = $conexao;
    }

    public function authenticate($username, $password){
        $stmt = $this->conexao->prepare("SELECT id,senha FROM usuarios WHERE nome =? ");
        if (!$stmt) {
            die("erro no prepare (authenticate):". $this->conexao->errorInfo()[2]);
        }
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) { // Verifica se encontrou um usuário
            //verifica a senha criptogafada
            if (password_verify($password, $user["senha"])) {
                return $user["id"];
            }
        }
        return false;
    }

    public function userExists($username){
        $stmt = $this->conexao->prepare("SELECT id FROM usuarios WHERE nome =?");
        if (!$stmt) {
             die("Erro no prepare (userExists):" . $this->conexao->errorInfo()[2]);
        }
        $stmt->execute([$username]);
        $result = $stmt->fetchColumn();

        return $result > 0;
    }
}

// Processa o login se o formulario for enviado x
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"] ?? '';
    $senha = $_POST["senha"] ?? '';

    $authenticator = new UserAuthenticator($conexao);
    if ($authenticator->userExists($nome)) {
        $userId = $authenticator->authenticate($nome,$senha);

        if ($userId) {
            $_SESSION['id'] = $userId;
            $_SESSION['nome'] = $nome;

            //Redireciona para a pagina protegida
            header("Location: verifica_cliente.php");
            exit;
        }else {
            //login invalido - senha errada
            echo "Senha incorreta. <a herf='index.html'>Tente novamente</a>.";
        }
    }else {
        echo "Usuário não encontrado. ou Senha incorreta.";
        var_dump($_SERVER["REQUEST_METHOD"]);
    }
    
}

?>