<?php
header('Content-Type: application/json');

include_once 'alunos_controller.php';

// Verifique se os dados do formulário foram submetidos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $num_matricula = $_POST['num_matriculaCadastro'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST["senhaCadastro"];
    $confirmaSenha = $_POST["confirmaSenha"];

    $controller = new AlunoController();
    $controller->cadastrarAluno($num_matricula, $nome, $email, $senha, $confirmaSenha);
} else {
    // Se o método de requisição não for POST, retorne uma mensagem de erro
    echo json_encode(['status' => 'error', 'message' => 'Método de requisição inválido']);
}
