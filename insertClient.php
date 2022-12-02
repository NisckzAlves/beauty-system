<?php
$ok = false;
if (isset($_POST["cadastrar"])) {
  include("connection.php");
  $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
  $cpf = isset($_POST["cpf"]) ? $_POST["cpf"] : "";
  $endereco = isset($_POST["endereco"]) ? $_POST["endereco"] : "";
  $telefone = isset($_POST["telefone"]) ? $_POST["telefone"] : "";


  if ($nome != "" && $cpf != "" && $endereco != "" && $telefone != "") {
    $sql  = "INSERT INTO cliente(idCliente, nome, cpf, endereco, telefone) VALUES (null, ? , ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $ok = $stmt->execute([$nome, $cpf, $endereco, $telefone]);
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title> Inserir cliente </title>
  <?php
  include "header.php";
  ?>
</head>

<body>
  <div class="total">

    <div class="subtotal">
      <div class="telinha">
        <h1><a href="listClient.php" style="color:#2F195F; text-decoration: none;"> CLIENTE</a></h1>
        <form method="POST">
          <div class="texto">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Bruna Alves" required>
          </div>
          <div class="texto">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" placeholder="333.123.456-01" required>
          </div>
          <div class="texto">
            <label for="endereco">Endereço</label>
            <input type="text" name="endereco" id="endereco" placeholder="Rua Brasil 45" required>
          </div>
          <div class="texto">
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" placeholder="(18) 99234-5679" required>

          </div>
          <button class="btn-padrao" value="cadastrar" name="cadastrar">Cadastrar</button>
        </form>
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      $("#cpf").mask("000.000.000-00");
      $("#telefone").mask("(00) 00000-0000")
    </script>

    <?php
    if ($ok) {
    ?>
      <script>
        // success error warning info question
        Swal.fire({
          icon: 'success',
          title: 'Sucesso!',
          text: 'Cliente cadastrado com sucesso!',
        })
      </script>
    <?php
    }

    ?>


</body>

</html>