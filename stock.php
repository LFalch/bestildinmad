<?php
session_start();
if ($_SESSION['id']) {
  $usrId = $_SESSION['id'];
  $rolle = $_SESSION['rolle'];
  $vare = $_POST['vare'];
  $amount = $_POST['amount'];
  $kantine = ($rolle == 'kantinepersonale');
  if ($kantine and $vare and $amount) {
    include 'inc/mysql.php';
    $conn = new_conn();

    $amount = mysqli_escape_string($conn, $amount);
    $vare = mysqli_escape_string($conn, $vare);

    $sql = "UPDATE `vare` SET `stock` = '$amount' WHERE `id` = $vare;";

    $conn->query($sql);
  }
}

header("Location: /?p=lager");
exit;
?>
