<?php
require_once __DIR__ . '/loadEnv.php';

loadEnv(__DIR__ . '/../.env');

define('DB_HOST', getenv('DB_HOST'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));
define('DB_NAME', getenv('DB_NAME'));

// Conectar ao MySQL sem especificar o banco de dados
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Criar o banco de dados, se não existir, e selecioná-lo
$sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
$conn->query($sql);
$conn->select_db(DB_NAME);

// Criar a tabela 'estados', se não existir
$sql = "CREATE TABLE IF NOT EXISTS estados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    sigla CHAR(2) NOT NULL UNIQUE
)";
$conn->query($sql);

// Criar a tabela 'cidades', se não existir
$sql = "CREATE TABLE IF NOT EXISTS cidades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(250) NOT NULL,
    estado_id INT NOT NULL,
    FOREIGN KEY (estado_id) REFERENCES estados(id) ON DELETE CASCADE
)";
$conn->query($sql);
