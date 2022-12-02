<?php
$ok = false;
include "connection.php";
$idAgendamento = isset($_GET["idAgendamento"]) ? $_GET['idAgendamento'] : "";

if (!is_numeric($idAgendamento)) {
  // Não é um ID Valido =D
  header("Location: listScheduling.php");
}

$stmt = $connection->prepare("SELECT * FROM agendamento WHERE idAgendamento=:id");
$stmt->bindParam(":id", $idAgendamento);
$stmt->execute();

$agen = $stmt->fetch();
if ($agen) {
  $data = $agen["data"];
  $hora = $agen["hora"];
  $status = $agen["status"];
  $pagamento = $agen["tipoPagamento"];
  $cliente = $agen["idCliente"];
  $servico = $agen["idServico"];
} else {
  // O Cliente não existe =D
  header("Location: listSchedulingComplet.php ");
}
if (isset($_POST["alterar"])) {
  $data = isset($_POST["data"]) ? $_POST["data"] : "";
  $hora = isset($_POST["hora"]) ? $_POST["hora"] : "";
  $status = isset($_POST["status"]) ? $_POST["status"] : "";
  $pagamento = isset($_POST["tipoPagamento"]) ? $_POST["tipoPagamento"] : "";
  $cliente = isset($_POST["idCliente"]) ? $_POST["idCliente"] : "";
  $servico = isset($_POST["idServico"]) ? $_POST["idServico"] : "";
  if ($data != "" && $hora != "" && $status != "" && $pagamento != "" && $cliente != "" && $servico != "") {
    //$mysql_query = "UPDATE notas ;
    $sql  = "UPDATE agendamento SET data='{$data}', hora='{$hora}',  status='{$status}', tipoPagamento='{$pagamento}', idCliente='{$cliente}',  idServico='{$servico}' WHERE idAgendamento={$idAgendamento}";
    $stmt = $connection->prepare($sql);
    $ok = $stmt->execute();
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title> Editar agendamento</title>
  <?php
  include "header.php";
  ?>
</head>

<body>
  <div class="total">
    <div class="subtotal">
      <div class="telinha">
        <h1> Agendamentos </h1>
        <form method="POST">
          <div class="texto">
            <label for="data">Data</label>
            <input type="date" name="data" id="data" placeholder="01/01/2001" value="<?= $data ?>" required>
          </div>

          <div class="texto">
            <label for="hora">Hora</label>
            <input type="time" name="hora" id="hora" value="<?= $hora ?>" required>
          </div>
          <div class="texto">
            <label for="status">Status</label>
            <select id="status" name="status" style="width: 100%;
            border: none;
            border-radius: 10px;
            padding: 15px;
            background: #6b5896;
            color: rgb(255, 215, 203);
            font-size: 12pt;
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
          <div class="texto">
            <label for="status">Pagamento</label>
            <!-- <input type="text" name="tipoPagamento" id="tipoPagamento" value="<?= $pagamento ?>"required> -->
            <select id="tipoPagamento" name="tipoPagamento" style="width: 100%;
            border: none;
            border-radius: 10px;
            padding: 15px;
            background: #6b5896;
            color: rgb(255, 215, 203);
            font-size: 12pt;
            box-shadow: 0px 10px 40px rgba(8, 8, 8, 0.719);
            box-sizing: border-box;" required>
              <option value="Dinheiro" <?php if ($pagamento == "Dinheiro") {
                                          echo "selected";
                                        } ?>>Dinheiro</option>
              <option value="Cartão de crédito" <?php if ($pagamento == "Cartão de crédito") {
                                                  echo "selected";
                                                } ?>>Cartão de crédito</option>
              <option value="Cartão de debito" <?php if ($pagamento == "Cartão de debito") {
                                                  echo "selected";
                                                } ?>>Cartão de debito</option>
              <option value="Pix" <?php if ($pagamento == "Pix") {
                                    echo "selected";
                                  } ?>>Pix</option>
              <option value="Cheque" <?php if ($pagamento == "Cheque") {
                                        echo "selected";
                                      } ?>>Cheque</option>
            </select>

            </select>
          </div>
          <div class="texto">
            <label for="cliente">Cliente</label>
            <select name="idCliente" id="idCliente" style="width: 100%;
            border: none;
            border-radius: 10px;
            padding: 15px;
            background: #6b5896;
            color: rgb(255, 215, 203);
            font-size: 12pt;
            box-shadow: 0px 10px 40px rgba(8, 8, 8, 0.719);
            box-sizing: border-box;" required>
              <?php
              $stmt = $connection->prepare("SELECT * FROM cliente");
              $stmt->execute();
              foreach ($stmt->fetchAll() as $row) {
              ?>
                <option value='<?= $row["idCliente"] ?>' <?php if ($row["idCliente"] == $cliente) {
                                                            echo "selected";
                                                          } ?>> <?= $row["nome"] ?></option>
              <?php
              }
              ?>
            </select>
          </div>
          <div class="texto">
            <label for="servico">Serviço</label>
            <select name="idServico" id="idServico" style="width: 100%;
            border: none;
            border-radius: 10px;
            padding: 15px;
            background: #6b5896;
            color: rgb(255, 215, 203);
            font-size: 12pt;
            box-shadow: 0px 10px 40px rgba(8, 8, 8, 0.719);
            box-sizing: border-box;" required>
              <?php
              $stmt = $connection->prepare("SELECT * FROM servico");
              $stmt->execute();
              foreach ($stmt->fetchAll() as $row) {
              ?>
                <option value='<?= $row["idServico"] ?>' <?php if ($row["idServico"] == $servico) {
                                                            echo "selected";
                                                          } ?>> <?= $row["nome"] ?></option>
              <?php
              }
              ?>
            </select>
          </div>

          <button class="btn-padrao" value="alterar" name="alterar">Alterar</button>
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
          text: 'Agendamento alterado com sucesso!',
        })
      </script>
    <?php
    }

    ?>

  </div>
</body>

</html>