<?php
session_start();

header('Content-Type: application/json');

// Inclua o seu controlador
include_once 'reservas_controller.php';

// Verifique se os dados da requisição AJAX foram recebidos corretamente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifique se os parâmetros necessários foram fornecidos
    if (isset($_SESSION['num_matricula'])) {
        // Obtenha os valores dos parâmetros
        $data_reserva = $_POST['data_reserva'];
        $num_sala = $_POST['num_sala'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fim = $_POST['hora_fim'];
        $num_matricula = $_SESSION['num_matricula'];

        // Chame a função para fazer a reserva
        $reservasController = new ReservaController();
        $result = $reservasController->fazerReserva($num_matricula, $num_sala, $hora_inicio, $hora_fim, $data_reserva);

        echo json_encode($result);
        exit;
    } else {
        echo json_encode($result);
        exit;
    }
}
?>
