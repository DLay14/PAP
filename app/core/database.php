<?php

Class Database 
{
// Variável estática para armazenar a instância do Database
private static $instance = null;

// Variável para armazenar a conexão PDO
private $con;

private function __construct()
{
    try {
        $string = DB_TYPE . ":host=" . DB_HOST . ";dbname=" . DB_NAME;
        $this->con = new PDO($string, DB_USER, DB_PASS);
        // Defina o modo de erro PDO para exceção
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die($e->getMessage());
    }
}

// Método para obter a instância única
public static function getInstance()
{
    if (self::$instance === null) {
        self::$instance = new self();
    }

    return self::$instance;
}

// Método para obter a conexão PDO
public function getConnection()
{
    return $this->con;
}

// Método para ler dados do banco de dados
public function read($query, $data = array())
{
    $stm = $this->con->prepare($query);
    $result = $stm->execute($data);

    if ($result) {
        $data = $stm->fetchAll(PDO::FETCH_OBJ);
        if (is_array($data) && count($data) > 0) {
            return $data;
        }
    }

    return false;
}

// Método para escrever dados no banco de dados
public function write($query, $data = array())
{
    $stm = $this->con->prepare($query);
    $result = $stm->execute($data);

    if ($result) {
        return true;
    }

    return false;
}
}

/*
$db = Database::getInstance();  
$data = $db->read("describe users");
show($data);
*/