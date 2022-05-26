
<?php include ("../config/bd.php");

$ruta = "Upload/";

foreach ($_FILES as $key){
        $nombre =$key["name"];
        $ruta_temp=$key ["tmp_name"];
        $destino=$ruta.$nombre;
        $fecha =getdate();
        $explo=explode(".",$nombre);
        if ($explo [1] !="csv"){
          $alert=1;
        }else{

          if(move_uploaded_file($ruta_temp,$destino)){
            $alert=2;
          }

        }
        // print_r ($fecha);
        // print_r($nombre);
        // print_r($ruta_temp);
        // die();
}     
      $x=0;
      $data=array();
      $fichero=fopen($destino, "r");
      while (($datos = fgets($fichero,200)) !=FALSE){
        // var_dump ($datos);
        $x++;
        if($x>1){
          //  $codigo[] ='("'.$datos[0].''.$datos[1].''.$datos[2].''.$datos[3].''.$datos[4].''.$datos[5].'")';
          $data[]='('.$datos[0].','.$datos[1].','.$datos[2].','.$datos[3].','.$datos[4].')';
          // $data[]='("'.$datos[0].'")';
          // $data[]='("'.$datos[0].'","'.$datos[1].'","'.$datos[2].'")';
          //  $data[]='("'.$datos[0].'","'.$datos[1].'","'.$datos[2].'","'.$datos[3].'","'.$datos[4].'","'.$datos[5].'","'.$datos[6].'")';
          var_dump ($data);
          echo "<Br>";
          print_r($data);
        }

      }
      // print_r ($data);
      // echo "<br>";
      // var_dump ($data);
      // echo "<br>";
      // echo "aqui es el vardump datos";
      // echo "<br>";
      
      
?>