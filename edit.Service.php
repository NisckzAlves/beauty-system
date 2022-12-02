<!DOCTYPE html>
<html>

<head>
  <?php
  include "header.php";
  ?>
  <title>Editar servico</title>
</head>

<?php
include "connection.php";
$ok = false;
$idServico = isset($_GET["idServico"]) ? $_GET['idServico'] : "";

if (!is_numeric($idServico)) {
  // Não é um ID Valido =D
  header("Location: listServico.php");
}

$stmt = $connection->prepare("SELECT * FROM servico WHERE idServico=:id");
$stmt->bindParam(":id", $idServico);
$stmt->execute();

$servico = $stmt->fetch();
if ($servico) {
  $nome = $servico["nome"];
  $valor = $servico["valor"];
} else {
  // O Cliente não existe =D
  header("Location: listService.php ");
}

if (isset($_POST["enviar"])) {
  $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
  $valor = isset($_POST["valor"]) ? $_POST["valor"] : "";


  $mysql_query = "UPDATE servico SET nome='{$nome}', valor='{$valor}' WHERE idServico={$idServico}";
  $stmt = $connection->prepare($mysql_query);
  $ok = $stmt->execute();
}
// Connection Close	
?>

<body>
  <div class="total">

    <div class="subtotal">
      <div class="telinha">
        <h1>ATUALIZAR SERVIÇO</h1>
        <form method="POST">
          <input type="hidden" name="id" value="<?= $row['id']; ?>">
          <div class="texto">
            <label for="nome">Nome</label>
            <input type="text" value="<?= $nome ?>" name="nome" id="nome" placeholder="Maquiagem artistica" required>
          </div>
          <div class="texto">
            <label for="valor">Valor</label>
            <input type="number" value="<?= $valor ?>" name="valor" id="valor" step=".02" placeholder="109.99" required>
          </div>
          <button class="btn-padrao" value="enviar" name="enviar">Alterar</button>
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
          text: 'Serviço alterado com sucesso!',
        })
      </script>
    <?php
    }
    ?>
  </div>
</body>

</html>