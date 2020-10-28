<?php

/*
Vamos criar um Header, ou seja, um cabeçalho.
Este cabeçalho permite o acesso a listagem de usuarios com diversas origens
Por isso estamos usando o *(asterisco) para essa permissão que será para 
 - http
 - https
 - file
 - ftp
*/
header("Access-Control-Allow-Origin:*");

/*
Vamos definir qual será o formato de dados que o cliente irá enviar e 
receber em relação a api. Este formato será do tipo JSON(Javascript on
Notatio)
*/
header("Content-Type: application/json;charset=utf-8");

/*
Abaixo estamos incluindo o arquivo database.php que possui a 
classe Database com a conexão com o banco deados
*/

include_once "../../config/database.php";

/*
O arquivo usuario.php foi será incluido para que a classe Usuario 
seja usada. Vale lembrar que esta classe possui o CRUD
*/
include_once "../../domain/listarlogin.php";

/*
Criamos um objeto chamado $database. É uma instância da classe Database 
que está na pasta config e isso nos dará acesso a todo o seu conteudo
publico
*/


$database = new Database();

/*
Executar a função que está dentro do database chamada getConnection, pois
esta função realiza a conexao com o banco de dados
*/

$db = $database->getConnection();

/*
Vamos fazer uma instância da classe usuário para ter acesso a todo
o seu conteúdo.
*/
$id=$_GET['idcliente'];

$usuario = new Listar($db);

$rs = $usuario->listarLog($id);

if($rs->rowCount()>0){
    $usuario_arr["saida"] = array();
/*
A estrutra while(equanto) realiza a busca de todos os usuários cadastrados
até chegar ao final da tabela e tras os dados para fetch array organizar 
em formato de array
Assim será mais fácil de adcionar no array de usuarios para apresentar 
ao final
*/
    while($linha = $rs->fetch(PDO::FETCH_ASSOC)){

        /*
        o comando extract é capaz de separar de forma mais simples os 
        campos da tabela usuarios
        */
        $array_item = array(
            "foto"=>$linha ["foto"],
             "idcliente"=>$linha ["idcliente"],
             "nomecliente"=> $linha ["nomecliente"],
             "cpf"=> $linha ["cpf"],
             "sexo"=> $linha ["sexo"],
             "email"=>$linha ["email"],
             "senha"=>$linha ["senha"],
             "telefone"=>$linha ["telefone"],
             "idendereco"=>$linha ["idendereco"],
             "tipo"=> $linha ["tipo"],
             "logradouro"=>$linha ["logradouro"],
             "numero"=> $linha ["numero"],
             "complemento"=>$linha ["complemento"],
             "bairro"=>$linha ["bairro"],
             "cep"=>$linha ["cep"],
        );
        array_push($usuario_arr["saida"],$array_item);

    }

    header("HTTP/1.0 200");
    echo json_encode($usuario_arr);
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Não há usuários cadastrados"));
}

?>