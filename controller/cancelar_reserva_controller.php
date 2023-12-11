<?php
session_start();

include_once 'reservas_controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['num_matricula'])) {
        $id_reserva = $_POST['id_reserva'];

        $reservasController = new ReservaController();
        $result = $reservasController->cancelarReserva($id_reserva);

        echo json_encode($result);
        exit;
    } else {
        echo json_encode("Método de requisição inválido");
        exit;
    }
}
