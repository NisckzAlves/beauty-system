<!DOCTYPE html>
<html>

<head>
  <?php
  include "header.php";
  ?>
  <title>Editar atendente</title>
</head>

<?php
include "connection.php";
$ok = false;
$idAtendente = isset($_GET["idAtendente"]) ? $_GET['idAtendente'] : "";

if (!is_numeric($idAtendente)) {
  // Não é um ID Valido =D
  header("Location: listAttendant.php");
}

$stmt = $connection->prepare("SELECT * FROM atendente WHERE idAtendente=:id");
$stmt->bindParam(":id", $idAtendente);
$stmt->execute();

$atendente = $stmt->fetch();
if ($atendente) {
  $nome = $atendente["nome"];
  $cpf = $atendente["cpf"];
  $cargo = $atendente["cargo"];
  $dataNasc = $atendente["dataNasc"];
  $salario = $atendente["salario"];
  $endereco = $atendente["endereco"];
  $email = $atendente["email"];
  $senha = $atendente["senha"];
} else {
  // O Cliente não existe =D
  header("Location: listAttendant.php ");
}

if (isset($_POST["enviar"])) {
  $nome = isset($_POST["nome"]) ? $_POST["nome"] : "";
  $cpf = isset($_POST["cpf"]) ? $_POST["cpf"] : "";
  $cargo = isset($_POST["cargo"]) ? $_POST["cargo"] : "";
  $dataNasc = isset($_POST["dataNasc"]) ? $_POST["dataNasc"] : "";
  $endereco = isset($_POST["endereco"]) ? $_POST["endereco"] : "";
  $email = isset($_POST["email"]) ? $_POST["email"] : "";
  $senha = md5(isset($_POST["senha"]) ? $_POST["senha"] : "");
  $salario = isset($_POST["salario"]) ? $_POST["salario"] : "";



  $mysql_query = "UPDATE atendente SET nome='{$nome}', cpf='{$cpf}',  cargo='{$cargo}', dataNasc='{$dataNasc}', salario='{$salario}',endereco='{$endereco}' WHERE idAtendente={$idAtendente}";
  $stmt = $connection->prepare($mysql_query);
  $ok = $stmt->execute();
}
// Connection Close	
?>

<body>
  <div class="total">
    <div class="subtotal">
      <div class="telinha">
        <h1>ALTERAR ATENDENTE</h1>
        <form method="POST">
          <div class="texto">
            <input type="hidden" name="id" value="<?= $row['id']; ?>">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Bruna Alves" value="<?= $nome ?>" required>
          </div>
          <div class="texto">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" placeholder="333.123.456-01" value="<?= $cpf ?>" required>
          </div>
          <div class="texto">
            <label for="salario">Salário</label>
            <input type="number" name="salario" id="salario" step="0.2" value="<?= $salario ?>" required>
          </div>
          <div class="texto">
            <label for="cpf">Endereço</label>
            <input type="text" name="endereco" id="endereco" placeholder="Avenida brasil, 121" value="<?= $endereco ?>" required>
          </div>
          <div class="texto">
            <label for="dataNasc">Data Nascimento</label>
            <input type="date" name="dataNasc" id="dataNasc" placeholder="(18) 99234-5679" value="<?= $dataNasc ?>" required> <br>
            <label for="cargo">Cargo</label>
          </div>

          <div class="radio">
            <input type="radio" id="adm" name="cargo" value="administrador">
            <label for="adm">Administrador</label>
            <label for="atd">Atendente</label>
            <input type="radio" id="atd" name="cargo" value="atendente">
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
          text: 'Atendente alterado com sucesso!',
        })
      </script>
    <?php
    }
    ?>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
      $("#cpf").mask("000.000.000-00");
      $("#telefone").mask("(00) 00000-0000")
    </script>
  </div>
</body>

</html>