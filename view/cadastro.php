<?php
include_once('../controller/alunos_controller.php');

// Verificando se os dados do formulário foram submetidos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitizando e pegando dados do formulário
    $num_matricula = $_POST['num_matricula'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST["senha"];


    $controller = new AlunoController();
    $controller->criarAluno($num_matricula, $nome, $email, $senha);
}
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inclua o CSS do SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
    <!-- Inclua o script do SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Reserva de Salas</title>
    <link rel="stylesheet" href="../assets/css/reservar_sala.css"> <!-- Caminho para o seu CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">
            <img src="path/to/your/logo.png" alt="Logo" style="width: 50px;"> <!-- Caminho para o seu logo -->
        </a>
        <div class="navbar-nav">
            <a class="nav-item nav-link active" href="reservar_sala.php">Area do Alunos</a>

        </div>
    </nav>

    <form method="post" action="cadastro.php" autocomplete="off" style="display:none;" id="ContainerCadastro">
        <div class="container mt-4">
            <div class="col-md-6">
                <div class="card mb-4">
                    <label for="matricula" class="card-header">Matrícula:</label>
                    <input class="form-control" id="matricula" name="num_matricula" required>
                    <label for="nome" class="card-header">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required><br>

                    <label for="email" class="card-header">E-mail:</label>
                    <input type="email" class="form-control" name="email" required><br>

                    <label for="senha" class="card-header">Senha:</label>
                    <input type="password" class="form-control" name="senha" required><br>

                    <input type="submit" class="btn btn-primary" value="Cadastrar" name="submit">
                    <a href=# id="switchToLogin">Voltar para  tela de Login</a>

                </div>
            </div>
        </div>
    </form>
    <form method="post" action="cadastro.php" autocomplete="off" id="ContainerLogin">
        <div class="container mt-4">
            <div class="col-md-6">
                <div class="card mb-4">
                    <label for="matricula" class="card-header">Matrícula:</label>
                    <input class="form-control" id="matricula" name="num_matricula" required>
                    <label for="senha" class="card-header">Senha:</label>
                    <input type="password" class="form-control" name="senha" required><br>
                    <input type="submit" class="btn btn-primary" value="Login" name="submitLogin">
                    <a href=# id="switchToCadastro">Cadastre-se</a>

                </div>
            </div>
        </div>
    </form>
    
    <!-- Inclua o script do SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../assets/js/ajaxContainers.js"></script>
    <script src="../assets/js/ajaxEnvioFormularios.js"></script>
</body>

</html>