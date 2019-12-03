<?php
include_once('../common/sesion.php');
if($_SESSION['nivel']==4 || $_SESSION['nivel']==1){
}else{ header('Location: ../principal.php'); }
require '../../common/conexion.php' ;
include '../../common/datosGenerales.php';
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
</head>
<body>
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <?php include('../common/navbar.php'); ?>
        <div class="page-wrapper">
          <div class="page-breadcrumb">
              <div class="row">
                  <div class="col-5 align-self-center">
                      <h4 class="page-title">Despacho</h4>
                  </div>
                  <div class="col-7 align-self-center">
                      <div class="d-flex align-items-center justify-content-end">
                          <nav aria-label="breadcrumb">
                              <ol class="breadcrumb">
                                  <li class="breadcrumb-item">
                                      <a href="../principal.php">Inicio</a>
                                  </li>
                                  <li class="breadcrumb-item active" aria-current="page">Despacho</li>
                              </ol>
                          </nav>
                      </div>
                  </div>
              </div>
          </div>
                <div class="container-fluid">
                  <div class="row justify-content-around mb-3">
                      <div class="col-sm-4 text-center">
                        <a class="btn btn-link text-success" href="buscador_pedido.php">Busqueda de Pedidos</a>
                      </div>
                      <div class="col-sm-4 text-center">
                        <a class="btn btn-link text-success" href="empaquetado.php">Empaquetado</a>
                      </div>
                      <div class="col-sm-4 text-center">
                        <a class="btn btn-link text-success" href="envios.php">Envíos</a>
                      </div>
                  </div>
                  <?php
                      $sql="SELECT IDPEDIDO, ESTATUS,FECHAPEDIDO FROM `PEDIDOS` WHERE `ESTATUS`>2 and `ESTATUS`<6  ORDER BY FECHAPEDIDO ASC " ;
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0){
                    ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                              <th class="border-top-0">Pedido</th>
                                              <th class="border-top-0">Estatus</th>
                                              <th class="border-top-0">Fecha</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          <?php
                                            while($row = $result->fetch_assoc()){
                                              $id=$row['IDPEDIDO'];
                                              $estatus=$row['ESTATUS'];
                                              $fecha=$row['FECHAPEDIDO'];
                                          ?>
                                           <tr>
                                               <td class="txt-oflo"> <small><?php echo $id;?></small> </td>
                                               <td>
                                                 <?php
                                                      switch ($estatus) {
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
                                               <td class="txt-oflo"><?=$fecha?></td>
                                           </tr>
                                        </tbody>
                                            <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php include('../common/footer.php'); ?>
                    </div>
                    <?php
                    }else{
                    ?>
                      <div class="row my-3 text-danger justify-content-center">
                        <h5>¡No hay pedidos para sacar!</h5>
                      </div>
                </div>
                <?php include('../common/footer.php'); ?>
        </div>
        <?php
          }
            $conn->close();
            ?>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/custom.min.js"></script>
</body>
</html>
