<?php
session_start();
include '../common/conexion.php';
$respuesta=0;
if(isset($_SESSION['USER'])){
  $user=$_SESSION['USER'];
  $sql="SELECT IDUSUARIO FROM USUARIOS WHERE CORREO='$user';";
  $result=$conn->query($sql);
  if($result->num_rows>0){while($row=$result->fetch_assoc()){$id_user=intval($row['IDUSUARIO']);}}
}
if(isset($_GET['id'],$_GET['e']) && !empty($_GET['id'])){
$idmodelo=intval($_GET['id']);
$aux=$_GET['e'];
if($aux==2){
  $sql="DELETE FROM `FAVORITOS` WHERE USERID='$id_user' AND MODELOID='$idmodelo'";
  if($conn->query($sql)===TRUE){$respuesta=2;}
}elseif($aux==1){
  $sql="INSERT INTO `FAVORITOS` (`USERID`,`MODELOID`) VALUES ($id_user,$idmodelo);";
  if($conn->query($sql)===TRUE){$respuesta=1;}
}
}
echo $respuesta;
?>
