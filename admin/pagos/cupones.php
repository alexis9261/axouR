<?php
include '../common/sesion.php';
if($_SESSION['nivel']==4 || $_SESSION['nivel']==1){
}else{ header('Location: ../principal.php'); }
require '../../common/conexion.php';
include '../../common/datosGenerales.php';
if(isset($_GET['orden'], $_GET['id']) ){
  $newid=$_GET['id'];
  if ($_GET['orden']=='good'){
    #Registrar comentario con el Ticket asignado
    $comentario= $_GET['comentario'];
    $sql="UPDATE `TICKETS` SET `COMENTARIO`='$comentario' WHERE  `IDPEDIDO`='$newid'";
    if ($conn->query($sql) === FALSE) { echo "Error: " . $sql. "<br>" . $conn->error; }
    #cambiar de estatus
    $sql="UPDATE `PEDIDOS` SET `ESTATUS`='9' WHERE  `IDPEDIDO`='$newid'";
    if ($conn->query($sql) === FALSE) {echo "Error: " . $sql. "<br>" . $conn->error; }
  }else if ($_GET['orden']=='bad'){
    #cambia a estatus de cancelado
    $sql="UPDATE `PEDIDOS` SET `ESTATUS`='11' WHERE  `IDPEDIDO`='$newid'";
    if ($conn->query($sql) === FALSE) {
      echo "Error: " . $sql. "<br>" . $conn->error;
    }
    $conn->close();
  }
  header ('location:index.php');
}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Administración de la E-Comerce <?php echo $nombrePagina;?>.">
  <meta name="author" content="Eutuxia Web, C.A.">
  <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
  <title><?php echo $nombrePagina;?> - Administración</title>
  <link href="../../css/new.css" rel="stylesheet">
  <link href="../dist/css/style.min.css" rel="stylesheet">
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="../css/Stile.css">
</head>
<script>
  function deshabilitaRetroceso(){
    window.location.hash="no-back-button";
    window.location.hash="Again-No-back-button" //chrome
    window.onhashchange=function(){window.location.hash="no-back-button";}
  }
