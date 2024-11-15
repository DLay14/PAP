<?php
// Inicia a sessão
session_start();

//print_r($_SERVER);

$path = $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
$path = str_replace("index.php", "", $path);

define('ROOT', $path);

define('ASSETS', $path . "assets/");

//define('THEME', 'admin/');

// Inclui o arquivo de inicialização
include "../app/init.php";

// Cria uma instância da classe App
$app = new App();
?>
