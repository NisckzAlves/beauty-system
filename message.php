<!DOCTYPE html>
<html lang="en">

<head>
  <title>Reclamações</title>
  <?php
  include "header.php";
  ?>
  <?php
  $ok = false;
  include("connection.php");
  if (isset($_POST["cadastrar"])) {
    $tipo = isset($_POST["tipo"]) ? $_POST["tipo"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
    $atendente = isset($_POST["idAtendente"]) ? $_POST["idAtendente"] : "";
    if ($tipo != "" && $email != "" && $descricao != "" && $atendente != "") {
      $sql = "INSERT INTO `mensagem` (`idMensagem`, `idAtendente`, `tipo`, `email`, `descricao`) VALUES (NULL, ?,?,?,?)";
      $stmt = $connection->prepare($sql);
      $ok = $stmt->execute([$atendente, $tipo, $email, $descricao]);
    }
  }

  ?>
</head>

<body>
  <div class="total">
    <div class="subtotal">
      <div class="telinha">
        <h1> Dúvidas ou sugestões </h1>
        <form method="POST" style="width:100%;">
          <div class="texto">
            <input type="hidden" name="idAtendente" id="idAtendente" value="<?= $idAtendente = $_SESSION["idAtendente"]; ?>">
            <select id="tipo" name="tipo" style="width: 100%;
          border: none;
          border-radius: 10px;
          padding: 15px;
          background: #6b5896;
          color: rgb(255, 215, 203);
          font-size: 12pt;
          box-shadow: 0px 10px 40px rgba(8, 8, 8, 0.719);
          box-sizing: border-box;" required>
              <option value="Sugestões">Sugestões</option>
              <option value="Dúvidas">Dúvidas</option>
              <option value="Elogios">Elogios</option>
            </select>
          </div>

          <div class="texto">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
          </div>
          <div class="texto">
            <label for="descricao">Descrição</label>
            <textarea style="resize:none; border: none;
            border-radius: 10px;
            padding: 15px;
            background: #6b5896;
            color: rgb(255, 215, 203);
            box-shadow: 0px 10px 40px rgba(8, 8, 8, 0.719);
            box-sizing: border-box;" cols="42" rows="10" name="descricao" id="descricao" required></textarea>
          </div>

          <button class="btn-padrao" value="cadastrar" name="cadastrar">Cadastrar</button>
        </form>
      </div>
    </div>

    <?php
    if ($ok) {
    ?>
      <script>
        // success error warning info question
        Swal.fire({
          icon: 'success',
          title: 'Sucesso!',
          text: 'Nova dúvida ou sugestões registradas, um administrador poderá conferir.',
        })
      </script>
    <?php
    }

    ?>

  </div>
</body>

</html>