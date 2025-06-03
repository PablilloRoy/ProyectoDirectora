<?php
require __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv; 
// load the .env file containing environment variables
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');

$dotenv->load();
// Check if the environment variables are set
function conectarDB(): mysqli
{
    $host = $_ENV['HOST'];        
    $usuario = $_ENV['USUARIO'];   
    $password = $_ENV['PASSWORD']; 
    $database = $_ENV['DATABASE']; 
    $puerto = $_ENV['PUERTO'];     

    $db = mysqli_connect($host, $usuario, $password, $database, $puerto);

    if (!$db) {
        echo "Error base de datos no conectada";
        exit;
    }

    return $db;
}
