<?php
$ok = false;
if (isset($_POST["cadastrar"])) {
  include("connection.php");
  $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
  $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
  $status = isset($_POST["status"]) ? $_POST["status"] : "";
  $atendente = isset($_POST["atendente"]) ? $_POST["atendente"] : "";

  if ($nome != "" && $descricao != "" && $status != "" && $atendente != "") {
    $sql  = "INSERT INTO notas(idNota, nome, descricao, status, idAtendente) VALUES (null, ? , ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $ok = $stmt->execute([$nome, $descricao, $status, $atendente]);
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <title> Inserir notas</title>
  <?php
  include "header.php";
  ?>
</head>

<body>
  <div class="total">
    <div class="subtotal">
      <?php
      $idAtendente = $_SESSION['idAtendente'];
      ?>
      <div class="telinha">
        <h1>Notas</h1>
        <form method="POST">
          <div class="texto">
            <input type="hidden" name="atendente" id="atendente" value="<?= $idAtendente ?>">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Realizar cadastro" required>
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
          <div class="texto">
            <label for="status">Status</label>
            <select id="status" name="status" style="width: 100%;
            border: none;
            border-radius: 10px;
            padding: 15px;
            background: #6b5896;
            color: rgb(255, 215, 203);
            box-shadow: 0px 10px 40px rgba(8, 8, 8, 0.719);
            box-sizing: border-box;" required>
              <option value="Não iniciado">Não iniciado</option>
              <option value="Em andamento">Em andamento</option>
              <option value="Concluído">Concluído</option>
            </select>
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
        text: 'Nova nota adicionada',
      })
    </script>
  <?php
  }

  ?>

  </div>
</body>

</html>