</script>
<body>
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
    <?php include '../common/navbar.php';?>
    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-5 align-self-center">
            <h4 class="page-title"> Pagos </h4>
          </div>
          <div class="col-auto align-self-center ml-auto">
            <div class="d-flex align-items-center justify-content-end">
              <div class="container">
                <div class="row">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="../principal.php">Inicio</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Inventario</li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-around mb-3">
        <div class="col-sm-4 text-center">
          <a class="btn btn-link text-success" href="../Pagos/">Pagos</a>
        </div>
        <div class="col-sm-4 text-center">
          <a class="btn btn-link text-success" href="cupones.php">Cupones</a>
        </div>
        <div class="col-sm-4 text-center">
          <a class="btn btn-link text-success" href="tickets.php">Tickets</a>
        </div>
      </div>
      <div class="container-fluid">
        <?php
        $sql="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE `ESTATUS`=8";
        $result=$conn->query($sql);
        if($result->num_rows>0){
          ?>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th class="border-top-0">Cliente</th>
                        <th class="border-top-0">Estatus</th>
                        <th class="border-top-0">Ticket</th>
                        <th class="border-top-0">Fecha de Compra</th>
                        <th class="border-top-0">Articulos</th>
                        <th class="border-top-0">Monto</th>
                        <th class="border-top-0">...</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while($row = $result->fetch_assoc()) {
                        $id=$row['IDPEDIDO'];
                        $sql2="SELECT *  FROM PEDIDOS p
                        INNER JOIN COMPRAS c ON c.IDPEDIDO=p.IDPEDIDO
                        WHERE p.IDPEDIDO='$id' "; //encuentro los articulos del pedido
                        $result2 = $conn->query($sql2);
                        if($result2->num_rows > 0){
                          while($row2 = $result2->fetch_assoc()){
                            #GET VALUES
                            $estatus=$row2['ESTATUS'];
                            $fecha=$row2['FECHAPEDIDO'];
                            #cliente
                            $cliente=$row2['CLIENTE'];
                            $correo_cliente=$row2['EMAIL'];
                            $monto=$row2['MONTO'];
                            ?>
                            <?php
                            $ticket='Sin Ticket';
                            $sql_ticket="SELECT * FROM TICKETS WHERE IDPEDIDO='$id'";
                            $result_ticket = $conn->query($sql_ticket);
                            if ($result_ticket->num_rows > 0){
                              while($row_t = $result_ticket->fetch_assoc()){
                                $ticket=$row_t['IDTICKET'];
                              }
                            }
                            ?>
                            <tr>
                              <td class="txt-oflo"><?=$cliente?></td>
                              <td>
                                <?php
                                switch ($estatus) {
                                  case '0': echo '<span class="label label-info label-rounded">Por Pagar</span>';
                                  break;
                                  case '1':  echo '<span class="label label-danger label-rounded">Pago Fallido</span>';
                                  break;
                                  case '2': echo '<span class="label label-warning  label-rounded">Pago Pendiente</span>';
                                  break;
                                  case '3':  echo '<span class="label label-purple label-rounded">Por Buscar</span>';
                                  break;
                                  case '4':  echo '<span class="label label-info label-rounded">Por Empaquetar</span>';
                                  break;
                                  case '5': echo '<span class="label label-warning label-rounded">Por Enviar</span>';
                                  break;
                                  case '6': echo '<span class="label label-success label-rounded">Enviado</span>';
                                  break;
                                  case '7': echo '<span class="label label-success label-rounded">Completado</span>';
                                  break;
                                  case '8': echo '<span class="label label-info label-rounded">Tienda</span>';
                                  break;
                                  case '9': echo '<span class="label label-success label-rounded">Tienda - Completado</span>';
                                  break;
                                  case '10': echo '<span class="label label-danger label-rounded">Bajo Revisión</span>';
                                  break;
                                  case '11': echo '<span class="label label-danger label-rounded">Cancelado</span>';
                                  break;
                                  default:
                                  echo '<span class="label label-danger label-rounded">Error</span>';
                                  break;
                                }
                                ?>
                              </td>
                              <td class="txt-oflo"><?=$ticket?></td>
                              <td class="txt-oflo"><?=$fecha?></td>
                              <td><span class="font-medium"><button type="button" class="enlace2 ml-auto" href="javascript:void(0)" data-toggle="modal" data-target="#ver_<?=$id?>">Ver artículos</button></span></td>
                              <td><?php echo number_format($monto,2,'.',',') ?></td>
                                <!-- setpoint-->
                              <td  class="txt-oflo"><a id="good" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#pro<?php echo $id;?>" href="javascript:void(0)" >Procesar</a>
                                  <a id="bad" class="btn btn-outline-danger btn-sm" href="index.php?orden=bad&id=<?php echo $id;?>"><span title="Reportar Inconveniente" data-toggle="tooltip">Cancelar</span></a></td>
                            </tr>
                                <div class="modal fade" id="pro<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <form action="index.php" method="get">
                                        <div class="modal-header">
                                          <h5 class="modal-title">Procesar pedido con el ticket - <?php echo $ticket; ?></h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="container-fluid">
                                            <div class="row">
                                              <div class="col-12">
                                                <input type="hidden" value="good" name="orden">
                                                <input type="hidden" name="id" value="<?php echo $id;?>">
                                                <textarea rows="4" cols="60" name="comentario" id="comentario" placeholder="Detalle la venta con un comentario"></textarea>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                          <input type="submit"  id="boton-enviar" class="btn btn-primary" value="Procesar">
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal fade bd-example-modal-lg" id="ver_<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="closeSesionLabel">Articulos de <?=$cliente?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="container-fluid">
                                          <?php
                                          $sql8="SELECT *, m.IMAGEN AS IMA, it.CANTIDAD as CANTIDAD FROM ITEMS it
                                          INNER JOIN INVENTARIO i ON i.IDINVENTARIO=it.IDINVENTARIO
                                          INNER JOIN MODELOS m ON m.IDMODELO=i.IDMODELO
                                          INNER JOIN PRODUCTOS p ON p.IDPRODUCTO=m.IDPRODUCTO
                                          WHERE it.IDPEDIDO='$id'";
                                          $res12= $conn->query($sql8);
                                          if ($res12->num_rows > 0){
                                            while($row9 = $res12->fetch_assoc()){
                                              #items
                                              $idinventario=$row9['IDINVENTARIO'];
                                              $cantidad=$row9['CANTIDAD'];
                                              #inventario
                                              $talla=$row9['TALLA'];
                                              #modelos
                                              $idcolor1=$row9['COLOR1'];
                                              $idcolor2=$row9['COLOR2'];
                                              $imagen=$row9['IMA'];
                                              #productos
                                              $nombre=$row9['NOMBRE_P'];
                                              #genero
                                              switch($row9['GENERO']){
                                                case '1': $genero='Dama';
                                                break;
                                                case '2': $genero='Caballero';
                                                break;
                                                case '3': $genero='Niño';
                                                break;
                                                case '4': $genero='Niña';
                                                break;
                                                default: $genero='Otro';
                                                break;
                                              }
                                              $marca=ucwords($row9['MARCA']);
                                              $material=ucwords($row9['MATERIAL']);
                                              #MANGA
                                              switch($row9['MANGA']){
                                                case '1': $manga='Redondo';
                                                break;
                                                case '2': $manga='En V';
                                                break;
                                                case '3': $manga='Mao';
                                                break;
                                                case '4': $manga='Chemise';
                                                break;
                                                default: $manga='No Aplica';
                                                break;
                                              }
                                              #CUELLO
                                              switch($row9['CUELLO']){
                                                case '1': $cuello='Corta';
                                                break;
                                                case '2': $cuello='3/4';
                                                break;
                                                case '3': $cuello='Larga';
                                                break;
                                                case '4': $cuello='Sin Manga';
                                                break;
                                                default: $cuello='No Aplica';
                                                break;
                                              }
                                              #nombre de color
                                              $sql1="SELECT COLOR FROM COLOR WHERE IDCOLOR=$idcolor1";
                                              $sql2="SELECT COLOR FROM COLOR WHERE IDCOLOR=$idcolor2";
                                              #COLOR 1
                                              $res1= $conn->query($sql1);
                                              if ($res1->num_rows > 0){
                                                while($row1 = $res1->fetch_assoc()){
                                                  #COLOR
                                                  $color1=$row1['COLOR'];
                                                }
                                              }
                                              #COLOR 2
                                              $res2= $conn->query($sql2);
                                              if ($res2->num_rows > 0){
                                                while($row2 = $res2->fetch_assoc()){
                                                  #COLOR
                                                  $color2=$row2['COLOR'];
                                                }
                                              }
                                              ?>
                                              <div class="row">
                                                <div class="col-2 text-center">
                                                  <img class="img-fluid" src="../../imagen/<?=$imagen?>" width="70px" height="70px">
                                                </div>
                                                <div class="col-10">
                                                  <div class="container-fluid">
                                                    <div class="row">
                                                      <div class="col-auto">
                                                        <b><?=$nombre?> de <?=$genero?></b>
                                                      </div>
                                                      <div class="col-12">
                                                        <div class="row">
                                                          <div class="col-6">
                                                            <small class="d-block">CANTIDAD: <span class="text-muted"><?=$cantidad?></span></small>
                                                            <small class="d-block">TALLA: <span class="text-muted"><?=$talla?></span></small>
                                                            <small class="d-block">COLOR(es): <span class="text-muted"><?=$color1?> / <?=$color2?></span></small>
                                                            <small class="d-block">MANGA: <span class="text-muted"><?=$manga?></span></small>
                                                          </div>
                                                          <div class="col-6">
                                                            <small class="d-block">MARCA: <span class="text-muted"><?=$marca?></span></small>
                                                            <small class="d-block">MATERIAL: <span class="text-muted"><?=$material?></span></small>
                                                            <small class="d-block">CUELLO: <span class="text-muted"><?=$cuello?></span></small>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <hr>
                                            <?php }} ?>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                <?php }}} ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <?php include '../common/footer.php';?>
        <?php }else{ ?>
          <div class="row my-3 text-danger justify-content-center">
            <h5>¡No hay Pago externos pendientes!</h5>
          </div>
        <?php } $conn->close(); ?>
      </div>
      <?php include '../common/footer.php';?>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="../dist/js/custom.min.js"></script>
</body>
</html>
