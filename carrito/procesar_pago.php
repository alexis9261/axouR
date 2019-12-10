<?php
 require '../common/conexion.php';
 $respuesta=1;
 //consegir mediante GET or POST  CI & Codigo
 if(isset($_POST['id_pedido'],$_POST['banco_e'],$_POST['banco_r'],$_POST['monto'],$_POST['referencia'],$_POST['fechapago'])){
   $idPedido=$_POST['id_pedido'];
   //Validar que existe el PEDIDO
   $sql="SELECT * FROM pedidos WHERE IDPEDIDO='$idPedido' LIMIT 1";
   $result=$conn->query($sql);
   if($result->num_rows>0){
     $bancoe=$_POST['banco_e'];
     $bancor=$_POST['banco_r'];
     $monto=$_POST['monto'];
     if(isset($_POST['moneda'])){
       $moneda=$_POST['moneda'];
     }else{
       $moneda="Bs";
     }
     //$moneda=;
     $ref=$_POST['referencia'];
     $fecha=$_POST['fechapago'];
     if($bancoe!=NULL && $bancor!=NULL && $monto!=NULL && $ref!=NULL && $fecha!=NULL){
       //Limpiar string
       $bancoe=str_replace("'","",$bancoe);
       $bancor=str_replace("'","",$bancor);
       $ref=str_replace("'","",$ref);
       $sql="INSERT INTO `pagos` (`IDPEDIDO`,`BANCOEMISOR`,`BANCORECEPTOR`,`MONTO`,`MONEDA`,`REFERENCIA`,`FECHAPAGO`,`ESTATUS`) VALUES ('$idPedido','$bancoe','$bancor','$monto', '$moneda','$ref','$fecha','0')";
       if($conn->query($sql)===TRUE){
         $sql2="UPDATE `pedidos` SET `ESTATUS`='2' WHERE `IDPEDIDO`='$idPedido';";
         if($conn->query($sql2)===TRUE){$respuesta=0;}
       }
     }
   }
 }
 if($respuesta!=0){$respuesta=2;}
header("Location: ../perfil/detalles.php?id=$idPedido&resp=$respuesta");
?>
