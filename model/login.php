<?php

require "../conexaoBanco.php";

class RequestResponse
{
  public $success;
  public $detail;

  function __construct($success, $detail)
  {
    $this->success = $success;
    $this->detail = $detail;
  }
}

function checkLogin($pdo, $email, $senha)
{
  $sql = <<<SQL
    SELECT senhaHash
    FROM Pessoa
    INNER JOIN Funcionario
    ON Pessoa.id_pessoa = Funcionario.id_pessoa
    WHERE email = ?
    SQL;

  try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $senhaHash = $stmt->fetchColumn();

    if (!$senhaHash)
      return false; // a consulta não retornou nenhum resultado (email não encontrado)

    if (!(md5($senha) == $senhaHash))
      return false; // senha incorreta

    // email e senha corretos
    return true;
  } catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

$user = $_POST["user"] ?? "";
$senha = $_POST["senha"] ?? "";

$pdo = mysqlConnect();
if (checkLogin($pdo, $user, $senha)) { // verifica o retorno da função 
  $cookieParams = session_get_cookie_params();
  $cookieParams['httponly'] = true;
  session_set_cookie_params($cookieParams);

  // cria uma nova sessão para o usuário
  session_start();
  $_SESSION['loggedIn'] = true;
  $_SESSION['user'] = $user;
  $response = new RequestResponse(true, 'acessorestrito');
} else
  $response = new RequestResponse(false, '');

echo json_encode($response);
