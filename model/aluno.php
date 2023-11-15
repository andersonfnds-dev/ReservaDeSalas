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
        }
        return false;
    }



}

?>