
$(document).ready(function () {
    // Função para verificar os horários disponíveis ao selecionar uma data
    function verificarHorariosDisponiveis(dataReserva, numSala) {
        console.log('Chamando verificarHorariosDisponiveis com dataReserva:', dataReserva, 'e numSala:', numSala);
        $.ajax({
            url: '../controller/reservas_controller.php',
            method: 'POST',
            data: { data_reserva: dataReserva, num_sala: numSala },
            dataType: 'json', // Defina o tipo de dados esperado como JSON
            success: function (response) {
                console.log('Resposta do servidor:', response);
                // Atualizar o dropdown de horários com os horários disponíveis e ocupados
                const horariosDropdown = $("#horarios_disponiveis");
                horariosDropdown.empty(); // Limpar as opções existentes

                // Adicionar lógica para atribuir cores aos horários
                response.forEach(function (horario) {
                    const option = $('<option>').val(horario.hora_inicio).text(horario.hora_inicio + ' - ' + horario.hora_fim);

                    // Adicione a classe CSS apropriada com base na disponibilidade
                    if (horario.disponivel) {
                        option.addClass("horario-disponivel").removeClass("horario-ocupado");
                    } else {
                        option.addClass("horario-ocupado").removeClass("horario-disponivel");
                    }

                    // Adicione os dados de disponibilidade como atributo
                    option.data("disponivel", horario.disponivel);

                    // Adicione a opção ao dropdown
                    horariosDropdown.append(option);
                });
            },
            error: function (error) {
                console.error('Erro ao chamar verificarHorariosDisponiveis:', error.responseText);
            }
        });
    }


    // Quando a data de reserva é alterada
    $("#data_reserva1").on("change", function () {
        // Obter a data selecionada
        const dataReserva = $(this).val();

        const numSala = 1;

        // Chamar a função para verificar os horários disponíveis
        verificarHorariosDisponiveis(dataReserva, numSala);
    });
});
