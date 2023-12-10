<?php
session_start();

include_once 'reservas_controller.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['num_matricula'])) {

        $num_matricula = $_SESSION['num_matricula'];

        $reservasController = new ReservaController();
        $result = $reservasController->listarMinhasReservas($num_matricula);

        echo json_encode($result);
    } else {
        echo json_encode("Método de requisição inválido");
        exit;
    }
}