<?php
include 'sessao.php';
include 'conexão.php';
if (!$id) {
    header("Location: index.html");
    exit;
}

$stmt = $conexao->prepare("SELECT nome, foto, raca, sexo, porte FROM pets WHERE usuario_id=?");
$stmt->execute([$id]);
$pets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus pets</title>
</head>
<body>
    <h1>olá, Seja bem vindo <?php htmlspecialchars($nome);?>!</h1>
    <a href="logout.php">Sair</a>

    <h2>Seus pets:</h2>
    <?php if ($pets): ?>
        <?php foreach ($pets as $p): ?>
            <div>
                <img src="<?php htmlspecialchars($p['foto'] ?:'img/pet_padrao.jpg')?>" alt="<?php htmlspecialchars($p['nome'])?>">
                <h2><?php htmlspecialchars($p['nome'])?></h2>
                <p>Raça:<?php htmlspecialchars($p['raca'])?><br>
                   Sexo:<?php htmlspecialchars($p['sexo'])?><br>
                   Porte:<?php htmlspecialchars($p['porte'])?>
                </p>
            </div>
            <hr>
        <?php endforeach; ?>
        <?php else: ?>
            <p>Você ainda não cadastrou nehum pet.</p>
        <?php endif; ?>
</body>
</html>