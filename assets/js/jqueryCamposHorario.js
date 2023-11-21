$(document).ready(function () {
    // Itera sobre as 10 salas
    for (let i = 1; i <= 10; i++) {
        const btnReservarSelector = `#btnReservar${i}`;
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

        $(btnReservarSelector).on("click", function () {
            const dataReserva = $(dataReservaSelector).val();
            const horaInicio = $(horaInicioSelector).val();
            const horaFim = $(horaFimSelector).val();
            const numSala = i;

            // Chame a função para verificar horários disponíveis e realizar a reserva
            fazerReserva(dataReserva, numSala, horaInicio, horaFim);
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

function fazerReserva(dataReserva, numSala, horaInicio, horaFim) {
    console.log('Chamando fazerReserva com dataReserva:', dataReserva, 'e numSala:', numSala, 'e horaInicio:', horaInicio, 'e horaFim:', horaFim);
    $.ajax({
        url: '../controller/reservar_sala_controller.php',
        method: 'POST',
        data: { data_reserva: dataReserva, num_sala: numSala, hora_inicio: horaInicio, hora_fim: horaFim },
        dataType: 'json', // Defina o tipo de dados esperado como JSON
        success: function (response) {

            console.log('Resposta do servidor:', response);
            if (response.status === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso',
                    text: response.message,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Erro',
                    text: response.message,
                });
            }

        },
        error: function (error) {
            console.error('Erro ao chamar fazerReserva:', error.responseText);
        }
    });
}






