<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitalize</title>

    <!-- Links CSS -->
    <link rel="stylesheet" href="css/index.css">

    <!-- Link boostratp -->
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
            <li><a href="../cadastro">Cadastro</a></li>
            <li><a href="#">Listagem</a></li>
        </ul>
    </nav>
    <main>
        <h1>Opções de Lista</h1>
        <div id="buttons">
            <div class="row">
                <div class="col-12 col-md-3 divBtn">
                    <a class="btn" href="listagem_funcionarios.php">Lista de Funcionários</a>
                </div>
                <div class="col-12 col-md-9 divDesc">
                    <p>Consulte a lista de funcionários cadastrados</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3 divBtn">
                    <a class="btn" href="listagem_pacientes.php">Lista de Pacientes</a>
                </div>
                <div class="col-12 col-md-9 divDesc">
                    <p>Consulte a lista de pacientes cadastrados</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3 divBtn">
                    <a class="btn" href="listagem_enderecos.php">Lista de Endereços</a>
                </div>
                <div class="col-12 col-md-9 divDesc">
                    <p>Consulte a lista de endereços cadastrados</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3 divBtn">
                    <a class="btn" href="listagem_agenda.php">Lista de Consultas</a>
                </div>
                <div class="col-12 col-md-9 divDesc">
                    <p>Consulte a lista de agendamentos</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-3 divBtn">
                    <a class="btn" href="listagem_agenda_pessoal.php">Minhas Consultas</a>
                </div>
                <div class="col-12 col-md-9 divDesc">
                    <p>Consulte sua agenda de consultas</p>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; Todos os direitos são reservados à Vitalize.</p>
    </footer>
</body>
</html>