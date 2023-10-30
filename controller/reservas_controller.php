<?php
include_once 'model/Reserva.php';

class ReservaController {
    
    private $model;

    public function __construct() {
        $this->model = new Reserva();
    }

    // Método para fazer uma reserva
    public function fazerReserva($id_sala, $id_aluno, $data_inicio, $data_fim) {
        
        // Verificar a disponibilidade da sala primeiro
        if ($this->model->isSalaDisponivel($id_sala, $data_inicio, $data_fim)) {
            
            // Se a sala estiver disponível, proceder com a reserva
            $sucesso = $this->model->create($id_sala, $id_aluno, $data_inicio, $data_fim);
            
            if ($sucesso) {
                // Reserva efetuada com sucesso
                header('Location: minhas_reservas.php?status=success');
            } else {
                // Erro ao fazer reserva
                header('Location: reservar_sala.php?status=error');
            }
            
        } else {
            // Sala não está disponível para o horário desejado
            header('Location: reservar_sala.php?status=unavailable');
        }
    }

    // Método para listar reservas de um aluno específico
    public function listarReservas($id_aluno) {
        return $this->model->readByAluno($id_aluno);
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
