<?php

function section(){ ?>
<h1 class="title">Oversigt</h1>
<table class="table">
    <thead>
      <tr>
        <th>pris</th>
        <th>Vare</th>
        <th>Antal</th>
      </tr>
    </thead>
    <tbody>
      <?php
        for ($i=0; $i < count($vareArray); $i++) {
          $id = $vareArray[$i][0];

          $query = $conn->query("SELECT `id`, `name`, `price`, `img_file` FROM vare");
          $bestil = $query->fetch_all();

          for ($j=0; $j < count($vare); $j++) {
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>".$vare[$j][1]."</td>";
            echo "<td>".$vare[$j][2]."</td>";
            echo "</tr>";
          }
        }
      ?>
    </tbody>
  </table>
<?php } else { ?>
  <p>Log venligst ind for at bestille mad</p>
<?php }
}

<table class="table">
 


    
    <tr>
      <th>Panini</th>
      <td><img src="/img/panini.jpg" class="image is-64x64"></td>
      <td>25 kr</td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td><a href="">Tilføj</a></td>
    </tr>
      
    <tr>
      <th>Kylling/Bacon sandwich</th>
      <td><img src="/img/kbsandwich.jpg" class="image is-64x64"></td>
      <td>25 kr</td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td> </td>
      <td><a href="">Tilføj</a></td>
    </tr>
</table>

<?php }

function title(){
  echo "Bestil Din Mad - Forside";
}
?>
