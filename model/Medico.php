<?php
    class Medico{
        public $id_medico;
        public $nome;
        public $especialidade;
        public $crm;
        
        function __construct($n, $e, $c){
            $this->nome = $n;
            $this->especialidade = $e;
            $this->crm = $c;
        }

        function setIdMedico($id){
            $this->id_medico = $id;
        }

        static function getEspecialidades($pdo){
            try{
                $sql = <<<SQL
                    SELECT 
                        DISTINCT(especialidade)
                    FROM Medico
                    ORDER BY especialidade
                SQL;

                $resp = $pdo->query($sql);

                $retornoEspecialidades = [];
                while ($row = $resp->fetch()){
                    $especialidade = htmlspecialchars($row['especialidade']);

                    $retornoEspecialidades[] = $especialidade;
                }

                return $retornoEspecialidades;
            } catch (Exception $e){
                exit('Falha inesperada: '. $e->getMessage());
            }
        }

        static function getMedicosEspecialidade($pdo, $e){
            try{
                $sql = <<<SQL
                    SELECT 
                        Medico.id_medico, Pessoa.nome, Medico.especialidade, Medico.crm
                    FROM Medico
                    INNER JOIN Funcionario
                        ON Funcionario.id_funcionario = Medico.id_funcionario
                    INNER JOIN Pessoa
                        ON Pessoa.id_pessoa = Funcionario.id_pessoa
                    WHERE Medico.especialidade = ?
                    ORDER BY especialidade
                SQL;

                $resp = $pdo->prepare($sql);
                $resp->execute([$e]);

                $retornoMedicos = [];
                while ($row = $resp->fetch()){
                    $id_medico = $row['id_medico'];
                    $nome = htmlspecialchars($row['nome']);
                    $especialidade = htmlspecialchars($row['especialidade']);
                    $crm = htmlspecialchars($row['crm']);

                    $medico = new Medico(
                        $nome,
                        $especialidade,
                        $crm
                    );

                    $medico->setIdMedico($id_medico);

                    $retornoMedicos[] = $medico;
                }

                return $retornoMedicos;
            } catch (Exception $e){
                exit('Falha inesperada: '. $e->getMessage());
            }
        }
    }
?>