<?php
require '../../conexaoBanco.php';

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

// Atributos de Funcionario
$dt_contrato = $_POST["data"] ?? "";
$salario = $_POST["salario"] ?? "";
$senha = $_POST["senha"] ?? "";

// Atributos do Medico
$vinculo = $_POST["vinculo"] ?? "";
$crm = $_POST["crm"] ?? "";
$especialidade = $_POST["especialidade"] ?? "";

$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql1 = <<<SQL
INSERT INTO Pessoa (nome, sexo, email, telefone, CEP, logradouro, cidade, estado)
VALUES (?, ?, ?, ?, ?, ?, ?, ?)
SQL;

$sql2 = <<<SQL
INSERT INTO Funcionario (dt_contrato, salario, senhaHash, id_pessoa)
VALUES (?, ?, ?, ?)
SQL;

$sql3 = null;

if($vinculo == "M"){
  $sql3 = <<<SQL
  INSERT INTO Medico (especialidade, crm, id_funcionario)
  values (?, ?, ?)
  SQL;
}

try {
  $pdo->beginTransaction();

  $stmt1 = $pdo->prepare($sql1);
  if(!$stmt1->execute([
    $nome, 
    $sexo, 
    $email, 
    $telefone, 
    $CEP, 
    $logradouro,  
    $cidade, 
    $estado
  ])) throw new Exception("Falha na primeira inserção");

  $id_pessoa = $pdo->lastInsertId();

  $stmt2 = $pdo->prepare($sql2);
  if(!$stmt2->execute([
    $dt_contrato, 
    $salario, 
    $senhaHash, 
    $id_pessoa
  ])) throw new Exception("Falha na segunda inserção");

  $id_funcionario = $pdo->lastInsertId();

  if($sql3 != null){
    $stmt3 = $pdo->prepare($sql3);
    if(!$stmt3->execute([
      $especialidade,
      $crm,
      $id_funcionario
    ])) throw new Exception("Falha na terceira inserção");
  }

  $pdo->commit();

} catch (Exception $e) {
  $pdo->rollBack();
  exit('Rollback executado: ' . $e->getMessage());
}
?>