<?php
class pet{
    private $conn;
    private $usuario_id;
    public $nome;
    public $sexo;
    public $raca;
    public $porte;
    public $foto;

    public function _constructct($conn,$usuario_id, $nome, $sexo, $raca, $porte, $foto = null){
        $this ->conn = $conn ;
        $this->usuario_id = $usuario_id;
        $this ->nome = trim($nome);
        $this->sexo = $sexo;
        $this->raca = $raca;
        $this->porte = $porte;
        $this->foto = $foto;
        
    }
    public function salvar(){
        $sql = "INSERT INTO pets (usuario_id ,nome, sexo, raca, porte, foto) VALUES (?,?,?,?,?,? ) ";
        $stmt = $this->conn >prepare($sql);

        if ($stmt ->execute([$this->usuario_id,$this->nome, $this->sexo, $this->raca, $this->porte, $this->foto])) {
            return $this->usuario_id;
        } else{
            throw new Exception("Erro ao salvar o pet.", 1);
            
        }
    }
}
?>