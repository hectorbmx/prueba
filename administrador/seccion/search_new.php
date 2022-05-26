<?php 
    // AQUI ESTE ES UNA OPCION PARA REALIZAR VARIAS OPCIONES
    // TANTO BUSQUEDA, PROCESOS, Y LO QUE NECESITAS
    include ("../config/bd.php"); //Se incluye la BD
    //Se inicializan las variables
    $ul_begin = '<ul>';
    $li_text = '';
    $ul_end = '</ul>';

    // Se validan los datos a recibir
    // ES LO UNICO QUE NECESITAS
    // SI NO HAY ALGÚN DATO SE MUESTRA EL ERROR
    if(
        !isset($_POST["queryMethod"]) ||
        !isset($_POST["searchQuery"])
    )
    {
        $li_text = '<li>Error al recibir los parámetros, favor de revisar</li>';
        echo $ul_begin.$li_text.$ul_end;
    }
    else
    {
        // SE OBTIENEN LOS DATOS
        $queryMethod = $_POST["queryMethod"]; // Metodo de busqueda
        $searchQuery = $_POST["searchQuery"]; // Texto de la búsqueda

        switch ($queryMethod) {
            case 1: // BÚSQUEDA EN LA TABLA costos_obra
                if($searchQuery) // SI HAY DATOS SE HACE LA BUSQUEDA
                {
                    //CONSULTA DE BASE DE DATOS
                    $sql=$conexion->prepare("SELECT * FROM costos_obra WHERE codigo LIKE '%".$searchQuery."%'" ); 
                    $sql->execute();
                    $result =$sql->fetchall(PDO::FETCH_ASSOC);
                    
                    // SI HAY RESULTADOS SE MUESTRAN LOS DATOS
                    if(count($result) > 0)
                    {
                        foreach ($result as $row)
                        {
                            $li_text .= '<li>'.$row["codigo"].' - '.$row["concepto"].'</li>';
                        }
                    }
                    else // SI NO HAY RESULTADOS
                    {
                        $li_text = '<li>No existen registros</li>';
                    }
            
                    echo $ul_begin.$li_text.$ul_end;
                }
            break;
        }

    }
?>