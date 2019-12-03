<?php
include '../common/sesion.php';
require '../../common/conexion.php';
include '../../common/datosGenerales.php';
$ventas=1;
if(isset($_GET['search'])){$search=$_GET['search'];}
if(isset($_GET['orden'],$_GET['id'])){
  $newid=$_GET['id'];
  if($_GET['orden']=='completed'){
    //validar que esta en su etapa finalizada
    $sql="SELECT * FROM PEDIDOS WHERE IDPEDIDO='$newid' and ESTATUS=6 LIMIT 1";
    $result=$conn->query($sql);
    if($result->num_rows>0){while($row=$result->fetch_assoc()){$band=true;}}
    if($band){
      //actualizar estatus a completado.
      $sql3="UPDATE `PEDIDOS` SET `ESTATUS`='9' WHERE `IDPEDIDO`='$newid'";
      if($conn->query($sql3)===TRUE){}else{}
      }
    }
    header('location: ../ventas/');
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
  <link href="../dist/css/style.min.css" rel="stylesheet">
  <link href="../../css/new.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
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
                <h4 class="page-title">Ventas  <a href="../ventas" class="m-2" ><i title="Actualizar" data-toggle="tooltip" class="ti-loop"></i></a></h4>
              </div>
              <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="../principal.php">Inicio</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">Ventas</li>
                    </ol>
                  </nav>
                </div>
              </div>
            </div>
          </div>
            <div class="container-fluid">
              <?php
              if (isset($search)){
                if ($search=='ccc'){
                  $sql="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE ESTATUS='9' ORDER BY FECHAPEDIDO DESC";
                }else if($search=='fii'){
                  $sql="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE ESTATUS='12' ORDER BY FECHAPEDIDO DESC";
                }else if($search=='rrr'){
                  $sql="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE ESTATUS='10' ORDER BY FECHAPEDIDO DESC";
                }else if($search=='eee'){
                  $sql="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE ESTATUS='6' ORDER BY FECHAPEDIDO DESC";
                }else if($search=='bbb'){
                  $sql="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE ESTATUS='3' ORDER BY FECHAPEDIDO DESC";
                }else if($search=='ppp'){
                  $sql="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE ESTATUS='2' ORDER BY FECHAPEDIDO DESC";
                }else if($search=='ppee'){
                  $sql="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE ESTATUS='5' ORDER BY FECHAPEDIDO DESC";
                }else{
                  $sql="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE DOCID LIKE '%$search%' ORDER BY FECHAPEDIDO DESC";
                }
              }else{
                $sql="SELECT `IDPEDIDO` FROM `PEDIDOS` ORDER BY FECHAPEDIDO DESC";
              }
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
                              <th class="border-top-0">Fecha de Compra</th>
                              <th class="border-top-0">Artículos</th>
                              <th class="border-top-0">Total (Bs)</th>
                              <th></th>
                            </tr>
                          </thead>
                                    <tbody>
                                        <?php
                                        while($row = $result->fetch_assoc()) {
                                          $id=$row['IDPEDIDO'];
                                          $sql2="SELECT * FROM PEDIDOS p
                                          INNER JOIN ENVIOS e ON e.IDPEDIDO=p.IDPEDIDO
                                          INNER JOIN COMPRAS c ON c.IDPEDIDO=p.IDPEDIDO
                                          WHERE p.IDPEDIDO='$id' "; //encuentro los articulos del pedido
                                          $result2 = $conn->query($sql2);
                                          if($result2->num_rows>0){
                                            while($row2=$result2->fetch_assoc()){
                                              #GET VALUES
                                              $estatus=$row2['ESTATUS'];
                                              $fecha=$row2['FECHAPEDIDO'];
                                              #cliente
                                              $cliente=$row2['CLIENTE'];
                                              $ci_cliente=$row2['DOCID'];
                                              $telf_cliente=$row2['TELEFONO'];
                                              $correo_cliente=$row2['EMAIL'];
                                              $monto=$row2['MONTO'];
                                              //$peso=$row2['PESOT'];
                                               #Direccion
                                               $pais=$row2['PAIS'];
                                               $estado=$row2['ESTADO'];
                                               $ciudad=$row2['CIUDAD'];
                                               $municipio=$row2['MUNICIPIO'];
                                               $parroquia=$row2['PARROQUIA'];
                                               $direccion=$row2['DIRECCION'];
                                               $codigopostal=$row2['CODIGOPOSTAL'];
                                               $encomienda=$row2['ENCOMIENDA'];
                                               $observaciones=$row2['OBSERVACIONES'];
                                               #refencia de ENVIOS
                                               if($row2['GUIA']!=NULL){
                                                 $guia= $row2['GUIA'];
                                               }else{
                                                 $guia='Sin Enviar';
                                               }
                                               #receptor
                                               $receptor=$row2['RECEPTOR'];
                                               $ci_receptor=$row2['CIRECEPTOR'];
                                               $telf_receptor=$row2['TELFRECEPTOR'];
                                               #Factura
                                               $isfactura=false;
                                               if(!empty($row2['RAZONSOCIAL']) and !empty($row2['RIFCI']) and !empty($row2['DIRFISCAL'])){
                                                 $isfactura=true;
                                                 $razon_social=$row2['RAZONSOCIAL'];
                                                 $rif=$row2['RIFCI'];
                                                 $dir_fiscal=$row2['DIRFISCAL'];
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
                                                  case '8': echo '<span class="label label-info label-rounded">Pago Externo</span>';
                                                      break;
                                                  case '9': echo '<span class="label label-success label-rounded">Completado</span>';
                                                      break;
                                                  case '10': echo '<span class="label label-danger label-rounded">Bajo Revisión</span>';
                                                      break;
                                                  case '11': echo '<span class="label label-danger label-rounded">Cancelado</span>';
                                                      break;
                                                  case '12': echo '<span class="label label-warning  label-rounded">Fondos insuficientes</span>';
                                                      break;
                                                  default:
                                                  echo '<span class="label label-danger label-rounded">Error</span>';
                                                      break;
                                              }
                                               ?> </td>
                                            <td class="txt-oflo"><?=$fecha?></td>
                                            <td><span class="font-medium"><button type="button" class="enlace2 ml-auto" href="javascript:void(0)" data-toggle="modal" data-target="#ver_<?=$id?>">Ver artículos</button></span></td>
                                            <td><span class="font-medium"><?=number_format($monto,2,',','.')?></span></td>
                                            <td><a href="javascript:void(0)" data-toggle="modal" data-target="#edit_<?=$id?>"><i title="Revisar" data-toggle="tooltip" class="ti-pencil-alt"></i></a>
                                          <?php if ($estatus=='6'){ echo '<a href="javascript:void(0)" data-toggle="modal" data-target="#completed_'.$id.'"><i title="Completar" data-toggle="tooltip" class=" mx-2 text-success ti-check"></i></a>'; } ?>
                                            </td>
                                        </tr>
                                        <!-- Modal finalizar venta -->
                                        <div class="modal fade" id="completed_<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <form action="index.php" method="get">
                                                <div class="modal-header">
                                                  <h5 class="modal-title">Finalizar compra</h5>
                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                  </button>
                                                </div>
                                                <div class="modal-body">
                                                  <div class="container-fluid">
                                                    <div class="row">
                                                      <div class="col-12">
                                                        <input type="hidden" value="completed" name="orden">
                                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                                        <p class="text-center">¿Estás seguro que desea finalizar la compra?<br><span class="text-muted"> Recuerda que esta accion no puede ser modificada en un Futuro.</span></p>
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                  <input type="submit" id="boton-enviar" class="btn btn-primary" value="Completar">
                                                </div>
                                              </form>
                                            </div>
                                          </div>
                                        </div>
                                        <!-- Modal ver articulos -->
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
                                                    $sql8="SELECT * FROM PRODUCTOS p
                                                    INNER JOIN ITEMS it ON p.IDPRODUCTO=it.IDPRODUCTO
                                                    WHERE it.IDPEDIDO='$id'";
                                                    $res12= $conn->query($sql8);
                                                    if($res12->num_rows>0){
                                                      while($row9=$res12->fetch_assoc()){
                                                        #items
                                                        $id_producto=$row9['IDPRODUCTO'];
                                                        $cantidad=$row9['CANTIDAD'];
                                                        #inventario
                                                        //$talla=$row9['TALLA'];
                                                        #modelos
                                                        //$idcolor1=$row9['COLOR1'];
                                                        //$idcolor2=$row9['COLOR2'];
                                                        $imagen=$row9['IMAGEN'];
                                                        #productos
                                                        $nombre=$row9['NOMBRE_P'];
                                                        $id_marca=$row9['IDMARCA'];
                                                        $sql="SELECT * FROM MARCAS WHERE IDMARCA=$id_marca";
                                                        $res= $conn->query($sql);
                                                        if($res->num_rows>0){
                                                          while($row=$res->fetch_assoc()){
                                                            $nombre_marca=$row['NOMBREMARCA'];
                                                          }
                                                        }
                                                        $id_categ=$row9['IDCATEGORIA'];
                                                        $sql="SELECT * FROM CATEGORIAS WHERE IDCATEGORIA=$id_categ";
                                                        $res= $conn->query($sql);
                                                        if($res->num_rows>0){
                                                          while($row=$res->fetch_assoc()){
                                                            $categoria=$row['NOMBRE'];
                                                          }
                                                        }
                                                 ?>
                                                <div class="row">
                                                     <div class="col-2 text-center">
                                                       <img class="img-fluid" src="../inventario/img/<?=$imagen?>" width="70px" height="70px">
                                                     </div>
                                                     <div class="col-10">
                                                       <div class="container-fluid">
                                                         <div class="row">
                                                           <div class="col-auto">
                                                             <b><?=$nombre?></b>
                                                           </div>
                                                           <div class="col-12">
                                                             <div class="row">
                                                               <div class="col-6">
                                                                 <div class="d-block">CATEGORIA: <span class="text-muted"><?php echo $categoria;?></span></div>
                                                                 <div class="d-block">CANTIDAD: <span class="text-muted"><?=$cantidad?></span></div>
                                                                 <div class="d-block">MARCA: <span class="text-muted"><?php echo $nombre_marca;?></span></div>
                                                               </div>
                                                             </div>
                                                           </div>
                                                         </div>
                                                       </div>
                                                     </div>
                                                 </div>
                                                <hr>
                                                   <?php } } ?>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="modal fade bd-example-modal-lg" id="edit_<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <div class="row">
                                                  <div class="col-6">
                                                    <h5 class="modal-title" id="closeSesionLabel">A Enviar por <?=$encomienda?></h5>
                                                  </div>
                                                  <div class="col-6">
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
                                                      case '8': echo '<span class="label label-info label-rounded">Pago Externo</span>';
                                                              break;
                                                      case '9': echo '<span class="label label-success label-rounded">Completado</span>';
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
                                                  </div>
                                                </div>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                                </button>
                                              </div>
                                              <div class="modal-body">
                                                <div class="container-fluid">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <div class="container-fluid">
                                                        <div class="row">
                                                          <div class="col-auto">
                                                            <b>Datos de Cliente</b>
                                                          </div>
                                                          <div class="col-12">
                                                            <div class="row">
                                                              <div class="col-6">
                                                                <small class="d-block">Nombre: <span class="text-muted"><?=$cliente?></span></small>
                                                                <small class="d-block">Teléfono: <span class="text-muted"><?php echo $telf_cliente; ?></span></small>
                                                              </div>
                                                              <div class="col-6">
                                                                <small class="d-block">Cédula: <span class="text-muted"><?php echo $ci_cliente; ?></span></small>
                                                                <small class="d-block">Email: <span class="text-muted"><?php echo $correo_cliente;  ?></span></small>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                          <div class="col-auto">
                                                            <b>Datos de Envío</b>
                                                          </div>
                                                          <div class="col-12">
                                                            <div class="row">
                                                              <div class="col-6">
                                                                <small class="d-block">Enviar a: <span class="text-muted"><?=$receptor?></span></small>
                                                                <small class="d-block">Ci: <span class="text-muted"><?=$ci_receptor?></span></small>
                                                                <small class="d-block">Teléfono: <span class="text-muted"><?php echo $telf_receptor; ?></span></small>
                                                                <small class="d-block">País: <span class="text-muted"></span><?=$pais?></small>
                                                                <small class="d-block">Municipio: <span class="text-muted"><?=$municipio?></span></small>
                                                                <small class="d-block">Código Postal: <span class="text-muted"><?=$codigopostal?></span></small>
                                                              </div>
                                                              <div class="col-6">
                                                                <small class="d-block">Cedula: <span class="text-muted"><?=$ci_receptor?></span></small>
                                                                <small class="d-block">Estado: <span class="text-muted"><?=$estado?></span></small>
                                                                <small class="d-block">Parroquia: <span class="text-muted"><?=$parroquia?></span></small>
                                                                <small class="d-block">Dirección: <span class="text-muted"><?=$direccion?></span></small>
                                                                <small class="d-block">Guia: <span class="text-muted"><?=$guia?></span></small>
                                                                </div>
                                                                <div class="col-12">
                                                              </div>
                                                              <div class="col-12">
                                                                <small class="d-block">Observaciones: <span class="text-muted"><?=$observaciones?></span></small>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <?php if($isfactura==true){
                                                    ?>
                                                  <hr>
                                                  <div class="co-12">
                                                    <b>Factura Fiscal:</b>
                                                    <small class="d-block">Razon Social: <span class="text-muted"><?=$razon_social?></span></small>
                                                    <small class="d-block">Rif: <span class="text-muted"><?=$rif?></span></small>
                                                    <small class="d-block">Direccion Fiscal: <span class="text-muted"><?=$dir_fiscal?></span></small>
                                                  </div>
                                                  <?php } ?>
                                                </div>
                                                <hr>
                                                <!--h2 class="text-center">Peso: <?=number_format($peso,2,',','.')?> gr</h2-->
                                              </div>
                                            </div>
                                          </div>
                                    </div>
                                    <?php }}} ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
              <?php } ?>
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
