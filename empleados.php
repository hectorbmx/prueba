<?php  include ("template/header.php"); ?>
<?php include ("administrador/config/bd.php"); ?>
<?php
$sql= $conexion->prepare("SELECT * FROM riveraco1.empleados_ ");           
            $sql->bindParam(':id',$txtId);
            $sql->execute();
            $rest=$sql->fetchall(PDO::FETCH_ASSOC);

?>

<div class="container-sm">
<table class="table">
  <thead>
    <tr>
      <th scope="col"># empleado</th>
      <th scope="col">Nombre</th>
      <th scope="col">foto</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($rest as $result) { ?>
    <tr>
      <th scope="row"><?PHP echo $result ['id'];?></th>
      <td><?PHP echo $result ['nombre'];?></td>
      <td><?PHP echo $result ['foto'];?></td>
      <td>@mdo</td>
    </tr>
  <?php } ?>
  
  </tbody>
</table>
</div>
<?php  include ("template/footer.php"); ?>