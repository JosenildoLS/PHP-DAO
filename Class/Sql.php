<?php

class Sql extends PDO {

    private $conn;

    public function __construct() {

        // Caso haja um erro durante a conexão, recuperamos isso usando o try/catch e PDOException
        try {

            $options = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET character_set_connection=UTF8;',
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            $this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "", $options);
        } catch (PDOException $e) {
            exit("Erro: " . $e->getMessage());
        }
    }

    private function setParams($statement, $parameters = array()) {

        foreach ($parameters as $key => $value) {
            $this->setParam($statement, $key, $value);
        }
    }

    private function setParam($statement, $key, $value) {
        $statement->bindParam($key, $value);
    }

    public function query($rawQuery, $params = array()) {
        $stmt = $this->conn->prepare($rawQuery);
        $this->setParams($stmt, $params);

        $stmt->execute();
        return $stmt;
    }

    public function select($rawQuery, $params = array()): array {
        $stmt = $this->query($rawQuery, $params);

        // Retorna um array indexado pelo nome da coluna
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
