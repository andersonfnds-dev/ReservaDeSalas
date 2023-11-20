$(document).ready(function () {
    $("#ContainerCadastro").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "../controller/cadastro_aluno.php", // Alterado para o novo arquivo PHP
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: data.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: data.message,
                    });
                }
            }
        });
    });
});

$(document).ready(function () {
    $("#ContainerLogin").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "../controller/login_aluno.php",
            data: $(this).serialize(),
            dataType: 'json',
            success: function (data) {
                if (data.status === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sucesso',
                        text: data.message,
                    }).then(function () {
                        // Redireciona para a página inicial após o usuário clicar em OK
                        window.location.href = "../view/reservar_sala.php";
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erro',
                        text: data.message,
                    });
                }
            }
        });
    });
});
