<?php
session_start();

    include_once 'Common/conexion.php';

    $pago_ok='Pago Exitoso';
    $pago_pen='Pago Pendiente';
    $pago_falla='Pago Fallido';

    $msn_ok='Nos complace que te hayas decidido a comprar en ROUXA. El pago ya ha sido procesado como exitoso. Por lo que tu compra es todo un hecho, en las proximas  cuarenta y ocho (48) horas estaremos enviando tu pedido.';

    $msn_pen='Nos complace que te hayas decidido a comprar en ROUXA. El pago ha sido procesado como pendiente, una vez la plataforma de Mercado Pago realice la aprobación del dinero, tu pedido será enviado dentro de las proximas cuarenta y ocho (48) horas.';

    $msn_falla='El pago ha sido cancelado, esperamos que pronto este de vuelta. Gracias por visitarnos.';

    $msn_seguimiento='Recuerda que puedes hacerle seguimiento a tu pedido a través del IDCOMPRA. Solo debes dirigirte a "Compras" en el menu principal, añadir tu ID y ¡Listo!. Muchas Gracias por tu Compra, Te queremos.';
   ?>

  <!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <meta name="desciption" content="Rouxa, Tienda virtual de Ropa para Damas, Caballeros y Niños.">
    <meta name="keywords" content="Rouxa, Ropa, Damas, Caballeros, Zapatos, Tienda Virtual">
    <meta name="author" content="Eutuxia, C.A.">
    <meta name="application-name" content="Tienda Virtual de Ropa, Rouxa." />
     <link rel="stylesheet" href="css/style-main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <!-- Font -Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" integrity="sha384-p2jx59pefphTFIpeqCcISO9MdVfIm4pNnsL08A6v5vaQc4owkQqxMV8kg4Yvhaw/" crossorigin="anonymous">

  <!-- Para anuncios de google -->
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-8952175764108741",
    enable_page_level_ads: true
  });
</script>

    <title>Rouxa</title>
  </head>
   <script>
        function deshabilitaRetroceso(){
    window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button" //chrome
    window.onhashchange=function(){window.location.hash="no-back-button";}
            }
    </script>
  <body onload="deshabilitaRetroceso()">
   <?php include_once 'menu.php';?>



<!--
 Inicio de codigo.
 !-->


           <?php

        if (isset($_GET['back']) and isset($_GET['id'])){
            $back=$_GET['back'];
            $id=md5($_GET['id']);

            switch($back){
                //success
                case '1':
                    ?>
     <div class="jumbotron mb-0" style="min-height:100vh">
      <h1 class="display-4"  style="color: #0d0;"><?php echo $pago_ok;?></h1>
      <p  class="lead"><?php echo $msn_ok;?></p>
       <hr class="my-4">
        <p  ><?php echo $msn_seguimiento;?>
    </div>


                    <?php

                    break;
                case '2':
                     ?>

    <div class="jumbotron mb-0" style="min-height:100vh">
      <h1 class="display-4"  style="color:#00d"><?php echo $pago_pen;?></h1>
      <p  class="lead"><?php echo $msn_pen;?></p>
       <hr class="my-4">
        <p  ><?php echo $msn_seguimiento;?>
    </div>

                    <?php


                    break;
                case '3':
                     ?>

  <div class="jumbotron mb-0" style="min-height:100vh">
      <h1 class="display-4"  style="color:#d00"><?php echo $pago_falla;?></h1>
       <hr class="my-4">
      <p  class="lead"><?php echo $msn_falla;?></p>
    </div>

                    <?php

                      $sql0="
                        DELETE FROM ENVIOS WHERE IDPEDIDO='$id'";
                        if ($conn->query($sql0) === TRUE) {

                        } else {
                        echo "Error: " . $sql0 . "<br>" . $conn->error;
                        }
                        $sql0="
                        DELETE FROM ITEMS WHERE IDPEDIDO='$id'";
                        if ($conn->query($sql0) === TRUE) {

                        } else {
                        echo "Error: " . $sql0 . "<br>" . $conn->error;
                        }

                        $sql0="UPDATE `PEDIDOS` SET `ESTATUS`='1' WHERE  `IDPEDIDO`='$id'";

                        if ($conn->query($sql0) === TRUE) {

                        } else {
                        echo "Error: " . $sql0 . "<br>" . $conn->error;
                        }

                    break;

            }}
            session_destroy();
               ?>


<!--
Fin  de codigo.
 !-->

<!--
Pie de Pagina
 !-->
<?php include_once 'Pie.php';?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
  </body>
</html>
