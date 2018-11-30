<?php
include 'inc/mysql.php';
//vi inkludere php siden som opretter forbindelse til databasen

function section(){
  $loggedIn = isset($_SESSION['id']);
?>
<!--//tjekker om brugeren er logget ind, alt på siden sker kun, hvis man er logget ind-->

<h1 class="title">Lager</h1>
<table class="table">
<!--vi opretter et html tabel, med classen "table" fra vores css framework-->
    <thead>
      <tr>
        <th>Vare</th>
        <th>Billede</th>
        <th>Pris</th>
        <th>Antal på lager</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $conn = new_conn();
        $query = $conn->query('SELECT `id`, `name`, `price`, `img_file`, `stock` FROM vare');
        $vareArray = $query->fetch_all();
    //Vi tager de relavante info fra tabellen i databasen, og putter dem i en variable som vi så laver til et array

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
        //vi skriver de forskellige elementer ind i en html table

          if ($loggedIn) {
            echo '<td>';
            ?>
            <form class="level" action="/stock.php" method="POST">
              <div class="field">
                <div class="control">
                  <input class="input" type="text" name="amount" required="">
                </div>
              </div>
              <input type="hidden" name="vare" value="<?php echo $id; ?>">
              <div class="field">
                <div class="control">
                  <input class="button is-primary" type="submit" name="submit" value="Ændr">
                </div>
              </div>
            </form>
            <?php
            echo '</td>';
          } else {
            echo '<td>&nbsp;</td';
          }
          echo '</tr>';
        }
      ?>
    </tbody>
  </table>
<?php }

function title(){
  echo 'Bestil Din Mad - Oversigt';
}
