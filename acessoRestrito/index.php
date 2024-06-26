<?php

session_start();

$email = $_SESSION['user'] ?? "";

if(trim($email) == "")
    header("location: ../../login.html");

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalize</title>

    <!-- Links CSS -->
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header>
        <img src="../images/logomarca.png" alt="Logomarca da Vitalize">
    </header>
    <nav>
        <ul>
            <li><a href="../">Home</a></li>
            <li class="flexPeso"><a href="../acessoRestrito/index.html">Início Adminsitrativo</a></li>
            <li><a href="cadastro">Cadastro</a></li>
            <li><a href="listas">Listagem</a></li>
        </ul>
    </nav>
    <main>
        <h1>Bem Vindo ao Sistema Administrativo da Vitalize</h1>
    </main>
    <footer>
        <p>&copy; Todos os direitos são reservados à Vitalize.</p>
    </footer>
</body>
</html>