$(document).ready(function () {
    // Chame a função do backend para obter as reservas
    $.ajax({
        url: '../controller/minhas_reservas_controller.php',
        method: 'POST',
        dataType: 'json',
        success: function (response) {
            console.log('Reservas recebidas:', response);
            // Manipule os dados recebidos e exiba na página
            exibirReservas(response);
        },
        error: function (error) {
            console.error('Erro ao obter reservas:', error.responseText);
        }
    });
});

// Função para exibir as reservas na página
function exibirReservas(reservas) {
    console.log('Chamando exibirReservas com reservas:', reservas);

    // Limpar qualquer conteúdo existente na área de exibição de reservas
    $('#areaReservas').empty();

    // Se não houver reservas, exibir uma mensagem
    if (reservas.length === 0) {
        const semReservasElement = document.createElement('p');
        semReservasElement.innerText = 'Você não possui reservas.';
        $('#areaReservas').append(semReservasElement);
        return;
    }

    // Iterar sobre as reservas e adicionar elementos HTML
    for (let i = 0; i < reservas.length; i++) {
        const reserva = reservas[i];
        console.log('Criando elemento para reserva:', reserva);

        // Criar elemento HTML
        const elementoReserva = `
            <div class="card mb-4">
                <div class="card-header">Reserva ${i + 1}</div>
                <div class="card-body">
                    <p>Dia: ${reserva.dia}</p>
                    <p>Sala: ${reserva.sala}</p>
                    <p>Hora de Início: ${reserva.hora_inicio}</p>
                    <p>Hora de Término: ${reserva.hora_fim}</p>
                    <button class="btn btn-danger" onclick="cancelarReserva(${reserva.id})">Cancelar Reserva</button>
                </div>
            </div>
        `;

        // Adicionar o elemento à área de exibição
        $('#areaReservas').append(elementoReserva);
    }
}




// Função para cancelar uma reserva
function cancelarReserva(idReserva) {
    // Implemente a lógica de cancelamento da reserva usando AJAX ou outra abordagem
    // ...

    // Atualize a exibição após o cancelamento
    // Exemplo: recarregue as reservas
    // $.ajax({ ... });
}