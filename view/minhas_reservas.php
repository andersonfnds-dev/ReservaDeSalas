<?php
session_start();

if (!isset($_SESSION['num_matricula'])) {
    header('Location: auth.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
    <title>Reserva de Salas</title>
    <link rel="stylesheet" href="../assets/css/minhasReservas.css"> <!-- Caminho para o seu CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>

    <!-- Navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="../assets/image/EasyRooms.png" alt="Logo"
                style="width: 60px;border: 1px solid #27214d;border-radius:70px ;"> <!-- Caminho para o seu logo -->
        </a>
        <div class="navbar-collapse">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link " href="reservar_sala.php">Reservar Sala</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="minhas_reservas.php">Minhas Reservas</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link btn btn-outline-primary" href="../controller/logout_controller.php">Sair da
                        Sessão</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
    <div class="row mt-4">
        <div class="col-12">
            <label for="intervaloTempo">Choose the interval:</label>
            <select id="intervaloTempo" class="form-control">
                <option value="semana">Week</option>
                <option value="mes">Month</option>
                <option value="ano">Year</option>
            </select>
        </div>
    </div>
    <div class="row mt-4">
        <canvas id="reservasChart" width="400" height="200" style="margin-bottom: 3%;"></canvas>
    </div>

        <div class="row" id="areaReservas">
            <!-- As reservas serão exibidas aqui -->
        </div>
        
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/minhasReservas.js"></script>