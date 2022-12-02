<?php
require_once('connection.php');
$consulta = $connection->query("SELECT * FROM atendente;");
?>
<!DOCTYPE html>
<html>

<head>
  <?php
  include "header.php";
  ?>
  <title>Atendentes</title>
</head>


<body>
  <div class="total">
    <div class="telinha">
      <div class="total-opcoes">
        <a href="insertAttendant.php">
          <button type="button" class="btn-cadastrar">
            Novo Atendente
          </button>
        </a>
        <input type="text" id="search" name="search" placeholder="Buscar  ">
      </div> <br>

      <h4>Atendentes</h4> <br>

      <div class="tabelinha">
        <table id="table">
          <tr class="table-title">
            <table id="table">
              <tr class="table-title">
                <td>Nome</td>
                <td>CPF</td>
                <td>Cargo</td>
                <td>Data Nascimento</td>
                <td>Endereço</td>
                <td>Email</td>
                <td>Ação</td>
              </tr>
              <?php
              while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
              ?>
                <tr></tr>
                <td><?php echo $linha['nome']; ?></td>
                <td><?php echo $linha['cpf']; ?></td>
                <td><?php echo $linha['cargo']; ?></td>
                <td><?php echo date('d/m/Y', strtotime($linha['dataNasc'])); ?></td>
                <td><?php echo $linha['endereco']; ?></td>
                <td><?php echo $linha['email']; ?></td>
                <td>
                  <a href="editAttendant.php?idAtendente=<?php echo $linha['idAtendente']; ?>">
                    <button type="button" class="btn-editar"> Editar </button> </a>
                  <button type="button" class="btn-excluir" onclick="excluir(<?php echo $linha['idAtendente']; ?>)">Excluir </button>
                </td>
          </tr>
        <?php
              }
        ?>
        </table>
      </div>
      <script>
        function excluir(id) {
          Swal.fire({
            title: 'Tem certeza?',
            text: "Excluir esse atendente é uma ação irreverssivel!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "Não",
            confirmButtonText: 'Sim!'
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = `deleteAttendant.php?idAtendente=${id}`;
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