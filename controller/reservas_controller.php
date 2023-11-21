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
        $response = [
            'status' => 'error',
            'message' => 'Matrícula ou senha incorretas!'
        ];
        // Se a sala estiver disponível, proceder com a reserva
        $reservaSucesso = $this->model->fazerReserva($num_sala, $num_matricula, $hora_inicio, $hora_fim, $data_reserva);

        if ($reservaSucesso) {
            // Reserva bem-sucedida
            $response['status'] = 'success';
            $response['message'] = 'Reserva realizada com sucesso!';
        } else {
            // Horário ocupado, informe o usuário
            $response['message'] = 'Horário indisponível! Selecione outro horário.';
        }

        echo json_encode($response);
        exit;
    }

    public function verificarHorariosDisponiveis($data_reserva, $num_sala)
    {
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        // Consulta no banco de dados para obter os horários disponíveis e ocupados
        $horarios_disponiveis = $this->model->consultarHorariosDisponiveis($data_reserva, $num_sala);

        error_log("Horários disponíveis: " . print_r($horarios_disponiveis, true));

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
