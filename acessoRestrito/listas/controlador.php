<?php
    require '../../conexaoBanco.php';
    require '../../model/Agenda.php';
    require '../../model/Endereco.php';
    require '../../model/Paciente.php';
    require '../../model/Funcionario.php';

    $pdo = mysqlConnect();

    $acao = $_GET['acao'];

    switch ($acao){
        case 'listagem_agenda_pessoal':
            break;
        case 'listagem_agenda':
            $dados = Agenda::getAgendamentos($pdo);

            header('Content-type: application/json');
            echo json_encode($dados);
            break;
        case 'listagem_enderecos':
            $dados = Endereco::getCEPs($pdo);

            header('Content-type: application/json');
            echo json_encode($dados);
            break;
        case 'listagem_funcionarios':
            $dados = Funcionario::getFuncionarios($pdo);

            header('Content-type: application/json');
            echo json_encode($dados);
            break;
        case 'listagem_pacientes':
            $dados = Paciente::getPacientes($pdo);

            header('Content-type: application/json');
            echo json_encode($dados);
            break;
        default:
            exit('Falha na solicitação de dados!');
            break;
    }
?>