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

        $response = [
            'status' => 'error',
            'message' => ''
        ];

        try {
            // Validar e-mail
            $domain = substr($email, strpos($email, '@') + 1);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !checkdnsrr($domain, 'MX')) {
                throw new Exception('Digite um email válido!');
            }

            // Validar matrícula
            if (strlen($num_matricula) < 4 || !ctype_digit($num_matricula)) {
                throw new Exception('A matrícula deve ter pelo menos 4 números!');
            }

            // Validar senha
            if (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{6,}$/", $senha)) {
                throw new Exception('A senha precisa ter pelo menos 6 caracteres, uma letra e um número!');
            }

            // Verificar a confirmação da senha
            if ($senha !== $confirmaSenha) {
                throw new Exception('As senhas não coincidem!');
            }

            if (empty($response['message'])) {
                $senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

            }

            // Chame o método no modelo para criar o aluno
            $cadastro_result = $this->model->createAluno($num_matricula, $nome, $email, $senhaCriptografada);

            // Se houver erros, retornar a lista de erros em formato JSON
            if (!empty($response['message'])) {
                echo json_encode($response);
                return;

            } else {
                if (!$cadastro_result) {
                    $response['message'] = $cadastro_result;
                } else {
                    $response['status'] = 'success';
                    $response['message'] = 'Cadastro realizado com sucesso!';
                }
                echo json_encode($response);
            }
        } catch (Exception $e) {
            $response['message'] = $e->getMessage();
            echo json_encode($response);
        }
    }

    public function loginAluno($num_matricula, $senha)
    {
        $response = [
            'status' => 'error',
            'message' => 'Matrícula ou senha incorretas!'
        ];

        // Chame o método no modelo para realizar o login
        $login_result = $this->model->login($num_matricula, $senha);

        if (is_array($login_result)) {
            // Login bem-sucedido
            $response['status'] = 'success';
            $response['message'] = 'Login realizado com sucesso!';
            $response['user_data'] = $login_result;

            // Inicia a sessão
            session_start();

            // Guarda informações do usuário na sessão
            $_SESSION['user_data'] = $login_result;
        } else {
            // Login falhou
            $response['message'] = 'Matrícula ou senha incorretas!';
        }

        echo json_encode($response);
        exit;
    }

}
?>