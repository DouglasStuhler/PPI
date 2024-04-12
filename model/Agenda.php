<?php
    class Agenda{
        public $id_agenda;
        public $dt_agenda;
        public $hr_agenda;
        public $nome;
        public $sexo;
        public $email;
        public $id_medico;
        public $nm_medico;
        public $especialidade;
        
        function __construct($dt, $hr, $n, $s, $email, $m){
            $this->dt_agenda = $dt;
            $this->hr_agenda = $hr;
            $this->nome = $n;
            $this->sexo = $s;
            $this->email = $email;
            $this->id_medico = $m;
        }

        function setIdAgenda($id){
            $this->id_agenda = $id;
        }

        function setInfoMedico($nm, $especialidade){
            $this->nm_medico = $nm;
            $this->especialidade = $especialidade;
        }

        static function getAgendamentos($pdo){
            try{
                $sql = <<<SQL
                    SELECT 
                        Agenda.id_agenda, Agenda.dt_agenda, Agenda.hr_agenda, Agenda.nome AS nome_paciente, Agenda.sexo, Agenda.email, Agenda.id_medico, PessoaMedico.nome, Medico.especialidade
                    FROM Agenda
                    JOIN Medico ON Medico.id_medico = Agenda.id_medico
                    JOIN Funcionario ON Funcionario.id_funcionario = Medico.id_funcionario
                    JOIN Pessoa PessoaMedico ON PessoaMedico.id_pessoa = Funcionario.id_pessoa
                    WHERE Agenda.dt_agenda >= date('Y-m-d') 
                        AND Agenda.hr_agenda >= date('H:i:s')
                    ORDER BY Agenda.dt_agenda, Agenda.hr_agenda
                SQL;

                $resp = $pdo->query($sql);

                $arrayAgendamento = [];
                while($row = $resp->fetch()){
                    $id_agenda = $row['id_agenda'];
                    $dt_agenda = new DateTime($row['dt_agenda']);
                    $dt_agenda = $dt_agenda->format('d-m-Y');

                    $hr_agenda = $row['hr_agenda'];

                    $nome = htmlspecialchars($row['nome_paciente']);
                    $sexo = htmlspecialchars($row['sexo']);
                    $email = htmlspecialchars($row['email']);
                    $id_medico = htmlspecialchars($row['id_medico']);
                    $nm_medico = htmlspecialchars($row['nome']);
                    $especialidade = htmlspecialchars($row['especialidade']);

                    $agendamento = new Agenda(
                        $dt_agenda,
                        $hr_agenda,
                        $nome,
                        $sexo,
                        $email,
                        $id_medico
                    );

                    $agendamento->setInfoMedico($nm_medico, $especialidade);
                    $agendamento->setIdAgenda($id_agenda);

                    $arrayAgendamento[] = $agendamento;
                }
                return $arrayAgendamento;
            } catch (Exception $e){
                exit('Falha inesperada: '. $e->getMessage());
            }
        }

        function getAgendamentosMedico($pdo, $medico){
            try{
                $sql = <<<SQL
                    SELECT 
                        Agenda.dt_agenda, Agenda.hr_agenda, Agenda.nome, Agenda.sexo, Agenda.email, Agenda.id_medico, PessoaMedico.nome, Medico.especialidade
                    FROM Agenda
                    JOIN Medico ON Medico.id_medico = Agenda.id_medico
                    JOIN Funcionario ON Funcionario.id_funcionario = Medico.id_funcionario
                    JOIN Pessoa PessoaMedico ON PessoaMedico.id_pessoa = Funcionario.id_pessoa
                    WHERE Agenda.dt_agenda >= date('Y-m-d') 
                        AND Agenda.hr_agenda >= date('H:i:s')
                        AND Agenda.id_medico = $medico
                    ORDER BY Agenda.dt_agenda, Agenda.hr_agenda
                SQL;

                $resp = $pdo->query($sql);

                $arrayAgendamento = [];
                while($row = $resp->fetch()){
                    $dt_agenda = new DateTime($row['Agenda']['dt_agenda']);
                    $dt_agenda = $dt_agenda->format('d-m-Y');

                    $hr_agenda = $row['Agenda']['hr_agenda'];

                    $nome = htmlspecialchars($row['Agenda']['nome']);
                    $sexo = htmlspecialchars($row['Agenda']['sexo']);
                    $email = htmlspecialchars($row['Agenda']['email']);
                    $id_medico = htmlspecialchars($row['Agenda']['id_medico']);
                    $nm_medico = htmlspecialchars($row['PessoaMedico']['nome']);
                    $especialidade = htmlspecialchars($row['Medico']['especialidade']);

                    $agendamento = new Agenda(
                        $dt_agenda,
                        $hr_agenda,
                        $nome,
                        $sexo,
                        $email,
                        $id_medico
                    );

                    $agendamento->setInfoMedico($nm_medico, $especialidade);

                    $arrayAgendamento[] = $agendamento;
                }
                return $arrayAgendamento;
            } catch (Exception $e){
                exit('Falha inesperada: '. $e->getMessage());
            }
        }
    }
?>