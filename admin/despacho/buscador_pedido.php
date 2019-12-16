<?php
  include '../common/sesion.php';
  if($_SESSION['nivel']==4 || $_SESSION['nivel']==1){
  }else{header('Location: ../principal.php');}
  require '../../common/conexion.php';
  include '../../common/datosGenerales.php';
  if(isset($_GET['orden'], $_GET['id'])){
    $newid=$_GET['id'];
    if($_GET['orden']=='good'){
      $sql="UPDATE `pedidos` SET `ESTATUS`='4' WHERE `IDPEDIDO`='$newid'";
      if($conn->query($sql)===TRUE){}
    }elseif($_GET['orden']=='bad'){
      if(isset($_GET['comentario'])){
        $comentario=$_GET['comentario'];
      }
      #resportero de falla
      $reportero=$_SESSION['USUARIO'];
      #estatus 0-Por resolver  1-Resuelta
      $estatus=0;
      #ORIGEN
      $origen='Busqueda';
      $sql="UPDATE `pedidos` SET `ESTATUS`='10' WHERE `IDPEDIDO`='$newid'";
      if($conn->query($sql)===TRUE){}
      $sql="INSERT INTO `fallas`(`IDPEDIDO`,`REPORTERO`,`ESTATUS`,`PROBLEMA`,`FECHAFALLA`,`ORIGEN`) VALUES ('$newid','$reportero','$estatus','$comentario',NOW(),'$origen')";
      if($conn->query($sql)===TRUE){}
      $conn->close();
    }
    header ('location:buscador_pedido.php');
  }
  $array_meses=array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
  $array_dias=array('','Lun','Mar','Mie','Jue','Vie','Sab','Dom');
  //buscar los nombres de las tallas
  $nombre_tallas=array();
  $id_tallas_bd=array();
  $sql="SELECT * FROM tallas";
  $res=$conn->query($sql);
  if($res->num_rows>0){
    while($row=$res->fetch_assoc()){
      array_push($nombre_tallas,$row['TALLA']);
      array_push($id_tallas_bd,$row['IDTALLA']);
    }
  }
  //categorias
  $sql="SELECT * FROM categorias WHERE PADRE=0";
  $id_categorias=array();
  $categorias_padre=array();
  $result=$conn->query($sql);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      array_push($id_categorias,$row['IDCATEGORIA']);
      array_push($categorias_padre,$row['NOMBRE']);
    }
  }
  //marcas
  $sql="SELECT * FROM marcas LIMIT 8";
  $id_marcas=array();
  $nombres_marcas=array();
  $result=$conn->query($sql);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      array_push($id_marcas,$row['IDMARCA']);
      array_push($nombres_marcas,$row['NOMBREMARCA']);
    }
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
        $sql="SELECT `IDPEDIDO` FROM `pedidos` WHERE `ESTATUS`=3";
        $result=$conn->query($sql);
        if($result->num_rows>0){
          ?>
          <table id="example" class="display text-dark" style="width:100%">
            <thead>
              <tr>
                <th>Pedido</th>
                <th>Estatus</th>
                <th>Fecha de Compra</th>
                <th>Artículos</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
              while($row=$result->fetch_assoc()){
                $id=$row['IDPEDIDO'];
                $sql2="SELECT `IDPEDIDO`,`ESTATUS`,`FECHAPEDIDO` FROM `pedidos` WHERE `IDPEDIDO`='$id' AND ESTATUS=3 ORDER BY 3 ASC;";
                $result2=$conn->query($sql2);
                if($result2->num_rows>0){
                  while($row2=$result2->fetch_assoc()){
                    $estatus=$row2['ESTATUS'];
                    $fecha=$row2['FECHAPEDIDO'];
                    $fecha=$array_dias[date('N',strtotime(substr($fecha,0,10)))]." ".substr($fecha,8,2)." de ".$array_meses[substr($fecha,5,2)]." a las ".substr($fecha,11,5);
                    ?>
                    <tr>
                      <td class="text-center"><b><?php echo $id;?></b></td>
                      <td><span class="label label-purple label-rounded">Por Buscar</span></td>
                      <td><?=$fecha?></td>
                      <td><span class="font-medium"><button type="button" class="enlace2 ml-auto" href="javascript:void(0)" data-toggle="modal" data-target="#ver<?php echo $id;?>">Ver artículos</button></span></td>
                      <td>
                        <a id="good" class="btn btn-outline-success btn-sm" href="buscador_pedido.php?orden=good&id=<?php echo $id;?>" >Listo</a>
                        <a id="bad" class="btn btn-outline-danger btn-sm" href="javascript:void(0)" data-toggle="modal" data-target="#fal<?php echo $id;?>"><span title="Reportar Inconveniente" data-toggle="tooltip">Falla</span></a>
                      </td>
                    </tr>
                    <!-- Modal ver articulos -->
                    <div class="modal fade bd-example-modal-lg" id="ver<?php echo $id;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="closeSesionLabel">Artículos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <?php
                            $sqla="SELECT INVENTARIOID,CANTIDAD,PRECIO FROM `items` WHERE PEDIDOID='$id'";
                            $resultado=$conn->query($sqla);
                            if($resultado->num_rows>0){
                              while($rowa=$resultado->fetch_assoc()){
                                $inventarioId=$rowa['INVENTARIOID'];
                                $cantidad=$rowa['CANTIDAD'];
                                $precioProducto=$rowa['PRECIO'];
                                $sqla2="SELECT i.IDMODELO,i.TALLAID,i.PESO,m.IDPRODUCTO,m.COLOR1,m.COLOR2,m.IMAGEN,p.NOMBRE_P,p.GENERO,p.CATEGORIAID,p.MARCAID,p.ESTATUS FROM `inventario` i INNER JOIN `modelos` m ON i.IDMODELO=m.IDMODELO INNER JOIN `productos` p ON m.IDPRODUCTO=p.IDPRODUCTO WHERE i.IDINVENTARIO='$inventarioId'";
                                $resultado2=$conn->query($sqla2);
                                if($resultado2->num_rows>0){
                                  while($rowa2=$resultado2->fetch_assoc()){
                                    $idModelo=$rowa2['IDMODELO'];
                                    $tallaId=$rowa2['TALLAID'];
                                    $talla=$nombre_tallas[array_search($tallaId,$id_tallas_bd)];
                                    $titulo=$rowa2['PESO'];
                                    $color1=$rowa2['COLOR1'];
                                    $color2=$rowa2['COLOR2'];
                                    $imagen=$rowa2['IMAGEN'];
                                    $titulo=$rowa2['NOMBRE_P'];
                                    $genero=$rowa2['GENERO'];
                                    $categoriaId=$rowa2['CATEGORIAID'];
                                    $categoria=$categorias_padre[array_search($categoriaId,$id_categorias)];
                                    $marcaId=$rowa2['MARCAID'];
                                    $marca=$nombres_marcas[array_search($marcaId,$id_marcas)];
                                    $estatus=$rowa2['ESTATUS'];
                                  }
                                }
                                ?>
                                <div class="row mb-2">
                                  <div class="col-3 text-center">
                                    <img src="../inventario/img/<?php echo $imagen;?>" alt="<?php echo $titulo;?>" width="70vw">
                                  </div>
                                  <div class="col-8">
                                    <div class="row">
                                      <div class="col-9 px-0">
                                        <div class="row">
                                          <span><a href="../../vitrina/detalles.php?idmodelo=<?php echo $idModelo;?>" target="_blank"><?php echo $titulo;?></a></span>
                                        </div>
                                        <div class="row">
                                          Talla: <span class="text-dark"><?php echo $cantidad.$talla;?></span>
                                        </div>
                                      </div>
                                      <div class="col-sm-3 ml-auto">
                                        <?php echo number_format($precioProducto,2,',','.');?> Bs
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <?php
                              }
                            }
                            ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Falla -->
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
              } ?>
            </tbody>
          </table>
        <?php }else{ ?>
          <div class="row my-3 text-danger justify-content-center">
            <h5>¡No hay pedidos para sacar!</h5>
          </div>
        <?php } ?>
          <?php $conn->close(); ?>
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
