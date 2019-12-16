<?php if(!isset($_SESSION)){session_start();}
//Requiere de que el comando de inicio de session haya sido llamado.
include '../common/conexion.php';
include '../common/datosGenerales.php';
include '../cambioDolar/index.php';
$STATUS_START=0;
//AÑADIR VARIABLE SOLICITADA [CS=compra solicitada], se esta contando las cantidades de compras solicitadas
$sql="SELECT `VALUE` FROM variables WHERE `NOMBRE`='CS'";
$result=$conn->query($sql);
if($result->num_rows>0){while($row=$result->fetch_assoc()){$CS=$row["VALUE"];}}
$CS=$CS+1;
$sql="UPDATE `variables` SET `VALUE`=$CS WHERE `NOMBRE`='CS';";
if($conn->query($sql)===FALSE){}
//Se crea el pedido
$sql="INSERT INTO `pedidos` (EMAILUSER,ESTATUS,FECHAPEDIDO) VALUES ('$email_user','$STATUS_START',NOW());";
if($conn->query($sql)===TRUE){$id_pedido=mysqli_insert_id($conn);}
if(isset($id_pedido) && !empty($id_pedido)){
  //Se crea la compra
  $montoActual=$monto*$dolar;
  $sql2="INSERT INTO `compras`(`PEDIDOID`,`MONTO`) VALUES ('$id_pedido','$montoActual');";
  if($conn->query($sql2)===FALSE){}
  //Se agregan los productos del carrito a la tabla Items
  if(isset($_SESSION['carrito'])){
    $datos=$_SESSION['carrito'];
    foreach($datos as $d){
      $id_inventario=$d['Id'];
      $cantidad_item=$d['Cantidad'];
      $precio_item=$d['Precio']*$dolar;
      $sql_item="INSERT INTO `items` (`PEDIDOID`,`INVENTARIOID`,`CANTIDAD`,`PRECIO`) VALUES ('$id_pedido','$id_inventario','$cantidad_item','$precio_item')";
      if($conn->query($sql_item)==FALSE){}
    }
  }
  //verifico el numero telefonico
  if(!isset($telefono)){$telefono="";}
  //Se agragan los datos de envio
  if(isset($_POST['isfacture'])){
    $sql="INSERT INTO `envios`(`PEDIDOID`,`ESTADO`,`MUNICIPIO`,`DIRECCION`,`CODIGOPOSTAL`,`RECEPTOR`,`CIRECEPTOR`,`TELFRECEPTOR`,`ENCOMIENDA`,`GUIA`,`FACTFISCAL`)
    VALUES ('$id_pedido','$estado','$municipio','$direccion','$postal','$email_user','$identidad','$telefono','$encomienda',NULL,1)";
  }else{
    $sql="INSERT INTO `envios`(`PEDIDOID`,`ESTADO`,`MUNICIPIO`,`DIRECCION`,`CODIGOPOSTAL`,`RECEPTOR`,`CIRECEPTOR`,`TELFRECEPTOR`,`ENCOMIENDA`,`GUIA`,`FACTFISCAL`)
    VALUES ('$id_pedido','$estado','$municipio','$direccion','$postal','$email_user','$identidad','$telefono','$encomienda',NULL,0)";
  }
  if($conn->query($sql)===TRUE){}
  #Se resta del inventario
  $datos=$_SESSION['carrito'];
  for($i=0;$i<count($datos);$i++){
    #conseguir Id de inventario
    $idinv=$datos[$i]['Id'];
    $cantidad=$datos[$i]['Cantidad'];
    $sql="UPDATE `inventario` SET CANTIDAD=CANTIDAD-$cantidad WHERE IDINVENTARIO=$idinv";
    if($conn->query($sql)===TRUE){
      //Se destruye el carrito de compras
      unset($_SESSION['carrito']);
      unset($_SESSION['monto']);
      unset($_SESSION['total_items']);
    }
  }
}
$conn->close();
?>
