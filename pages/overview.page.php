<?php

function section(){ ?>
<h1 class="title">Oversigt</h1>
<table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Name</td>
            </tr>
        </thead>
        <tbody>
        <?php
if(isset($_POST['submit'])){
include 'inc/mysql.php';
$conn = new_conn();
    
    
    
            
            $results = $conn->query("SELECT `id`, `name`, `price`, `img_file` FROM vare");
            while($row = mysqli_fetch_assoc($results)) {
            ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                </tr>

            <?php } ?>
            </tbody>
            </table>
<?php
}
?>
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
