<?php
    require 'model/Agenda.php';
    require 'model/Medico.php';
    require 'conexaoBanco.php';

    $pdo = mysqlConnect();

    $acao = $_GET['acao'] ?? '';

    switch($acao){
        case 'getEspecialidadeMedicos':
            $dados = Medico::getEspecialidades($pdo);

            header('Content-type: application/json');
            echo json_encode($dados);
            break;
        case 'getMedicosEspecialidade':
            $e = $_GET['param'] ?? '';
            $dados = Medico::getMedicosEspecialidade($pdo, $e);

            header('Content-type: application/json');
            echo json_encode($dados);
            break;
        case 'getHorarios':
            $m = $_GET['medico'] ?? '';
            $d = $_GET['data'] ?? '';

            $dados = Agenda::getAgendamentosMedicoData($pdo, $m, $d);

            header('Contetn-type: application/json');
            echo json_encode($dados);
            break;
    }

    $dadosPost = $_POST ?? '';


    if($dadosPost != '' && !empty($dadosPost)){
        $agendamento = Agenda::addAgenda($pdo, $dadosPost);

        header('Contetn-type: application/json');
        echo json_encode($agendamento);
        die;
    }
?>