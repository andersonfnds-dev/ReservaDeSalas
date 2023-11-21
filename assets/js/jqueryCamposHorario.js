$(document).ready(function () {

    // Itera sobre as 10 salas
    for (let i = 1; i <= 10; i++) {
        const dataReservaSelector = `#data_reserva${i}`;
        const horaInicioSelector = `#hora_inicio${i}`;
        const horariosDisponiveisSelector = `#horarios_disponiveis${i}`;
        const horaFimSelector = `#hora_fim${i}`;

        // Quando a data de reserva é alterada para a sala i
        $(dataReservaSelector).on("change", function () {
            const dataReserva = $(this).val();

            const numSala = i;

            verificarHorariosDisponiveis(dataReserva, numSala, horariosDisponiveisSelector);

            $(`${horaInicioSelector}, ${horaFimSelector}`).prop("disabled", false);
        });
    }

    // Exemplo: Desabilitar os campos novamente ao carregar a página
    $("input[id^='hora_inicio'], input[id^='hora_fim']").prop("disabled", true);
});


// Função para verificar os horários disponíveis ao selecionar uma data
function verificarHorariosDisponiveis(dataReserva, numSala, horariosDisponiveisSelector) {
    console.log('Chamando verificarHorariosDisponiveis com dataReserva:', dataReserva, 'e numSala:', numSala);
    $.ajax({
        url: '../controller/horario_reservas_controller.php',
        method: 'POST',
        data: { data_reserva: dataReserva, num_sala: numSala },
        dataType: 'html', // Defina o tipo de dados esperado como JSON
        success: function (response) {

            console.log('Resposta do servidor:', response);
            const horariosDropdown = $(horariosDisponiveisSelector);  
            horariosDropdown.html(response); // Inserir a resposta diretamente no dropdown

        },
        error: function (error) {
            console.error('Erro ao chamar verificarHorariosDisponiveis:', error.responseText);
        }
    });
}






