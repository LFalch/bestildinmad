<?php

function title(){
  echo "Bestil Din Mad - Fejl";
}

function section(){
    $errorType = $_GET['e'] or '';
    $title = "";
    $body = "";

    switch ($errorType) {
        case 'user':
        $title = 'Forkert brugernavn';
        $body = '<p>Det indtastede brugernavn kunne ikke findes.</p>';
        break;
        case 'passwd':
        $title = 'Forkert kode';
        $body = '<p>Den indtastede adgangskode matchede ikke.</p>';
        break;
        default:
        $body = "<p>Der skete en ukendt fejl.</p>";
    } ?>
        <h1 class="title">
          Fejl
          <?php
          if ($title != "") {
            echo " - $title";
          }
          ?>
        </h1>
        <?php
        echo($body);
        ?>
<?php }
?>
