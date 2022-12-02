<?php
// Initialize the session
session_start();

if (isset($_GET['idCliente'])) {
    $id = $_GET['idCliente'];

    require_once('connection.php');

    // Mysql query to delete record from table
    $mysql_query = "DELETE FROM cliente WHERE idCliente=$id";

    if ($connection->query($mysql_query) === TRUE) {
        $msg = "delete success";
        $msgerror = "";
    }

} else {
    $msg =  "delete error";
    $msgerror =  "O ID não foi informado!";
}

header("Location:listClient.php?msg={$msg}&msgerror={$msgerror}");
