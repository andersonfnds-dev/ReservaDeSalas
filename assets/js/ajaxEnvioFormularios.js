
            // script do AJAX para o formulário de cadastro
            $(document).ready(function () {
                $("#ContainerCadastro").on('submit', function (e) {
                    e.preventDefault(); // Adicionado para evitar a submissão padrão do formulário

                    $.ajax({
                        type: "POST",
                        url: "../view/cadastro.php",
                        data: $(this).serialize,
                        success: function (response) {
                            if (response.status === "success") {
                                // Em caso de sucesso, exibe a mensagem de cadastro bem-sucedido
                     Swal.fire({
                         icon: 'success',
                         title: 'Sucesso',
                         text: 'Cadastro realizado com sucesso!',
                     });
                 
                            } else {
                                // Se houver algum erro, exibe a mensagem de erro
                                 echo 
                     Swal.fire({
                         icon: 'error',
                         title: 'Erro',
                         text: 'Erro ao cadastrar aluno.',
                     });
                 
                    }}
                });
                });
            });