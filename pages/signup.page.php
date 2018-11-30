<?php

function section(){ ?>
  <h1 class="title">Log ind</h1>
  <form action="/login.php" method="POST">
    <div class="field">
      <label for="navn" class="label">Rigtige Navn (Det du hedder)</label>
      <div class="control">
        <input class="input" type="text" name="name" required="">
      </div>
    </div>
    <div class="field">
      <label for="username" class="label">Brugernavn (Det du logger ind med)</label>
      <div class="control">
        <input class="input" type="text" name="username" required="">
      </div>
    </div>
        <div class="field">
      <label for="email" class="label">Email (Den email du læser)</label>
      <div class="control">
        <input class="input" type="email" name="email" required="">
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
  echo "Bestil Din Mad - Opret Bruger";
}
?>