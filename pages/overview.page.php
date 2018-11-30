<?php
include 'inc/mysql.php';

function section(){ ?>
<h1 class="title">Oversigt</h1>
<table class="table">
    <thead>
      <tr>
        <th>Vare</th>
        <th>Billede</th>
        <th>Pris</th>
        <th>Antal</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $conn = new_conn();
        $query = $conn->query('SELECT `id`, `name`, `price`, `img_file`, `stock` FROM vare');
        $vareArray = $query->fetch_all();

        for ($i=0; $i < count($vareArray); $i++) {
          $id = $vareArray[$i][0];
          $name = $vareArray[$i][1];
          $pris = $vareArray[$i][2];
          $img = $vareArray[$i][3];
          $stock = $vareArray[$i][4];

          echo "<tr>";
          echo "<td>$name</td>";
          echo "<td><img src=\"/img/$img\" class=\"image is-64x64\"></td>";
          echo "<td>$pris</td>";
          echo "<td>$stock</td>";
          echo "<td><a class=\"button\" href=\"/order.php?id=$id\">Tilføj vare</a></td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
<?php }

function title(){
  echo "Bestil Din Mad - Oversigt";
}
?>
