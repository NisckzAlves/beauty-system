<!DOCTYPE html>
<html>

<head>
  <?php
  include "header.php";
  ?>
  <title>Configuração do perfil</title>
</head>


<body>
  <div class="total">

    <?php
    include "connection.php";
    $ok = false;
    $idAtendente = isset($_GET["idAtendente"]) ? $_GET['idAtendente'] : "";
    $idAtendente = $_SESSION["idAtendente"];
    if (isset($_POST["enviar"])) {
      $senhaAtual = isset($_POST["senhaAtual"]) ? $_POST["senhaAtual"] : "";
      $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
      $senha2 = isset($_POST["senha2"]) ? $_POST["senha2"] : "";
      if ($senha == $senha2) {
        $sql = "SELECT * from atendente where idAtendente='$idAtendente' and senha=md5('$senhaAtual')";
        $stmt = $connection->prepare($sql);
        $stmt->execute();
        $ok = $stmt->fetch();
        if ($ok) {
          $stmt = $connection->prepare("UPDATE atendente SET senha=md5('$senha') WHERE idAtendente='$idAtendente'");
          $msg = $stmt->execute() ? "OK" : "Erro ao alterar senha";
        } else {
          if ($ok == false) {
    ?>
            <script>
              // success error warning info question
              Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: 'Senha incorreta',
              })
            </script>
          <?php
          }
        }
      } else {
        if ($ok == false) {
          ?>
          <script>
            // success error warning info question
            Swal.fire({
              icon: 'error',
              title: 'Erro!',
              text: 'Senhas divergentes',
            })
          </script>
    <?php
        }
      }
    }
    // Connection Close	
    ?>
    <form method="post">
      <div style="width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;">
        <div class="subtotal">
          <div class="telinha">
            <h1>Deseja alterar sua senha?</h1>
            <form method="POST" style="width:100%;">
              <input type="hidden" name="id" value="">
              <div class="texto">
                <label for="senha">Senha atual</label>
                <input type="password" name="senhaAtual" id="senhaAtual" value="" required> <br>
              </div>

              <div class="texto">
                <label for="senha">Nova senha</label>
                <input type="password" name="senha" id="senha" value="" required> <br>
              </div>

              <div class="texto">
                <label for="senha">Confirme sua senha</label>
                <input type="password" name="senha2" id="senha2" value="" required> <br>
              </div>

              <button class="btn-padrao" value="enviar" name="enviar">Alterar</button>
            </form>
          </div>
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
            text: 'Senha alterada com sucesso',
          })
        </script>
      <?php
      }

      ?>

  </div>
</body>

</html>