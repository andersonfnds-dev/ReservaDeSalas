<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
    public function fazerReserva($num_matricula, $num_sala, $hora_inicio, $hora_fim, $data_reserva)
    {
        // Verificar se o horário está ocupado
        if (!$this->horarioOcupado($num_sala, $hora_inicio, $hora_fim, $data_reserva)) {
            // Horário disponível, fazer a reserva

            // Prepare a consulta para inserir a reserva
            $consulta = $this->conn->prepare("INSERT INTO reservas (num_matricula, num_sala, hora_inicio, hora_fim, data_reserva) VALUES (:num_matricula, :num_sala, :hora_inicio, :hora_fim, :data_reserva)");

            // Bind dos parâmetros
            $consulta->bindParam(':num_matricula', $num_matricula);
            $consulta->bindParam(':num_sala', $num_sala);
            $consulta->bindParam(':hora_inicio', $hora_inicio);
            $consulta->bindParam(':hora_fim', $hora_fim);
            $consulta->bindParam(':data_reserva', $data_reserva);

            // Executar a consulta
            $consulta->execute();

            // Retornar algum indicador de sucesso se necessário
            return true;
        } else {
            // Horário ocupado, retornar indicador de falha ou mensagem
            return false;
        }
    }

    // Função para verificar se o horário está ocupado
    private function horarioOcupado($num_sala, $hora_inicio, $hora_fim, $data_reserva)
    {
        // Consulta para verificar se há reservas que ocupam o mesmo horário
        $consulta = $this->conn->prepare("SELECT COUNT(*) AS total_reservas FROM reservas WHERE num_sala = :num_sala AND data_reserva = :data_reserva AND ((hora_inicio >= :hora_inicio AND hora_inicio < :hora_fim) OR (hora_fim > :hora_inicio AND hora_fim <= :hora_fim))");

        // Bind dos parâmetros
        $consulta->bindParam(':num_sala', $num_sala);
        $consulta->bindParam(':hora_inicio', $hora_inicio);
        $consulta->bindParam(':hora_fim', $hora_fim);
        $consulta->bindParam(':data_reserva', $data_reserva);

        // Executar a consulta
        $consulta->execute();

        // Obter o resultado
        $totalReservas = $consulta->fetch(PDO::FETCH_ASSOC)['total_reservas'];

        // Se houver pelo menos uma reserva, o horário está ocupado
        return $totalReservas > 0;
    }

    // Ler reservas de um aluno específico
    public function readByAlunoReservas($num_matricula)
    {
    
        $query = "SELECT * FROM " . $this->table_name . " WHERE num_matricula = ? ORDER BY data_reserva DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $num_matricula);
        $stmt->execute();

        
        if ($stmt->rowCount() > 0) {
            return $stmt;
        } else {
            return "Nenhuma reserva encontrada para a matrícula indicada.";
        }
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

    public function consultarHorariosDisponiveis($data_reserva, $num_sala)
    {

        // Prepare a consulta para obter as reservas para a data dada
        $consulta = $this->conn->prepare("SELECT COUNT(*) AS total_reservas FROM reservas WHERE num_sala = :num_sala AND data_reserva = :data_reserva");
        $consulta->bindParam(':num_sala', $num_sala);
        $consulta->bindParam(':data_reserva', $data_reserva);
        $consulta->execute();

        $totalReservas = $consulta->fetch(PDO::FETCH_ASSOC)['total_reservas'];

        $horarios_disponiveis = [];
        $hora_atual = strtotime('08:00');
        $hora_final = strtotime('22:00');

        if ($totalReservas > 0) {
            // Há reservas, então verificamos os horários ocupados

            // Continue com a lógica atual para obter os horários ocupados
            $consulta = $this->conn->prepare("SELECT hora_inicio, hora_fim FROM reservas WHERE num_sala = :num_sala AND data_reserva = :data_reserva");
            $consulta->bindParam(':num_sala', $num_sala);
            $consulta->bindParam(':data_reserva', $data_reserva);
            $consulta->execute();

            // Obtenha os horários ocupados
            $horarios_ocupados = [];
            while ($reserva = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $horarios_ocupados[] = [
                    'hora_inicio' => $reserva['hora_inicio'],
                    'hora_fim' => $reserva['hora_fim']
                ];
            }

            // Gere os horários disponíveis excluindo os horários ocupados
            while ($hora_atual < $hora_final) {
                $hora_inicio = date('H:i', $hora_atual);
                $hora_fim = date('H:i', $hora_atual + 60 * 60); // Adiciona uma hora

                // Verifica se o horário está ocupado
                $ocupado = false;
                foreach ($horarios_ocupados as $horario_ocupado) {
                    // Verifica se o horário de início ou o horário de fim da reserva estão dentro do intervalo
                    if (
                        ($hora_inicio >= $horario_ocupado['hora_inicio'] && $hora_inicio < $horario_ocupado['hora_fim']) ||
                        ($hora_fim > $horario_ocupado['hora_inicio'] && $hora_fim <= $horario_ocupado['hora_fim'])
                    ) {
                        $ocupado = true;
                        break;
                    }
                }

                // Se não estiver ocupado e não ultrapassar as 22:00, adiciona aos horários disponíveis
                if (!$ocupado && $hora_atual < strtotime('22:00')) {
                    $horarios_disponiveis[] = [
                        'hora_inicio' => $hora_inicio,
                        'hora_fim' => $hora_fim
                    ];
                }

                // Avança para a próxima hora
                $hora_atual += 60 * 60;
            }
        } else {
            // Gere os horários disponíveis excluindo os horários ocupados
            while ($hora_atual <= $hora_final) {
                $hora_inicio = date('H:i', $hora_atual);
                $hora_fim = date('H:i', $hora_atual + 60 * 60); // Adiciona uma hora

                // Se não ultrapassar as 22:00, adiciona aos horários disponíveis
                if ($hora_atual <= strtotime('22:00')) {
                    $horarios_disponiveis[] = [
                        'hora_inicio' => $hora_inicio,
                        'hora_fim' => $hora_fim
                    ];
                }

                $hora_atual += 60 * 60;
            }
        }

        $htmlOptions = '';
        foreach ($horarios_disponiveis as $horario) {
            $htmlOptions .= '<option value="' . $horario['hora_inicio'] . '">' . $horario['hora_inicio'] . ' - ' . $horario['hora_fim'] . '</option>';
        }

        echo $htmlOptions;
        exit;
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
