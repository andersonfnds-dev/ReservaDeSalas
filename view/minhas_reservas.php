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
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="reservar_sala.php">Reservar Sala</a>
            <a class="nav-item nav-link active" href="minhas_reservas.php">Minhas Reservas</a>
        </div>
    </nav>

    <div class="container mt-4">
    <div class="row" id="areaReservas">
        <!-- As reservas serão exibidas aqui -->
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="../assets/js/minhasReservas.js"></script>