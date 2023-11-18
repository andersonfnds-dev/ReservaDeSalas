<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Inclua o CSS do SweetAlert2 -->
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Reserva de Salas</title>
    <link rel="stylesheet" href="../assets/css/reservar_salas.css"> <!-- Caminho para o seu CSS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>

<body class="container-body">

    <nav class="container-nav">
        <a class="navbar-brand" href="#">
            <img src="../assets/image/MyLibrary.png" alt="Logo"
                style="width: 60px;border: 1px solid #27214d;border-radius:70px ;"> <!-- Caminho para o seu logo -->
        </a>
        <div class="navbar-nav">
            <a class="style-nav" href="">MyLibrary</a>

        </div>
    </nav>
    <div class="container-geral">
        <form method="post" autocomplete="off" style="display:none;" id="ContainerCadastro">

            <div class="container-login-cadastro">
                <div class="style-login-cadastro">
                    <br>
                    <label for="matricula" class="style-label">Matrícula:</label>
                    <input class="style-input" id="matriculaCadastro" name="num_matriculaCadastro" required>
                    <br>
                    <label for="nome" class="style-label">Nome:</label>
                    <input type="text" class="style-input" id="nome" name="nome" required><br>

                    <label for="email" class="style-label">E-mail:</label>
                    <input type="email" class="style-input" name="email" required><br>

                    <label for="senha" class="style-label">Senha:</label>
                    <input type="password" class="style-input" name="senhaCadastro" required><br>

                    <label for="senha" class="style-label">Confirme a sua senha:</label>
                    <input type="password" class="style-input" name="confirmaSenha" required><br>

                    <input type="submit" class="style-botton" value="Cadastrar" name="submit">
                    <br>
                    <a href=# id="switchToLogin">Voltar para a tela de Login</a>
                    <br>

                </div>
            </div>
        </form>
        <br><br>

        <form method="post" autocomplete="off" id="ContainerLogin">

            <div class="container-login-cadastro">
                <div class="style-login-cadastro">
                    <br>
                    <label for="matricula" class="style-label">Matrícula:</label>
                    <input class="style-input" id="matriculaLogin" name="num_matriculaLogin" required>
                    <br>
                    <label for="senha" class="style-label">Senha:</label>
                    <input type="password" class="style-input" name="senhaLogin" required><br>

                    <input type="submit" class="style-botton" value="Login" name="submitLogin">
                    <br>
                    <a href=# id="switchToCadastro">Cadastre-se</a>
                    <br>
                </div>
            </div>
        </form>
        

    </div>

    <!-- Inclua o script do SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.17/dist/sweetalert2.all.min.js"></script>
    <script src="../assets/js/ajaxContainers.js"></script>
    <script src="../assets/js/ajaxEnvioFormularios.js"></script>
</body>

</html>