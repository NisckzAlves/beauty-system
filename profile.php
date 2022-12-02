<!DOCTYPE html>
<html>

<head>
  <?php
  include "header.php";
  $vetImg = [
    "miaumiau.jpg",
    "miaul.jpg",
    "mials.jpg",
    "miau2.jpg",
    "miau3.jpg",
    "miau4.jpg",
    "miau6.jpg",
    "lua.jpg",
    "gatoau.jpg",
    "dog.jpg"
  ];
  $rand = rand(0, count($vetImg) - 1);
  $imagem = $vetImg[$rand];
  ?>
  <title>Perfil</title>
</head>

<body>
  <div class="total">
    <?php
    include "connection.php";
    $idAtendente = $_SESSION["idAtendente"];
    $stmt = $connection->prepare("SELECT * FROM atendente where idAtendente=$idAtendente;");
    $stmt->execute();
    $consulta = $stmt->fetch();
    ?>
    <div class="subtotal">
      <div class="telinha">
        <h1>Perfil</h1> <br>
        <img src="<?= $imagem ?>" alt="Perfil" class="miau">
        <p>@<?php echo $consulta['nome']; ?></p>
        <form>
          <div class="texto">
            <label for="senha">Email</label>
            <input type="text" value="<?php echo $consulta['email']; ?>" disabled> <br>
          </div>

          <div class="texto">
            <label for="senha">CPF</label>
            <input type="text" value="<?php echo $consulta['cpf']; ?>" disabled> <br>
          </div>

          <div class="texto">
            <label for="senha">Cargo</label>
            <input type="text" value="<?php echo $consulta['cargo']; ?>" disabled> <br>
          </div>

          <div class="textoLink">
            <p><a href="editProfile.php"> Deseja trocar sua senha?</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>