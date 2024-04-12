<?php
    class Paciente{
        public $nome;
        public $sexo;
        public $email;
        public $telefone;
        public $CEP;
        public $logradouro;
        public $cidade;
        public $estado;
        // Atributos de Paciente
        public $peso;
        public $altura;
        public $tp_sangue;
        public $id_pessoa;

        function __construct($peso, $altura, $tp_sangue, $id_pessoa){
            $this->peso = $peso;
            $this->altura = $altura;
            $this->tp_sangue = $tp_sangue;
            $this->id_pessoa = $id_pessoa;
        }

        function setInfoPessoa($nome, $sexo, $email, $telefone, $CEP, $logradouro, $cidade, $estado){
            $this->nome = $nome;
            $this->sexo = $sexo;
            $this->email = $email;
            $this->telefone = $telefone;
            $this->CEP = $CEP;
            $this->logradouro = $logradouro;
            $this->cidade = $cidade;
            $this->estado = $estado;
        }

        static function getPacientes($pdo){
            try{
                $sql = <<<SQL
                    SELECT Pessoa.nome, Pessoa.sexo, Pessoa.email, Pessoa.telefone, Pessoa.CEP, Pessoa.logradouro, Pessoa.cidade, Pessoa.estado, Paciente.peso, Paciente.altura, Paciente.tp_sangue, Paciente.id_pessoa
                    FROM Paciente
                    JOIN Pessoa ON Pessoa.id_pessoa = Paciente.id_pessoa
                    ORDER BY Pessoa.nome
                SQL;

                $resp = $pdo->query($sql);

                $arrayPacientes = [];

                while($row = $resp->fetch()){
                    $nome = htmlspecialchars($row['nome']);
                    $sexo = htmlspecialchars($row['sexo']);
                    $email = htmlspecialchars($row['email']);
                    $telefone = htmlspecialchars($row['telefone']);
                    $CEP = htmlspecialchars($row['CEP']);
                    $logradouro = htmlspecialchars($row['logradouro']);
                    $cidade = htmlspecialchars($row['cidade']);
                    $estado = htmlspecialchars($row['estado']);
                    
                    $peso = $row['peso'];
                    $altura = $row['altura'];
                    $tp_sangue = htmlspecialchars($row['tp_sangue']);
                    $id_pessoa = $row['id_pessoa'];

                    $paciente = new Paciente(
                        $peso,
                        $altura,
                        $tp_sangue, 
                        $id_pessoa
                    );

                    $paciente->setInfoPessoa($nome, $sexo, $email, $telefone, $CEP, $logradouro, $cidade, $estado);

                    $arrayPacientes[] = $paciente;
                }
                return $arrayPacientes;
            } catch (Exception $e){
                exit('Falha inexperada: ' . $e->getMessage());
            }
        }
    }
?>