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
    
    <link rel="stylesheet" href="css/pagina.css">
    
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <title>Meus pets</title>
</head>
<body>
    <div class="container">
        <div class="content-box">
            <h1>olá, Seja bem vindo <?php echo htmlspecialchars($nome);?>!</h1>
            <a href="logout.php">Sair</a>

            <h2>Seus pets:</h2>
            
            <?php if ($pets): ?>
                <?php foreach ($pets as $p): ?>
                    <div class="pet-card">
                        <img src="<?php echo htmlspecialchars($p['foto'] ?:'img/pet_padrao.jpg')?>" alt="<?php htmlspecialchars($p['nome'])?>">
                        
                        <div class="pet-info">
                            <h2><?php echo htmlspecialchars($p['nome'])?></h2>
                            <p>
                                <strong>Raça:</strong> <?php echo htmlspecialchars($p['raca'])?><br>
                                <strong>Sexo:</strong> <?php echo htmlspecialchars($p['sexo'])?><br>
                                <strong>Porte:</strong> <?php echo htmlspecialchars($p['porte'])?>
                            </p>
                        </div>
                    </div>
                    <?php endforeach; ?>
            <?php else: ?>
                <p>Você ainda não cadastrou nehum pet.</p>
            <?php endif; ?>

        </div> </div> </body>
</html>