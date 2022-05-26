<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php  
    $sql= $conexion->prepare("SELECT * from costos_obra ");           
    $sql->execute();
    $cuenta =$sql ->rowCount();
    $empleados=$sql->fetchall(PDO::FETCH_ASSOC);?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
  <title></title>
 
</head>
<body>

<div class="cargando">
    <div class="loader-outter"></div>
    <div class="loader-inner"></div>
</div>




<div class="container">

<h3 class="text-center">
Importa el proyecto desde neoData con tu archivo CSV</h3>
<hr>
<br><br>


 <div class="row">
    <div class="col-md-7">
      <form action="recibe_excel.php" method="POST" enctype="multipart/form-data"/>
        <div class="file-input text-center">
            <input  type="file" name="dataCliente" id="file-input" class="file-input__input"/>
            <label class="file-input__label" for="file-input">
              <i class="zmdi zmdi-upload zmdi-hc-2x"></i>
              <span>Elegir Archivo Excel</span></label
            >
          </div>
      <div class="text-center mt-5">
          <input type="submit" name="subir" class="btn-enviar" value="Subir Excel"/>
      </div>
      </form>
    </div>

    <div class="col-md-5">
 
Total de lineas en proyecto(<?php echo $cuenta;?>)
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>#Obra</th>
               <th>codigo</th>
              <th>Concepto</th>
              <th>tipo</th>
              <th>unidad</th>
              <th>cantidad</th>
              <th>precio</th>
              <th>importe</th>
              <th>incidencia</th>
              <th>fecha</th>
              
            </tr>
          </thead>
          <tbody>
            <?php 
            
             foreach ($empleados as $result) {?>
            <tr>
              <th scope="row"></th>
              <td><?php echo $result['id_obra']; ?></td>
              <td><?php echo $result['codigo']; ?></td>
              <td><?php echo $result['concepto']; ?></td>
              <td><?php echo $result['tipo']; ?></td>
              <td><?php echo $result['unidad']; ?></td>
              <td><?php echo $result['cantidad']; ?></td>
              <td><?php echo $result['precio']; ?></td>
              <td><?php echo $result['importe']; ?></td>
              <td><?php echo $result['incidencia']; ?></td>
              <td><?php echo $result['fecha']; ?></td>
              
            </tr>
          <?php } ?>
          </tbody>
        </table>

    </div>
  </div>

</div>


<script src="js/jquery.min.js"></script>
<script src="'js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(window).load(function() {
            $(".cargando").fadeOut(1000);
        });      
});
</script>

</body>
</html>

<?php include ("../template/footer.php");?>