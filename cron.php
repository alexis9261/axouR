<?php
#ejecutese cada 30 minutos.
if(isset($_GET['acceso'])) {
  $key=$_GET['acceso'];
  $key=md5($key);
  if($key=='e95294b730f61c8175550ec244bfcb50'){
    //Acceso a la ejecucion del cron
    require 'common/conexion.php';
    #busca todos los pedidos con estatus 0 de mas de una hora de realizados
    $sql="SELECT p.IDPEDIDO, TIMESTAMPDIFF(MINUTE, p.FECHAPEDIDO ,NOW()) AS DIFTIME  FROM PEDIDOS p WHERE ESTATUS=0";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
         while($row = $result->fetch_assoc()) {
           #Identifica los pedidos con estatus "Por pagor"(0)
             $id_p=$row['IDPEDIDO'];
            #CONSIGUE EL DIF TIME DEL Pedido
            $dif_min= $row['DIFTIME'];
            #Pedidos realizados con mas de media(1/2) horas
            if($dif_min>30){
              #Enviar pedidos a fallidos.
              $sql="UPDATE `PEDIDOS` SET `ESTATUS`='1' WHERE  `IDPEDIDO`='$id_p'";
               if ($conn->query($sql) === TRUE) {
               }
              #devolver inventario Retenido.
              #ID PEDIDO.
             $id=$id_p;
             #devolver INVENTARIO
             $sql_devolucion1="SELECT * FROM ITEMS WHERE IDPEDIDO='$id'";
             $result_d = $conn->query($sql_devolucion1);
             if ($result_d->num_rows > 0) {
               while($row_d = $result_d->fetch_assoc()) {
                 #conseguir Id de inventario
                 $idinv=$row_d['IDINVENTARIO'];
                 #cantidad de inventario
                 $cantidad= $row_d['CANTIDAD'];
                 #Añadir INVENTARIO
                 $sql ="UPDATE INVENTARIO SET CANTIDAD=CANTIDAD+$cantidad WHERE IDINVENTARIO='$idinv'";
                 if($conn->query($sql) === TRUE){
                   #PRODUCTO AÑADIDO
                 }
                 else{
                   #echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>';
                 }
               }
             }
           }
         }
       }
    }
}
 ?>
