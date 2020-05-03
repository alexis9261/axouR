<?php
    session_start();
    include('fpdf/fpdf.php');

class PDF extends FPDF
{

// Cabecera de página
function titulo()
{
    // Logo
    $this->Image('imagen/Logo.jpg',130,10,50);
    // Arial bold 15
    $this->SetFont('Arial','B',16);
    // Título
     $this->Cell(30,10,'Recibo de compra',0,0,'L');
    // Salto de línea
    $this->Ln(20);
}
// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-35);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    //Nota
   //Nota
    $this->Cell(0,5,'Nota: Se agradece enviar este recibo de compra a nuestro correo: rouxavzla@gmail.com, una vez verificado el pago de la compra, el pedido ',0,1,'L');
    $this->Cell(0,10,' se enviará dentro de las proximas 24 a 48 horas.',0,1,'L');
    
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
}

// Tabla coloreada
function CreateTableSession($header)
{
    
    // Salto de línea
    $this->Ln(10);
    // Colores, ancho de línea y fuente en negrita
    $this->SetFillColor(50,50,50);
    $this->SetTextColor(255);
    $this->SetDrawColor(90,90,90);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
    // Cabecera
    $w = array(70,20, 45, 45);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
    $this->Ln();
    
    // Restauración de colores y fuentes
    $this->SetFillColor(255,255,255);
    $this->SetTextColor(0);
    $this->SetFont('');
    // Datos
    $fill = false;
    
    if(isset($_SESSION['carrito'])){
    $datos=$_SESSION['carrito'];
        
       for($i=0;$i<count($datos);$i++){
        
       
        $this->Cell($w[0],6,$datos[$i]['Nombre'],0,0,'C',$fill);
         $this->Cell($w[1],6,$datos[$i]['Talla'],0,0,'C',$fill);
         $this->Cell($w[2],6,$datos[$i]['Precio'],0,0,'C',$fill);
         $this->Cell($w[3],6,$datos[$i]['Cantidad'],0,0,'C',$fill);
          $this->Ln();
        $fill = !$fill;
     }
    
    // Línea de cierre
    $this->Cell(array_sum($w),0,'','T');
        
    }
    
    
    
    
}
}




$pdf = new PDF();
// Títulos de las columnas
$header = array('Producto', 'Talla', 'Precio [Bs]', 'Cantidad [Piezas]');
// Carga de datos

$pdf->AddPage();
$pdf->titulo();

$hoy=getdate();
$pdf->SetFont('Arial','',14);
 $pdf->Cell(0,10,'Fecha:'.$hoy['mday'].'/'.$hoy['mon'].'/'.$hoy['year'],0,1,'R');
 $pdf->Cell(0,10,'Numero de Orden:             ',0,1,'R');
$pdf->SetFont('Arial','',10);
if($_SESSION){
$pdf->Cell(0,10,'Cliente: '.$_SESSION['Nombre-Apellido']. ' | CI(RIF): '.$_SESSION['doc-identidad'] ,0,1,'L');
$pdf->Cell(0,10,'Telefono: '.$_SESSION['telefono'].' | Correo:  '.$_SESSION['correo'],0,1,'L');
$pdf->Cell(0,10,'Direccion:  '.$_SESSION['direccion'],0,1,'L');
$pdf->Cell(0,10,'Comentarios: '.$_SESSION['comentarios'],0,1,'L');

$pdf->SetFont('Arial','',8);
$pdf->CreateTableSession($header);
$pdf->Ln(10);
$pdf->SetFont('Arial','',20);

if(isset($_SESSION['total'])){
 $pdf->Cell(0,10,'Total: '.$_SESSION['total'].'.00   Bs',0,1,'C');   
}

$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'',0,1,'C');    
$pdf->Cell(0,10,'Detalles del Pago',0,1,'L');
$pdf->SetFont('Arial','',10);
$pdf->Cell(0,10,'Titular: '.$_POST['titular'],0,1,'L'); $pdf->Cell(0,10,'CI | RIF: '.$_POST['doc-identidad'],0,1,'L'); 
$pdf->Cell(0,10,'Correo: '.$_POST['correo'],0,1,'L'); $pdf->Cell(0,10,'Banco Emisor: '.$_POST['bancoE'],0,1,'L'); $pdf->Cell(0,10,'Banco Receptor: '.$_POST['bancoR'],0,1,'L'); $pdf->Cell(0,10,'Referencia: '.$_POST['ref'],0,1,'L');     
   
    
}
$pdf->Output();

include './Common/Incrementa_compras.php';

session_destroy();

?>