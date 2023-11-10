
$(document).ready(function () {
    // Função para verificar os horários disponíveis ao selecionar uma data
    function verificarHorariosDisponiveis(dataReserva) {
        console.log("Testeeeeee");
        $.ajax({
            url: '../controller/reservas_controller.php',
            method: 'POST',
            data: { data_reserva: dataReserva },
            success: function (response) {
                // Atualizar o dropdown de horários com os horários disponíveis e ocupados
                const horariosDropdown = $("#horarios_disponiveis");
                horariosDropdown.html(response);

                // Adicionar lógica para atribuir cores aos horários
                horariosDropdown.find("option").each(function () {
                    const horario = $(this).val();

                    // Adicione sua lógica para verificar se o horário está disponível ou ocupado
                    if (horarioDisponivel) {
                        $(horario).css("color", "green");
                    } else {
                        $(horario).css("color", "red");
                    }
                });
            }
        });
    }

    // Quando a data de reserva é alterada
    $("#data_reserva1").on("change", function () {
        // Obter a data selecionada
        const dataReserva = $(this).val();

        // Chamar a função para verificar os horários disponíveis
        verificarHorariosDisponiveis(dataReserva);
    });
});
