<?php
header('Content-Type: application/json');

// Inclua o seu controlador
include_once 'reservas_controller.php';

// Verifique se os dados da requisição AJAX foram recebidos corretamente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifique se os parâmetros necessários foram fornecidos
    if (isset($_POST['data_reserva']) && isset($_POST['num_sala'])) {
        // Obtenha os valores dos parâmetros
        $data_reserva = $_POST['data_reserva'];
        $num_sala = $_POST['num_sala'];

        // Crie uma instância do controlador de reservas
        $controller = new ReservaController();

        // Chame a função para verificar os horários disponíveis
        $horarios_disponiveis = $controller->verificarHorariosDisponiveis($data_reserva, $num_sala);

        // Responda com os horários disponíveis em formato JSON
        echo json_encode($horarios_disponiveis);
    } else {
        // Se os parâmetros não foram fornecidos, retorne uma mensagem de erro
        echo json_encode(['status' => 'error', 'message' => 'Parâmetros inválidos']);
    }
} else {
    // Se o método de requisição não for POST, retorne uma mensagem de erro
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido']);
}
?>