$(document).ready(function () {
    // Chame a função do backend para obter as reservas
    $.ajax({
        url: '../controller/minhas_reservas_controller.php',
        method: 'POST',
        dataType: 'json',
        success: function (response) {
            console.log('Reservas recebidas:', response);
            // Manipule os dados recebidos e exiba na página
            exibirReservas(response.reservas);
        },
        error: function (error) {
            console.error('Erro ao obter reservas:', error.responseText);
        }
    });
});

// Função para formatar a data no formato "dd-mm-yyyy"


// Função para exibir as reservas na página
function exibirReservas(reservas) {
    console.log('Função exibirReservas chamada com reservas:', reservas);

    // Limpar qualquer conteúdo existente na área de exibição de reservas
    $('#areaReservas').empty();

    // Se não houver reservas, exibir uma mensagem
    if (!reservas || !reservas.length) {
        console.log('Nenhuma reserva encontrada.');
        const semReservasElement = document.createElement('p');
        semReservasElement.innerText = 'Você não possui reservas.';
        $('#areaReservas').append(semReservasElement);
    } else {
        console.log('Reservas encontradas:', reservas);
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
}

// Função para cancelar uma reserva
function cancelarReserva(idReserva) {
    // Confirmar se o usuário realmente deseja cancelar a reserva
    Swal.fire({
        title: 'Tem certeza?',
        text: 'Você realmente deseja cancelar esta reserva?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sim, cancelar!',
        cancelButtonText: 'Não, volte às minhas reservas.'
    }).then((result) => {
        if (result.isConfirmed) {
            // Chamar a função do backend para cancelar a reserva
            $.ajax({
                url: '../controller/cancelar_reserva_controller.php', // Substitua pelo caminho correto
                method: 'POST',
                data: { id_reserva: idReserva },
                dataType: 'json',
                success: function (response) {
                    if (response.status === "success") {
                        Swal.fire({
                            title: 'Reserva Cancelada!',
                            text: response.message,
                            icon: 'success'
                        });

                        // Atualizar a exibição das reservas após o cancelamento
                        listarMinhasReservas(); // Adapte isso conforme necessário
                    } else {
                        Swal.fire({
                            title: 'Erro!',
                            text: response.message,
                            icon: 'error'
                        });
                    }
                },
                error: function (error) {
                    console.error('Erro ao cancelar reserva:', error.responseText);
                }
            });
        }
    });
}