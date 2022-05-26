<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php include ("search.php"); ?>

<?php 
 $idObra =(isset($_POST['idObra']))?$_POST['idObra']:"";
 $idProduct =(isset($_POST['idProduct']))?$_POST['idProduct']:"";
 print_r ($idProduct);

$sql= $conexion->prepare("SELECT c.id_obra,c.codigo,c.tipo, c.concepto,c.cantidad,c.precio,c.importe,SUM(co.importe)as total
FROM costos_obra c
LEFT JOIN costos_obra_detalles co ON co.id_cod_prod = c.codigo 
WHERE c.id_obra = :id_obra GROUP BY c.codigo ");           
$sql->bindParam(':id_obra',$idObra);
if (!empty($sql)) { 
	echo  "";}  
$sql->execute();
$consulta=$sql->fetchall(PDO::FETCH_ASSOC);

$sql= $conexion->prepare("SELECT SUM(importe)as total FROM costos_obra WHERE id_obra = :id_obra and tipo = '1' ");     
$sql->bindParam(':id_obra',$idObra);      
$sql->execute();
$consulta2=$sql->fetchall(PDO::FETCH_ASSOC);

$sql= $conexion->prepare("SELECT SUM(importe)as total2 FROM costos_obra WHERE id_obra = :id_obra and tipo = '2'");           
$sql->bindParam(':id_obra',$idObra);
$sql->execute();
$consulta3=$sql->fetchall(PDO::FETCH_ASSOC);


$sql= $conexion->prepare("SELECT SUM(importe)as total3 FROM costos_obra WHERE id_obra = :id_obra and tipo = '3'");           
$sql->bindParam(':id_obra',$idObra);
$sql->execute();
$consulta4=$sql->fetchall(PDO::FETCH_ASSOC);




$sql= $conexion->prepare("SELECT c.id_obra,c.codigo, c.concepto,c.cantidad,c.precio,c.importe,SUM(co.importe)as total
						 FROM costos_obra c
						LEFT JOIN costos_obra_detalles co ON co.id_cod_prod = c.codigo 
						 WHERE c.id_obra = :id_obra GROUP BY c.codigo");           
						$sql->bindParam(':id_obra',$idObra);
						$sql->execute();
						$consulta5=$sql->fetchall(PDO::FETCH_ASSOC);
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

$(function(){
				// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
				$("#adicional").on('click', function(){
					$("#tabla tbody tr:eq(0)").clone().removeClass('fila-fija').appendTo("#tabla");
				});
			 
				// Evento que selecciona la fila y la elimina 
				$(document).on("click",".eliminar",function(){
					var parent = $(this).parents().get(0);
					$(parent).remove();
				});
			});
      //Evento para autocompletar el codigo de un producto en en la salida de productos de Obra
      $(document).ready(function(){  
      $('#proveedor').keyup(function(){  
           var query5 = $(this).val();  
           if(query5 != '')  
           {  
                $.ajax({  
                     url:"search.php",  
                     method:"POST",  
                     data:{query5:query5},  
                     success:function(data)  
                     {  
                          $('#countryList').fadeIn();  
                          $('#countryList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#proveedor').val($(this).text());  
           $('#countryList').fadeOut();  
      });  
 });

// AQUI ESTÁ TODO LO QUE NECISTAS PARA LA BÚSQUEDAS
$(document).ready(function(){

  // AQUI CAE EL ACCIÓN PARA LA BÚSQUEDA
  $("#searchQuery").keyup(function(e){
    if(e.which != 10) {// SI ES DIFERENTE DE ENTER HACE LA BÚSQUEDA
      // SE LLAMA AL ARCHIVO PARA LA BUSQUEDA
      // QUE SEA DIFERENTE DEL ENTER
      $.ajax({  
            url:"search_new.php",  //ARCHIVO NUEVO PARA LAS BUSQUEDAS
            method:"POST",  
            data:{
              searchQuery:$(this).val(),
              queryMethod: 1
            },  
            success:function(data)  
            {  
                          $('#searchList').fadeIn();  
                          $('#searchList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#searchQuery').val($(this).text());  
           $('#searchList').fadeOut();  
      });  
 });
</script>
<?php
	$accion=(isset($_POST['accion']))?$_POST['accion']:"";
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
        $mensaje2=  "Registro agregado con exito!. <a href='javascript:history.back();'>Regresar</a>";}          
        break;
		
		case"gasto":{
			$numeroSalida =isset($_POST['numeroSalida']) ? $_POST['numeroSalida'] : 0;
			$Obra = isset($_POST['Obra']) ? ($_POST['Obra']) : 0;
			$idProductos = isset($_POST['idProducto']) ? $_POST['idProducto'] : "";
			$cantidades = isset($_POST['Cantidad']) ? $_POST['Cantidad'] : "";
			$precio = isset($_POST['Precio']) ? $_POST['Precio'] : "";
			$importe = isset($_POST['Importe']) ? $_POST['Importe'] : "";
			$hoy =date("Y-m-d");
	  
			//Se valida si es un array
			if(is_array($idProductos))
			{
			  // Se hace el foreach de uno de los arrays
			  // Se toma el que sea, solo para tomar como base
			  // Opté de esta manera para obtener el indice
			  // con eso tomo el indice del arreglo
			  foreach($idProductos as $index => $idProducto)
			  {
				 //Validar productos hacia la base de datos
				 //Armando el query
				  $selectSql = $conexion->prepare ("SELECT * from costos_obra where codigo =:codigo");
				  $selectSql->bindParam(':codigo',$idProducto); //Está en la linea 217
				  $selectSql->execute(); // Se ejecuta el query
				  $DBProductos = $selectSql->fetch(PDO::FETCH_LAZY); //Se optienen los datos
				  
				  if($DBProductos)
				  {
					//  echo "Aqui se hace el insert";		
					// La variable $cantidades está en la linea  207
					echo "<H1>Se guardaron los siguientes registros</H1>";
					echo "<h3>Numero de ssalida: </h3>". $numeroSalida ;
					echo "<br>";
					echo "<h3>Numero de obra :</h3>". $Obra ;
					$cantidad = $cantidades[$index]; // Aqui se toma la cantidad por cada renglón
					 $precios = $precio[$index];
					 $importes =$importe[$index];
					;
					
					echo "<br>";
					echo "Id del producto : ".$idProducto;
					echo "<br>";
					echo "Cantidad :".$cantidad;
					echo "<br>";
					echo "Precio : ".$precios;
					echo "<br>";
					echo "importe : ".$importes;
					echo "<br>";
					echo "<br><br>";
					$sql=$conexion->prepare ("INSERT INTO costos_obra_detalles (id_obra,id_salida,id_cod_prod,cantidad,precio,importe,fecha)
                                   VALUES (:id_obra,:id_salida,:id_cod_prod,:cantidad,:precio,:importe,:fecha)");
								   $sql->bindParam(':id_obra',$Obra);
								   $sql->bindParam(':id_salida',$numeroSalida);
								   $sql->bindParam(':id_cod_prod',$idProducto);
								   $sql->bindParam(':cantidad',$cantidad);
								   $sql->bindParam(':precio',$precios);
								   $sql->bindParam(':importe',$importes);
								   $sql->bindParam(':fecha',$hoy);
                                   $sql->execute();
					//BESOS EN EL HOYO PAPITO
				  }
				  else
				  {
					// echo "El producto con el id ".$idProducto." no existe <br>";
					// echo '<button type="button" class="btn btn-warning">','El producto: '.$idProducto.',no existe en esta obra</button>';
					$mensaje3  ="El producto con el id ".$idProducto." no existe <br>";
				  }
				  
			  }
			}
			else
			{
			  echo "No se pueden agregar los productos";
			}
		

		break;
		}
	}
?>
<div class="container">

<!-- ESTE ES EL CAMPO QUE FUNCIONA PARA LA CONSULTA -->
<!-- LO PUSE A FUERA PARA QUE NO AFECTE CON EL FORMULARIO -->
<!-- SE PUSO AFUERA POR QUE NO TIENE NADA QUE VER -->
<input class="form-control" type="text" name="searchQuery" id="searchQuery" placeholder="Búsqueda para el drop">
<!-- AQUI SE MUESTRASN LOS RESULTADOS -->
<div id="searchList"></div> 

<form method="post">
	<h1><label>Ingresa el numero de obra </label></h1><br>
<input class="form-control" type="text" name="idObra" placeholder="Obra"><br>
<button type="submit" class ="btn btn-success">Consultar</button>
<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#ModalNuevo">Agregar concepto:</button>
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalNuevo4">Agregar Gasto:</button>
	</form>
<form method="post">
<!-- Aqui termina el formulario de busqueda -->
<!-- Modal para agregar concepto unevo a Obra -->
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
	</form>
      </div>
    </div>
  </div>
</div>
<!-- aqui comienza el segundo modal o modal de gastos -->
<form action="" method="post"></form>
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
<!--TERMINA  Modal para agregar concepto unevo a Obra -->
<!--MODAL AGREGA LINEAS-->

<div class="modal fade" id="ModalNuevo4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        
      <h5 class="modal-title" id="exampleModalLabel">Captura datos de salida:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
	  <form method="post"  enctype="multipart/form-data">

      <!-- Cabecera -->
				<table class="table table-light">
          <tbody>
            <tr>
              <td>
                <label for="">Numero de salida</label>  
                <input type="text" class="col-2" class="form-control"name ="numeroSalida">
              </td>
			  <td>
                <label for="">Numero de Obra</label>  
                <input type="text" class="col-2" class="form-control"name ="Obra">
              </td>
          
            </tr>
          </tbody>
        </table>

          <table class="table"  id="tabla">
        	<tr >
          				<!-- <td><input type="text" class="form-control" name ="Obra[]" placeholder="# Obra"/></td> -->
						<form method="post"><td><input type="text" class="form-control" name="idProducto[]"  id="proveedor" placeholder="ID Producto"/></form>
            
            <div id="countryList"></div>
            <!-- <input class="form-control" type="text" name="searchQuery" id="searchQuery" placeholder="Búsqueda para el drop">
<!-- AQUI SE MUESTRASN LOS RESULTADOS -->
            <!-- <div id="searchList"></div>  -->
           
						<td><input type="text" class="form-control" required name="Cantidad[]" placeholder="Cantidad"/></td>
						<td><input type="text" class="form-control" required name="Precio[]" placeholder="precio"/></td>
						<td><input type="text" class="form-control" required name="Importe[]" placeholder="importe"/></td>
						<!-- <td><input type="text" required name="Obra[]" placeholder="Obra"/></td> -->
         
						<td class="eliminar"><input type="button"   value="Menos -"/></td>
					</tr>
				</table>

				<div class="btn-der">
					<!-- <input type="submit" name="insertar" value="Guardar" class="btn btn-success"/> -->
          <button type="submit" name ="accion" value ="gasto" class="btn btn-success">Guardar todo</button>
					<button id="adicional" name="adicional" type="button" class="btn btn-warning"> Agregar mas lineas </button>

				</div>
          
          </form>
      </div>
    </div>
  </div>
</div>



<!-- aqui inicia la tabla para desplegar los resultados -->
<table id="example" class="display nowrap" style="width:100%">
<?php if (isset($mensaje3)){?>
        <div class="alert alert-danger" role="alert">
          <?php echo $mensaje3; ?>
        </div>
        <?php  } ?>
		<?php if (isset($mensaje2)){?>
        <div class="alert alert-success" role="alert">
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
                <th>GASTADO</th>
                <th>SALDO</TH>
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
                
                <td><?PHP echo $result ['total'];?></td>
                <td><?PHP $resta= $result['importe']-$result['total'];
						if ($resta >1) echo $resta; 
						else if ($resta<1) echo '<button type="button" class="btn btn-danger">Excedido</button>';
						else if ($result['total']==0) echo'<button type="button" class="btn btn-warning">Sin gasto</button>' ;?>
                
                
            </tr>
            <?php } ?>      
        </tbody>
		<table id="example2" class="display nowrap" style="width:100%">
    <thead>
      <tr><h1>TOTALES GENERALES</h1></tr>
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