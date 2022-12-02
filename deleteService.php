<?php
// Initialize the session
session_start();

if (isset($_GET['idServico'])) {
    $id = $_GET['idServico'];

    require_once('connection.php');

    // Mysql query to delete record from table
    $mysql_query = "DELETE FROM servico WHERE idServico=$id";

    if ($connection->query($mysql_query) === TRUE) {
        $msg = "delete success";
        $msgerror = "";
    }

} else {
    $msg =  "delete error";
    $msgerror =  "O ID não foi informado!";
}

header("Location:listService.php?msg={$msg}&msgerror={$msgerror}");
?>