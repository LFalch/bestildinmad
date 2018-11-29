<?php

function section(){ ?>
  <h1 class="title">Log ind</h1>
  <form action="/login.php" method="POST">
    <div class="field">
      <label for="username" class="label">Brugernavn</label>
      <div class="control">
        <input class="input" type="text" name="username" required="">
      </div>
    </div>
    <div class="field">
      <label for="password" class="label">Adgangskode</label>
      <div class="control">
        <input class="input" type="password" name="password" required="">
      </div>
    </div>
    <div class="field">
      <div class="control">
        <input class="button is-primary" type="submit" name="submit" value="Log ind">
      </div>
    </div>
  </form>
<?php }

function title(){
  echo "Bestil Din Mad - Log ind";
}
?>
