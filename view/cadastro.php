<?php
include_once('../controller/alunos_controller.php');

// Verificando se os dados do formulário foram submetidos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['submitLogin'])) {
        // Sanitizando e pegando dados do formulário
        $num_matricula = $_POST['num_matriculaLogin'];
        $senha = $_POST["senhaLogin"];

        $controller = new AlunoController();
        $controller->login($num_matricula, $senha);
    } elseif (isset($_POST['submitCadastro'])) {
        // Sanitizando e pegando dados do formulário
        $num_matricula = $_POST['num_matriculaCadastro'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST["senhaCadastro"];
        $confirmaSenha = $_POST["confirmaSenha"];

        $controller = new AlunoController();
        $controller->cadastrarAluno($num_matricula, $nome, $email, $senha, $confirmaSenha);
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>
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
                    <input class="form-control" id="matricula" name="num_matriculaCadastro" required>
                    <label for="nome" class="card-header">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required><br>

                    <label for="email" class="card-header">E-mail:</label>
                    <input type="email" class="form-control" name="email" required><br>

                    <label for="senha" class="card-header">Senha:</label>
                    <input type="password" class="form-control" name="senhaCadastro" required><br>

                    <label for="senha" class="card-header">Confirme a sua Senha:</label>
                    <input type="password" class="form-control" name="confirmaSenha" required><br>

                    <input type="submit" class="btn btn-primary" value="Cadastrar" name="submitCadastro">
                    <br>
                    <a href=# id="switchToLogin">Voltar para tela de Login</a>
                </div>
            </div>
        </div>
    </form>
    <form method="post" action="cadastro.php" autocomplete="off" id="ContainerLogin">
        <div class="container mt-4">
            <div class="col-md-6">
                <div class="card mb-4">
                    <label for="matricula" class="card-header">Matrícula:</label>
                    <input class="form-control" id="matricula" name="num_matriculaLogin" required>
                    <label for="senha" class="card-header">Senha:</label>
                    <input type="password" class="form-control" name="senhaLogin" required><br>
                    <input type="submit" class="btn btn-primary" value="Login" name="submitLogin">
                    <br>
                    <a href=# id="switchToCadastro">Cadastre-se</a>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../assets/js/ajaxContainers.js"></script>
</body>

</html>