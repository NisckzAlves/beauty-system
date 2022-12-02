<?php
// Initialize the session
session_start();

if (isset($_GET['idNota'])) {
    $id = $_GET['idNota'];

    require_once('connection.php');

    // Mysql query to delete record from table
    $mysql_query = "DELETE FROM notas WHERE idNota=$id";

    if ($connection->query($mysql_query) === TRUE) {
        $msg = "delete success";
        $msgerror = "";
    }

} else {
    $msg =  "delete error";
    $msgerror =  "O ID não foi informado!";
}

header("Location:Notes.php?msg={$msg}&msgerror={$msgerror}");
?>