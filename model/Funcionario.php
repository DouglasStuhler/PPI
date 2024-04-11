<?php
    class Funcionario{
        public $nome;
        public $sexo;
        public $email;
        public $telefone;
        public $CEP;
        public $logradouro;
        public $cidade;
        public $estado;
        // Atributos de Funcionario
        public $dt_contrato;
        public $salario;
        public $senha;
        public $id_pessoa;
        public $id_funcionario;
        // Atributos de Médico
        public $crm;
        public $especialidade;

        function __construct($dt_contrato, $salario, $id_pessoa){
            $this->dt_contrato = $dt_contrato;
            $this->salario = $salario;
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

        function setIdFuncionario($id){
            $this->id_funcionario = $id;
        }

        function setInfoMedico($crm, $especialidade){
            $this->crm = $crm;
            $this->especialidade = $especialidade;
        }

        function getFuncionarios($pdo){
            try{
                $sql = <<<SQL
                    SELECT Pessoa.nome, Pessoa.sexo, Pessoa.email, Pessoa.telefone, Pessoa.CEP, Pessoa.logradouro, Pessoa.cidade, Pessoa.estado, Funcionario.dt_contrato, Funcionario.salario, Funcionario.id_pessoa, Funcionario.id_funcionario, Medico.crm, Medico.especialidade
                    FROM Funcionario
                    JOIN Pessoa ON Pessoa.id_pessoa = Funcionario.id_pessoa
                    LEFT JOIN Medico ON Medico.id_funcionario = Funcionario.id_funcionario
                    ORDER BY Pessoa.nome
                SQL;

                $resp = $pdo->query($sql);

                $arrayFuncionarios = [];

                while($row = $resp->fetch()){
                    $nome = htmlspecialchars($row['nome']);
                    $sexo = htmlspecialchars($row['sexo']);
                    $email = htmlspecialchars($row['email']);
                    $telefone = htmlspecialchars($row['telefone']);
                    $CEP = htmlspecialchars($row['CEP']);
                    $logradouro = htmlspecialchars($row['logradouro']);
                    $cidade = htmlspecialchars($row['cidade']);
                    $estado = htmlspecialchars($row['estado']);
                    
                    $dt_contrato = new DateTime($row['dt_contrato']);
                    $dt_contrato = $dt_contrato->format('d-m-Y');
                    $salario = $row['salario'];
                    $id_pessoa = $row['id_pessoa'];
                    $id_funcionario = $row['id_funcionario'];

                    $crm = htmlspecialchars($row['crm']);
                    $especialidade = htmlspecialchars($row['especialidade']);

                    $funcionario = new Funcionario(
                        $dt_contrato,
                        $salario,
                        $id_pessoa
                    );

                    $funcionario->setInfoPessoa($nome, $sexo, $email, $telefone, $CEP, $logradouro, $cidade, $estado);
                    $funcionario->setIdFuncionario($id_funcionario);
                    $funcionario->setInfoMedico($crm, $especialidade);

                    $arrayFuncionarios[] = $funcionario;
                }
                return $arrayFuncionarios;
            } catch (Exception $e){
                exit('Falha inexperada: ' . $e->getMessage());
            }
        }
    }
?>