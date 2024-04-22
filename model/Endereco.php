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

            $check_sql = <<<SQL
                            SELECT COUNT(*) 
                            FROM Enderecos 
                            WHERE CEP = ?
                            SQL;

            $check_stmt = $pdo->prepare($check_sql);
            $check_stmt->execute([$this->CEP]);
            $count = $check_stmt->fetchColumn();

            if ($count > 0) {
                // Se o CEP já existir
                return 1;
            }

            $sql = <<<SQL
                    INSERT INTO Enderecos (CEP, logradouro, cidade, estado)
                    VALUES (?, ?, ?, ?)
                    SQL;

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$this->CEP, $this->logradouro, $this->cidade, $this->estado]);

            return 0;
        } catch (Exception $e) {
            exit('Falha inesperada: ' . $e->getMessage());
        }
    }
}
