<?php
// Initialize the session
session_start();

if (isset($_GET['idMensagem'])) {
    $id = $_GET['idMensagem'];

    require_once('connection.php');

    // Mysql query to delete record from table
    $mysql_query = "DELETE FROM mensagem WHERE idMensagem=$id";

    if ($connection->query($mysql_query) === TRUE) {
        $msg = "delete success";
        $msgerror = "";
    }

} else {
    $msg =  "delete error";
    $msgerror =  "O ID não foi informado!";
}

header("Location:consultMessage.php?msg={$msg}&msgerror={$msgerror}");
