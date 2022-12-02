<?php
require_once('connection.php');
$consulta = $connection->query("SELECT mensagem.*, (atendente.nome) as atendenteNome from mensagem INNER JOIN atendente ON atendente.idAtendente = mensagem.idAtendente;");

?>
<!DOCTYPE html>
<html>

<head>
  <?php
  include "header.php";
  ?>
  <title>Agendamentos</title>
</head>

<body>
  <div class="total">
    <div class="telinha" style="display: inline-block;">
      <div class="total-opcoes">
      </div> <br>

      <h4>Dúvidas e sugestões de usuários</h4> <br>

      <div class="tabelinha">
        <table id="table">
          <tr class="table-title">
            <td>Nome atendente</td>
            <td>Email</td>
            <td>Tipo</td>
            <td>Descrição</td>
            <td>Ação</td>
          </tr>
          <?php
          while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
          ?>
            <tr></tr>

            <td><?php echo $linha['atendenteNome']; ?></td>
            <td><?php echo $linha['email']; ?></td>
            <td><?php echo $linha['tipo']; ?></td>
            <td><?php echo $linha['descricao']; ?></td>
            <td>
              </a>
              <button type="button" class="btn-excluir" onclick="excluir(
                <?php echo $linha['idMensagem']; ?>)">
                Excluir
              </button>
            </td>
            </td>
            </tr>
          <?php
          }
          ?>
        </table>
      </div>
    </div>
    <script>
      function excluir(id) {
        Swal.fire({
          title: 'Tem certeza?',
          text: "Exluir esta dúvida ou sugestão?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: "Não",
          confirmButtonText: 'Sim!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `deleteMessege.php?idMensagem=${id}`;
          }
        })
      }
    </script>
  </div>
</body>

</html>