<?php
include_once '../model/aluno.php';

class AlunoController
{

    private $model;

    public function __construct()
    {
        $this->model = new Aluno();
    }

    // Método para criar um novo aluno
    public function cadastrarAluno($num_matricula, $nome, $email, $senha, $confirmaSenha)
    {
        


        $sucesso = $this->model->createAluno($num_matricula, $nome, $email, $senha);

        if ($sucesso) {
            // Cadastro realizado com sucesso
            echo "<script>
                     Swal.fire({
                         icon: 'success',
                         title: 'Sucesso',
                         text: 'Cadastro realizado com sucesso!',
                     });
                 </script>";
        } else {
            // Erro no cadastro
            echo "<script>
                     Swal.fire({
                         icon: 'error',
                         title: 'Erro',
                         text: 'Erro ao cadastrar aluno.',
                     });
                 </script>";
        }
    }
}

?>