<?php
session_start();

if(!isset($_SESSION['user_data'])){
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
    <title>Reserva de Salas</title>
    <link rel="stylesheet" href="../assets/css/reservar_salas.css"> <!-- Caminho para o seu CSS -->
</head>

<body>

    <!-- Navegação -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
        <img src="../assets/image/MyLibrary.png" alt="Logo" style="width: 60px;border: 1px solid #27214d;border-radius:70px ;"> <!-- Caminho para o seu logo -->
        </a>
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="reservar_sala.php">Reservar Sala</a>
            <a class="nav-item nav-link" href="minhas_reservas.php">Minhas Reservas</a>
        </div>
    </nav>

    <!-- Conteúdo Principal -->
    <div class="container mt-4">
        <div class="row flex-container">
            <!-- Estes são exemplos de cards. Repita para cada sala. -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Sala 1</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="data_reserva">Data da Reserva</label>
                            <input type="date" class="form-control" id="data_reserva1" name="data_reserva" required>
                        </div>
                        <div class="form-group">
                            <label for="horarios_disponiveis">Horários Disponíveis</label>
                            <select class="form-control" id="horarios_disponiveis" name="horarios_disponiveis">
                                <!-- Opções de horários serão geradas dinamicamente pelo JavaScript -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="hora_inicio">Hora de Início</label>
                            <input type="time" class="form-control" id="hora_inicio1" name="hora_inicio" required disabled>
                        </div>

                        <div class="form-group">
                            <label for="hora_fim">Hora de Término</label>
                            <input type="time" class="form-control" id="hora_fim1" name="hora_fim" required disabled>
                        </div>
                        <button class="btn btn-primary">Reservar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Sala 2</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="data_reserva">Data da Reserva</label>
                            <input type="date" class="form-control" id="data_reserva2" name="data_reserva" required>
                        </div>

                        <div class="form-group">
                            <label for="hora_inicio">Hora de Início</label>
                            <input type="time" class="form-control" id="hora_inicio2" name="hora_inicio" required disabled>
                        </div>

                        <div class="form-group">
                            <label for="hora_fim">Hora de Término</label>
                            <input type="time" class="form-control" id="hora_fim2" name="hora_fim" required disabled>
                        </div>
                        <button class="btn btn-primary">Reservar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Sala 3</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="data_reserva">Data da Reserva</label>
                            <input type="date" class="form-control" id="data_reserva3" name="data_reserva" required>
                        </div>

                        <div class="form-group">
                            <label for="hora_inicio">Hora de Início</label>
                            <input type="time" class="form-control" id="hora_inicio3" name="hora_inicio" required disabled>
                        </div>

                        <div class="form-group">
                            <label for="hora_fim">Hora de Término</label>
                            <input type="time" class="form-control" id="hora_fim3" name="hora_fim" required disabled>
                        </div>
                        <button class="btn btn-primary">Reservar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Sala 4</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="data_reserva">Data da Reserva</label>
                            <input type="date" class="form-control" id="data_reserva4" name="data_reserva" required>
                        </div>

                        <div class="form-group">
                            <label for="hora_inicio">Hora de Início</label>
                            <input type="time" class="form-control" id="hora_inicio4" name="hora_inicio" required disabled>
                        </div>

                        <div class="form-group">
                            <label for="hora_fim">Hora de Término</label>
                            <input type="time" class="form-control" id="hora_fim4" name="hora_fim" required disabled>
                        </div>
                        <button class="btn btn-primary">Reservar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Sala 5</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="data_reserva">Data da Reserva</label>
                            <input type="date" class="form-control" id="data_reserva5" name="data_reserva" required>
                        </div>

                        <div class="form-group">
                            <label for="hora_inicio">Hora de Início</label>
                            <input type="time" class="form-control" id="hora_inicio5" name="hora_inicio" required disabled>
                        </div>

                        <div class="form-group">
                            <label for="hora_fim">Hora de Término</label>
                            <input type="time" class="form-control" id="hora_fim5" name="hora_fim" required disabled>
                        </div>
                        <button class="btn btn-primary">Reservar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Sala 6</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="data_reserva">Data da Reserva</label>
                            <input type="date" class="form-control" id="data_reserva6" name="data_reserva" required>
                        </div>

                        <div class="form-group">
                            <label for="hora_inicio">Hora de Início</label>
                            <input type="time" class="form-control" id="hora_inicio6" name="hora_inicio" required disabled>
                        </div>

                        <div class="form-group">
                            <label for="hora_fim">Hora de Término</label>
                            <input type="time" class="form-control" id="hora_fim6" name="hora_fim" required disabled>
                        </div>
                        <button class="btn btn-primary">Reservar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Sala 7</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="data_reserva">Data da Reserva</label>
                            <input type="date" class="form-control" id="data_reserva7" name="data_reserva" required>
                        </div>

                        <div class="form-group">
                            <label for="hora_inicio">Hora de Início</label>
                            <input type="time" class="form-control" id="hora_inicio7" name="hora_inicio" required disabled>
                        </div>

                        <div class="form-group">
                            <label for="hora_fim">Hora de Término</label>
                            <input type="time" class="form-control" id="hora_fim7" name="hora_fim" required disabled>
                        </div>
                        <button class="btn btn-primary">Reservar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Sala 8</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="data_reserva">Data da Reserva</label>
                            <input type="date" class="form-control" id="data_reserva8" name="data_reserva" required>
                        </div>

                        <div class="form-group">
                            <label for="hora_inicio">Hora de Início</label>
                            <input type="time" class="form-control" id="hora_inicio8" name="hora_inicio" required disabled>
                        </div>

                        <div class="form-group">
                            <label for="hora_fim">Hora de Término</label>
                            <input type="time" class="form-control" id="hora_fim8" name="hora_fim" required disabled>
                        </div>
                        <button class="btn btn-primary">Reservar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Sala 9</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="data_reserva">Data da Reserva</label>
                            <input type="date" class="form-control" id="data_reserva9" name="data_reserva" required>
                        </div>

                        <div class="form-group">
                            <label for="hora_inicio">Hora de Início</label>
                            <input type="time" class="form-control" id="hora_inicio9" name="hora_inicio" required disabled>
                        </div>

                        <div class="form-group">
                            <label for="hora_fim">Hora de Término</label>
                            <input type="time" class="form-control" id="hora_fim9" name="hora_fim" required disabled>
                        </div>
                        <button class="btn btn-primary">Reservar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">Sala 10</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="data_reserva">Data da Reserva</label>
                            <input type="date" class="form-control" id="data_reserva10" name="data_reserva" required>
                        </div>

                        <div class="form-group">
                            <label for="hora_inicio">Hora de Início</label>
                            <input type="time" class="form-control" id="hora_inicio10" name="hora_inicio" required disabled>
                        </div>

                        <div class="form-group">
                            <label for="hora_fim">Hora de Término</label>
                            <input type="time" class="form-control" id="hora_fim10" name="hora_fim" required disabled>
                        </div>

                        <button class="btn btn-primary" id="btnReservar">Reservar</button>
                    </div>
                </div>


                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="../assets/js/jqueryCamposHorario.js"></script>
                <script src="../assets/js/ajaxHorariosDisponiveis.js"></script>

</body>

</html>