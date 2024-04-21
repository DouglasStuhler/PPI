<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalize</title>

    <!-- Links CSS -->
    <link rel="stylesheet" href="css/index.css">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header>
        <img src="../../images/logomarca.png" alt="Logomarca da Vitalize">
    </header>
    <nav>
        <ul>
            <li><a href="../../">Home</a></li>
            <li class="flexPeso"><a href="../">Início Adminsitrativo</a></li>
            <li><a href="index.html">Cadastro</a></li>
            <li><a href="../listas">Listagem</a></li>
        </ul>
    </nav>
    <main>
        <h1>Opções de Cadastro</h1>
        <div id="buttons">
            <div class="row">
                <div class="col-12 col-md-3 divBtn">
                    <a class="btn" href="cadastro_funcionario.php">Cadastro de Funcionários</a>
                </div>
                <div class="col-12 col-md-9 divDesc">
                    <p>Clique no botão para efetuar o cadastramento de algum funcionário em nosso sistema.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3 divBtn">
                    <a class="btn" href="cadastro_paciente.php">Cadastro de Pacientes</a>
                </div>
                <div class="col-12 col-md-9 divDesc">
                    <p>Clique no botão para efetuar o cadastramento de algum paciente em nosso sistema.</p>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; Todos os direitos são reservados à Vitalize.</p>
    </footer>
</body>
</html>