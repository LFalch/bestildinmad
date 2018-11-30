<?php
session_start();

function name($id) {
  $conn = new_conn();
  $query = $conn->query("SELECT `name` FROM `bruger` WHERE id=$id");

  if($query->num_rows != 0) {
    $row = $query->fetch_assoc();
    return $row['name'];
  }
}

function vare($id) {
  $conn = new_conn();
  $query = $conn->query("SELECT `name`, `img_file` FROM `vare` WHERE id=$id");

  if($query->num_rows != 0) {
    $row = $query->fetch_assoc();
    return $row;
  }
}

function section(){ ?>
  <h1 class="title">Bestilte varer</h1>
<?php if ($_SESSION['id']) {
  $usrId = $_SESSION['id'];
  $rolle = $_SESSION['rolle'];
  $kantine = ($rolle == 'kantinepersonale');

  include 'inc/mysql.php';
  $conn = new_conn();

  $sql = 'SELECT `id`, `bruger_id`, `time` FROM `bestilling`';
  if (!$kantine) {
    $sql .= " WHERE `bruger_id` = '$usrId'";
  }
  $query = $conn->query($sql);
  $bestillingArray = $query->fetch_all();

  for ($i=0; $i < count($bestillingArray); $i++) {
    $id = $bestillingArray[$i][0];
    $name = name($bestillingArray[$i][1]);
    $time = $bestillingArray[$i][2];
  ?>
  <h2 class="subtitle">Bestilte varer af <?php echo $name; echo " $time"?></h2>
  <table class="table">
    <thead>
      <tr>
        <th>Vare</th>
        <th>Billede</th>
        <th>Antal</th>
      </tr>
    </thead>
    <tbody>
  <?php
    $query = $conn->query("SELECT `id`, `vare_id`, `amount` FROM `bestilling_vare` WHERE `bestilling_id` = '$id'");
    $bestil = $query->fetch_all();

    for ($j=0; $j < count($bestil); $j++) {
      $vareId = $bestil[$j][1];
      $prod = vare($vareId);
      $img = $prod['img_file'];
      $name = $prod['name'];

      echo "<tr>";
      echo "<td>$name</td>";
      echo "<td><img src=\"/img/$img\" class=\"image is-64x64\"></td>";
      echo '<td>'.$bestil[$j][2].'</td>';
      echo "</tr>";
    }
       ?>
    </tbody>
  </table>
<?php
    if ($kantine) {
      echo "<a href=\"/remove.php?bestilling=$id\" class=\"button is-danger\">
    <span class=\"icon is-small\">
    <i class=\"fas fa-times\"></i>
    </span>
    <span>Fjern bestilling</span>
  </a>";
    }
  }
} else {
?>
<a class="button is-danger">
 <span class="icon is-small">
   <i class="fas fa-times"></i>
 </span>
 <span>Fjern bestilling</span>
</a>

  <p>Log venligst ind for at se bestilt mad</p>
<?php }
}

function title(){
  echo "Bestil Din Mad - Bestillinger";
}
?>
