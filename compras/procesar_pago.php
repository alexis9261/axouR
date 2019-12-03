<?php
 require_once '../common/conexion.php';
if (isset($_POST['pass'])){
  if($_POST['pass']==md5('Venezuela Libre')){
    //consegir mediante GET or POST  CI & Codigo
    if(isset($_POST['docid'], $_POST['idcompra'], $_POST['bancoe'], $_POST['bancor'], $_POST['monto'], $_POST['moneda'], $_POST['referencia'], $_POST['fecha'])){
    $docid=$_POST['docid'];
    $id=$_POST['idcompra'];
    if ($id!=NULL){
      $id=md5($id.$docid);
      //Validar que existe el PEDIDOS
      $sql="SELECT * FROM PEDIDOS WHERE IDPEDIDO='$id'";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
          // output data of each row
          $bancoe=$_POST['bancoe'];
          $bancor=$_POST['bancor'];
          $monto=$_POST['monto'];
          $moneda=$_POST['moneda'];
          $ref=$_POST['referencia'];
          $fecha=$_POST['fecha'];
          if ($bancoe!=NULL && $bancor!=NULL && $monto!=NULL && $moneda!=NULL && $ref!=NULL && $fecha!=NULL ){
            //Limpiar string
            $bancoe=str_replace("'","",$bancoe);
            $bancor=str_replace("'","",$bancor);
            $ref=str_replace("'","",$ref);
            //SQL line
            $sql = "INSERT INTO `PAGOS` (`IDPEDIDO`,`BANCOEMISOR`, `BANCORECEPTOR`, `MONTO`, `MONEDA`,`REFERENCIA`,`FECHAPAGO`,`ESTATUS`) VALUES ('$id','$bancoe','$bancor','$monto', '$moneda','$ref','$fecha','0')";
            if ($conn->query($sql) === TRUE) {
              $sql2="UPDATE `PEDIDOS` SET `ESTATUS`='2' WHERE  `IDPEDIDO`='$id'";
              if ($conn->query($sql2) === TRUE) {
                  echo 0;
              }else {
                echo -5;// Error en bbdd - Error al Guardar intentelo nuevamente.
                 //echo "Error: " . $sql2. "<br>" . $conn->error;
              }
            }else{
                echo -5;// Error en bbdd - Error al Guardar intentelo nuevamente.
            }

          }else{
            //error Falta datos de pago
            echo -4;
          }

      }else{
        //error de cedula o llave digital.
        echo -3;
      }
    }else{
      //falta llave digital
      echo -2;
    }
  }else{
      echo -1;
    }
  }
}
#header('Location: Reporte.php');
?>
