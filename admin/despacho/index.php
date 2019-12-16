<?php
include '../common/sesion.php';
if($_SESSION['nivel']==4 || $_SESSION['nivel']==1){
}else{header('Location: ../principal.php');}
require '../../common/conexion.php';
include '../../common/datosGenerales.php';
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
        $sql="SELECT IDPEDIDO,ESTATUS,FECHAPEDIDO FROM `pedidos` WHERE `ESTATUS`>2 AND `ESTATUS`<6 ORDER BY FECHAPEDIDO ASC;";
        $result=$conn->query($sql);
        if($result->num_rows>0){
          ?>
          <table id="example" class="display text-dark" style="width:100%">
            <thead>
              <tr>
                <th>Pedido</th>
                <th>Estatus</th>
                <th>Fecha</th>
              </tr>
            </thead>
            <tbody>
              <?php
              while($row = $result->fetch_assoc()){
                $id=$row['IDPEDIDO'];
                $estatus=$row['ESTATUS'];
                $fecha=$row['FECHAPEDIDO'];
                $fecha=$array_dias[date('N',strtotime(substr($fecha,0,10)))]." ".substr($fecha,8,2)." de ".$array_meses[substr($fecha,5,2)]." a las ".substr($fecha,11,5);
                ?>
                <tr>
                  <td class="text-center"><b><?php echo $id;?></b></td>
                  <td>
                    <?php
                    switch($estatus){
                      case '3':
                      echo '<span class="label label-purple label-rounded">Por Buscar</span>';
                      break;
                      case '4':
                      echo '<span class="label label-info label-rounded">Por Empaquetar</span>';
                      break;
                      case '5':
                      echo '<span class="label label-warning label-rounded">Por Enviar</span>';
                      break;
                      default:
                      echo '<span class="label label-danger label-rounded">Error</span>';
                      break;
                    }
                    ?>
                  </td>
                  <td><?=$fecha?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        <?php }else{ ?>
          <div class="row my-3 text-danger justify-content-center">
            <h5>¡No hay pedidos para sacar!</h5>
          </div>
        <?php } ?>
        <?php $conn->close();?>
      </div>
    </div>
    </div>
    <script>
      $(document).ready(function(){
        $('#example').addClass('nowrap').dataTable({
          responsive:true,
          pageLength:50
        });
      });
    </script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/custom.min.js"></script>
    <script src="../../vendor/datatables/datatables.min.js"></script>
</body>
</html>
