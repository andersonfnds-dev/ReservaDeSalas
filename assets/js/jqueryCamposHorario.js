$(document).ready(function () {
    console.log("Testeeeeee");
    // Itera sobre as 10 salas
    for (let i = 1; i <= 10; i++) {
        const dataReservaSelector = `#data_reserva${i}`;
        const horaInicioSelector = `#hora_inicio${i}`;
        const horaFimSelector = `#hora_fim${i}`;

        // Quando a data de reserva é alterada para a sala i
        $(dataReservaSelector).on("change", function () {
            
            $(`${horaInicioSelector}, ${horaFimSelector}`).prop("disabled", false);
        });
    }

    // Exemplo: Desabilitar os campos novamente ao carregar a página
    $("input[id^='hora_inicio'], input[id^='hora_fim']").prop("disabled", true);
});