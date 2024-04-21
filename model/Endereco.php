<?php
class Endereco
{
    public $CEP;
    public $logradouro;
    public $cidade;
    public $estado;

    function __construct($CEP, $logradouro, $cidade, $estado)
    {
        $this->CEP = $CEP;
        $this->logradouro = $logradouro;
        $this->cidade = $cidade;
        $this->estado = $estado;
    }

    static function getCEP($pdo, $CEP){
        try{
            $sql = <<<SQL
                SELECT logradouro, cidade, estado
                FROM Enderecos
                where CEP = :cep
                LIMIT 1
                SQL;

            $resp = $stmt->prepare($sql);
            $stmt->bindParam(':cep', $CEP);
            $stmt->execute();

            // Retorna o resultado da consulta
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            exit('Falha inesperada: ' . $e->getMessage());
        }
    }

    static function getCEPs($pdo)
    {
        try {
            $sql = <<<SQL
                    SELECT CEP, logradouro, cidade, estado
                    FROM Enderecos
                    ORDER BY CEP
                SQL;

            $resp = $pdo->query($sql);

            $arrayCEPs = [];

            while ($row = $resp->fetch()) {
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
        } catch (Exception $e) {
            exit('Falha inexperada: ' . $e->getMessage());
        }
    }
    public function insertEndereco($pdo)
    {
        try {
            $sql = <<<SQL
                    INSERT INTO Enderecos (CEP, logradouro, cidade, estado)
                    VALUES (?, ?, ?, ?)
                    SQL;

            $stmt = $pdo->prepare($sql);
            $stmt->execute([ $this->CEP, $this->logradouro, $this->cidade, $this->estado ]);

            return true;
        } catch (Exception $e) {
            exit('Falha inesperada: ' . $e->getMessage());
        }
    }
}
