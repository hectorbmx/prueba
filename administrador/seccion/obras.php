<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php 

 $idObra =(isset($_POST['idObra']))?$_POST['idObra']:"";
 $sql= $conexion->prepare("SELECT * from costos_obra ");           
  
$sql->execute();
$consulta=$sql->fetchall(PDO::FETCH_ASSOC);

$sql= $conexion->prepare("SELECT SUM(importe)as total FROM costos_obra WHERE tipo = '1'");           
$sql->execute();
$consulta2=$sql->fetchall(PDO::FETCH_ASSOC);

$sql= $conexion->prepare("SELECT SUM(importe)as total2 FROM costos_obra WHERE tipo = '2'");           
$sql->execute();
$consulta3=$sql->fetchall(PDO::FETCH_ASSOC);

$sql= $conexion->prepare("SELECT SUM(importe)as total3 FROM costos_obra WHERE tipo = '3'");           
$sql->execute();
$consulta4=$sql->fetchall(PDO::FETCH_ASSOC);
?>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

  <script>
$(document).ready(function() {
    $('#example').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detalles de  '+data[1]+' ' +data[2];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
} );

$(document).ready(function() {
    $('#example2').DataTable( {
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detalles de  '+data[1]+' ' +data[2];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        }
    } );
} );
</script>
<?php 

$accion=(isset($_POST['accion']))?$_POST['accion']:"";
?>

<?php

