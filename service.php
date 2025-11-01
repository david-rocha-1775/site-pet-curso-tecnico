<?php
class CadastroService{
    public function savarFoto($filesArray, $index){
        if (!isset($filesArray['name'][$index])|| $filesArray ['error'] [$index] !== UPLOAD_ERR_OK){
            return null; // caso nao envie a foto 
        }
        $uploadDir = __DIR__. "/uploads/";
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $nomeArquivo = uniqid() ." ". basename ($filesArray['name'][$index]);
        $destino = $uploadDir .$nomeArquivo;

        if(move_uploaded_file($filesArray ['tmp_name'][$index],$destino)){
            return "uploads/". $nomeArquivo;//salva a foto
            
        }
    }
    
}

?>