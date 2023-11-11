<?php
require_once('../conn/conexao_cadastro.php');

// Verificando se os dados do formulário foram submetidos
if (isset($_POST['matricula'])) {
    // Sanitizando e pegando dados do formulário
    $matricula = filter_input(INPUT_POST, "matricula", FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $senha = $_POST["senha"];

    // Verifica se a conexão foi bem-sucedida
    if ($con === null) {
        die("Erro na conexão com o banco de dados.");
    }

    // Preparando e executando a instrução SQL com marcadores de posição de ponto de interrogação
    $stm = $con->prepare("INSERT INTO alunos (num_matricula, nome, email, senha) VALUES (?, ?, ?, ?)");

    // Verificando se a preparação foi bem-sucedida
    if ($stm === false) {
        die("Erro na preparação da instrução SQL: " . $con->error);
    }

    // Vinculando parâmetros e executando
    $stm->bind_param('isss', $matricula, $nome, $email, $senha); // 'isss' são os tipos dos parâmetros

    if ($stm->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro no cadastro: " . $stm->error;
    }

    // Fechando a instrução
    $stm->close();
}

// Fechando a conexão
$con->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Reserva de Salas</title>
    <link rel="stylesheet" href="../assets/css/reservar_sala.css"> <!-- Caminho para o seu CSS -->
</head>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="path/to/your/logo.png" alt="Logo" style="width: 50px;"> <!-- Caminho para o seu logo -->
        </a>
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="reservar_sala.php">Cadastrar Alunos</a>
            
        </div>
    </nav>
    
    <form method="post" autocomplete="off">
        <div class="container mt-4">
            <div class="col-md-6">
                <div class="card mb-4">
                        <label for="matricula" class="card-header">Matrícula:</label>
                        <input  class="form-control" id="matricula" name="matricula" required>
                        <label for="nome" class="card-header">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required><br>
                    
                        <label for="email" class="card-header">E-mail:</label>
                        <input type="email"  class="form-control" name="email" required><br>

                        <label for="senha" class="card-header">Senha:</label>
                        <input type="password" class="form-control" name="senha" required><br>

                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                    
                </div>         
            </div>
        </div>    
    </form>
</body>
</html>
