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
    <link rel="stylesheet" href="css/lista.css">

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
            <li><a href="../cadastro">Cadastro</a></li>
            <li><a href="../listas">Listagem</a></li>
        </ul>
    </nav>
    <main>
        <h1>Lista de Endereços</h1>
        <div class="table-responsive">
            <table id="tabela" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th class="dt-center">CEP</th>
                        <th class="dt-center">Logradouro</th>
                        <th class="dt-center">Cidade</th>
                        <th class="dt-center">Estado</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
    </main>
    <footer>
        <p>&copy; Todos os direitos são reservados à Vitalize.</p>
    </footer>

    <script>
        let xhr = new XMLHttpRequest();
        xhr.open('GET', 'controlador.php?acao=listagem_enderecos');
        xhr.responseType = 'json';

        xhr.onload = function(){
            if (xhr.status != 200 || xhr.response === null) {
                console.log("A resposta não pode ser obtida ");
                console.log(xhr.status);
                return;
            }

            const dados = xhr.response;

            const tabela = document.querySelector('#tabela tbody');
    
            let text = '';
            
            for(i = 0; i < dados.length; i++){
                text += '<td class="dt-center">'+dados[i].CEP+'</td>'
                text += '<td class="dt-center">'+dados[i].logradouro+'</td>'
                text += '<td class="dt-center">'+dados[i].cidade+'</td>'
                text += '<td class="dt-center">'+dados[i].estado+'</td>'

                let el = document.createElement('tr');

                el.innerHTML = text;

                tabela.appendChild(el);
            }

        }
        xhr.send();
    </script>
</body>
</html>