  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <title>Menu</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="shortcut icon" href="favicon.ico" />


<?php
session_start();

if ($_SESSION["idAtendente"] == null) {
  header("Location: index.php");
}

?>
<section>
  <nav>
    <ul class="menuItems">
      <li>
        <a href="#"><img src="profile.png" width="25px" class="imgMenu"></a>
        <ul>
        <li><a href="profile.php">Perfil</a></li>
	      <li><a href="message.php">Dúvidas e Sugestões</a></li>
        <?php
      if ($_SESSION['cargo'] == 'administrador') {
      ?>
        <li><a href='consultMessage.php'>Consultar</a></li>

      <?php
      }
      ?>
        </ul>
      </li>
      <li><a href='home.php'>Home</a></li>
      <li><a href='listClient.php'>Clientes</a></li>
      <?php
      if ($_SESSION['cargo'] == 'administrador') {
      ?>
        <li><a href='listAttendant.php'>Atendentes</a></li>

      <?php
      }
      ?>
      <li><a href='listSchedulingComplet.php'>Agendamentos</a></li>
      <li><a href='notes.php'>Notas</a></li>
      <li><a href='listService.php'>Serviços</a></li>
      <li><a href='logout.php'>Sair</a></li>
    </ul>
  </nav>
</section>
