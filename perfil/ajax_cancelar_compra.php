<?php
require '../common/conexion.php';
$respuesta=0;
if(isset($_GET['id_pedido'],$_GET['text'])){
  $id_pedido=$_GET['id_pedido'];
  $motivo=$_GET['text'];
  $sql="UPDATE `pedidos` SET `ESTATUS`=8,`TEXTO`='$motivo' WHERE IDPEDIDO='$id_pedido';";
  if($conn->query($sql)===TRUE){$respuesta=1;}else{$respuesta=0;}
}
echo "$respuesta";
