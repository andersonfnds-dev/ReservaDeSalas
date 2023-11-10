<?php
include_once '../conn/conexao.php';

class Reserva
{
    private $conn;
    private $table_name = "reservas";

    public $id_reserva;
    public $num_matricula;
    public $num_sala;
    public $hora_inicio;
    public $hora_fim;
    public $data_reserva;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Criar uma nova reserva
    public function createReserva()
    {
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
    public function readByAlunoReservas()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE num_matricula = ? ORDER BY hora_inicio DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->num_matricula);
        $stmt->execute();

        return $stmt;
    }

    // Deletar uma reserva
    public function deleteReserva()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id_reserva = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id_reserva);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Atualizar uma reserva
    public function update()
    {
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

    public function consultarHorariosDisponiveis($data_reserva)
    {

        $conn = $this->conn;

        // Prepare a consulta para obter as reservas para a data dada
        $consulta = $this->$conn->prepare("SELECT hora_inicio, hora_fim FROM reservas WHERE data_reserva = :data_reserva");
        $consulta->bindParam(':data_reserva', $data_reserva);
        $consulta->execute();
        if (!$consulta->execute()) {
            die(print_r($consulta->errorInfo(), true)); // Isso exibirá informações de erro
        }

        // Obtenha os horários ocupados
        $horarios_ocupados = [];
        while ($reserva = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $horarios_ocupados[] = [
                'hora_inicio' => $reserva['hora_inicio'],
                'hora_fim' => $reserva['hora_fim']
            ];
        }

        // Defina o intervalo de horários disponíveis (assumindo, por exemplo, que vai de 8:00 às 22:00)
        $horarios_disponiveis = [];
        $hora_atual = strtotime('08:00');
        $hora_final = strtotime('22:00');

        // Gere os horários disponíveis excluindo os horários ocupados
        while ($hora_atual <= $hora_final) {
            $hora_inicio = date('H:i', $hora_atual);
            $hora_fim = date('H:i', $hora_atual + 60 * 60); // Adiciona uma hora

            // Verifica se o horário está ocupado
            $ocupado = false;
            foreach ($horarios_ocupados as $horario_ocupado) {
                if ($hora_inicio >= $horario_ocupado['hora_inicio'] && $hora_inicio < $horario_ocupado['hora_fim']) {
                    $ocupado = true;
                    break;
                }
            }

            // Se não estiver ocupado, adiciona aos horários disponíveis
            if (!$ocupado) {
                $horarios_disponiveis[] = [
                    'hora_inicio' => $hora_inicio,
                    'hora_fim' => $hora_fim
                ];
            }

            // Avança para a próxima hora
            $hora_atual += 60 * 60;
        }

        return json_encode($horarios_disponiveis);
    }

    // Ler todas as reservas
    public function readAll()
    {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY hora_inicio DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
}
