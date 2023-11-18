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

document.getElementById('switchToCadastro').addEventListener('click', function () {
    // Habilitar o formulário de cadastro
    document.getElementById('ContainerCadastro').style.display = 'block';

    // Salvar o estado no localStorage
    localStorage.setItem('formularioCadastroExibido', 'true');
});

document.addEventListener('DOMContentLoaded', function () {
    // Verificar o estado no localStorage
    var formularioCadastroExibido = localStorage.getItem('formularioCadastroExibido');

    // Se o formulário de cadastro foi exibido anteriormente, mantenha-o visível
    if (formularioCadastroExibido === 'true') {
        document.getElementById('ContainerCadastro').style.display = 'block';
    }
});
