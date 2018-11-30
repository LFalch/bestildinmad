<?php
if(isset($_POST['submit'])){
  include 'inc/mysql.php';
  $conn = new_conn();

  $name = mysqli_escape_string($conn, $_POST['name']) or "";
  $usr = mysqli_escape_string($conn, $_POST['username']) or "";
  $email = mysqli_escape_string($conn, $_POST['email']) or "";
  $pwd = mysqli_escape_string($conn, $_POST['password']) or "";
  $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
  $salt = '';
  for ($i = 0; $i < 16; $i++) {
    $salt .= $characters[rand(0, strlen($characters) - 1)];
  }
  $usrPwd = hash("sha256", $pwd.$salt);

  $query = $conn->query("INSERT INTO `bruger` (`name`, `brugernavn`, `email`, `password`, `salt`) VALUES ('$name', '$usr', '$email', '$usrPwd', '$salt')");

  header("Location: /?p=login");
  exit;
} else {
  header("Location: /?p=signup");
  exit;
}
?>
