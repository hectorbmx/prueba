<?php include ("../template/cabecera.php");?>
<?php include ("../config/bd.php"); ?>
<?php include ("search.php"); ?>


<?php $sql= $conexion->prepare("SELECT productos.id_producto,nombre,descripcion,proveedor,area,existencia
                                 from productos
                                 ");           
            
            $sql->execute();
            $empleados=$sql->fetchall(PDO::FETCH_ASSOC);
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
       $(document).ready(function(){  
      $('#proveedor').keyup(function(){  
           var query2 = $(this).val();  
           if(query2 != '')  
           {  
                $.ajax({  
                     url:"search.php",  
                     method:"POST",  
                     data:{query2:query2},  
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
$("#ModalNuevo").find("input,textarea,select").val("");


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
</script>
<?php 
$nombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
$descripcion =(isset($_POST['descripcion']))?$_POST['descripcion']:"";
$proveedor =(isset($_POST['proveedor']))?$_POST['proveedor']:"";
$area =(isset($_POST['area']))?$_POST['area']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
$hoy =date("Y-m-d");
$nombreProveedor =(isset($_POST['nombreProveedor']))?$_POST['nombreProveedor']:"";
$descripcionProveedor =(isset($_POST['descripcionProveedor']))?$_POST['descripcionProveedor']:"";
$rfcProveedor =(isset($_POST['rfcProveedor']))?$_POST['rfcProveedor']:"";
$domicilioProveedor =(isset($_POST['domicilioProveedor']))?$_POST['domicilioProveedor']:"";
$telefonoProveedor =(isset($_POST['telefonoProveedor']))?$_POST['telefonoProveedor']:"";
$emailProveedor =(isset($_POST['emailProveedor']))?$_POST['emailProveedor']:"";
$hoyProveedor =date("Y-m-d");
$item=(isset($_POST['item']))?$_POST['item']:"";
$cantidad =(isset($_POST['cantidad']))?$_POST['cantidad']:"";
$factura =(isset($_POST['factura']))?$_POST['factura']:"";
$costo =(isset($_POST['costo']))?$_POST['costo']:"";
$hoyEntrada =date("Y-m-d");
$itemSalida=(isset($_POST['itemSalida']))?$_POST['itemSalida']:"";
$cantidadSalida =(isset($_POST['cantidadSalida']))?$_POST['cantidadSalida']:"";
$obra =(isset($_POST['obra']))?$_POST['obra']:"";
$hoySalida =date("Y-m-d");
// $idProducto =(isset($_POST'idProducto']))?$_POST['idProducto ']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";
?>

<?php

switch($accion){
    
    case "agregar":

                    $sql=$conexion->prepare ("INSERT INTO productos (nombre,descripcion,proveedor,area,fecha_registro)
                                                    VALUES (:nombre,:descripcion,:proveedor,:area,:fecha_registro)");
                    $sql->bindParam(':nombre',$nombre);
                    $sql->bindParam(':descripcion',$descripcion);
                    $sql->bindParam(':proveedor',$proveedor);
                    $sql->bindParam(':area',$area);
                    $sql->bindParam(':fecha_registro',$hoy);
                    $sql->execute(); 
                    // if (!empty($sql)) { $sql=$conexion->prepare ("SELECT * from inventario_almacen where id_producto=:id_producto");}          
                    
                    if (!empty($sql)) { 
                        $mensaje=  "Registro agregado con exito!. <a href='javascript:history.back();'>Regresar</a>";}          
                    break;

    case "proveedor":                        
                    $sql=$conexion->prepare ("INSERT INTO proveedores (nombre,descripcion,RFC,domicilio,telefono,email,fecha_registro)
                                                    VALUES (:nombre,:descripcion,:RFC,:domicilio,:telefono,:email,:fecha_registro)");
                    $sql->bindParam(':nombre',$nombreProveedor);
                    $sql->bindParam(':descripcion',$descripcionProveedor);
                    $sql->bindParam(':RFC',$rfcProveedor);
                    $sql->bindParam(':domicilio',$domicilioProveedor);
                    $sql->bindParam(':telefono',$telefonoProveedor);
                    $sql->bindParam(':email',$emailProveedor);
                    $sql->bindParam(':fecha_registro',$hoyProveedor);
                    $sql->execute(); 
                    if (!empty($sql)) { 
                        $mensaje=  "Registro agregado con exito!. <a href='javascript:history.back();'>Regresar</a>";}          
                    break;   
    case "entrada":
                    $sql=$conexion->prepare ("SELECT * from productos where id_producto =:id_producto");
                    $sql->bindParam(':id_producto',$item);            
                    $sql->execute();
                    $productos=$sql->fetch(PDO::FETCH_LAZY);
                    if (!$productos){
                           $mensaje2=  "El Codigo del producto no esta registrado! Registralo en la opcion de PRODUCTOS. <a href='productos_giralda.php'>ir</a>";
                        }
                      
                        else { $sql=$conexion->prepare ("INSERT INTO entradas_almacen (id_producto,cantidad,costo,factura,fecha,tipo)
                                   VALUES (:id_producto,:cantidad,:costo,:factura,:fecha,1)");
                                   $sql->bindParam(':id_producto',$item);
                                   $sql->bindParam(':cantidad',$cantidad);
                                   $sql->bindParam(':costo',$costo);
                                   $sql->bindParam(':factura',$factura);
                                   $sql->bindParam(':fecha',$hoyEntrada);
                                   $sql->execute(); 
                                   
                                   if (!empty($sql)){
                                        $sql=$conexion->prepare ("UPDATE productos set existencia = existencia + :cantidad where id_producto = :id_producto");
                                        $sql->bindParam(':id_producto',$item);
                                        $sql->bindParam(':cantidad',$cantidad);
                                        $sql->execute(); 
                                       if (!empty($sql)){ 
                                       $mensaje=  "Registro agregado con exito!. <a href='productos_giralda.php'>Regresar</a>";
                                                     }
                                                   }     
                                                }
                                   break;
     case "salida":
                    $sql=$conexion->prepare ("SELECT * from productos where id_producto =:id_producto");
                    $sql->bindParam(':id_producto',$itemSalida);            
                    $sql->execute();
                    $productos=$sql->fetch(PDO::FETCH_LAZY);
                    if (!$productos){
                         $mensaje2=  "El Codigo del producto no esta registrado! Registralo en la opcion de PRODUCTOS. <a href='productos_giralda.php'>ir</a>";
                                }                              
                       else { $sql=$conexion->prepare ("INSERT INTO entradas_almacen (id_producto,cantidad, obra,fecha,tipo)
                                                      VALUES (:id_producto,:cantidad,:obra,:fecha,2)");
                              $sql->bindParam(':id_producto',$itemSalida);
                              $sql->bindParam(':cantidad',$cantidadSalida);
                              $sql->bindParam(':obra',$obra);
                              $sql->bindParam(':fecha',$hoySalida);
                              $sql->execute(); 
                                                 
                                if (!empty($sql)){
                                $sql=$conexion->prepare ("UPDATE productos set existencia = existencia - :cantidad where id_producto = :id_producto");
                                $sql->bindParam(':id_producto',$itemSalida);
                                $sql->bindParam(':cantidad',$cantidadSalida);
                                $sql->execute(); 
                                    if (!empty($sql)){ 
                                     $mensaje=  "Registro agregado con exito!. <a href='productos_giralda.php'>Regresar</a>";
                                                }
                                            }     
                                        }
                                break;                                                            
     case "salida2":
      // Cabecera
      //Condiciones ternarias
      // Condicion ? Cuando es true : Cuando es falso
      $numeroSalida =isset($_POST['numeroSalida']) ? $_POST['numeroSalida'] : "";
      $Obra = isset($_POST['Obra']) ? isset($_POST['Obra']) : "";
      
      //Detalles
      $idProductos = isset($_POST['idProducto']) ? $_POST['idProducto'] : "";
      $cantidades = isset($_POST['Cantidad']) ? $_POST['Cantidad'] : "";

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
            $selectSql = $conexion->prepare ("SELECT * from productos where id_producto =:id_producto");
            $selectSql->bindParam(':id_producto',$idProducto); //Está en la linea 217
            $selectSql->execute(); // Se ejecuta el query
            $DBProductos = $selectSql->fetch(PDO::FETCH_LAZY); //Se optienen los datos
            
            if($DBProductos)
            {
              echo "Aqui se hace el insert";
              
              // La variable $cantidades está en la linea  207
              $cantidad = $cantidades[$index]; // Aqui se toma la cantidad por cada renglón
              echo "<br>";
              echo "esta es la obra". $Obra;
              echo "<br>";
              echo "Linea ".($index + 1);
              echo "<br>";
              echo "Id del producto => ".$idProducto;
              echo "<br>";
              echo "Cantidad => ".$cantidad;
              echo "<br><br>";
              //BESOS EN EL HOYO PAPITO
            }
            else
            {
              echo "El producto con el id ".$idProducto." no existe <br>";
            }
        }
      }
      else
      {
        echo "No se pueden agregar los productos";
      }
                                                               
                                  // if (!empty($sql)){
                                  // $sql=$conexion->prepare ("UPDATE productos set existencia = existencia - :cantidad where id_producto = :id_producto");
                                  // $sql->bindParam(':id_productoi',$idProducto);
                                  // $sql->bindParam(':cantidad',$Cantidad);
                                  // $sql->execute(); 
                                  // if (!empty($sql)){ 
                                  // $mensaje=  "Registro agregado con exito!. <a href='productos_giralda.php'>Regresar</a>";
                                  //     }
                                  // }     
                              // }
                                              break;                                                
}                                   
?>

<div class="container" width='100%'><br><br><br>
<h1>INVENTARIO GIRALDA</h1><br>
<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#ModalNuevo">Agregar producto</button>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalNuevo1">Agregar proveedor</button>
<button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#ModalNuevo2">Agregar entrada</button>
<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ModalNuevo3">Agregar salida</button>
<button type="button" class="btn btn-Secondary" data-bs-toggle="modal" data-bs-target="#ModalNuevo4">Agregar salida 2</button>

<!-- MODAL PARA INGRESO DE PRODUCTOS-->
<div class="modal fade" id="ModalNuevo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura del producto:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
          <form method="post"  enctype="multipart/form-data">
          
          <div class="form-floating mb-3">
          <input type="text" name="nombre" id="nombre" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Nombre producto:</label> 
                
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Descripcion:</label>      
          </div>
          <!-- INPUT QUE BUSCA Y AUTOCOMPLETA-->
          <div class="form-floating mb-3">
          <input type="text" name="proveedor" id="proveedor" class="form-control" placeholder=""required /> 
          <label for="floatingInput">proveedor:</label> 
          <div id="countryList"></div>     
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="area" id="area" class="form-control" placeholder=""required /> 
          <label for="floatingInput">area:</label>      
          </div>                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name ="accion" value ="agregar" class="btn btn-success">Guardar</button>
            </form>
      </div>
    </div>
  </div>
</div>
<!-- MODAL PARA PROVEEDOR-->
<div class="modal fade" id="ModalNuevo1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura datos del proveedor:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
          <form method="post"  enctype="multipart/form-data">
          
                <div class="form-floating mb-3">
                <input type="text" name="nombreProveedor" id="nombre" class="form-control" placeholder=""required /> 
                <label for="floatingInput">Nombre:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="descripcionProveedor" id="descripcion" class="form-control" placeholder=""required /> 
                <label for="floatingInput">Descripcion:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="rfcProveedor" id="rfc" class="form-control" placeholder=""required /> 
                <label for="floatingInput">RFC:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="domicilioProveedor" id="domicilio" class="form-control" placeholder=""required /> 
                <label for="floatingInput">domicilio:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="telefonoProveedor" id="telefono" class="form-control" placeholder=""required /> 
                <label for="floatingInput">telefono:</label>      
                </div>
                <div class="form-floating mb-3">
                <input type="text" name="emailProveedor" id="email" class="form-control" placeholder=""required /> 
                <label for="floatingInput">email:</label>      
                </div>    
                         
            </div>
            
            <div class="modal-footer">
            <button type="button"value ="agregar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name ="accion" value ="proveedor" class="btn btn-success">Guardar</button>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- TERMINA MODAL PROVEEDOR-->

<!-- MODAL ENTRADA-->
<div class="modal fade" id="ModalNuevo2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura datos de entrada:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
          <form method="post"  enctype="multipart/form-data">
          
          <div class="form-floating mb-3">
          <input type="text" name="item" id="item" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Codigo de producto:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Cantidad:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="factura" id="factura" class="form-control" placeholder=""required /> 
          <label for="floatingInput"># Factura:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="costo" id="costo" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Costo de factura:</label>      
          </div>
                     
            </div>
            <div class="modal-footer">
            <button type="button"value ="agregar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" name ="accion" value ="entrada" class="btn btn-success">Guardar</button>
            </form>
      </div>
    </div>
  </div>
</div>
<!-- -->
<!-- MODAL SALIDA-->
<div class="modal fade" id="ModalNuevo3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Captura datos de entrada:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
          <form method="post"  enctype="multipart/form-data">
          
          <div class="form-floating mb-3">
          <input type="text" name="itemSalida" id="itemSalida" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Codigo de producto:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="cantidadSalida" id="cantidadSalida" class="form-control" placeholder=""required /> 
          <label for="floatingInput">Cantidad:</label>      
          </div>
          <div class="form-floating mb-3">
          <input type="text" name="obra" id="obra" class="form-control" placeholder=""required /> 
          <label for="floatingInput"># Obra:</label>      
          </div>         
          </div>
          <div class="modal-footer">
          <button type="button"value ="agregar" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name ="accion" value ="salida" class="btn btn-success">Guardar</button>
          </form>
      </div>
    </div>
  </div>
</div>
<!-- -->

<!-- MODAL SALIDA AGREGANDO FILAS-->
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
                <input type="text" class="col-2" name ="numeroSalida">
              </td>
                
              <td>
                <label for="">Numero de Obra</label>
                <input type="text" class="col-2" name ="Obra">
              </td>
            </tr>
          </tbody>
        </table>

          <table class="table"  id="tabla">
        	<tr >
          
						<td><input type="text" class="form-control" name="idProducto[]" placeholder="ID Producto"/></td>
						<td><input type="text" required name="Cantidad[]" placeholder="Cantidad"/></td>
						<!-- <td><input type="text" required name="Obra[]" placeholder="Obra"/></td> -->
						<td class="eliminar"><input type="button"   value="Menos -"/></td>
					</tr>
				</table>

				<div class="btn-der">
					<!-- <input type="submit" name="insertar" value="Guardar" class="btn btn-success"/> -->
          <button type="submit" name ="accion" value ="salida2" class="btn btn-success">Guardar todo</button>
					<button id="adicional" name="adicional" type="button" class="btn btn-warning"> Agregar mas lineas </button>

				</div>
          
          </form>
      </div>
    </div>
  </div>
</div>

<!-- 
codigo original agregar filas  
<div class="modal fade" id="ModalNuevo4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Captura datos de salida:</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
      <div class="modal-body">
          <form method="post"  enctype="multipart/form-data">
          
				<table class="table"  id="tabla">
					<tr     >
						<td><input required name="idalumno[]" placeholder="ID Producto"/></td>
						<td><input required name="nombre[]" placeholder="Cantidad"/></td>
						<td><input required name="carrera[]" placeholder="Fecha"/></td>
						<td><input required name="grupo[]" placeholder="Obra"/></td>
						<td class="eliminar"><input type="button"   value="Menos -"/></td>
					</tr>
				</table>

				<div class="btn-der">
					<input type="submit" name="insertar" value="Guardar" class="btn btn-success"/>
					<button id="adicional" name="adicional" type="button" class="btn btn-warning"> Más + </button>

				</div>
          
          </form>
      </div>
    </div>
  </div>
</div>-->
<!-- -->
<?php

				//////////////////////// PRESIONAR EL BOTÓN //////////////////////////
				if(isset($_POST['insertar']))

				{


				$items1 = ($_POST['idalumno']);
				$items2 = ($_POST['nombre']);
				$items3 = ($_POST['carrera']);
				$items4 = ($_POST['grupo']);
				 
				///////////// SEPARAR VALORES DE ARRAYS, EN ESTE CASO SON 4 ARRAYS UNO POR CADA INPUT (ID, NOMBRE, CARRERA Y GRUPO////////////////////)
				while(true) {

				    //// RECUPERAR LOS VALORES DE LOS ARREGLOS ////////
				    $item1 = current($items1);
				    $item2 = current($items2);
				    $item3 = current($items3);
				    $item4 = current($items4);
				    
				    ////// ASIGNARLOS A VARIABLES ///////////////////
				    $id=(( $item1 !== false) ? $item1 : ", &nbsp;");
				    $nom=(( $item2 !== false) ? $item2 : ", &nbsp;");
				    $carr=(( $item3 !== false) ? $item3 : ", &nbsp;");
				    $gru=(( $item4 !== false) ? $item4 : ", &nbsp;");

				    //// CONCATENAR LOS VALORES EN ORDEN PARA SU FUTURA INSERCIÓN ////////
				    $valores='('.$id.',"'.$nom.'","'.$carr.'","'.$gru.'"),';

				    //////// YA QUE TERMINA CON COMA CADA FILA, SE RESTA CON LA FUNCIÓN SUBSTR EN LA ULTIMA FILA /////////////////////
				    $valoresQ= substr($valores, 0, -1);
				    
				    ///////// QUERY DE INSERCIÓN ////////////////////////////
				    
                    $sqla ="SELECT FROM productos where id_producto = $items1 "; 
                    $sqla->execute();
                    $productos=$sql->fetch(PDO::FETCH_LAZY);
                    if (!$productos){
                         $mensaje2=  "El Codigo del producto no esta registrado! Registralo en la opcion de PRODUCTOS. <a href='productos_giralda.php'>ir</a>";
                                }                              
                       else {

                     $sql = "INSERT INTO salidas_almacen (id_producto,cantidad,fecha,obra) 
					 VALUES $valoresQ"; 
                       }

                    
					$sqlRes=$conexion->query($sql) or mysql_error();

				    
				    // Up! Next Value
				    $item1 = next( $items1 );
				    $item2 = next( $items2 );
				    $item3 = next( $items3 );
				    $item4 = next( $items4 );
				    
				    // Check terminator
				    if($item1 === false && $item2 === false && $item3 === false && $item4 === false) break;
    
				}
		
				}

                    ?>

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
                <th>#producto</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>proveedor</th>
                <th>area</th>
                <th>existencia</th>
                
                
                
                
                
            </tr>
        </thead>
        <tbody>
        <?php foreach ($empleados as $result) {?>
            <tr>
                <td><?PHP echo $result ['id_producto'];?></td>   
                <td><?PHP echo $result ['nombre'];?></td>
                <td><?PHP echo $result ['descripcion'];?></td>
                <td><?PHP echo $result ['proveedor'];?></td>
                <td><?PHP echo $result ['area'];?></td>
                <td><?PHP echo $result ['existencia'];?></td>
                
                
            </tr>
            <?php } ?>      
        </tbody>
        
    </table>

    
</div>
 


<!-- Agrega filas -- >
 <script type='text/javascript'>
        function addFields(){
            // Generate a dynamic number of inputs
            var number = document.getElementById("member").value;
            // Get the element where the inputs will be added to
            var container = document.getElementById("container");
            // Remove every children it had before
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
            for (i=0;i<number;i++){
                // Append a node with a random text
                container.appendChild(document.createTextNode("Member " + (i+1)));
                // Create an <input> element, set its type and name attributes
                var input = document.createElement("input");
                input.type = "text";
                input.name = "member" + i;
                container.appendChild(input);
                // Append a line break 
                container.appendChild(document.createElement("br"));
            }
        }
    </script>
</head>
<body>
    <input type="text" id="member" name="member" value="">Number of members: (max. 10)<br />
    <a href="#" id="filldetails" onclick="addFields()">Fill Details</a>
    <div id="container"/> -->
<?php include ("../template/footer.php");?>