//script da troca de formulários
$(document).ready(function () {

    // Quando o usuário clicar em "Cadastre-se", mostre o container de cadastro e esconda o de login
    $("#switchToCadastro").click(function (e) {
        e.preventDefault();

        $("#ContainerLogin").hide();
        $("#ContainerCadastro").show();
    });

});
// Quando o usuário clicar em "", mostre o container de cadastro e esconda o de login
$(document).ready(function () {

    $("#switchToLogin").click(function (e) {
        e.preventDefault();

        $("#ContainerCadastro").hide();
        $("#ContainerLogin").show();
    });

});