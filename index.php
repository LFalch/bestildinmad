<?php
  $page = $_GET['p'];
  $file = explode("/", $_SERVER['REQUEST_URI'])[1];
  if ($file == '') {
    $page = 'home';
  }

  if($page && file_exists("./pages/$page.page.php")){
    include("pages/$page.page.php");
    header("HTTP/1.1 200 OK");
  } else {
    include('pages/404.page.php');
    header("HTTP/1.1 404 Not Found");
  }
?>
<!DOCTYPE html>
<html lang="da">
<head>
  <title><?php
  if(function_exists("title")){
    title();
  }else{
    echo "Bestil Din Mad";
  }?></title>
  <meta lang="da" charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="/css/bulma.min.css">
  <link rel="styleskeet" href="/looks.css">
  <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
  <?php if(function_exists('head')) {
      head();
  } ?>
</head>
<body>
  <section class="section">
    <nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-brand" href="/?p=home">
      <img src="/img/logo.png" style="width: 100px; height: 100px">
    </a>
  </div>

  <div class="level">
    <div class="navbar-start">
      <a href="/?p=home" class="navbar-item">
        Forside
      </a>
      <a href="/?p=overview" class="navbar-item">
        Varer
      </a>
      <a href="/?p=order" class="navbar-item">
        Bestillinger
      </a>

      <div class="navbar-end">
        <div class="navbar-item">
          <div class="buttons">
            <?php
            session_start();

            if (isset($_SESSION['id'])) { ?>
            <a class="button is-light"><?php echo("Hej, ".$_SESSION['name']); ?></a>
            <a href="/logout.php" class="button is-primary">
              <strong>Log ud</strong>
            </a>
            <?php
            } else { ?>
            <a href="/?p=login" class="button is-light">Log ind</a>
            <a href="/?p=signup" class="button is-primary">
              <strong>Opret bruger</strong>
            </a>
            <?php
            }
            ?>
          </div>
        </div>
    </div>
  </div>
</nav>
      <div class="container">
        <?php if(function_exists("section")){section();}else{echo "Fejlkode #194";} ?>
      </div>
    </section>
  </div>
</body>
</html>
