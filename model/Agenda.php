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

        static function getAgendamentosMedicoData($pdo, $medico, $d){
            try{
                $sql = <<<SQL
                    SELECT 
                        Agenda.hr_agenda
                    FROM Agenda
                    JOIN Medico ON Medico.id_medico = Agenda.id_medico
                    JOIN Funcionario ON Funcionario.id_funcionario = Medico.id_funcionario
                    JOIN Pessoa PessoaMedico ON PessoaMedico.id_pessoa = Funcionario.id_pessoa
                    WHERE Agenda.dt_agenda = ?
                        AND Agenda.id_medico = ?
                    ORDER BY Agenda.dt_agenda, Agenda.hr_agenda
                SQL;

                $d = new DateTime($d);
                $d = $d->format('Y-m-d');

                $resp = $pdo->prepare($sql);
                $resp->execute([$d, $medico]);

                $arrayAgendamento = [];
                while($row = $resp->fetch()){

                    $hr_agenda = substr($row['hr_agenda'], 0, 5);

                    $arrayAgendamento[] = $hr_agenda;
                }
                return $arrayAgendamento;
            } catch (Exception $e){
                exit('Falha inesperada: '. $e->getMessage());
            }
        }

        static function addAgenda($pdo, $dadosPost){
            try{
                $sql = <<<SQL
                    INSERT INTO Agenda (dt_agenda, hr_agenda, nome, sexo, email, id_medico)
                    VALUES (?, ?, ?, ?, ?, ?)
                SQL;
    
                
                $paciente = htmlspecialchars($dadosPost['nome']);
                $sexo = $dadosPost['sexo'];
                $email = htmlspecialchars($dadosPost['email']);
                $medico = $dadosPost['medico'];
    
                $data = new DateTime($dadosPost['data']);
                $data = $data->format('Y-m-d');
    
                $horario = new DateTime($dadosPost['horario']);
                $horario = $horario->format('H:i:s');
    
                $ins = $pdo->prepare($sql);
                $ins->execute([
                    $data,
                    $horario,
                    $paciente,
                    $sexo,
                    $email,
                    $medico
                ]);

                return true;
            } catch (Exception $e){
                return false;
            }
        }

        static function getAgendamentosMedico($pdo, $medico){
            try{
                $sql = <<<SQL
                    SELECT 
                        Agenda.id_agenda, Agenda.dt_agenda, Agenda.hr_agenda, Agenda.nome AS nome_paciente, Agenda.sexo, Agenda.email, Agenda.id_medico, PessoaMedico.nome, Medico.especialidade
                    FROM Agenda
                    JOIN Medico ON Medico.id_medico = Agenda.id_medico
                    JOIN Funcionario ON Funcionario.id_funcionario = Medico.id_funcionario
                    JOIN Pessoa PessoaMedico ON PessoaMedico.id_pessoa = Funcionario.id_pessoa
                    WHERE ((Agenda.dt_agenda = ? AND Agenda.hr_agenda >= ?)
                        OR (Agenda.dt_agenda > ?))
                        AND PessoaMedico.email = ?
                    ORDER BY Agenda.dt_agenda, Agenda.hr_agenda
                SQL;

                $resp = $pdo->prepare($sql);
                $resp->execute([date('Y-m-d'),date('H:i:s'),date('Y-m-d'),$medico]);

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
    }
?>