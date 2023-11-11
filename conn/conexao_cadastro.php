<?php

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reserva_salas";

// Cria a conexão
$con = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($con->connect_error) {
    die("Erro na conexão com o banco de dados: " . $con->connect_error);
}

// Retorna a conexão
return $con;
?>
