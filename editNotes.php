<!DOCTYPE html>
<html>

<head>
  <?php
  include "header.php";
  ?>
  <title>Editar nota</title>
</head>

<?php
include "connection.php";

$idNota = isset($_GET["idNota"]) ? $_GET['idNota'] : "";

if (!is_numeric($idNota)) {
  // Não é um ID Valido =D
  header("Location: notes.php");
}

$stmt = $connection->prepare("SELECT * FROM notas WHERE idNota=:id");
$stmt->bindParam(":id", $idNota);
$stmt->execute();

$nota = $stmt->fetch();
if ($nota) {
  $nome = $nota["nome"];
  $descricao = $nota["descricao"];
  $status = $nota["status"];
} else {
  // O Cliente não existe =D
  header("Location: notes.php ");
}

if (isset($_POST["enviar"])) {
  $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
  $descricao = isset($_POST["descricao"]) ? $_POST["descricao"] : "";
  $status = isset($_POST["status"]) ? $_POST["status"] : "";

  $mysql_query = "UPDATE notas SET nome='{$nome}', descricao='{$descricao}',  status='{$status}' WHERE idNota={$idNota}";
  $stmt = $connection->prepare($mysql_query);
  $stmt->execute();
}
// Connection Close	
?>

<body>
  <div class="total">
    <form method="post">
      <div class="subtotal">
        <div class="telinha">
          <h1>ALTERAR NOTA</h1>
          <form method="POST">
            <input type="hidden" name="idNota" id="idNota" value="<?= $idNota ?>">
            <div class="texto">
              <label for="nome">Nome</label>
              <input type="text" name="nome" id="nome" placeholder="" value="<?= $nome ?>" required>
            </div>
            <div class="texto">
              <label for="descricao">Descrição</label>
              <textarea style="resize:none; border: none;
              border-radius: 10px;
              padding: 15px;
              background: #6b5896;
              color: rgb(255, 215, 203);
              box-shadow: 0px 10px 40px rgba(8, 8, 8, 0.719);
              box-sizing: border-box;" cols="43" rows="10" name="descricao" id="descricao" required><?= $descricao ?></textarea>
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
                <option value="Não iniciado" <?php if ($status == "Não iniciado") {
                                                echo "selected";
                                              } ?>>Não iniciado</option>
                <option value="Em andamento" <?php if ($status == "Em andamento") {
                                                echo "selected";
                                              } ?>>Em andamento</option>
                <option value="Concluído" <?php if ($status == "Concluído") {
                                            echo "selected";
                                          } ?>>Concluído</option>
              </select>
            </div>
            <button class="btn-padrao" value="enviar" name="enviar">Alterar</button>
          </form>
        </div>
      </div>
      </script>
</body>

</html>