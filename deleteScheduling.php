<?php
// Initialize the session
session_start();

if (isset($_GET['idAgendamento'])) {
    $id = $_GET['idAgendamento'];

    require_once('connection.php');

    // Mysql query to delete record from table
    $mysql_query = "DELETE FROM agendamento WHERE idAgendamento=$id";

    if ($connection->query($mysql_query) === TRUE) {
        $msg = "delete success";
        $msgerror = "";
    }

} else {
    $msg =  "delete error";
    $msgerror =  "O ID não foi informado!";
}

header("Location:listSchedulingComplet.php?msg={$msg}&msgerror={$msgerror}");
