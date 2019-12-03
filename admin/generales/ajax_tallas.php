<?php
include '../common/sesion.php';
require '../../common/conexion.php';
$respuesta=0;
if (isset($_GET['band']) and $_GET['band']==1){
if(isset($_GET['talla'])){
$talla=$_GET['talla'];
$sql="INSERT INTO TALLAS (`TALLA`) VALUES ('$talla')";
if($conn->query($sql)===TRUE){$respuesta=1;}else{$respuesta=2;}
}
}else{
if(isset($_GET['delete']) & !empty($_GET['delete'])){
$idtalla=$_GET['delete'];
$sql="DELETE FROM MARCAS WHERE IDMARCA='$idtalla'";
if($conn->query($sql)===TRUE){$respuesta=1;}else{$respuesta=2;}
}
}
echo "$respuesta";
