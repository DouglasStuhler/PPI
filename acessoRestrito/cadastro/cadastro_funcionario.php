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
    <link rel="stylesheet" href="css/cadastro.css">

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
        <h1>Cadastro de Funcionário</h1>
        <form id="formCad" action="controlador_func.php" method="POST">
            <fieldset>
                <legend>Dados Pessoais</legend>
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" id="nome" class="form-control" required>
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="sexo">Sexo</label>
                        <select name="sexo" id="sexo" class="form-control" required>
                            <option value="">Selecione uma opção</option>
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="N">Prefiro não informar</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-4">
                        <label for="data">Início do Contrato</label>
                        <input type="date" name="inicioContrato" id="data" class="form-control" required>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="salario">Salário</label>
                        <input type="number" name="salario" id="salario" class="form-control" step=".01" required>
                    </div>
                    <div class="form-group col-12 col-md-4">
                        <label for="senha">Senha</label>
                        <input type="text" name="senha" id="senha" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-4">
                        <label for="vinculo">Vínculo</label>
                        <select name="vinculo" id="vinculo" class="form-control" required>
                            <option value="">Selecione uma opção</option>
                            <option value="M">Médico</option>
                            <option value="O">Outro</option>
                        </select>
                    </div>
                    <div class="form-group col-12 col-md-4 medico">
                        <label for="crm">CRM</label>
                        <input type="text" class="form-control" name="crm" id="crm">
                    </div>
                    <div class="form-group col-12 col-md-4 medico">
                        <label for="espec">Especialidade</label>
                        <input type="text" class="form-control" name="espec" id="espec">
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Contato</legend>
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="tel">Telefone</label>
                        <input type="tel" name="telefone" id="tel" class="form-control" placeholder="34 99999-9999" pattern="[0-9]{2} [0-9]{5}-[0-9]{4}" required>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>Endereço</legend>
                <div class="row">
                    <div class="form-group col-12 col-md-4">
                        <label for="cep">CEP</label>
                        <input type="text" name="cep" id="cep" class="form-control" placeholder="99999-999" pattern="[0-9]{5}-[0-9]{3}" required>
                    </div>
                    <div class="form-group col-12 col-md-8">
                        <label for="logra">Logradouro</label>
                        <input type="text" name="logradouro" id="logra" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12 col-md-6">
                        <label for="cidade">Cidade</label>
                        <input type="text" name="cidade" id="cidade" class="form-control" required>
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="estado">Estado</label>
                        <input type="text" name="estado" id="estado" class="form-control" required>
                    </div>
                </div>
            </fieldset>
            <div class="row">
                <div class="col-12 center">
                    <button class="btn btn-success btn-lg">Cadastrar</button>
                </div>
            </div>
        </form>
    </main>
    <footer>
        <p>&copy; Todos os direitos são reservados à Vitalize.</p>
    </footer>
    <script src="../../js/busca_endereco.js"></script>
    <script>
        // Interação Médico
        const vinc = document.querySelector('#vinculo');

        vinc.onchange = (e) => {

            let els = document.querySelectorAll('.medico');

            if(vinc.value == 'M'){    
                for(i = 0; i < els.length; i++){
                    els[i].style.display = 'block';
                    els[i].querySelector('.form-control').setAttribute('required', true);
                }
            } else {
                for(i = 0; i < els.length; i++){
                    els[i].style.display = 'none';
                    els[i].querySelector('.form-control').setAttribute('required', false);
                }
            }
        }

        // Envio Formulário
        const form = document.querySelector('#formCad');

        form.onsubmit = (e) => {
            e.preventDefault();

            alert('Funcionário cadastrado com sucesso!');
            window.location.assign('../');
        }
    </script>
</body>
</html>