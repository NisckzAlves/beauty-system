<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <title>Menu</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="shortcut icon" href="favicon.ico" />
</head>

<body>
  <div class="total-login">

    <?php
    session_start();
    if (isset($_SESSION["idAtendente"])) {
      header("Location:home.php");
    } // Verifica se foi feito login


    if (isset($_POST)) {
      $ok = false;
      include("connection.php");
      $email = isset($_POST["email"]) ? $_POST["email"] : "";
      $senha = isset($_POST["senha"]) ? $_POST["senha"] : "";
      // varivel = condicao ? valor verdadeiro : valor falso;

      if ($email != "" && $senha != "") {

        // Prepara o SELECT
        $stmt = $connection->prepare("SELECT * FROM atendente WHERE email=:email AND senha=md5(:senha)"); // "=?" para 
        $stmt->bindParam(':email', $email);                                                         // evitar que manipulem senha.
        $stmt->bindParam(':senha', $senha);                                                         // evitar que manipulem senha.
        $stmt->execute();
        $stmt->execute();
        $user = $stmt->fetch();
        // fetch = Buscar

        if (isset($user["idAtendente"])) {
          $_SESSION["idAtendente"] = $user["idAtendente"];
          $_SESSION["cargo"] = $user["cargo"];
          $_SESSION["nome"] = $user["nome"];
          echo "OK";
          header("Location:home.php");
        } else {
    ?>
          <script>
            // success error warning info question
            Swal.fire({
              icon: 'error',
              title: 'Erro!',
              text: 'Login ou senha invalidos',
            })
          </script>
    <?php

        }
      }
    }


    ?>


    <div class="subtotal">
      <div class="telinha">
        <h1>LOGIN</h1>
        <br>
        <form method="POST">
          <div class="texto">
            <input type="email" name="email" id="email" placeholder="E-mail" required>
          </div>
          <br>
          <div class="texto">
            <input type="password" name="senha" id="senha" placeholder="Senha" required>
          </div>
          <input id="botao" type="submit" class="btn-padrao" value="Entrar">
        </form>
      </div>
    </div>
  </div>


</body>

</html>