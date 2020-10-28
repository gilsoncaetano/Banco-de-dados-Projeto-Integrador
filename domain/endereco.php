<?php


class Endereco{

  public $idendereco;
  public $tipo; 
  public $logradouro; 
  public $numero;
  public $complemento;
  public $bairro;
  public $cep;
  public $idcliente;
  
  public function __construct($db){
    $this->conexao = $db;

}

public function listar(){
    $query = "select * from endereco";

    $stmt = $this->conexao->prepare($query);

    $stmt->execute();

    return $stmt;
}

public function perfilend($id){
    $query = "select en.idendereco,
    en.tipo,
    en.logradouro,
    en.numero,
    en.complemento,
    en.bairro,
    en.cep,
    en.idcliente,
    cli.foto from endereco en inner join cliente cli on en.idcliente=cli.idcliente where idendereco=:id";

    $stmt = $this->conexao->prepare($query);
         
    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */
    $stmt->bindParam(":id",$id);

    $stmt->execute();

    return $stmt;
}

public function perfilinicial(){
    $query = "select
    cl.idcliente,
    cl.nomecliente,
    cl.cpf,
    cl.sexo,
    cl.email,
    cl.telefone,
    cl.foto,
    cl.senha,
    en.idendereco,
    en.tipo,
    en.logradouro,
    en.numero,
    en.complemento,
    en.bairro,
    en.cep,
    en.idcliente,
    ar.idarma,
    ar.cpfarma,
    ar.funcao,
    ar.sigma,
    ar.arma,
    ar.fabricante,
    ar.calibre,
    ar.modelo,
    ar.cano,
    ar.capacidade,
    ar.funcionamento,
    ar.notafiscal,
    ar.datafiscal,
    ar.orgaoauto,
    ar.codigoauto
    from endereco en inner join cliente cl on en.idcliente=cl.idcliente
	inner join armasigma ar on ar.idcliente=cl.idcliente
    where en.idendereco = idendereco";
    $stmt = $this->conexao->prepare($query);
    
    $stmt ->execute();

    return $stmt;

   }

public function cadastro(){

    $query = "insert into endereco set tipo=:t, logradouro=:l, numero=:n, complemento=:c, bairro=:b, cep=:ce,idcliente=:cl";


    $stmt = $this->conexao->prepare($query);

    /*Vamos vincular os dados que vem do app ou navegador com os campos de
    banco de dados
    */
    $stmt->bindParam(":t",$this->tipo);
    $stmt->bindParam(":l",$this->logradouro);
    $stmt->bindParam(":n",$this->numero);
    $stmt->bindParam(":c",$this->complemento);
    $stmt->bindParam(":b",$this->bairro);
    $stmt->bindParam(":ce",$this->cep);
    $stmt->bindParam(":cl",$this->idcliente);

    if($stmt->execute()){
        return true;

    }
    else{
        return false;
    }
}

public function alterarEndereco(){
    $query = "update endereco set  tipo=:t, logradouro=:l, numero=:n, complemento=:c, bairro=:b, cep=:ce, idcliente=:cli where idendereco=:id";

    $stmte = $this->conexao->prepare($query);

  
    /*Vamos vincular os dados que vem do app ou navegador com os campos de
    banco de dados
    */
   
    $stmte->bindParam(":t",$this->tipo);
    $stmte->bindParam(":l",$this->logradouro);
    $stmte->bindParam(":n",$this->numero);
    $stmte->bindParam(":c",$this->complemento);
    $stmte->bindParam(":b",$this->bairro);
    $stmte->bindParam(":ce",$this->cep);
    $stmte->bindParam(":cli",$this->idcliente);
    $stmte->bindParam(":id",$this->idendereco);
    

    if($stmte->execute()){
        return true;
    }
    else{
        return false;
    }

}

public function apagarEndereco(){
    $query = "delete from endereco where idendereco=:id";

    $stmte = $this->conexao->prepare($query);

    
    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */
   
    $stmte->bindParam(":id",$this->idendereco);

    if($stmte->execute()){
        return true;
    }
    else{
        return false;
    }

}

}

?>
