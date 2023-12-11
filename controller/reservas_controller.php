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

        // Consulta no banco de dados para obter os horários disponíveis e ocupados
        $horarios_disponiveis = $this->model->consultarHorariosDisponiveis($data_reserva, $num_sala);

        error_log("Horários disponíveis: " . print_r($horarios_disponiveis, true));

        // Resposta Ajax com os horários
        echo json_encode($horarios_disponiveis);
        exit;
    }

    // Método para listar reservas de um aluno específico
    public function listarMinhasReservas($num_matricula)
    {
        $reservas = $this->model->readByAlunoReservas($num_matricula);

        if (is_string($reservas)) {
            // Não há reservas, $reservas contém a mensagem
            echo json_encode(['success' => false, 'message' => $reservas]);
            exit;
        } else {
            // Há reservas, retorne os dados no formato JSON
            $reservasArray = [];

            while ($row = $reservas->fetch(PDO::FETCH_ASSOC)) {
                $dataFormatada = date('d-m-Y', strtotime($row['data_reserva']));
                $reservasArray[] = [
                    'id' => $row['id_reserva'],
                    'dia' => $dataFormatada,
                    'sala' => $row['num_sala'],
                    'hora_inicio' => $row['hora_inicio'],
                    'hora_fim' => $row['hora_fim'],
                ];
            }
            echo json_encode(['success' => true, 'reservas' => $reservasArray]);
            exit;
        }
    }

    // Método para cancelar uma reserva
    public function cancelarReserva($id_reserva)
    {
        $response = [
            'status' => 'error',
            'message' => 'Não foi possível cancelar sua reserva, tente novamente.'
        ];

        $sucesso = $this->model->deleteReserva($id_reserva);

        if ($sucesso) {
            $response['status'] = 'success';
            $response['message'] = 'Reserva cancelada com sucesso!';
            echo json_encode ($response);
            exit;
        } else {
            echo json_encode ($response);
            exit;
        }
    }

    // ... Outros métodos conforme necessário ...

}
