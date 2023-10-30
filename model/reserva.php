<?php
include_once '../conn/conexao.php';

class Reserva {
    private $conn;
    private $table_name = "reservas";

    public $id_reserva;
    public $id_aluno;
    public $id_sala;
    public $data_inicio;
    public $data_fim;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Criar uma nova reserva
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (id_aluno, id_sala, data_inicio, data_fim) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_aluno);
        $stmt->bindParam(2, $this->id_sala);
        $stmt->bindParam(3, $this->data_inicio);
        $stmt->bindParam(4, $this->data_fim);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Ler reservas de um aluno específico
    public function readByAluno() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id_aluno = ? ORDER BY data_inicio DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_aluno);
        $stmt->execute();

        return $stmt;
    }

    // Deletar uma reserva
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_reserva = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_reserva);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Atualizar uma reserva
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET id_aluno = ?, id_sala = ?, data_inicio = ?, data_fim = ? WHERE id_reserva = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_aluno);
        $stmt->bindParam(2, $this->id_sala);
        $stmt->bindParam(3, $this->data_inicio);
        $stmt->bindParam(4, $this->data_fim);
        $stmt->bindParam(5, $this->id_reserva);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Ler todas as reservas
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY data_inicio DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
