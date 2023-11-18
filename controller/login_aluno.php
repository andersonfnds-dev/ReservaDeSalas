<?php
header('Content-Type: application/json');

include_once 'alunos_controller.php';

// Verifique se os dados do formulário foram submetidos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $num_matricula = $_POST['num_matriculaLogin'];
    $senha = $_POST["senhaLogin"];

    $controller = new AlunoController();
    $controller->loginAluno($num_matricula, $senha);
} else {
    // Se o método de requisição não for POST, retorne uma mensagem de erro
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido']);
}