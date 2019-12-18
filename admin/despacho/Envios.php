<?php
include '../common/sesion.php';
if($_SESSION['nivel']==4 || $_SESSION['nivel']==1){
}else{header('Location: ../principal.php');}
require '../../common/conexion.php';
include '../../common/datosGenerales.php';
if(isset($_GET['orden'],$_GET['id_pedido'])){
  $id_pedido=$_GET['id_pedido'];
  if($_GET['orden']=='good'){
    if(isset($_GET['guia']) && $_GET['guia']!=NULL){
      $guia=$_GET['guia'];
      $sql="UPDATE `envios` SET `GUIA`='$guia' WHERE `PEDIDOID`='$id_pedido'";
      if($conn->query($sql)===TRUE){
        $sql2="UPDATE `pedidos` SET `ESTATUS`='6' WHERE `IDPEDIDO`='$id_pedido'";
        if($conn->query($sql2)===TRUE){}
      }
    }
  }elseif($_GET['orden']=='bad'){
    if(isset($_GET['comentario'])){
      $comentario=$_GET['comentario'];
    }
    #resportero de falla
    $reportero=$_SESSION['USUARIO'];
    #estatus 0-Por resolver  1-Resuelta
    $estatus=0;
    #ORIGEN
    $origen='Envios';
    $sql="UPDATE `pedidos` SET `ESTATUS`='10' WHERE `PEDIDOID`='$id_pedido'";
    if($conn->query($sql)===TRUE){}
    $sql="INSERT INTO `fallas`(`IDPEDIDO`,`REPORTERO`,`ESTATUS`,`PROBLEMA`,`FECHAFALLA`,`ORIGEN`) VALUES ('$id_pedido','$reportero','$estatus','$comentario',NOW(),'$origen')";
    if($conn->query($sql)===TRUE){}
    $conn->close();
  }
  //header ('location: envios.php');
}
$array_meses=array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
$array_dias=array('','Lun','Mar','Mie','Jue','Vie','Sab','Dom');
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
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
   <![endif]-->
   <link href="../../vendor/datatables/datatables.min.css" rel="stylesheet">
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
              <h4 class="page-title">Despacho</h4>
            </div>
          </div>
        </div>
        <div class="container-fluid">
          <div class="row justify-content-around mb-3">
            <div class="col-sm-4 text-center">
              <?php
              $sql="SELECT COUNT(*) AS TOTAL FROM pedidos WHERE ESTATUS=3";
              $result=$conn->query($sql);
              if($result->num_rows>0){while($row=$result->fetch_assoc()){$total_buscar=$row['TOTAL'];}}
               ?>
              <a class="btn btn-link text-success" href="buscador_pedido.php">Busqueda de Pedidos (<b><?php echo $total_buscar;?></b>)</a>
            </div>
            <div class="col-sm-4 text-center">
              <?php
              $sql="SELECT COUNT(*) AS TOTAL FROM pedidos WHERE ESTATUS=4";
              $result=$conn->query($sql);
              if($result->num_rows>0){while($row=$result->fetch_assoc()){$total_empaquetar=$row['TOTAL'];}}
               ?>
              <a class="btn btn-link text-success" href="empaquetado.php">Empaquetado (<b><?php echo $total_empaquetar;?></b>)</a>
            </div>
            <div class="col-sm-4 text-center">
              <?php
              $sql="SELECT COUNT(*) AS TOTAL FROM pedidos WHERE ESTATUS=5";
              $result=$conn->query($sql);
              if($result->num_rows>0){while($row=$result->fetch_assoc()){$total_enviar=$row['TOTAL'];}}
               ?>
              <a class="btn btn-link text-success" href="envios.php">Envíos (<b><?php echo $total_enviar;?></b>)</a>
            </div>
          </div>
            <?php
            $sql="SELECT `IDPEDIDO` FROM `pedidos` WHERE `ESTATUS`=5 ORDER BY FECHAPEDIDO ASC";
            $result=$conn->query($sql);
            if($result->num_rows>0){
              ?>
              <table id="example" class="display text-dark" style="width:100%">
                <thead>
                  <tr>
                    <th>Pedido</th>
                    <th>Estado</th>
                    <th>Municipio</th>
                    <th>C. Postal</th>
                    <th>Dirección</th>
                    <th>Agencia</th>
                    <th>Número de Guia</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                <?php
                while($row=$result->fetch_assoc()){
                  $id=$row['IDPEDIDO'];
                  $sql2="SELECT * FROM pedidos p
                  INNER JOIN envios e ON e.PEDIDOID=p.IDPEDIDO
                  INNER JOIN compras c ON c.PEDIDOID=p.IDPEDIDO
                  WHERE p.IDPEDIDO='$id' and ESTATUS=5"; //encuentro los articulos del pedido
                  $result2=$conn->query($sql2);
                  if($result2->num_rows>0){
                    while($row2=$result2->fetch_assoc()){
                      $estatus=$row2['ESTATUS'];
                      #Direccion
                      $estado=$row2['ESTADO'];
                      $municipio=$row2['MUNICIPIO'];
                      $direccion=$row2['DIRECCION'];
                      $codigopostal=$row2['CODIGOPOSTAL'];
                      $encomienda=$row2['ENCOMIENDA'];
                      #Factura
                      $isfactura=false;
                      if(!empty($row2['RAZONSOCIAL']) and !empty($row2['RIFCI']) and !empty($row2['DIRFISCAL'])){
                        $isfactura=true;
                        $razon_social=$row2['RAZONSOCIAL'];
                        $rif=$row2['RIFCI'];
                        $dir_fiscal=$row2['DIRFISCAL'];
                      }
                      #Peso
                      /*$sql8="SELECT i.PESO as PESO, it.CANTIDAD as CANTIDAD FROM ITEMS it
                      INNER JOIN INVENTARIO i ON i.IDINVENTARIO=it.IDINVENTARIO
                      WHERE it.IDPEDIDO='$id'";
                      $res12= $conn->query($sql8);
                      if ($res12->num_rows > 0){
                      $peso=0;
                      while($row9 = $res12->fetch_assoc()){
                      $peso=$peso+$row9['PESO']*$row9['CANTIDAD'];
                    }
                  }*/
                  ?>
                    <tr>
                      <form action="" method="get">
                        <td class="text-center"><b><?php echo $id;?></b></td>
                        <td><?=$estado?></td>
                        <td><?=$municipio?></td>
                        <td><?=$codigopostal?></td>
                        <td><?=$direccion?></td>
                        <!--td><span class="font-medium"><button type="button" class="enlace2 ml-auto" href="javascript:void(0)" data-toggle="modal" data-target="#ver<?php echo $id;?>">Ver dirección</button></span></td-->
                        <!--td><?php //echo number_format($peso,2,',','.') ?></td-->
                        <td><?php echo $encomienda;?></td>
                        <td>
                          <input class="form-control" type="text" placeholder="Código de Seguimiento" name="guia" required/>
                        </td>
                        <td>
                          <input type="hidden" value="good" name="orden"/>
                          <input type="text" value="<?=$id?>" name="id_pedido" style="display:none;"/>
                          <button type="submit" class="btn btn-outline-success btn-sm">Enviado</button>
                          <a class="btn btn-outline-danger btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#fal<?php echo $id;?>">Falla</a>
                        </td>
                      </form>
                    </tr>
                  <!-- Modal -->
                  <div class="modal fade" id="fal<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <form action="envios.php" method="get">
                          <div class="modal-header">
                            <h5 class="modal-title">¿Desea reportar una falla o inconveniente?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="container-fluid">
                              <div class="row">
                                <div class="col-12">
                                  <input type="hidden" value="bad" name="orden">
                                  <input type="hidden" name="id" value="<?php echo $id;?>">
                                  <textarea rows="4" cols="50" name="comentario" placeholder="Detalle la falla con un comentario"></textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" value="Enviar">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                <?php
               }
              }
             } ?>
            </tbody>
          </table>
          <?php }else{ ?>
            <div class="row my-3 text-danger justify-content-center">
              <h5>¡No hay pedidos para Enviar!</h5>
            </div>
            <?php
          }
          $conn->close();
          ?>
        </div>
      </div>
    </div>
    <script>
      $(document).ready(function(){
        $('#example').addClass('nowrap').dataTable({
          responsive:true,
          pageLength:50,
          columnDefs:[{
            "targets":[-1,-2],
            "orderable":false
          }]
        });
      });
    </script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/custom.min.js"></script>
    <script src="../../vendor/datatables/datatables.min.js"></script>
  </body>
  </html>
