<?php

/*
Vamos construir os cabeçalhos para trabalho com a api
*/
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json;charset=utf-8");

/*Para efetuar o cadastro de dados no banco é preciso
informar a api que essa ação irá ocorrer com ométodo PUT, que 
responsável pela atualização de dados da api
*/
header("Access-Control-Allow-Methods:PUT");

include_once "../../config/database.php";

include_once "../../domain/endereco.php";

$database = new Database();
$db = $database->getConnection();

$endereco = new Endereco($db);
$data = json_decode(file_get_contents("php://input"));

#Verificar se os dados vindos do usuário estão preenchidos
if(!empty($data->idcliente) && !empty($data->logradouro) && !empty($data->numero) && !empty($data->complemento) && !empty($data->bairro)  && !empty($data->cidade)  && !empty($data->estado) && !empty($data->cep)){

    $endereco->logradouro = $data->logradouro;
    $endereco->numero = $data->numero;
    $endereco->complemento = $data->complemento;
    $endereco->bairro = $data->bairro;
    $endereco->cidade = $data->cidade;
    $endereco->estado = $data->estado;
    $endereco->cep = $data->cep;
    $endereco->idcliente = $data->idcliente;
    

    if($endereco->alterarEndereco()){

        header("HTTP/1.0 201");
        echo json_encode(array("mensagem"=>"Endereço alterado com sucesso!"));
    }
    else{
        header("HTTP/1.0 400");
        echo json_encode(array("mensagem"=>"Não foi possível alterar dados do endereço"));
    }
}
else{
    header("HTTP/1.0 400");
    echo json_encode(array("mensagem"=>"Você precisa preencher todos os campos"));
}

?>
