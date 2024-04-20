<?php
require '../../../conexaoBanco.php';

$pdo = mysqlConnect();

// Resgatando os dados da pessoa
$nome = $_POST["nome"] ?? "";
$sexo = $_POST["sexo"] ?? "";
$email = $_POST["email"] ?? "";
$telefone = $_POST["telefone"] ?? "";
$CEP = $_POST["cep"] ?? "";
$logradouro = $_POST["logradouro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";

// Atributos de Paciente
$peso = $_POST["peso"] ?? "";
$altura = $_POST["altura"] ?? "";
$tp_sangue = $_POST["tp_sangue"] ?? "";

$sql1 = <<<SQL
  INSERT INTO Pessoa (nome, sexo, email, telefone, CEP, logradouro, cidade, estado)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?)
  SQL;

$sql2 = <<<SQL
  INSERT INTO Paciente (peso, altura, tp_sangue, id_pessoa)
  VALUES (?, ?, ?, ?)
  SQL;

try {
  $pdo->beginTransaction();

  $stmt1 = $pdo->prepare($sql1);
  $stmt1->execute([
    $nome, $sexo, $email, $telefone, $CEP, $logradouro,  $cidade, $estado
  ]);

  $id_pessoa = $pdo->lastInsertId();

  $stmt2 = $pdo->prepare($sql2);
  $stmt2->execute([
    $peso, $altura, $tp_sangue, $id_pessoa
  ]);

  $pdo->commit();

} catch (Exception $e) {
  $pdo->rollBack();
  exit('Rollback executado: ' . $e->getMessage());
}
?>