<?php
include_once 'model/reserva.php';
include_once 'conn/conexao.php';

class ReservaController
{

    private $model;

    public function __construct()
    {
        $this->model = new Reserva();
    }

    function verificarHorariosDisponiveis($data_reserva, $num_sala)
    {

        $num_sala = 1;
        $data_reserva = '2023-11-21';
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        $data_reserva = $_GET['data_reserva'];
        $num_sala = $_GET['num_sala'];
        // Consulta no banco de dados para obter os horários disponíveis e ocupados
        $horarios_disponiveis = $this->model->consultarHorariosDisponiveis($data_reserva, $num_sala);

        error_log("Horários disponíveis: " . print_r($horarios_disponiveis, true));

        // Resposta Ajax com os horários
        echo json_encode($horarios_disponiveis);
        exit;
    }

}