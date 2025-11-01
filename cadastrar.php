<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1); 
include_once 'conexão.php';
require 'usuario.php';
require 'pet.php';
require 'service.php';

// Garante que o metodo de envio é o post
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.html');
    exit;
}
try {
    if($_POST['senha'] !== $_POST['confirmar_senha']){
        throw new Exception("as senhas nao coincidem", 1);
    }

    $usuario = new usuario(
        $conexao,
        ($_POST['nome_usuario']),
        ($_POST['endereco']), 
        ($_POST['telefone']),
        ($_POST['email']),
        ($_POST['senha'])
    );

    $_usuarioID = $usuario->salvar();
    if (!$_usuarioID) {
        throw new Exception("Falha ao cadastrar o usuario ", 1);
    }

    if (!empty($_POST['pets']) && is_array($_POST['pets'])) {
        
        $uploadService = new CadastroService();

        foreach ($_POST['pets'] as $i => $pet) {
            
            $nome = trim($pet['nome_pet'] ?? "");
            $sexo = $pet['sexo'] ?? "";
            $porte = $pet['porte'] ?? "";
            $raca = $pet['raca'] ?? "";

            if (!$nome || !$sexo || !$porte || !$raca) {
                // Pula este pet se dados básicos estiverem faltando
                continue;
            }
            $foto = 'img/pet_padrao.jpg'; // Foto padrão
            
            if (!empty($_FILES['pet_fotos']['name'][$i]) && $_FILES['pet_fotos']['error'][$i] === UPLOAD_ERR_OK ) {

                $foto = $uploadService->salvarFoto($_FILES['pet_fotos'], $i) ?: $foto;
            }

            try {
                $novoPet = new Pet($conexao, $_usuarioID, $nome, $sexo, $raca, $porte, $foto);
                $novoPet->salvar(); 
                
            } catch (Exception $e) {
                echo "Erro ao cadastrar o pet '$nome': " . $e->getMessage();
            }
            
        }
    } 

echo "Cadastro realizado com sucesso!";
header ('Refresh: 2; URL=index.html');
exit;

} catch (Exception $e) {
    echo "Erro no cadastro " . $e->getMessage();
}
?>