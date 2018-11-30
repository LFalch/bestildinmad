<?php
session_start();
if (isset($_SESSION['id'])) {
    include 'inc/mysql.php';
    $conn = new_conn();

    $id = $_SESSION['id'];
    $sql = "INSERT INTO `bestilling` (`id`, `bruger_id`, `time`) VALUES (NULL, '$id', CURRENT_TIMESTAMP)";

    if (mysqli_query($conn, $sql)) {
        $last_id = mysqli_insert_id($conn);
        echo $last_id;
    }
}
?>
