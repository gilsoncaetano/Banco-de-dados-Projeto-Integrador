<?php

class Cliente{
public $idcliente;
public $nomecliente;
public $cpf;
public $sexo;
public $email;
public $telefone;
public $foto;
public $senha;

// public $idcontato;
// public $idendereco;
// public $idusuario;

    public function __construct($db){
        $this->conexao = $db;
    }

    /*
    Função para listar todos os usuários cadastrados no banco de dados
    */
    public function listar(){
        $query = "select * from cliente";
        /*
        Será criada a variável stmt(Statement - Sentença)
        para guardar a preparação da consulta select que será executada
        posteriormente
        */
        $stmt = $this->conexao->prepare($query);

        //executar a consulta e retornar seus dados
        $stmt->execute();

        return $stmt;

    }

    public function cadastro(){

    $query = "insert into cliente set nomecliente=:n, cpf=:c, sexo=:s, email=:e, telefone=:t, foto=:ft, senha=:sh";
   
    $stmt = $this->conexao->prepare($query);

    //Encriptografar a senha com o uso de md5
    $this->senha = md5($this->senha);

    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */

    $stmt->bindParam(":n",$this->nomecliente);
    $stmt->bindParam(":c",$this->cpf);
    $stmt->bindParam(":s",$this->sexo);
    $stmt->bindParam(":e",$this->email);
    $stmt->bindParam(":t",$this->telefone);
    $stmt->bindParam(":ft",$this->foto);
    $stmt->bindParam(":sh",$this->senha);
    
     if($stmt->execute()){
        return true;
        }
        else{
            return false;
        }

    }

    public function atualizarcliente(){
    $query = "update cliente set nomecliente=:n, cpf=:c, sexo=:s, email=:e, telefone=:t, foto=:ft, senha=:sh where idcliente=:idcli";

    $stmt = $this->conexao->prepare($query);

    //Encriptografar a senha com o uso de md5
    $this->senha = md5($this->senha);

    /*Vamos vincular os dados que veem do app ou navegador com os campos de
    banco de dados
    */

    $stmt->bindParam(":n",$this->nomecliente);
    $stmt->bindParam(":c",$this->cpf);
    $stmt->bindParam(":s",$this->sexo);
    $stmt->bindParam(":e",$this->email);
    $stmt->bindParam(":t",$this->telefone);
    $stmt->bindParam(":ft",$this->foto);
    $stmt->bindParam(":sh",$this->senha);
    $stmt->bindParam(":idcli",$this->idcliente);



    if($stmt->execute()){
    return true;
    }
    else{
    return false;
    }
    }


    public function apagarcliente(){
        $query = "delete from cliente where idcliente=:id";

        $stmt = $this->conexao->prepare($query);

        /*Vamos vincular os dados que veem do app ou navegador com os campos de
        banco de dados
        */
        $stmt->bindParam(":id",$this->idcliente);
      

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }

    }


    

}


?>