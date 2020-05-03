<?php
  include '../common/conexion.php';
  include '../common/datosGenerales.php';
  include 'common/sesion.php';
  $email=$_SESSION['USUARIO'];
  $sql="SELECT NIVEL FROM ADMIN_USUARIOS WHERE CORREO='$email'";
  $result_nivel=$conn->query($sql);
  if($row=$result_nivel->fetch_assoc()){
    $_SESSION['nivel']=$row['NIVEL'];
  }
//infomacion mostradas
//Compras Completadas
$sql="SELECT COUNT(*) AS CUENTA FROM PEDIDOS WHERE ESTATUS=9";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    $completed=$row['CUENTA'];
  }
}else{
  $completed=0;
}
//Compras canceladass
$sql="SELECT COUNT(*) AS CUENTA FROM PEDIDOS WHERE ESTATUS=11";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    $canceled=$row['CUENTA'];
  }
}else{
  $canceled=0;
}
//Compras pago pendiente
$sql="SELECT COUNT(*) AS CUENTA FROM PEDIDOS WHERE ESTATUS=2";
$result = $conn->query($sql);
if($result->num_rows>0){
  while($row = $result->fetch_assoc()){
    $paypending=$row['CUENTA'];
  }
}else{
  $paypending=0;
}
//Compras enviados
$sql="SELECT COUNT(*) AS CUENTA FROM PEDIDOS WHERE ESTATUS=6";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    $sending=$row['CUENTA'];
  }
}else {
  $sending=0;
}
//Compras saldo insuficiente
$sql="SELECT COUNT(*) AS CUENTA FROM PEDIDOS WHERE ESTATUS=12";
$result = $conn->query($sql);
if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()) {
    $lowacount=$row['CUENTA'];
  }
}else {
  $lowacount=0;
}
//Compras compras totales
$sql="SELECT COUNT(*) AS CUENTA FROM PEDIDOS";
$result = $conn->query($sql);
if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()) {
    $totalpurchase=$row['CUENTA'];
  }
}else {
  $totalpurchase=0;
}
//Pagos
//Pagos por procesar
$sql="SELECT COUNT(*) AS CUENTA FROM PAGOS WHERE ESTATUS=0";
$result = $conn->query($sql);
if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()) {
    $toprocess=$row['CUENTA'];
  }
}else {
  $toprocess=0;
}
//Pagos por procesar
$sql="SELECT COUNT(*) AS CUENTA FROM PAGOS WHERE ESTATUS=1";
$result = $conn->query($sql);
if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()) {
    $paycompleted=$row['CUENTA'];
  }
}else {
  $paycompleted=0;
}
//Pagos por procesar
$sql="SELECT COUNT(*) AS CUENTA FROM PAGOS WHERE ESTATUS=2";
$result = $conn->query($sql);
if ($result->num_rows > 0){
  while($row = $result->fetch_assoc()) {
    $payfailed=$row['CUENTA'];
  }
}else {
  $payfailed=0;
}
//Pagos por procesar
$sql="SELECT SUM(MONTO) AS CUENTA FROM PAGOS WHERE ESTATUS=1";
$result = $conn->query($sql);
if($result->num_rows>0){while($row=$result->fetch_assoc()){
    $totalpays=$row['CUENTA'];
  }
}else {
  $totalpays=0;
}
//Deposito
//Compras compras totales
$sql="SELECT COUNT(*) AS CUENTA FROM PEDIDOS WHERE ESTATUS=3";
$result=$conn->query($sql);
if($result->num_rows > 0){while($row = $result->fetch_assoc()){$tosearch=$row['CUENTA'];}}
//Compras compras totales
$sql="SELECT COUNT(*) AS CUENTA FROM PEDIDOS WHERE ESTATUS=4";
$result=$conn->query($sql);
if($result->num_rows > 0){while($row = $result->fetch_assoc()){$topackage=$row['CUENTA'];}}
//Compras compras totales
$sql="SELECT COUNT(*) AS CUENTA FROM PEDIDOS WHERE ESTATUS=5";
$result=$conn->query($sql);
if ($result->num_rows>0){while($row=$result->fetch_assoc()){$tosend=$row['CUENTA'];}}
//Compras compras totales
$sql="SELECT COUNT(*) AS CUENTA FROM PEDIDOS WHERE ESTATUS=10";
$result=$conn->query($sql);
if($result->num_rows>0){while($row=$result->fetch_assoc()){$infailure=$row['CUENTA'];}}
 ?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Página administrativa de <?php echo $nombrePagina;?>">
  <meta name="author" content="Eutuxia Web">
  <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
  <title><?php echo $nombrePagina;?> Administración</title>
  <link href="assets/dist/css/style.min.css" rel="stylesheet">
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>
  <!--div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div-->
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <?php include 'common/navbar.php';?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                  <div class="col-5 align-self-center">
                    <h4 class="page-title">Principal <a href="../admin/principal.php" class="m-2" ><i title="Actualizar" data-toggle="tooltip" class="ti-loop"></i></a></h4>
                  </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="principal.php">Inicio</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Principal</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row justify-content-center">
                  <div class="col-lg-11">
                    <div class="card">
                      <div class="card-body">
                        <!--h4 class="card-title">Página Administrativa de la Empresa <?php //if(isset($nombrePagina)){echo $nombrePagina;}else{echo '<b>sin nombre</b>'} ?></h4-->
                      </div>
                    </div>
                  </div>
                    <div class="col-lg-11  bg-white mb-1">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Ventas</h4>
                          <h6 class="card-subtitle">Encontrara los numeros de las ventas de <?php echo $nombrePagina;?></h6>
                          <div class="row">
                            <div class="col-4">
                              <h6 class="text-success"><b>Compras Completadas:</b> <span ><?php echo $completed;?></span></h6>
                            </div>
                            <div class="col-4">
                              <h6 class="text-danger"><b>Compras Canceladas:</b> <span><?php echo $canceled;?></span></h6>
                            </div>
                            <div class="col-4">
                              <h6 class="text-info"><b>Compras con Pago Pendiente: </b><span><?php echo $paypending;?></span></h6>
                            </div>
                            <div class="col-4">
                              <h6 class="text-success"><b>Compras Enviadas:</b> <span><?php echo $sending;?></span></h6>
                            </div>
                            <div class="col-4">
                              <h6 class="text-warning"><b>Compras con Saldo Insuficiente: </b><span><?php echo $lowacount;?></span> </h6>
                            </div>
                            <div class="col-4">
                              <h6><b>Compras Totales: </b><span><?php echo $totalpurchase;?></span> </h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-11  bg-white mb-1">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Pagos</h4>
                          <h6 class="card-subtitle">Encontrara los numeros de los Pagos de <?php echo $nombrePagina;?></h6>
                          <div class="row">
                            <div class="col-4">
                              <h6 class="text-info"><b>Pagos por Procesar: </b><span><?php echo $toprocess; ?></span> </h6>
                            </div>
                            <div class="col-4">
                              <h6 class="text-success"><b>Pagos Completados:</b> <span><?php echo $paycompleted; ?></span> </h6>
                            </div>
                            <div class="col-4">
                              <h6 class="text-danger"><b>Pagos Fallidos:</b> <span><?php echo $payfailed; ?></span> </h6>
                            </div>
                            <div class="col-4">
                              <h6><b>Total en pagos procesado:</b> <span><?php echo number_format($totalpays,2,'.',',');?></span> Bs </h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-11  bg-white mb-1">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Despacho</h4>
                          <h6 class="card-subtitle">Encontraras los numeros de los pedidos</h6>
                          <div class="row">
                            <div class="col-3">
                              <h6 class="text-info"><b>Pedidos Por Buscar:</b> <span><?php echo $tosearch;?></span> </h6>
                            </div>
                            <div class="col-3">
                              <h6  class="text-info"><b>Pedidos por Empaquetar:</b> <span><?php echo $topackage;?></span> </h6>
                            </div>
                            <div class="col-3">
                              <h6  class="text-info"><b>Pedidos por Enviar:</b> <span><?php echo $tosend;?></span> </h6>
                            </div>
                            <div class="col-3">
                              <h6 class="text-danger"><b>Pedidos en Falla:</b> <span><?php echo $infailure;?></span> </h6>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/dist/js/custom.min.js"></script>
</body>
</html>
