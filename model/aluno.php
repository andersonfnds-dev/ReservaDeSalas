<?php
include_once '../conn/conexao.php';

class Aluno
{

    private $conn;
    private $table_name = "alunos";

    public $num_matricula;
    public $nome;
    public $email;
    public $senha;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Criar um novo aluno
    public function createAluno($num_matricula, $nome, $email, $senha)
    {
        $query = "INSERT INTO " . $this->table_name . " (num_matricula, nome, email, senha) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $num_matricula);
        $stmt->bindParam(2, $nome);
        $stmt->bindParam(3, $email);
        $stmt->bindParam(4, $senha);

        if ($stmt->execute()) {
            return true;
        } else {
            // Adicione esta linha para obter informações de erro específicas
            $mensagem = print_r($stmt->errorInfo());
            return $mensagem;
        }
    }

    public function login($num_matricula, $senha)
    {
        $query = "SELECT num_matricula, senha FROM " . $this->table_name . " WHERE num_matricula = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $num_matricula);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            $senhaNoBanco = $result[0]['senha'];

            if (password_verify($senha, $senhaNoBanco)) {
                // Senha correta
                return $result;
            } else {
                // Matrícula ou senha incorretas
                return false;
            }
        } else {
            // Usuário não encontrado
            return false;
        }
    }
}

?>