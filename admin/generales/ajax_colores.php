<?php
include '../common/sesion.php';
require '../../common/conexion.php';
$respuesta=0;
if (isset($_GET['band']) and $_GET['band']==1){
if(isset($_GET['color']) and isset($_GET['color_hex'])){
$color=$_GET['color'];
$hex=$_GET['color_hex'];
$sql="INSERT INTO COLOR (`COLOR`,`HEX`) VALUES ('$color','$hex')";
if($conn->query($sql)===TRUE){$respuesta=1;}else{$respuesta=2;}
}
}
echo "$respuesta";
