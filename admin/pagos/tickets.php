<?php
  include '../common/sesion.php';
  if($_SESSION['nivel']==4 || $_SESSION['nivel']==1){
  }else{ header('Location: ../principal.php'); }
  require '../../common/conexion.php';
  include '../../common/datosGenerales.php';
  if(isset($_GET['orden'], $_GET['id']) ){
        $newid=$_GET['id'];
        if ($_GET['orden']=='new'){
          #crear IDTICKET
          $Ncadena=5;
          $newticket=substr(md5(time()), 0, $Ncadena);
          #Crear ticket en bbdd
          $sql = "INSERT INTO `TICKETS`(`IDTICKET`, `ESTATUS`) VALUES ('$newticket','$newid')";
         if ($conn->query($sql) === TRUE) {
            # echo "<center>Nuevo TICKETS registrado</center>";
            } else { //echo "Error: " . $sql . "<br>" . $conn->error;
                     echo '<script>alert("Error: Ticket Ya existe")</script>';
             }
        }else if ($_GET['orden']=='bad'){
            #cambia a estatus de cancelado
           $sql="DELETE FROM `TICKETS`  WHERE  `IDTICKET`='$newid'";
            if ($conn->query($sql) === TRUE) {
            } else {
               echo "Error: " . $sql. "<br>" . $conn->error;
            }
        }
        header('Location: ./tickets.php');
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
    window.location.hash="Again-No-back-button";
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
          <?php include('../common/navbar.php'); ?>
          <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Pagos </h4>
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
                        $sql="SELECT * FROM `TICKETS`";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0){
                      ?>
                      <div class="row">
                          <div class="col-12">
                            <div class="card">
                              <div class="card-body">
                                <h4 class="card-title">Tickets</h4>
                                <h6 class="card-subtitle">Los tickets son una herramienta disponible para manejar las compras externa a la E-commerce de manera manual, sin dejar el registro y el manejo de inventario a un lado.</h6>
                                <h6 class="card-subtitle">Generar ticket: <a href="tickets.php?orden=new&id=9">Nuevo Ticket</a></h6>
                              </div>
                            </div>

                              <div class="card">
                                  <div class="table-responsive">
                                      <table class="table table-hover">
                                          <thead>
                                              <tr>
                                                <th class="border-top-0">Ticket</th>
                                                <th class="border-top-0">Pedido</th>
                                                <th class="border-top-0">Estatus</th>
                                                <th class="border-top-0">Comentario</th>
                                                <th class="border-top-0">...</th>
                                              </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while($row = $result->fetch_assoc()) {
                                              $ticket=$row['IDTICKET'];
                                              $id=$row['IDPEDIDO'];
                                              $estatus=$row['ESTATUS'];
                                              $comentario=$row['COMENTARIO'];
                                                  ?>
                                              <tr>
                                                <td class="txt-oflo"><?=$ticket?></td>
                                                <td class="txt-oflo"><?=$id?></td>
                                                <td>
                                                  <?php
                                                switch ($estatus) {
                                                      case '9': echo '<span class="label label-info label-rounded">POR USAR</span>';
                                                          break;
                                                      case '99':  echo '<span class="label label-success label-rounded">USADO</span>';
                                                          break;
                                                      default:
                                                      echo '<span class="label label-danger label-rounded">Error</span>';
                                                        break;

                                                  }
                                                   ?> </td>
                                                <td>
                                                  <?php
                                                    if ($estatus<99){
                                                      ?>
                                                      <span class="font-medium">
                                                        Sin Comentario
                                                      </span>
                                                      <?php
                                                    }
                                                    else{
                                                      ?>
                                                      <span class="font-medium">
                                                        <button type="button" class="enlace2 ml-auto" href="javascript:void(0)" data-toggle="modal" data-target="#ver_<?=$id?>">Ver comentario</button>
                                                      </span>
                                                      <?php
                                                    }
                                                   ?>
                                                </td>

                                                <!-- setpoint-->
                                                <td  class="txt-oflo">
                                                  <?php if ($estatus<99){
                                                    ?>
                                                    <a id="bad" class="btn btn-outline-danger btn-sm" href="tickets.php?orden=bad&id=<?php echo $ticket;?>">
                                                      <span title="Eliminar ticket" data-toggle="tooltip">Eliminar</span>
                                                    </a>
                                                    <?php
                                                  } ?>

                                                </td>
                                            </tr>

                                            <div class="modal fade bd-example-modal-lg" id="ver_<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                  <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="closeSesionLabel">Comentario del ticket - <?=$ticket?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col-6">
                                                              Hola como esta
                                                            </div>
                                                         </div>
                                                      </div>
                                                      </div>
                                                    </div>
                                                  </div>
                                            </div>
                                        <?php } ?>

                                      </table>
                                  </div>
                              </div>
                          </div>
                          <?php include('../common/footer.php');  ?>
                      </div>
                    <?php
                    }else{
                    ?>
                      <div class="row my-3 text-danger justify-content-center">
                        <h5>¡No hay pedidos en Tienda para sacar!</h5>
                      </div>
                  </div>
                  <?php include('../common/footer.php');  ?>
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
