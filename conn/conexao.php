<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'db_reserva_salas';
    private $username = 'root';
    private $password = '';
    private $port = '3306'; // Altere para a porta que você está usando
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Erro na conexão: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
