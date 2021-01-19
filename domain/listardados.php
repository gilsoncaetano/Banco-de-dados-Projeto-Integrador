<?php


class Cadend{

    
    public $foto;
    public $idcliente;
    public $nomecliente;
    public $cpf;
    public $sexo;
    public $email;
    public $telefone;
    public $senha;
    public $idendereco;
    public $logradouro;
    public $numero;
    public $complemento;
    public $bairro;
    public $cidade;
    public $estado;
    public $cep;

    


    public function __construct($db){
        $this->conexao = $db;
    }

    public function cadastro(){

        $query = "insert into cliente set nomecliente=:n, cpf=:c, sexo=:s, email=:e, telefone=:t, foto=:ft, senha=:sh";
   
        $stmtcli = $this->conexao->prepare($query);
    
        //Encriptografar a senha com o uso de md5
        $this->senha = md5($this->senha);
    
        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
    
        $stmtcli->bindParam(":n",$this->nomecliente);
        $stmtcli->bindParam(":c",$this->cpf);
        $stmtcli->bindParam(":s",$this->sexo);
        $stmtcli->bindParam(":e",$this->email);
        $stmtcli->bindParam(":t",$this->telefone);
        $stmtcli->bindParam(":ft",$this->foto);
        $stmtcli->bindParam(":sh",$this->senha);

        $stmtcli->execute();

        $this->idcliente=$this->conexao->lastInsertId();

        $query = "insert into endereco set logradouro=:l, numero=:n, complemento=:c, bairro=:b, cidade=:cd, estado=:es, cep=:ce,idcliente=:cl";

        $stmt = $this->conexao->prepare($query);
    
        /*Vamos vincular os dados que vem do app ou navegador com os campos de
        banco de dados
        */
    
        $stmt->bindParam(":l",$this->logradouro);
        $stmt->bindParam(":n",$this->numero);
        $stmt->bindParam(":c",$this->complemento);
        $stmt->bindParam(":b",$this->bairro);
        $stmt->bindParam(":cd",$this->cidade);
        $stmt->bindParam(":es",$this->estado);
        $stmt->bindParam(":ce",$this->cep);
        $stmt->bindParam(":cl",$this->idcliente);
    
        if($stmt->execute()){
            return true;
    
        }
        else{
            return false;
        }
    }
}
?>