<?php
    require '../../conexaoBanco.php';
    // require '../../model/Agenda.php';
    require '../../model/Endereco.php';
    // require '../../model/Paciente.php';
    // require '../../model/Funcionario.php';

    $pdo = mysqlConnect();

    $acao = $_GET['acao'];

    switch ($acao){
        case 'listagem_agenda_pessoal':
            break;
        case 'lsitagem_agenda':
            // $dados = Agenda::getAgendamentos($pdo);

            header('Content-type: application/json');
            // echo json_encode($dados);
            break;
        case 'listagem_enderecos':
            break;
        case 'listagem_funcionarios':
            var_dump($pdo);
            // $dados = Funcionario::getFuncionarios($pdo);

            // var_dump($dados);

            header('Content-type: application/json');
            echo json_encode($dados);
            break;
            break;
        case 'listagem_pacientes':
            break;
        default:
            exit('Falha na solicitação de dados!');
            break;
    }
?>