<?php
// Initialize the session
session_start();

if (isset($_GET['idAtendente'])) {
    $id = $_GET['idAtendente'];

    require_once('connection.php');

    // Mysql query to delete record from table
    $mysql_query = "DELETE FROM atendente WHERE idAtendente=$id";

    if ($connection->query($mysql_query) === TRUE) {
        $msg = "delete success";
        $msgerror = "";
    }

} else {
    $msg =  "delete error";
    $msgerror =  "O ID não foi informado!";
}

header("Location:listAttendant.php?msg={$msg}&msgerror={$msgerror}");
