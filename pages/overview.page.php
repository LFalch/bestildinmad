<?php
include 'inc/mysql.php';

function section(){
  $loggedIn = isset($_SESSION['id']);
?>
<h1 class="title">Oversigt</h1>
<a class="button" onclick="order()">Bestil</a>
<table class="table">
    <thead>
      <tr>
        <th>Vare</th>
        <th>Billede</th>
        <th>Pris</th>
        <th>Antal på lager</th>
        <th>At bestille</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $conn = new_conn();
        $query = $conn->query('SELECT `id`, `name`, `price`, `img_file`, `stock` FROM vare');
        $vareArray = $query->fetch_all();

        for ($i=0; $i < count($vareArray); $i++) {
          $id = $vareArray[$i][0];
          $name = $vareArray[$i][1];
          $pris = $vareArray[$i][2];
          $img = $vareArray[$i][3];
          $stock = $vareArray[$i][4];

          echo "<tr id=\"id-$id\">";
          echo "<td>$name</td>";
          echo "<td><img src=\"/img/$img\" class=\"image is-64x64\"></td>";
          echo "<td>$pris</td>";
          echo "<td>$stock</td>";
          echo '<td>0</td>';
          if ($loggedIn) {
            echo '<td>';
            $attr = "onclick=\"add($id)\"";
            if ($stock == 0) {
              $attr = 'disabled';
            }
            echo "<a class=\"button is-primary\" $attr>
  <span class=\"icon is-small\">
    <i class=\"fas fa-plus\"></i>
  </span>
</a>";
            echo "<a class=\"button is-danger\" onclick=\"remove($id)\">
  <span class=\"icon is-small\">
    <i class=\"fas fa-minus\"></i>
  </span>
</a>";
            echo '</td>';
          } else {
            echo '<td>&nbsp;</td';
          }
          echo '</tr>';
        }
      ?>
    </tbody>
  </table>
  <a class="button" onclick="order()">Bestil</a>
<?php }

function title(){
  echo 'Bestil Din Mad - Oversigt';
}
function head() { ?>
    <script type="text/javascript">
        var orders = {};
        function add(id) {
            var doc = document.getElementById('id-'+id);
            var n = parseInt(doc.children[4].innerHTML);
            if (n < parseInt(doc.children[3].innerHTML)) {
                doc.children[4].innerHTML = n + 1;
                orders[id] = n + 1;
            }
        }
        function remove(id) {
            var doc = document.getElementById('id-'+id);
            var n = parseInt(doc.children[4].innerHTML);
            if (n > 0) {
                doc.children[4].innerHTML = n - 1;
                orders[id] = n - 1;
                if (n == 1) {
                    delete orders[id];
                }
            }
        }
        function order() {
            if (Object.keys(orders).length == 0) {
                return
            }

            httpRequest = new XMLHttpRequest();
            httpRequest.onreadystatechange = function(a, b, c) {
                if (this.readyState == 4 && this.status == 200) {
                    var orderId = httpRequest.responseText;

                    for (var id of Object.keys(orders)) {
                        var amount = orders[id];
                        httpRequest = new XMLHttpRequest();
                        httpRequest.onreadystatechange = function() {
                            // Maybe we want to do something in here
                        }
                        httpRequest.open('GET', '/order.php?order='+orderId+'&id='+id+'&amount='+amount);
                        httpRequest.send();
                    }
                    window.location.reload();

                    delete httpRequest;
                }
            }
            httpRequest.open('GET', '/neworder.php');
            httpRequest.send();
        }
    </script>
<?php } ?>
