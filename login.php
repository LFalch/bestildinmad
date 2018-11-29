<?php
if(isset($_POST['submit'])){
  include 'inc/mysql.php';
  $conn = new_conn();

  $usr = mysqli_escape_string($conn, $_POST['username']) or "";
  $pwd = mysqli_escape_string($conn, $_POST['password']) or "";

  $query = $conn->query("SELECT `id`, `name`, `email`, `password`, `salt`, `rolle` FROM `bruger` WHERE `brugernavn` = '$usr'");

  if($query->num_rows != 0) {
    session_start();
    $row = $query->fetch_assoc();
    $sql_pwd = $row['password'];

    $conn->close();

    $usrPwd = hash("sha256", $pwd.$row['salt']);

    if($usrPwd == $sql_pwd){
      $_SESSION['id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['rolle'] = $row['rolle'];

      header("Location: /?p=home");
      exit;
    }else{
      header("Location: /?p=error&e=passwd");
      exit;
    }
  } else {
    header("Location: /?p=error&e=user");
    exit;
  }
} else {
  header("Location: /?p=login");
  exit;
}
?>
