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
    echo '<script>alert("Endereço cadastrado com sucesso!");</script>';
    header("location: index.html");
} elseif ($resultado === 1) {
    echo '<script>alert("Endereço já cadastrado.");</script>';
    header("location: endereco.html");
} else {
    echo '<script>alert("Falha ao cadastrar o endereço, tente novamente!");</script>';
    header("location: endereco.html");
}
