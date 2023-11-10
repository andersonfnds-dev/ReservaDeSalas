<?php
include_once '../model/reserva.php';

class ReservaController
{

    private $model;

    public function __construct()
    {
        $this->model = new Reserva();
    }

    // Método para fazer uma reserva
    public function fazerReserva($num_sala, $num_matricula, $hora_inicio, $hora_fim, $data_reserva)
    {
        // Se a sala estiver disponível, proceder com a reserva
        $sucesso = $this->model->createReserva($num_sala, $num_matricula, $hora_inicio, $hora_fim, $data_reserva);

        if ($sucesso) {
            // Reserva efetuada com sucesso
            $status_sala = "Ocu";
        } else {
            // Sala não está disponível para o horário desejado
            header('Location: reservar_sala.php?status=unavailable');
        }
    }

    public function verificarHorariosDisponiveis($data_reserva)
    {
        // Consulta no banco de dados para obter os horários disponíveis e ocupados
        $horarios_disponiveis = $this->model->consultarHorariosDisponiveis($data_reserva);

        // Resposta Ajax com os horários
        echo json_encode($horarios_disponiveis);
        exit;
    }

    // Método para listar reservas de um aluno específico
    public function listarReservas($num_matricula)
    {
        return $this->model->readByAlunoReservas($num_matricula);
    }

    // Método para cancelar uma reserva
    public function cancelarReserva($id_reserva)
    {
        $sucesso = $this->model->deleteReserva($id_reserva);

        if ($sucesso) {
            header('Location: minhas_reservas.php?status=cancel_success');
        } else {
            header('Location: minhas_reservas.php?status=cancel_error');
        }
    }

    // ... Outros métodos conforme necessário ...

}
