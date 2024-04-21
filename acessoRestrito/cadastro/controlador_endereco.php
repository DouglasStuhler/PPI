<?php
  require '../../model/Endereco.php';
  require '../../conexaoBanco.php';

  $pdo = mysqlConnect();
  $acao = $_GET['acao'] ?? '';

  if($acao == 'getEndereco'){
    $cep = $_GET['cep'] ?? '';
    $dados = Endereco::getCEP($pdo, $cep);

    header('Content-type: application/json');
    echo json_encode($dados);
  }
?>