<?php
session_start();
if (isset($_SESSION['id'])) {
    include 'inc/mysql.php';
    $conn = new_conn();

    $best = mysqli_escape_string($conn, $_GET['order']);
    $vare = mysqli_escape_string($conn, $_GET['id']);
    $amt = mysqli_escape_string($conn, $_GET['amount']);

    if($best and $vare and $amt) {
        $sql = "INSERT INTO `bestilling_vare` (`id`, `bestilling_id`, `vare_id`, `amount`) VALUES (NULL, '$best', '$vare', '$amt')";
        $conn->query($sql);
    }
}
?>
