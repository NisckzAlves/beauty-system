<?php
define ( 'DB_HOST', 'localhost');
define ( 'DB_USER', 'root' );
define ( 'DB_PASSWORD', '' );
$dsn = "mysql:host=".DB_HOST.";dbname=esteticaclinica;charset=utf8";

$connection = null;

try {
    $connection = new PDO($dsn, DB_USER, DB_PASSWORD);
}catch (PDOException $e) {
    echo "Falha ao conectar no banco de dados";
    var_dump($e);
    exit;
}
