<?php 
 class Listar{   
public $foto;
public $idcliente;
public $nomecliente;
public $cpf;
public $sexo;
public $email;
public $telefone;
public $senha;
public $idendereco;
public $tipo;
public $logradouro;
public $numero;
public $complemento;
public $bairro;
public $cep;

public function __construct($db){
    $this->conexao = $db;
}
 public function listarLog($id){
   
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
   en.tipo,
   en.logradouro,
   en.numero,
   en.complemento,
   en.bairro,
   en.cep
   from endereco en inner join cliente cl on en.idcliente=cl.idcliente
   inner join armasigma ar on ar.idcliente=cl.idcliente 
    where en.idcliente =:id");

    $stmt=$this->conexao->prepare($query);

    $stmt->bindParam(":id",$id);

    $stmt->execute();

    return $stmt;
}
}
?>