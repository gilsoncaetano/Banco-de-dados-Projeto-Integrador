<?php


class Login{

    
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
    public $idarma;
    public $cpfarma; 
    public $funcao; 
    public $sigma;
    public $arma;
    public $fabricante;
    public $calibre;
    public $modelo;
    public $cano;
    public $capacidade;
    public $funcionamento;
    public $notafiscal;
    public $datafiscal;
    public $orgaoauto;
    public $codigoauto;
    


    public function __construct($db){
        $this->conexao = $db;
    }


public function login(){
   
       if ($query = "select
       cl.idcliente,
       cl.nomecliente,
       cl.cpf,
       cl.sexo,
       cl.email,
       cl.telefone,
       cl.foto,
       cl.senha,
       en.idendereco,
       en.idendereco,
       en.logradouro,
       en.numero,
       en.complemento,
       en.bairro,
       en.cidade,
       en.estado,
       en.cep
       from endereco en inner join cliente cl on en.idcliente=cl.idcliente
        where email=:e and senha=:s");

        
    
        $stmt = $this->conexao->prepare($query);
    
        $this->senha = md5($this->senha);
    
        $stmt->bindParam(":e",$this->email);
        $stmt->bindParam(":s",$this->senha);

        $stmt->execute();
        return $stmt;
    }

   

    }

?>