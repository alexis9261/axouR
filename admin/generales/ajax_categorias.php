<?php
include '../common/sesion.php';
require '../../common/conexion.php';
$respuesta=0;
if (isset($_GET['band']) and $_GET['band']==1){
if(isset($_GET['nombre'],$_GET['padre']) and !empty($_GET['nombre'])){
$nombre=$_GET['nombre'];
$padre=$_GET['padre'];
$sql="INSERT INTO `CATEGORIAS`(`NOMBRE`,`PADRE`) VALUES ('$nombre','$padre')";
if($conn->query($sql)===TRUE){$respuesta=1;}else{$respuesta=2;}
}
}else{
if(isset($_GET['delete']) & !empty($_GET['delete'])){
$id=$_GET['delete'];
$sql="DELETE FROM CATEGORIAS WHERE IDCATEGORIA='$id'";
if($conn->query($sql)===TRUE){$respuesta=1;}else{$respuesta=2;}
}
}
echo "$respuesta";
