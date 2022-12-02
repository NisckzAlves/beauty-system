<?php
$ok = false;
include("connection.php");
if (isset($_POST["cadastrar"])) {
  $data = isset($_POST["data"]) ? $_POST["data"] : "";
  $hora = isset($_POST["hora"]) ? $_POST["hora"] : "";
  $status = isset($_POST["status"]) ? $_POST["status"] : "";
  $pagamento = isset($_POST["tipoPagamento"]) ? $_POST["tipoPagamento"] : "";
  $cliente = isset($_POST["idCliente"]) ? $_POST["idCliente"] : "";
  $servico = isset($_POST["idServico"]) ? $_POST["idServico"] : "";
  if ($data != "" && $hora != "" && $status != "" && $pagamento != "" && $cliente != "" && $servico != "") {
    $sql  = "INSERT INTO `agendamento` (`idAgendamento`, `data`, `hora`, `status`, `tipoPagamento`, `idCliente`, `idServico`) VALUES (null, ?,?,?, ?, ?, ?)";

    //"INSERT INTO agendamento(idAgendamento, data, hora, status, tipoPagamento, idCliente, idServico) VALUES (null, ?,?,?, ?, ?, ?)";
    $stmt = $connection->prepare($sql);
    $ok = $stmt->execute([$data, $hora, $status, $pagamento, $cliente, $servico]);
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Inserir agendamento</title>
  <?php
  include "header.php";
  ?>
</head>

<body>
  <div class="total">
    <div class="subtotal">
      <div class="telinha">
        <h1> Agendamentos </h1>
        <form method="POST" style="width:100%;">
          <div class="texto">
            <label for="data">Data</label>
            <input type="date" name="data" id="data" placeholder="01/01/2001" required>
          </div>

          <div class="texto">
            <label for="hora">Hora</label>
            <input type="time" name="hora" id="hora" required>
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
              <option value="Não iniciado">Não iniciado</option>
              <option value="Em andamento">Em andamento</option>
              <option value="Concluído">Concluído</option>
            </select>

          </div>
          <div class="texto">
            <label for="status">Pagamento</label>

            <select id="tipoPagamento" name="tipoPagamento" style="width: 100%;
            border: none;
            border-radius: 10px;
            padding: 15px;
            background: #6b5896;
            color: rgb(255, 215, 203);
            font-size: 12pt;
            box-shadow: 0px 10px 40px rgba(8, 8, 8, 0.719);
            box-sizing: border-box;" required>
              <option value="Dinheiro">Dinheiro</option>
              <option value="Cartão de crédito">Cartão de crédito</option>
              <option value="Cartão de debito">Cartão de debito</option>
              <option value="Pix">Pix</option>
              <option value="Cheque">Cheque</option>
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
                <option value='<?= $row["idCliente"] ?>'> <?= $row["nome"] ?></option>
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
                <option value='<?= $row["idServico"] ?>'> <?= $row["nome"] ?></option>
              <?php
              }
              ?>
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
          text: 'Novo agendamento adicionado',
        })
      </script>
    <?php
    }

    ?>

  </div>
</body>

</html>