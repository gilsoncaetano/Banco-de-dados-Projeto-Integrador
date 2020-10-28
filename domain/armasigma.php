<?php


class Armasigma{

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
  public $idcliente;
  
  public function __construct($db){
    $this->conexao = $db;

}

public function listar(){
    $query = "select * from armasigma";

    $stmt = $this->conexao->prepare($query);

    $stmte->execute();

    return $stmt;
}

?>