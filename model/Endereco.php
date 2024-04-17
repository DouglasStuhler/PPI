<?php
    class Endereco{
        public $CEP;
        public $logradouro;
        public $cidade;
        public $estado;

        function __construct($CEP, $logradouro, $cidade, $estado){
            $this->CEP = $CEP;
            $this->logradouro = $logradouro;
            $this->cidade = $cidade;
            $this->estado = $estado;
        }

        static function getCEPs($pdo){
            try{
                $sql = <<<SQL
                    SELECT CEP, logradouro, cidade, estado
                    FROM Enderecos
                    ORDER BY CEP
                SQL;

                $resp = $pdo->query($sql);

                $arrayCEPs = [];

                while($row = $resp->fetch()){
                    $CEP = htmlspecialchars($row['CEP']);
                    $logradouro = htmlspecialchars($row['logradouro']);
                    $cidade = htmlspecialchars($row['cidade']);
                    $estado = htmlspecialchars($row['estado']);

                    $endereco = new Endereco(
                        $CEP,
                        $logradouro,
                        $cidade,
                        $estado
                    );

                    array_push($arrayCEPs, $endereco);
                }
                return $arrayCEPs;
            } catch (Exception $e){
                exit('Falha inexperada: ' . $e->getMessage());
            }
        }
    }
?>