<?php
include_once 'database.php';

class Sala {
    private $conn;
    private $table_name = "Salas";

    public $id_sala;
    public $nome; // Se você quiser adicionar nomes ou descrições às salas

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getSalas() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // ... Outros métodos relacionados a salas conforme necessário ...
}
