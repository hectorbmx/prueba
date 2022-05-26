<?php
include ("../config/bd.php"); 
include ("../template/cabecera.php");
$tipo       = $_FILES['dataCliente']['type'];
$tamanio    = $_FILES['dataCliente']['size'];
$archivotmp = $_FILES['dataCliente']['tmp_name'];
$lineas     = file($archivotmp);
$hoy =(date("Y-m-d"));

$i = 0;

foreach ($lineas as $linea) {
    $cantidad_registros = count($lineas);
    $cantidad_regist_agregados =  ($cantidad_registros - 1);

    if ($i != 0) {

        $datos = explode(",", $linea);
       //codigo que si funciona de prueba
        // $liente                = !empty($datos[0])  ? ($datos[0]) : '';
		// $area                   = !empty($datos[1])  ? ($datos[1]) : '';
        // $usuario                = !empty($datos[2])  ? ($datos[2]) : '';
        // $obra                   = !empty($datos[3])  ? ($datos[3]) : '';
        // $lugar_obra             = !empty($datos[4])  ? ($datos[4]) : '';
        // $atencion             = !empty($datos[6])  ? ($datos[6]) : '';
        // $fecha               = !empty($datos[7])  ? ($datos[7]) : '';
       
        // $sql=$conexion->prepare ("INSERT INTO presupuestos_ (id_cliente,id_area,id_usuario,nombre_obra,lugar_obra,atencion)
        // VALUES (:id_cliente,:id_area,:id_usuario,:nombre_obra,:lugar_obra,:atencion)");
        //  $sql->bindParam(':id_cliente',$cliente);
        //  $sql->bindParam(':id_area',$area);
        //  $sql->bindParam(':id_usuario',$usuario);
        //  $sql->bindParam(':nombre_obra',$obra);
        //  $sql->bindParam(':lugar_obra',$lugar_obra);
        //  $sql->bindParam(':atencion',$atencion);
        //   $id_obra       = !empty($datos[0])  ? ($datos[0]) : '';
          $id_obra        = !empty($datos[0])  ? ($datos[0]) : '';
		      $codigo        = !empty($datos[1])  ? ($datos[1]) : '';
          $concepto      = !empty($datos[2])  ? ($datos[2]) : '';
          $unidad        = !empty($datos[3])  ? ($datos[3]) : '';
          $cantidad      = !empty($datos[4])  ? ($datos[4]) : '';
          $precio        = !empty($datos[5])  ? ($datos[5]) : '';
          $importe       = !empty($datos[6])  ? ($datos[6]) : '';
          $incidencia    = !empty($datos[7])  ? ($datos[7]) : '';
          $fecha         = !empty($datos[8])  ? ($datos[8]) : '';

         $sql=$conexion->prepare ("INSERT INTO costos_obra (id_obra,codigo,concepto,tipo,unidad,cantidad,precio,importe,incidencia,fecha)
                                         VALUES (:id_obra,:codigo,:concepto,1,:unidad,:cantidad,:precio,:importe,:incidencia,:fecha)");
                                        //  VALUES (:id_obra,:codigo,:concepto,:unidad,:precio,:importe,:incidencia)");(id_obra,codigo,concepto,unidad,precio,importe,incidencia)
                                        //  ,:concepto,:unidad,:cantidad,:precio,:importe,:incidencia,:fecha) ");
             $sql->bindParam(':id_obra',$id_obra);
            $sql->bindParam(':codigo',$codigo);
             $sql->bindParam(':concepto',$concepto);
             $sql->bindParam(':unidad',$unidad);
             $sql->bindParam(':cantidad',$cantidad);
             $sql->bindParam(':precio',$precio);
             $sql->bindParam(':importe',$importe);
             $sql->bindParam(':incidencia',$incidencia);
             $sql->bindParam(':fecha',$hoy);                                        

         $sql->execute(); 
    }

      echo '<div>'. $i. "). " .$linea.'</div>';
    $i++;
}


  echo '<p style="text-aling:center; color:#333;">Total de Registros: '. $cantidad_regist_agregados .'</p>';

?>

<a href="importa.php">Atras</a>
<?php include ("../template/footer.php");?>