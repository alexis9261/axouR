<?php
include '../common/sesion.php';
require '../../common/conexion.php';
if(isset($_GET['estatus']) && !empty($_GET['estatus'])){$estatus=$_GET['estatus'];}else{$estatus=0;}
//edicion
if(isset($_GET['r'])){if(!empty($_GET['r'])){$editar=$_GET['r'];}}else{$editar=3;}
//pausar o activar productos
$activar=3;
$pausar=3;
if(isset($_GET['idp']) && !empty($_GET['idp'])){
  $Id_producto=$_GET['idp'];
  if(isset($_GET['band'])){
    $band=$_GET['band'];
    if($band==0){
      $sql="UPDATE `PRODUCTOS` SET `ESTATUS`=1 WHERE IDPRODUCTO=$Id_producto";
      if($conn->query($sql)===TRUE){$pausar=1;}else{$pausar=2;}
    }elseif($band==1){
      $sql="UPDATE `PRODUCTOS` SET `ESTATUS`=0 WHERE IDPRODUCTO=$Id_producto";
      if($conn->query($sql)===TRUE){$activar=1;}else{$activar=2;}
    }
  }
}
$array_tallas=array();
$array_colores=array();
$sql="SELECT * FROM TALLAS";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    array_push($array_tallas,$row['IDTALLA']."|".$row['TALLA']);
  }
}
$array_categorias_id=array();
$array_categorias_names=array();
$sql="SELECT IDCATEGORIA,NOMBRE FROM CATEGORIAS WHERE PADRE=0";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    array_push($array_categorias_id,$row['IDCATEGORIA']);
    array_push($array_categorias_names,$row['NOMBRE']);
  }
}
$array_marcas_id=array();
$array_marcas_names=array();
$sql="SELECT * FROM MARCAS";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    array_push($array_marcas_id,$row['IDMARCA']);
    array_push($array_marcas_names,$row['NOMBREMARCA']);
  }
}
$sql="SELECT * FROM COLOR";
$result=$conn->query($sql);
if($result->num_rows>0){while($row=$result->fetch_assoc()){array_push($array_colores,$row['IDCOLOR']."|".$row['COLOR']);}}
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Administración de la E-Comerce Rouxa.">
  <meta name="author" content="Eutuxia Web, C.A.">
  <link rel="icon" type="image/jpg" sizes="16x16" href="../img/<?php echo $imageLogo;?>">
  <title><?php echo $nombrePagina;?> - Administración</title>
  <link href="../assets/dist/css/style.min.css" rel="stylesheet">
  <link href="../assets/vendor/datatables/datatables.min.css" rel="stylesheet">
  <link href="../../css/new.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
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
            <div class="col-auto">
              <h4 class="page-title">Inventario</h4>
            </div>
            <div class="col-auto ml-auto">
              <?php
              $sql="SELECT COUNT(*) AS TOTAL FROM PRODUCTOS WHERE ESTATUS<>'$estatus'";
              $result=$conn->query($sql);
              if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                  $total=$row['TOTAL'];
                }
              }
               ?>
              <?php if(isset($_GET['estatus']) && $_GET['estatus']==1){ ?>
                  <a href="?estatus=0">Ver activas (<b><?php echo $total;?></b>)</a>
              <?php }else{ ?>
                <a href="?estatus=1">Ver pausados (<b><?php echo $total;?></b>)</a>
              <?php } ?>
            </div>
          </div>
        </div>
            <div class="container-fluid">
              <table id="example" class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th></th>
                    <th>Titulo</th>
                    <th>Nº Modelos</th>
                    <th>Categoria</th>
                    <th>Genero</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                    <?php
                      $sql="SELECT * FROM PRODUCTOS WHERE ESTATUS=$estatus;";
                      $result=$conn->query($sql);
                      if($result->num_rows>0){
                        $cont=0;
                        while($row=$result->fetch_assoc()){
                          ++$cont;
                          $idProducto=$row['IDPRODUCTO'];
                          $titulo=$row['NOMBRE_P'];
                          $genero=$row['GENERO'];
                          if($genero=="1"){$genero="Dama";}elseif($genero=="2"){$genero="Caballero";}
                          $idCategoria=$row['CATEGORIAID'];
                          $categoria=$array_categorias_names[array_search($idCategoria,$array_categorias_id)];
                          $precio=$row['PRECIO'];
                          $marca=$row['MARCAID'];
                          $marca=$array_marcas_names[array_search($marca,$array_marcas_id)];
                          $sql2="SELECT IDMODELO,IMAGEN FROM MODELOS WHERE IDPRODUCTO='$idProducto' LIMIT 1";
                          $result2=$conn->query($sql2);
                          if($result2->num_rows>0){
                            while($row2=$result2->fetch_assoc()){
                              $idModelo=$row2['IDMODELO'];
                              $imagen=$row2['IMAGEN'];
                            }
                          }
                          $sql3="SELECT COUNT(*) AS CUENTA FROM MODELOS WHERE IDPRODUCTO='$idProducto'";
                          $result3=$conn->query($sql3);
                          if($result3->num_rows>0){
                            while($row3=$result3->fetch_assoc()){
                              $cantidadModelos=$row3['CUENTA'];
                            }
                          }
                          ?>
                          <tr>
                            <td class="text-center"><?php echo $cont;?></td>
                            <td class="text-center"><img src="img/<?php echo $imagen;?>" width="30vw"></td>
                            <td><a href="../../vitrina/detalles.php?idmodelo=<?php echo $idModelo;?>" target="_blank"><?php echo $titulo;?></a></td>
                            <td class="text-center"><?php echo $cantidadModelos;?></td>
                            <td><?php echo $categoria;?></td>
                            <td><?php echo $genero;?></td>
                            <td><?php echo $marca;?></td>
                            <td><?php echo $precio;?></td>
                            <td>
                              <a class="mr-2" href="editProducto.php?idproducto=<?php echo $idProducto;?>">
                                <svg title="Editar" data-toggle="tooltip" xmlns="http://www.w3.org/2000/svg" width='15px' viewBox="0 0 576 512"><path fill="#3860ff" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"/></svg>
                              </a>
                              <?php if (isset($_GET['estatus']) && $_GET['estatus']==1){ ?>
                                <button class="btn btn-link" data-toggle='modal' data-target='.activar-<?php echo $idProducto;?>'>
                                  <svg title="Activar" data-toggle="tooltip" xmlns="http://www.w3.org/2000/svg" width='14px' viewBox="0 0 448 512"><path fill="#4aff36" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"/></svg>
                              <?php }else{ ?>
                                <button class="btn btn-link" data-toggle='modal' data-target='.pausar-<?php echo $idProducto;?>'>
                                  <svg title="Pausar" data-toggle="tooltip" xmlns="http://www.w3.org/2000/svg" width='14px' viewBox="0 0 448 512"><path fill="#ff5922" d="M144 479H48c-26.5 0-48-21.5-48-48V79c0-26.5 21.5-48 48-48h96c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zm304-48V79c0-26.5-21.5-48-48-48h-96c-26.5 0-48 21.5-48 48v352c0 26.5 21.5 48 48 48h96c26.5 0 48-21.5 48-48z"/></svg>
                              <?php } ?>
                              </button>
                            </td>
                          </tr>
                          <!-- Modal Activar-->
                          <div class='modal fade activar-<?php echo $idProducto;?>' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel2' aria-hidden='true'>
                            <div class='modal-dialog'>
                              <div class='modal-content container'>
                                <div class='modal-header'>
                                  <?php echo $titulo;?>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class'modal-body text-muted'>
                                  ¿Seguro que desea activar este articulo?
                                </div>
                                <div class="modal-footer">
                                  <button class='btn btn-danger btn-sm' type='button' data-dismiss='modal'>Cancelar</button>
                                  <a class="btn btn-primary btn-sm px-5 text-white" href="?idp=<?php echo $idProducto;?>&band=1">Activar</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- Modal Pausar-->
                          <div class='modal fade pausar-<?php echo $idProducto;?>' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel2' aria-hidden='true'>
                            <div class='modal-dialog'>
                              <div class='modal-content container'>
                                <div class='modal-header'>
                                  <?php echo $titulo;?>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                </div>
                                <div class'modal-body text-muted'>
                                  ¿Seguro que desea pausar este articulo?
                                </div>
                                <div class="modal-footer">
                                  <button class='btn btn-danger btn-sm' type='button' data-dismiss='modal'>Cancelar</button>
                                  <a class="btn btn-primary btn-sm px-5 text-white" href="?idp=<?php echo $idProducto;?>&band=0">Pausar</a>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php
                        }
                      }
                     ?>
                </tbody>
              </table>
        </div>
    </div>
    <!-- alert Activar -->
    <script>
      $(document).ready(function(){
        var activar=<?php echo $activar;?>;
        if(activar==1){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'success',title:'¡El producto fue activado exitosamente!'})
        }else if(activar==2){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'error',title:'¡Hubo un pequeño problema! \n Inténtalo de nuevo'})
        }
      });
    </script>
    <!-- alert Pausar -->
    <script>
      $(document).ready(function(){
        var pausar=<?php echo $pausar;?>;
        if(pausar==1){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'success',title:'¡El producto fue pausado exitosamente!'})
        }else if(pausar==2){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'error',title:'¡Hubo un pequeño problema! \n Inténtalo de nuevo'})
        }
      });
    </script>
    <!-- alert Editar -->
    <script>
      $(document).ready(function(){
        var editar=<?php echo $editar;?>;
        if(editar==1){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'success',title:'¡El producto fue editado exitosamente!'})
        }else if(editar==2){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'error',title:'¡Hubo un pequeño problema! \n Inténtalo de nuevo'})
        }
      });
    </script>
    <script>
      $(document).ready(function(){
        $('#example').addClass('nowrap').dataTable({
          responsive:true,
          columnDefs:[{
            "targets":[-1],
            "orderable":false
          }]
        });
      });
    </script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/dist/js/custom.min.js"></script>
    <script src="../assets/vendor/datatables/datatables.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@7.29.0/dist/sweetalert2.all.min.js'></script>
</body>
</html>
