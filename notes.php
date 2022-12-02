<!DOCTYPE html>
<html>
<head>
  <?php
  include "header.php";
  ?>
  <title>Notas</title>
  <style>
    .nota {
      padding: 30px 35px;
      background: #a18ad3;
      border-radius: 50px;
      box-shadow: 0px 10px 40px rgba(8, 8, 8, 0.719);
      color: white;
    }
  </style>
</head>

<body>
  <div class="total">
    <?php
    require_once('connection.php');
    $idAtendente = $_SESSION["idAtendente"];
    $consulta = $connection->prepare("SELECT idNota, nome, descricao, status, idAtendente FROM notas WHERE idAtendente=:id");
    $consulta->bindParam(":id", $idAtendente);
    $consulta->execute();
    ?>
    <br>
    <div style="text-align: center;">
      <a href="insertNotes.php"> <button class="btn-editar" style="width:300px; height: 50px;">Adicionar nota</button></a>
      <br><br>
      <div class="container">
        <div class="row" style="gap: 16px; justify-content: center;">
          <?php
          while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
          ?>
            <div class="col-md-3 nota" style="width: 300px;">
              <h2> <?php echo $linha['nome']; ?><br></h2>
              <p>
                <?php echo $linha['descricao']; ?><br>

              </p>Status: <?php echo $linha['status'] ?> <br> <br>
              <a href="editNotes.php?idNota=<?php echo $linha['idNota']; ?>">
                <button type="button" class="btn-editar">Editar</button></a>
              <button type="button" class="btn-excluir" onclick="excluir(<?php echo $linha['idNota']; ?>)">Excluir</button>
            </div>
          <?php } ?>
        </div>
        <script>
          function excluir(id) {
            Swal.fire({
              title: 'Tem certeza?',
              text: "Exluir esta nota?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              cancelButtonText: "Não",
              confirmButtonText: 'Sim!'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = `deleteNotes.php?idNota=${id}`;
              }
            })
          }
        </script>
      </div>
    </div>
  </div>
</body>

</html>