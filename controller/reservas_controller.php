<?php
include_once 'model/Reserva.php';

class ReservaController {
    
    private $model;

    public function __construct() {
        $this->model = new Reserva();
    }

    // Método para fazer uma reserva
    public function fazerReserva($num_sala, $num_matricula, $hora_inicio, $hora_fim, $data_reserva) {
        
        // Verificar a disponibilidade da sala primeiro
        if ($this->model->isSalaDisponivel($num_sala, $hora_inicio, $hora_fim)) {
            
            // Se a sala estiver disponível, proceder com a reserva
            $sucesso = $this->model->create($num_sala, $num_matricula, $hora_inicio, $hora_fim, $data_reserva);
            
            if ($sucesso) {
                // Reserva efetuada com sucesso
                $status_sala = "Ocu";
            
        } else {
            // Sala não está disponível para o horário desejado
            header('Location: reservar_sala.php?status=unavailable');
        }
    }
}

    // Método para listar reservas de um aluno específico
    public function listarReservas($num_matricula) {
        return $this->model->readByAluno($num_matricula);
    }

    // Método para cancelar uma reserva
    public function cancelarReserva($id_reserva) {
        $sucesso = $this->model->delete($id_reserva);
        
        if ($sucesso) {
            header('Location: minhas_reservas.php?status=cancel_success');
        } else {
            header('Location: minhas_reservas.php?status=cancel_error');
        }
    }

    // ... Outros métodos conforme necessário ...

}
?>

    

