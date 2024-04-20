<?php

require 'model/Endereco.php';
require 'conexaoBanco.php';

// resgata a ação a ser executada
$acao = $_GET['acao'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

switch ($acao) {

    case "cadEndereco":
        // recupera os dados do formulárioCEP, logradouro, cidade, estado
        $CEP = $_POST["CEP"] ?? "";
        $logr = $_POST["logr"] ?? "";
        $estado = $_POST["estado"] ?? "";
        $cidade = $_POST["cidade"] ?? "";

        // cria um novo Endereço
        $novoEndereco = new Endereco(
            $CEP,
            $logr,
            $estado,
            $cidade
        );

        // adiciona o endereço na tabela do banco de dados
        $resultado = $novoEndereco->insertEndereco($pdo);

        if ($resultado === true) {
            echo json_encode(["success" => true]);
            header("location: index.html");
        } else {
            echo json_encode(["success" => false, "error" => $resultado]);
        }
        
        break;

    default:
        exit("Ação não disponível");
}
