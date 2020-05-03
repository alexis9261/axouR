<?php
include '../common/sesion.php';
$pagos=1;
if($_SESSION['nivel']==4 || $_SESSION['nivel']==1){
}else{ header('Location: ../principal.php'); }
require '../../common/conexion.php';
include '../../common/datosGenerales.php';
if(isset($_GET['orden'],$_GET['id'])){
  $newid=$_GET['id'];
  if($_GET['orden']=='good'){
    #cambiar de estatus
    $sql="UPDATE `PAGOS` SET `ESTATUS`='1' WHERE `IDPAGO`='$newid'";
    if($conn->query($sql)===TRUE){
      //Pago procesados - Validar que los fondos son suficientes
      $total=0;
      if(isset($_GET['idp'])){
        $idpedido=$_GET['idp'];
        $sql="SELECT MONTO FROM `PAGOS` WHERE IDPEDIDO='$idpedido' and ESTATUS=1";
        $result=$conn->query($sql);
        if($result->num_rows>0){
          while($row=$result->fetch_assoc()){$total=$total+$row['MONTO'];}
          //buscar el monto de la compra en bs
          $sql2="SELECT MONTO FROM `COMPRAS` WHERE IDPEDIDO='$idpedido' LIMIT 1";
          $result = $conn->query($sql2);
          if($result->num_rows>0){while($row=$result->fetch_assoc()){$compra_monto=$row['MONTO'];}}
          if($total>=$compra_monto){
            //actualizamos estatus a pago procesado
            $sql3="UPDATE `PEDIDOS` SET `ESTATUS`='3' WHERE `IDPEDIDO`='$idpedido'";
            if($conn->query($sql3)===TRUE){}
          }else{
            //fondo insuficientes
            $sql3="UPDATE `PEDIDOS` SET `ESTATUS`='12' WHERE `IDPEDIDO`='$idpedido'";
            if($conn->query($sql3)===TRUE){}
          }
        }
      }
    }
  }else if($_GET['orden']=='bad'){
    #cambia a estatus de Fallido
    $sql="UPDATE `PAGOS` SET `ESTATUS`='2' WHERE `IDPAGO`='$newid'";
    if($conn->query($sql)===TRUE){}
  }else if($_GET['orden']=='review'){
    #cambia a estatus de Fallido
    $sql="UPDATE `PAGOS` SET `ESTATUS`='0' WHERE `IDPAGO`='$newid'";
    if($conn->query($sql)===TRUE){}
  }
  header('location:index.php');
}
$array_meses=array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
$array_dias=array('','Lun','Mar','Mie','Jue','Vie','Sab','Dom');
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Administración de la E-Comerce <?php echo $nombrePagina;?>.">
  <meta name="author" content="Eutuxia Web, C.A.">
  <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
  <title><?php echo $nombrePagina;?> - Administración</title>
  <link href="../../css/new.css" rel="stylesheet">
  <link href="../assets/dist/css/style.min.css" rel="stylesheet">
  <link href="../assets/vendor/datatables/datatables.min.css" rel="stylesheet">
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
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
                  <h4 class="page-title">Pagos  <a href="../Pagos" class="m-2" ><i title="Actualizar" data-toggle="tooltip" class="ti-loop"></i></a></h4>
                </div>
              </div>
                <?php
                $sql="SELECT * FROM `PAGOS` WHERE 1 ORDER BY IDPAGO DESC";
                $result=$conn->query($sql);
                if($result->num_rows>0){
                  $cont=0;
                  ?>
                  <table id="example" class="display text-dark" style="width:100%">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th>Referencia</th>
                        <th>Monto [U]</th>
                        <th>Banco Emisor</th>
                        <th>Banco Receptor</th>
                        <th>Fecha de Pago</th>
                        <th>Estatus</th>
                        <th></th>
                      </tr>
                    </thead>
                    <?php while($row=$result->fetch_assoc()){
                      ++$cont;
                      $id=$row['IDPAGO'];
                      $idp=$row['IDPEDIDO'];
                      $referencia=$row['REFERENCIA'];
                      $bancoe=$row['BANCOEMISOR'];
                      $bancor=$row['BANCORECEPTOR'];
                      $monto=$row['MONTO'];
                      $moneda=$row['MONEDA'];
                      $fecha=$row['FECHAPAGO'];
                      $fecha=$array_dias[date('N',strtotime(substr($fecha,0,10)))]." ".substr($fecha,8,2)." de ".$array_meses[substr($fecha,5,2)];
                      $estatus=$row['ESTATUS'];
                      ?>
                      <tbody>
                        <tr>
                          <td class="text-center"><b><?=$cont?></b></td>
                          <td><?=$referencia?></td>
                          <td><?php echo number_format($monto,2,',','.').'['.$moneda.']' ?></td>
                          <td><?=$bancoe?></td>
                          <td><?=$bancor?></td>
                          <td><?=$fecha?></td>
                          <?php
                          switch($estatus){
                            case '0':
                            ?>
                            <td><span class="text-info">Por Confirmar</span></td>
                            <td class="txt-oflo"><a id="good" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#pro<?php echo $id;?>" href="javascript:void(0)">Confirmar</a>
                              <a id="bad" class="btn btn-outline-danger btn-sm" href="index.php?orden=bad&id=<?php echo $id;?>"><span title="Reportar Inconveniente" data-toggle="tooltip">Fallido</span></a></td>
                              <?php
                              break;
                              case '1':
                              ?>
                              <td><span class="text-success">Pago Exitoso</span></td>
                              <td></td>
                              <?php
                              break;
                              case '2':
                              ?>
                              <td><span class="text-danger">Pago Fallido</span></td>
                              <td><a id="review" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#review<?php echo $id;?>" href="javascript:void(0)">Revisar</a></td>
                              <?php
                              break;
                            }
                            ?>
                          </tr>
                        </tbody>
                        <!-- Modal Confirmar pago -->
                        <div class="modal fade" id="pro<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <form action="index.php" method="get">
                                <div class="modal-header">
                                  <h5 class="modal-title">Procesar transferencia - Ref: <?php echo $referencia; ?></h5>
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
                                        <input type="hidden" name="idp" value="<?=$idp?>">
                                        <span class="text-center">¿Estás seguro de procesar este pago como exitoso?</span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                  <input type="submit"  id="boton-enviar" class="btn btn-primary px-5" value="Confirmar">
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <!-- Modal revisar pago -->
                        <div class="modal fade" id="review<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <form action="index.php" method="get">
                                <div class="modal-header">
                                  <h5 class="modal-title">Revisión de transferencia</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="container-fluid">
                                    <div class="row">
                                      <div class="col-12">
                                        <input type="hidden" value="review" name="orden">
                                        <input type="hidden" name="id" value="<?php echo $id;?>">
                                        <p class="text-center">¿Estás Seguro de volver a revisar este pago?<br><span class="text-muted"> Si consideras que hubo un error al procesar este pago como Fallido, realiza esta acción.</span></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                  <input type="submit"  id="boton-enviar" class="btn btn-primary" value="Volver a Revisar">
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      <?php } ?>
                    </table>
                <?php }else{ ?>
                  <div class="row my-3 text-danger justify-content-center">
                    <?php if (isset($_GET['search'])){ ?>
                      <h5>¡No hay Pago Encontrados!</h5>
                    <?php }else{ ?>
                      <h5>¡No hay Pago pendientes!</h5>
                    <?php } ?>
                  </div>
                <?php } ?>
            </div>
          </div>
      </div>
      <script>
        $(document).ready(function(){
          $('#example').addClass('nowrap').dataTable({
            responsive:true,
            pageLength: 50,
            columnDefs:[{
              "targets":[-1,-3],
              "orderable":false
            }]
          });
        });
      </script>
      <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
      <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="../assets/dist/js/custom.min.js"></script>
      <script src="../assets/vendor/datatables/datatables.min.js"></script>
    </body>
</html>
<?php $conn->close(); ?>
