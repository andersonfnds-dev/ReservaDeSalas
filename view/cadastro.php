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
    <link rel="stylesheet" href="../assets/css/reservar_salas.css"> <!-- Caminho para o seu CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
   
</head>

<body class = "container-body">

    <nav class="container-nav">
        <a class="navbar-brand" href="#">
            <img src="../assets/image/MyLibrary.png" alt="Logo" style="width: 60px;border: 1px solid #27214d;border-radius:70px ;"> <!-- Caminho para o seu logo -->
        </a>
        <div class="navbar-nav">
            <a class="style-nav" href="reservar_sala.php">MyLibrary</a>

        </div>
    </nav>
    <div class = "container-geral">
    <form method="post" action="cadastro.php" autocomplete="off" style="display:none;" id="ContainerCadastro">
   
            <div class="container-login-cadastro">
                <div class="style-login-cadastro">
                    <label for="matricula" class="style-label">Matrícula:</label>
                    <input class="style-input" id="matricula" name="num_matricula" required>
                    <label for="nome" class="style-label">Nome:</label>
                    <input type="text" class="style-input" id="nome" name="nome" required><br>

                    <label for="email" class="style-label">E-mail:</label>
                    <input type="email" class="style-input" name="email" required><br>

                    <label for="senha" class="style-label">Senha:</label>
                    <input type="password" class="style-input" name="senha" required><br>

                    <input type="submit" class="style-botton" value="Cadastrar" name="submit">
                    <a href=#  class = 'style-link'id="switchToLogin">Voltar para a tela de Login</a>

                </div>
            </div>
       
    
    </form>


    
        <form method="post" action="cadastro.php" autocomplete="off" id="ContainerLogin">
        
            <div class="container-login-cadastro">
                <div class="style-login-cadastro">
                    <label for="matricula" class="style-label">Matrícula:</label>
                    <input class="style-input" id="matricula" name="num_matricula" required>
                    <label for="senha" class="style-label">Senha:</label>
                    <input type="password" class="style-input" name="senha" required><br>
                    <input type="submit" class="style-botton" value="Login" name="submitLogin">
                    <a href=# class="style-link" id="switchToCadastro">Cadastre-se</a>

                </div>
            </div>
        
        </form>
   
    </div>
    
    <!-- Inclua o script do SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../assets/js/ajaxContainers.js"></script>
    <script src="../assets/js/ajaxEnvioFormularios.js"></script>
</body>

</html>