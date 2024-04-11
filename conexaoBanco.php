<?php

function mysqlConnect()
{
  $db_host = "sql305.infinityfree.com";
  $db_username = "if0_36125968";
  $db_password = "TrabalhoPPI2024";
  $db_name = "if0_36125968_vitalize";

  $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ];

  try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_username, $db_password, $options);
    return $pdo;
  } 
  catch (Exception $e) {
    exit('Ocorreu uma falha na conexão com o MySQL: ' . $e->getMessage());
  }
}
?>
