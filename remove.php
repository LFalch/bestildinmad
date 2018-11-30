<?php
session_start();
if ($_SESSION['id']) {
  $usrId = $_SESSION['id'];
  $rolle = $_SESSION['rolle'];
  $bestilling = $_GET['bestilling'];
  $kantine = ($rolle == 'kantinepersonale');
  if ($kantine and $bestilling) {
    include 'inc/mysql.php';
    $conn = new_conn();

    $bestilling = mysqli_escape_string($conn, $bestilling);

    $conn->query("DELETE FROM `bestilling_vare` WHERE `bestilling_id` = $bestilling");
    $conn->query("DELETE FROM `bestilling` WHERE `id` = $bestilling");
  }
}

header("Location: /?p=order");
exit;
?>
