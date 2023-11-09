<?php
include_once '../conn/conexao.php';

class Reserva {
    private $conn;
    private $table_name = "reservas";

    public $id_reserva;
    public $num_matricula;
    public $num_sala;
    public $hora_inicio;
    public $hora_fim;
    public $data_reserva;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Criar uma nova reserva
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (num_matricula, num_sala, hora_inicio, hora_fim, data_reserva) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->num_matricula);
        $stmt->bindParam(2, $this->num_sala);
        $stmt->bindParam(3, $this->hora_inicio);
        $stmt->bindParam(4, $this->hora_fim);
        $stmt->bindParam(5, $this->data_reserva);


        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Ler reservas de um aluno específico
    public function readByAluno() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE num_matricula = ? ORDER BY hora_inicio DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->num_matricula);
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
        $query = "UPDATE " . $this->table_name . " SET num_matricula = ?, num_sala = ?, hora_inicio = ?, hora_fim = ?, data_reserva = ? WHERE id_reserva = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->num_matricula);
        $stmt->bindParam(2, $this->num_sala);
        $stmt->bindParam(3, $this->hora_inicio);
        $stmt->bindParam(4, $this->hora_fim);
        $stmt->bindParam(5, $this->id_reserva);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Ler todas as reservas
    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY hora_inicio DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
?>