switch($accion){
    
    
    case "agregar":
      
      $Obra=(isset($_POST['Obra']))?$_POST['Obra']:"";
      $Codigo=(isset($_POST['Codigo']))?$_POST['Codigo']:"";
      $Concepto =(isset($_POST['Concepto']))?$_POST['Concepto']:"";
      $Tipo =(isset($_POST['Tipo']))?$_POST['Tipo']:"";
      $Unidad =(isset($_POST['Unidad']))?$_POST['Unidad']:"";
      $Cantidad =(isset($_POST['Cantidad']))?$_POST['Cantidad']:"";
      $Precio =(isset($_POST['Precio']))?$_POST['Precio']:"";
      $Importe =(isset($_POST['Importe']))?$_POST['Importe']:"";
      $Incidencia =(isset($_POST['Incidencia']))?$_POST['Incidencia']:"";
      $hoy =date("Y-m-d");     

      $sql=$conexion->prepare ("INSERT INTO costos_obra (id_obra,codigo,concepto,tipo,unidad,cantidad,precio,importe,incidencia,fecha)
      VALUES (:id_obra,:Codigo,:Concepto,:Tipo,:Unidad,:Cantidad,:Precio,:Importe,:Incidencia,:fecha)");

        $sql->bindParam(':id_obra',$Obra);
        $sql->bindParam(':Codigo',$Codigo);
        $sql->bindParam(':Concepto',$Concepto);
        $sql->bindParam(':Tipo',$Tipo);
        $sql->bindParam(':Unidad',$Unidad);
        $sql->bindParam(':Cantidad',$Cantidad);
        $sql->bindParam(':Precio',$Precio);
        $sql->bindParam(':Importe',$Importe);
        $sql->bindParam(':Incidencia',$Incidencia);
        $sql->bindParam(':fecha',$hoy);
        $sql->execute(); 
        if (!empty($sql)) { 
        $mensaje=  "Registro agregado con exito!. <a href='javascript:history.back();'>Regresar</a>";}          
        break;
        case "gastar":
      
          $ObraGasto=(isset($_POST['ObraGasto']))?$_POST['ObraGasto']:"";
          $CodigoGasto=(isset($_POST['CodigoGasto']))?$_POST['CodigoGasto']:"";
          $ConceptoGasto =(isset($_POST['ConceptoGasto']))?$_POST['ConceptoGasto']:"";
          $TipoGasto =(isset($_POST['TipoGasto']))?$_POST['TipoGasto']:"";
          $UnidadGasto =(isset($_POST['UnidadGasto']))?$_POST['UnidadGasto']:"";
          $CantidadGasto =(isset($_POST['CantidadGasto']))?$_POST['CantidadGasto']:"";
          $PrecioGasto =(isset($_POST['PrecioGasto']))?$_POST['PrecioGasto']:"";
          $ImporteGasto =(isset($_POST['ImporteGasto']))?$_POST['ImporteGasto']:"";
          $hoy =date("Y-m-d");  

          print_r($ObraGasto);
          
          $sql=$conexion->prepare ("INSERT INTO costos_obra_copy (id_obra,codigo,concepto,tipo,unidad,cantidad,precio,importe,fecha)
      VALUES (:id_obra,:Codigo,:Concepto,:Tipo,:Unidad,:Cantidad,:Precio,:Importe,:fecha)");

                
          $sql->bindParam(':id_obra',$ObraGasto);
          $sql->bindParam(':Codigo',$CodigoGasto);
          $sql->bindParam(':Concepto',$ConceptoGasto);
          $sql->bindParam(':Tipo',$TipoGasto);
          $sql->bindParam(':Unidad',$UnidadGasto);
          $sql->bindParam(':Cantidad',$CantidadGasto);
          $sql->bindParam(':Precio',$PrecioGasto);
          $sql->bindParam(':Importe',$ImporteGasto);
          $sql->bindParam(':fecha',$hoy);
          $sql->execute(); 
          if (!empty($sql)) { 
          $mensaje=  "Registro agregado con exito!. <a href='javascript:history.back();'>Regresar</a>";}          
          break;

      //  case "consultar":

      //      $id_obra=(isset($_POST['id_obra']))?$_POST['id_obra']:"";
      
      //      $sql= $conexion->prepare("SELECT * FROM riveraco1.costos_obra WHERE  id_obra=:id_obra");           
      //      $sql->bindParam(':id_obra',$id_obra);
      //      $sql->execute();
      //      $consultas=$sql->fetch(PDO::FETCH_ASSOC);

      //     $consulta = $consultas;
      //            if(empty($sql)){
      //              $mensaje="No existe ese folio de obra";
      //          }
      //   break;
}                       

?>

<div class="container" width='100%'><br><br><br>
<h1>Lista de conceptos de obra</h1><br>
<form role ="form "method="post" >
  
<input class="form-control" type="text" name="Consulta" placeholder="Escribe el numero de obra"></input>
<button type="submit" class="btn btn-success">buscar</button> 
<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ModalNuevo">Agregar concepto:</button>
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalNuevo2">Agregar Gasto:</button>

<div class="modal fade" id="ModalNuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura datos de entrada:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
          
         
          <div class="form-floating mb-3">
          <input type="text" name="Obra" id="Obra" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Obra:</label>      
          </div>

          <div class="form-floating mb-3">
          <input type="text" name="Codigo" id="Codigo" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Codigo de producto:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="Concepto" id="Concepto" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Concepto:</label>      
          </div>
          <select class="form-select" aria-label="Default select example" name="Tipo">
          <option selected>Tipo:</option>
          <option value="1">Materiales</option>
          <option value="2">Mano Obra</option>
          <option value="3">Maquinaria</option>
        </select><br>
        <select class="form-select" aria-label="Default select example" name="Unidad">
          <option selected>Unidad:</option>
          <option value="1">KG</option>
          <option value="2">LT</option>
          <option value="3">M3</option>
          <option value="4">DIA</option>
          <option value="5">JGO</option>
          <option value="6">M2</option>
          <option value="7">PZA</option>
          <option value="8">PT</option>
          <option value="9">JOR</option>
          <option value="10">HORA</option>
        </select><br>
          <div class="form-floating mb-3">
          <input type="text" name="Cantidad" id="Cantidad" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Cantidad:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="Precio" id="costo" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Costo:</label>      
          </div>
          
          <div class="form-floating mb-3">
          <input type="text" name="Importe" id="Importe" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Importe:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="Incidencia" id="Incidencia" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Incidencia:</label>      
          </div>
                     
            </div>
            <div class="modal-footer">
            <button type="button"value ="agregar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name ="accion" value ="agregar" class="btn btn-success">Guardar</button>
            
      </div>
    </div>
  </div>
</div>
<!-- aqui comienza el segundo modal o modal de gastos -->
<div class="modal fade" id="ModalNuevo2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura datos del gasto:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
            
          <div class="form-floating mb-3">
          <input type="text" name="ObraGasto" id="ObraGasto" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Obra:</label>      
          </div>

          <div class="form-floating mb-3">
          <input type="text" name="CodigoGasto" id="CodigoGasto" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Codigo de producto:</label>      
          </div>

          <div class="form-floating mb-3">
          <input type="text" name="ConceptoGasto" id="ConceptoGasto" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Concepto:</label>      
          </div>

          <select class="form-select" aria-label="Default select example" name="TipoGasto">
          <option selected>Tipo:</option>
          <option value="1">Materiales</option>
          <option value="2">Mano Obra</option>
          <option value="3">Maquinaria</option>
        </select><br>

        <select class="form-select" aria-label="Default select example" name="UnidadGasto">
          <option selected>Unidad:</option>
          <option value="1">KG</option>
          <option value="2">LT</option>
          <option value="3">M3</option>
          <option value="4">DIA</option>
          <option value="5">JGO</option>
          <option value="6">M2</option>
          <option value="7">PZA</option>
          <option value="8">PT</option>
          <option value="9">JOR</option>
          <option value="10">HORA</option>
        </select><br>

          <div class="form-floating mb-3">
          <input type="text" name="CantidadGasto" id="CantidadGasto" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Cantidad:</label>      
          </div>

          <div class="form-floating mb-3">
          <input type="text" name="PrecioGasto" id="costoGasto" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Costo:</label>      
          </div>
          
          <div class="form-floating mb-3">
          <input type="text" name="ImporteGasto" id="ImporteGasto" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Importe total con IVA:</label>      
          </div>
                     
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name ="accion" value ="gastar" class="btn btn-success">Guardar</button>
            </form>
      </div>
    </div>


  </div>
</div>

<!-- aqui termin el segundo modal o modal de gastos -->

<br><br><br>
<table id="example" class="display nowrap" style="width:100%">
<?php if (isset($mensaje)){?>
        <div class="alert alert-success" role="alert">
          <?php echo $mensaje; ?>
        </div>
        <?php  } ?>
        <?php if (isset($mensaje2)){?>
        <div class="alert alert-danger" role="alert">
          <?php echo $mensaje2; ?>
        </div>
        <?php  } ?>
        
        <thead>
            <tr>
                <th>OBRA #</th>
                <th>CODIGO</th>
                <th>CONCEPTO</th>
                <th>TIPO</th>
                <!-- <th>UNIDAD</th> -->
                <th>CANTIDAD</th>
                <th>PRECIO</th>
                <th>IMPORTE</th>
                <!-- <th>INCIDENCIA</th> -->
                <th>FECHA</th>
                <th>CONSUMO</TH>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($consulta as $result) {?>
            <tr>
            <td><?PHP echo $result ['id_obra'];?></td>   
                <td><?PHP echo $result ['codigo'];?></td>
                <td><?PHP echo $result ['concepto'];?></td>
                <td><?PHP if($result ['tipo']==1)echo 'Material';
                     else if($result ['tipo']==2)echo'Mano Obra';
                     else if($result ['tipo']==3)echo'Maquinaria';?></td>
                
                <td><?PHP echo $result ['cantidad'];?></td>
                <td>$<?PHP echo $result ['precio'];?></td>
                <td>$<?PHP echo $result ['importe'];?></td>
                
                <td><?PHP echo $result ['fecha'];?></td>
                <td></td>
                
                
            </tr>
            <?php } ?>      
        </tbody>
<?php 
$Obra=(isset($_POST['Obra']))?$_POST['Obra']:"";
$totales = $conexion->prepare ("SELECT SUM(importe) FROM costos_obra WHERE tipo = 1 and id_obra ='PI01'")      ?>        


   
    </table>
    <table id="example2" class="display nowrap" style="width:100%">
    <thead>
      <h1><tr>TOTALES GENERALES</tr></h1>
      <th>Total presupuestado de Material</th>
      <th>Toal de obra</th>
      <th>Maquinaria</th>
    </thead>
    <tbody>
      <tr>
      <td><?php foreach ($consulta2 as $total) { ?><?PHP echo $total ['total'];?><?php }?></td>
      <td> <?php foreach ($consulta3 as $total) { ?><?PHP echo $total ['total2'];?><?php }?></td>
      <td><?php foreach ($consulta4 as $total) { ?><?PHP echo $total ['total3'];?><?php }?></td>
    </tr>


    </tbody>
        </table>

    

    
</div>
 



<?php include ("../template/footer.php");?>