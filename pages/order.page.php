<?php
session_start();

function section(){ ?>
  <h1 class="title">Bestilte varer</h1>
<?php if ($_SESSION['id']) {
  $usrId = $_SESSION['id'];
  include 'inc/mysql.php';
  $conn = new_conn();

  $query = $conn->query("SELECT `id`, `time` FROM `bestilling` WHERE `bruger_id` = '$usrId'");
  $bestillingArray = $query->fetch_all();
?>

  <table class="table">
    <thead>
      <tr>
        <th>Bestillingsnummer</th>
        <th>Vare</th>
        <th>Antal</th>
      </tr>
    </thead>
    <tbody>
      <?php
        for ($i=0; $i < count($bestillingArray); $i++) {
          $id = $bestillingArray[$i][0];

          $query = $conn->query("SELECT `id`, `vare_id`, `amount` FROM `bestilling_vare` WHERE `bestilling_id` = '$id'");
          $bestil = $query->fetch_all();

          for ($j=0; $j < count($bestil); $j++) {
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>".$bestil[$j][1]."</td>";
            echo "<td>".$bestil[$j][2]."</td>";
            echo "</tr>";
          }
        }
      ?>
    </tbody>
  </table>
<?php } else { ?>
  <p>Log venligst ind for at bestille mad</p>
<?php }
}

function title(){
  echo "Bestil Din Mad - Bestillinger";
}
?>
