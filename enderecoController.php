<?php

require 'model/Endereco.php';
require 'conexaoBanco.php';

// conecta ao servidor do MySQL
$pdo = mysqlConnect();


// recupera os dados do formulárioCEP, logradouro, cidade, estado
$CEP = $_POST["cep"] ?? "";
$logr = $_POST["logr"] ?? "";
$estado = $_POST["estado"] ?? "";
$cidade = $_POST["cidade"] ?? "";
echo $CEP;
// cria um novo Endereço
$novoEndereco = new Endereco(
    $CEP,
    $logr,
    $estado,
    $cidade
);

// adiciona o endereço na tabela do banco de dados
$resultado = $novoEndereco->insertEndereco($pdo);
echo $resultado;
if ($resultado === true) {
    echo json_encode(["success" => true]);
    header("location: index.html");
} else {
    echo json_encode(["success" => false, "error" => $resultado]);
}
?>