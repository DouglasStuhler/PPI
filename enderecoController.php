<?php

require 'model/Endereco.php';
require 'conexaoBanco.php';

// conecta ao servidor do MySQL
$pdo = mysqlConnect();


// recupera os dados do formulárioCEP, logradouro, cidade, estado
$CEP = $_POST["cep"] ?? "";
$logr = $_POST["logradouro"] ?? "";
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

if ($resultado === 0) {
    header('Content-type: application/json');
    echo json_encode($resultado);
} elseif ($resultado === 1) {
    header('Content-type: application/json');
    echo json_encode($resultado);
} else {
    header('Content-type: application/json');
    echo json_encode($resultado);
}
