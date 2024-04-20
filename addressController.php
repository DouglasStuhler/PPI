<?php

require 'model/Endereco.php';
require 'conexaoBanco.php';

// resgata a ação a ser executada
$acao = $_GET['acao'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

switch ($acao) {

    case "adicionarEndereco":
        // recupera os dados do formulárioCEP, logradouro, cidade, estado
        $nome = $_POST["nome"] ?? "";
        $cpf = $_POST["cpf"] ?? "";
        $email = $_POST["email"] ?? "";
        $senha = $_POST["senha"] ?? "";
        $altura = $_POST["altura"] ?? "";
        $estadoCivil = $_POST["estadoCivil"] ?? "";
        $dataNascimento = $_POST["dataNascimento"] ?? "";

        // cria um novo Endereço
        $novoCliente = new Endereco(
            $nome,
            $cpf,
            $email,
            $senhaHash,
            $dataNascimento,
            $estadoCivil,
            $altura
        );

        // adiciona o cliente na tabela do banco de dados
        $novoCliente->AddToDatabase($pdo);
        header("location: controlador.php?acao=listarClientes");
        break;

    default:
        exit("Ação não disponível");
}
