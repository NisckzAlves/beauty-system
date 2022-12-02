<?php
require_once('connection.php');

$data = isset($_GET["data"]) ? $_GET["data"] : "";
if ($data == "") {
  $consulta = $connection->query("SELECT agendamento.*, (cliente.nome) as clienteNome, (servico.nome) as servicoNome, (servico.valor) as servicoValor FROM agendamento INNER JOIN cliente ON cliente.idCliente = agendamento.idCliente INNER JOIN servico ON servico.idServico = agendamento.idServico;");
} else {
  $consulta = $connection->query("SELECT agendamento.*, (cliente.nome) as clienteNome, (servico.nome) as servicoNome, (servico.valor) as servicoValor FROM agendamento INNER JOIN cliente ON cliente.idCliente = agendamento.idCliente INNER JOIN servico ON servico.idServico = agendamento.idServico;");
}
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
        <a href="listScheduling.php">
          <button type="button" class="btn-cadastrar">
            Agenda do dia
          </button>
        </a>
        <input type="text" id="search" name="search" placeholder="Buscar  ">
      </div> <br>

      <h4>Agenda </h4> <br>

      <div class="tabelinha">
        <table id="table">
          <tr class="table-title">
            <td>Nome cliente</td>
            <td>Serviço</td>
            <td>Valor</td>
            <td>Data</td>
            <td>Horario</td>
            <td>Pagamento</td>
            <td>Ação</td>
          </tr>
          <?php
          while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
          ?>
            <tr></tr>

            <td><?php echo $linha['clienteNome']; ?></td>
            <td><?php echo $linha['servicoNome']; ?></td>
            <td>R$ <?php echo number_format($linha['servicoValor'], 2, ",", "."); ?></td>
            <td><?php echo date('d/m/Y', strtotime($linha['data'])); ?></td>
            <td><?php echo $linha['hora']; ?></td>
            <td><?php echo $linha['tipoPagamento']; ?></td>
            <td>
              <a href="editScheduling.php?idAgendamento=<?php echo $linha['idAgendamento']; ?>">
                <button type="button" class="btn-editar">
                  Editar
                </button>
              </a>
              <button type="button" class="btn-excluir" onclick="excluir(
                <?php echo $linha['idAgendamento']; ?>
              )">
                Excluir
              </button>
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
          text: "Exluir este agendamento?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: "Não",
          confirmButtonText: 'Sim!'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `deleteScheduling.php?idAgendamento=${id}`;
          }
        })
      }

      $("#search").keyup(function() {
        var value = this.value.toLowerCase().trim();
        $("#table tr").each(function(index) {
          if (!index) return;
          $(this).find("td").each(function() {
            var id = $(this).text().toLowerCase().trim();
            var not_found = (id.indexOf(value) == -1);
            $(this).closest('tr').toggle(!not_found);
            return not_found;
          });
        });
      })
    </script>
  </div>
</body>

</html>