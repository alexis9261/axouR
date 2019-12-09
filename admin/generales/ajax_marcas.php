<?php
include '../common/sesion.php';
require '../../common/conexion.php';
$respuesta=0;
if (isset($_GET['band']) and $_GET['band']==1){
if(isset($_GET['marca'])){
$marca=$_GET['marca'];
$sql="INSERT INTO MARCAS (`NOMBREMARCA`) VALUES ('$marca')";
if($conn->query($sql)===TRUE){$respuesta=1;}else{$respuesta=2;}
}
}
echo "$respuesta";
