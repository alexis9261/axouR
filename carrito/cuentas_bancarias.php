<?php
session_start();
include '../common/conexion.php';
include '../cambioDolar/index.php';
include '../common/datosGenerales.php';
//mensaje de $msn_cuentas
$msn_cuentas="";
if(isset($_SESSION['monto'])){$monto=$_SESSION['monto'];}
//require ('../common/mercadopago.php');
//$mp=new MP('1153047962046613', 'i3RGdgCvJXrKT1ceMNOHs4YLNHdgZ9Mj');
if(isset($_POST['direccion'])){
  $direccion=str_replace("'","",$_POST['direccion']);
  $postal=$_POST['postal'];
  if(isset($_POST['encomienda_aux'],$_POST['estado_aux'],$_POST['municipio_aux'])){
    $estado=$_POST['estado_aux'];
    $municipio=$_POST['municipio_aux'];
    $encomienda=$_POST['encomienda_aux'];
  }else{
    $estado=$_POST['estado'];
    $municipio=$_POST['municipio'];
    $encomienda=$_POST['encomienda'];
  }
  if(isset($_POST['isfacture'])){
    $razon=$_POST['razon-social'];
    $identidad=$_POST['type-identidad'].'-'.$_POST['doc-identidad'];
    $dir_fiscal=$_POST['dir-fiscal'];
    //Se agregan estos datos a los datos del usuario
    $sql="INSERT INTO USUARIOS (RAZONSOCIAL,RIFCI,DIRFISCAL) VALUES ('$razon','$identidad','$dir_fiscal');";
    if($conn->query($sql)===TRUE){}
  }else{$razon='';$identidad='';$dir_fiscal='';}
  include 'comprar.php';
  //Enviar mail
  /*$cliente_mail=$_SESSION['nombre-cliente'];
  $destino=$_SESSION['email-cliente'];
  $titulo="Compra en Rouxa";
  $contenido = '<html>
  <head>
  <title>Rouxa</title>
  </head>
  <body>
  <h1>Compra en rouxa</h1>
  <p style="color:black">Un saludo cordial '.$cliente_mail.',
  <br>Agradecemos tu compra realizada en nuestra tienda virtual Rouxa, Recuerda que puedes hacerles seguimiento a traves del siguiente ID.
  <br>Que tengas un Feliz Dia.
  </p>
  <h4> IDCOMPRA: '.$Llave.'</h4>
</body>
</html>';
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: Rouxa <Rouxavzla@gmail.com>" . "\r\n";
mail($destino, $titulo, $contenido, $headers);
*/
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="desciption" content="Rouxa, Tienda virtual de Ropa para Damas, Caballeros y Niños.">
  <meta name="keywords" content="Rouxa, Ropa, Damas, Caballeros, Zapatos, Tienda Virtual">
  <meta name="author" content="Eutuxia, C.A.">
  <meta name="application-name" content="Tienda Virtual de Ropa, <?php echo $nombrePagina;?>."/>
  <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
  <link rel="stylesheet" href="../css/new.css">
  <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  <title><?php echo $nombrePagina;?></title>
</head>
<body>
  <?php include '../common/menu.php';include '../common/2domenu.php';?>
  <div class="container mb-2">
    <div class="row align-items-center">
      <div class="col-auto text-center">
        <img src="../admin/img/<?php echo $imageLogo;?>" width="40px" height="auto">
      </div>
      <div class="col-auto text-center">
        <h2 style="font-family: 'Playfair Display', serif;">¡Felicidades por tu Compra!</h2>
      </div>
      <div class="col-auto ml-auto align-self-end">
        <small class="text-muted">Puedes ver los detalles de tu compra en <a href="../perfil/compras.php">Mis compras</a> </small>
      </div>
      <!--div class="col-auto ml-auto">
        <a class="enlace2" href="index.php"><small>Carrito de compras </small></a> ->
        <a class="enlace2" href="datos_compra.php"><small>Datos </small></a> ->
        <small class="text-primary">Pago</small>
      </div-->
    </div>
  </div>
  <div class="container mb-0">
    <div class="row bg-light my-3 py-2">
      <h5 class="col-sm-4 text-muted"><b>Banesco</b></h5>
      <h6 class="col-sm-4"><b>N°</b> 0134 0464 03 4641026277</h6>
      <h6 class="col-sm-4 text-center"><b>Tipo: </b>Corriente</h6>
      <h5 class="col-sm-4 text-muted"><b>Banco Mercantil</b></h5>
      <h6 class="col-sm-4"><b>N°</b>0105 0283 7512 83148412</h6>
      <h6 class="col-sm-4 text-center"><b>Tipo: </b>Corriente</h6>
      <h5 class="col-sm-4 text-muted"><b>Banco Provincial</b></h5>
      <h6 class="col-sm-4"><b>N°</b> 0108 0558 9901 00043593</h6>
      <h6 class="col-sm-4 text-center"><b>Tipo: </b>Corriente</h6>
      <h5 class="col-sm-4 text-muted"><b>Banco del Tesoro</b></h5>
      <h6 class="col-sm-4"><b>N°</b> 0163 0217 1121 73013146</h6>
      <h6 class="col-sm-4 text-center"><b>Tipo: </b>Corriente</h6>
      <hr class="col-sm-11">
      <h6 class="col-sm-6 text-center"><b>Titular: </b>Rouxa, C.A.</h6>
      <h6 class="col-sm-6 text-center"><b>RIF: </b>J-XXXXXXX</h6>
    </div>
    <div class="row bg-light my-3 py-2">
      <h5 class="col-sm-12 text-dark text-center"><b>Monto:</b> <?php echo number_format($monto*$dolar,2, ",","."); ?> Bs </h5>
    </div>
    <div class="container-fluid text-center bg-light mt-3 pt-2">
      <div class="row justify-content-center">
        <div class="container text-muted">
          <small>Ten encuenta que nuestro sistema cancela tu pedido de no recibir un <i>Reporte de pago</i>, luego de venticuatro (24) Horas. Procura transferir y hacer el reporte los más pronto posible.</small>
        </div>
      </div>
    </div>
  </div>
  <hr class="my-4">
    <?php
    /**
    Mercadopago
    **/
    /*
    if (isset($_POST['nombre-cliente'])){
      $doc=$_SESSION['type-identidad-cliente'].'-'.$_SESSION['doc-identidad-cliente'];
      $id_mp=md5($Llave.$doc); //id registrado en el inventario
      $cliente_mp=$_POST['nombre-cliente'];
    }
    if (!empty($monto) and isset($_POST['nombre-cliente']) and isset($_POST['email-cliente'])){
      $preference_data = array(
      "items" => array(
      array(
      "title" => "Carrito de compras en Rouxa - $cliente_mp",
      "quantity" => 1,
      "currency_id" => "VEF", // Available currencies at: https://api.mercadopago.com/currencies
      "unit_price" =>  $monto
      )
      ),
      "payer" => array(
      "name"=>$_POST['nombre-cliente'],
      "email"=>$_POST['email-cliente'],
      ),
      "back_urls"=> array(
      "success"=> "https://www.rouxa.com.ve/back_MP.php?back=1&id=$id_mp",
      "pending"=> "https://www.rouxa.com.ve/back_MP.php?back=2&id=$id_mp",
      "failure"=> "https://www.rouxa.com.ve/back_MP.php?back=3&id=$id_mp"
      ),
      "notification_url"=> "https://www.rouxa.com.ve/receptor/",
      "external_reference"=>"$id_mp"
      );
      $preference = $mp->create_preference($preference_data);
      ?>
      <div class="continer mb-3">
        <div class="row justify-content-around">
          <a href="<?php echo $preference['response']['init_point']; ?>" id="boton-mercadopago" class="btn btn-outline-success btn-lg  col-4">Pagar</a>
        </div>
        <div class="row justify-content-around my-2">
          <small>Si desea cancelar la Compra presione: <a href="index.php?reset=" id="boton-mercadopago" class="text-muted">Vaciar Carrito</a></small>
        </div>
      </div>
      <?php
    }

    */
    ?>
    <div class="container mt-2">
      <div class="row justify-content-center">
        <a href="../index.php" target="_blank"><img src="../admin/img/<?php echo $imageLogo;?>" alt="" width="40px"></a>
      </div>
    </div>
    <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
