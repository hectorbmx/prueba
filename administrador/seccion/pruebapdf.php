<?php
include ("../config/bd.php");
require('fpdf/fpdf.php');
class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    // $this->Image('logo.pnjpfg',10,8,33);
    // Arial bold 15
    // $this->SetFont('Arial','B',15);
    // // Movernos a la derecha
    // $this->Cell(60);
    // // Título
    // $this->Cell(60,10,'Rivera Construcciones',1,0,'C');
    // // Salto de línea
    // $this->Ln(20);
    
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}



$sql= $conexion->prepare("SELECT * from costos_obra limit 10"); 
$sql->execute();
$consulta=$sql->fetchall(PDO::FETCH_ASSOC);

foreach($consulta as $con){
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',10);
    $pdf->Image('logo.jpeg',10,8,63);
    $pdf->setXY(30,60);
    $pdf->Cell(40,10,'Cliente',1,0,'F');
    $pdf->Cell(40,10,'Obra',1,0,'D');
    $pdf->Cell(40,10,'fecha',1,0,'D');
    $pdf->Ln(0);
   
    // echo '<br>';
    // echo $con['codigo'];
    // echo '<br>';
    // $pdf->Cell(40,10,'Fecha',1,0,'D');
}
// Creación del objeto de la clase heredada
// $pdf = new PDF();
// $pdf->AliasNbPages();
// $pdf->AddPage();
// $pdf->SetFont('Times','',12);
// $pdf->Cell(40,10,'Cliente',1,0,'D');
// $pdf->Cell(40,10,'Obra',1,0,'D');
// $pdf->Cell(40,10,'',1,0,'D');
// $pdf->Cell(40,10,'Fecha',1,0,'D');




// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,utf8_decode('Imprimiendo línea número ').$i,0,1);
$pdf->Output();
?>

