<?php
  include_once('../common/sesion.php');
  if($_SESSION['nivel']==4 || $_SESSION['nivel']==1){
  }else{ header('Location: ../principal.php'); }
  require '../../common/conexion.php';
  include '../../common/datosGenerales.php';
  if(isset($_GET['orden'], $_GET['id']) ){
    $newid=$_GET['id'];
    if ($_GET['orden']=='good'){
      $sql="UPDATE `PEDIDOS` SET `ESTATUS`='4' WHERE  `IDPEDIDO`='$newid'";
      if ($conn->query($sql) === TRUE) {
      } else { echo "Error: " . $sql. "<br>" . $conn->error; }
    }
    else if ($_GET['orden']=='bad'){
      if (isset($_GET['comentario'])){
        $comentario=$_GET['comentario'];
      }
      #resportero de falla
      $reportero=$_SESSION['USUARIO'];
      #estatus 0-Por resolver  1-Resuelta
      $estatus=0;
      #ORIGEN
      $origen='Busqueda';
      $sql="UPDATE `PEDIDOS` SET `ESTATUS`='10' WHERE  `IDPEDIDO`='$newid'";
      if($conn->query($sql)===TRUE){
      }else{echo "Error: ".$sql."<br>".$conn->error;}
      $sql="INSERT INTO `FALLAS`(`IDPEDIDO`,`REPORTERO`,`ESTATUS`,`PROBLEMA`,`FECHAFALLA`,`ORIGEN`) VALUES ('$newid','$reportero','$estatus','$comentario',NOW(),'$origen')";
      if($conn->query($sql)===TRUE){
      }else{echo "Error: ".$sql."<br>".$conn->error;}
      $conn->close();
    }
    header ('location:buscador_pedido.php');
  }
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
                      <h4 class="page-title">Despacho</h4>
                    </div>
                    <div class="col-auto align-self-center ml-auto">
                        <div class="d-flex align-items-center justify-content-end">
                          <div class="container">
                            <div class="row">
                              <div class="col-auto">
                                <a href="../principal.php">Inicio</a>
                              </div>
                              <div class="col-auto">
                                <a href="index.php">Despacho</a>
                              </div>
                              <div class="col-auto">
                                Busqueda de Pedidos
                              </div>
                            </div>
                          </div>
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
                        $sql="SELECT `IDPEDIDO` FROM `PEDIDOS` WHERE `ESTATUS`=3";
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
                                                <th class="border-top-0">Fecha de Compra</th>
                                                <th class="border-top-0">Articulos</th>
                                                <th></th>
                                              </tr>
                                        </thead>
                                          <tbody>
                                            <?php
                                              while($row = $result->fetch_assoc()){
                                                $id=$row['IDPEDIDO'];
                                                $sql2="SELECT `IDPEDIDO`, `ESTATUS`, `FECHAPEDIDO` FROM `PEDIDOS` WHERE `IDPEDIDO`='$id' and ESTATUS=3  ORDER BY 3 ASC "; //encuentro los articulos del pedido
                                              #$sql2="SELECT `IDINVENTARIO`, `CANTIDAD`, `FECHAPEDIDO` FROM `ITEMS` WHERE `IDPEDIDO`='$id'";//encuentro los articulos del pedido
                                                $result2 = $conn->query($sql2);
                                                if ($result2->num_rows > 0){
                                                  while($row2 = $result2->fetch_assoc()){
                                                    #GET VALUES
                                                    $estatus=$row2['ESTATUS'];
                                                    $fecha=$row2['FECHAPEDIDO'];
                                                    ?>
                                              <tr>
                                                  <td class="txt-oflo"> <small><?php echo $id;?></small> </td>
                                                  <td><span class="label label-purple label-rounded">Por Buscar</span></td>
                                                  <td class="txt-oflo"><?=$fecha?></td>
                                                  <td><span class="font-medium"><button type="button" class="enlace2 ml-auto" href="javascript:void(0)" data-toggle="modal" data-target="#ver<?php echo $id;?>">Ver artículos</button></span></td>
                                                  <td><a id="good" class="btn btn-outline-success btn-sm" href="buscador_pedido.php?orden=good&id=<?php echo $id;?>" >Listo</a>
                                                  <a id="bad" class="btn btn-outline-danger btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#fal<?php echo $id;?>"><span title="Reportar Inconveniente" data-toggle="tooltip">Falla</span></a></td>
                                              </tr>
                                              <!-- Ver articulos -->
                                              <div class="modal fade bd-example-modal-lg" id="ver<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <div class="modal-header">
                                                      <h5 class="modal-title" id="closeSesionLabel"><small>Pedido - <?php echo $id;?></small> </h5>
                                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                      </button>
                                                    </div>
                                                    <div class="modal-body">
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
                                                              //$peso=$row9['PESO'];
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
                                                              //$material=ucwords($row9['MATERIAL']);
                                                       ?>
                                                      <div class="container-fluid">
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
                                                                      <small class="d-block">CANTIDAD: <span class="text-muted"><?=$cantidad?></span></small>
                                                                      <small class="d-block">MARCA: <span class="text-muted"><?=$nombre_marca?></span></small>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <hr>
                                                      </div>
                                                    <?php }} ?>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="modal fade" id="fal<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                  <div class="modal-content">
                                                    <form action="buscador_pedido.php" method="get">
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
                                                            <textarea rows="4" cols="50" name="comentario" id="comentario" placeholder="Detalle la falla con un comentario"></textarea>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                      <input type="submit"  id="boton-enviar" class="btn btn-primary" value="Enviar">
                                                    </div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>
                                              <?php
                                              }
                                                  }
                                                  ?>
                                          </tbody>
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
                        <h5>¡No hay pedidos para sacar!</h5>
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
