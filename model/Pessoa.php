<?php
    class Pessoa{
        public $id_pessoa;
        public $nome;
        public $sexo;
        public $email;
        public $telefone;
        public $CEP;
        public $logradouro;
        public $cidade;
        public $estado;
        
        function __construct($n, $s, $email, $t, $cep, $l, $c, $e){
            $this->nome = $n;
            $this->sexo = $s;
            $this->email = $email;
            $this->telefone = $t;
            $this->CEP = $cep;
            $this->logradouro = $l;
            $this->cidade = $c;
            $this->estado = $e;
        }

        function getPessoas($pdo){
            try{
                $sql = <<<SQL
                    SELECT 
                        nome, sexo, email, telefone, CEP, logradouro, cidade, estado
                    FROM Pessoa
                    ORDER BY nome
                SQL;

                $resp = $pdo->query($sql);

                $retornoPessoas = [];
                while ($row = $resp->fetch()){
                    $nome = htmlspecialchars($row['nome']);
                    $sexo = htmlspecialchars($row['sexo']);
                    $email = htmlspecialchars($row['email']);
                    $telefone = htmlspecialchars($row['telefone']);
                    $CEP = htmlspecialchars($row['CEP']);
                    $logradouro = htmlspecialchars($row['logradouro']);
                    $cidade = htmlspecialchars($row['cidade']);
                    $estado = htmlspecialchars($row['estado']);

                    $pessoa = new Pessoa(
                        $nome,
                        $sexo,
                        $email,
                        $telefone,
                        $CEP,
                        $logradouro,
                        $cidade,
                        $estado
                    );

                    $retornoPessoas[] = $pessoa;
                }

                return $retornoPessoas;
            } catch (Exception $e){
                exit('Falha inesperada: '. $e->getMessage());
            }
        }
    }
?>