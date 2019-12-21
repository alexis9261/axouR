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
    $sql="SELECT * FROM PEDIDOS WHERE IDPEDIDO='$newid' AND ESTATUS=6 LIMIT 1";
    $result=$conn->query($sql);
    if($result->num_rows>0){while($row=$result->fetch_assoc()){$band=true;}}
    if($band){
      //actualizar estatus a completado.
      $sql3="UPDATE `PEDIDOS` SET `ESTATUS`='9' WHERE `IDPEDIDO`='$newid'";
      if($conn->query($sql3)===TRUE){}
    }
  }
  header('location: ../ventas/');
}
$array_meses=array('','Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');
$array_dias=array('','Lun','Mar','Mie','Jue','Vie','Sab','Dom');
//buscar los nombres de las tallas
$nombre_tallas=array();
$id_tallas_bd=array();
$sql="SELECT * FROM TALLAS";
$res=$conn->query($sql);
if($res->num_rows>0){
  while($row=$res->fetch_assoc()){
    array_push($nombre_tallas,$row['TALLA']);
    array_push($id_tallas_bd,$row['IDTALLA']);
  }
}
//categorias
$sql="SELECT * FROM CATEGORIAS WHERE PADRE=0";
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
$sql="SELECT * FROM MARCAS LIMIT 8";
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
              <div class="col-5 align-self-center">
                <h4 class="page-title">Ventas  <a href="../ventas" class="m-2" ><i title="Actualizar" data-toggle="tooltip" class="ti-loop"></i></a></h4>
              </div>
            </div>
          </div>
            <div class="container-fluid">
              <?php
              if (isset($search)){
                if($search=='ccc'){
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
                    <table id="example" class="display" style="width:100%">
                      <thead>
                        <tr class="text-dark">
                          <th>#</th>
                          <th>Estatus</th>
                          <th>Cliente</th>
                          <th>Teléfono</th>
                          <th>Fecha de Compra</th>
                          <th>Enviar</th>
                          <th>Artículos</th>
                          <th>Total (Bs)</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody class="text-dark">
                        <?php
                      $cont=0;
                      while($row=$result->fetch_assoc()){
                        ++$cont;
                        $id=$row['IDPEDIDO'];
                        $sql2="SELECT * FROM USUARIOS u
                        INNER JOIN PEDIDOS p ON u.CORREO=p.EMAILUSER
                        INNER JOIN ENVIOS e ON e.PEDIDOID=p.IDPEDIDO
                        INNER JOIN COMPRAS c ON c.PEDIDOID=p.IDPEDIDO
                        WHERE p.IDPEDIDO='$id';"; //encuentro los articulos del pedido
                        $result2=$conn->query($sql2);
                        if($result2->num_rows>0){
                          while($row2=$result2->fetch_assoc()){
                            $cliente=$row2['NOMBRE']." ".$row2['APELLIDO'];
                            $ci_cliente=$row2['DOCUMENTOID'];
                            $correo_cliente=$row2['EMAILUSER'];
                            $telefono=$row2['TELEFONO'];
                            $estatus=$row2['ESTATUS'];
                            $fecha=$row2['FECHAPEDIDO'];
                            $fecha=$array_dias[date('N',strtotime(substr($fecha,0,10)))]." ".substr($fecha,8,2)." de ".$array_meses[substr($fecha,5,2)]." a las ".substr($fecha,11,5);
                            //$peso=$row2['PESOT'];
                            $estado=$row2['ESTADO'];
                            $municipio=$row2['MUNICIPIO'];
                            $direccion=$row2['DIRECCION'];
                            $codigopostal=$row2['CODIGOPOSTAL'];
                            $encomienda=$row2['ENCOMIENDA'];
                            $monto=$row2['MONTO'];
                            $facturaFiscal=$row2['FACTFISCAL'];
                            #refencia de ENVIOS
                            if($row2['GUIA']!=NULL){$guia= $row2['GUIA'];}else{$guia='Sin Enviar';}
                            #Factura
                            if(!empty($row2['RAZONSOCIAL']) and !empty($row2['RIFCI']) and !empty($row2['DIRFISCAL'])){
                              $razon_social=$row2['RAZONSOCIAL'];
                              $rif=$row2['RIFCI'];
                              $dir_fiscal=$row2['DIRFISCAL'];
                            }
                            ?>
                            <tr>
                              <td class="text-center"><b><?php echo $cont;?></b></td>
                              <td>
                                <?php
                                switch($estatus){
                                  case '0': $estatus_string='<span class="label label-info label-rounded" data-toggle="tooltip" title="Aún no se ha registrado un pago">Por Pagar</span>';
                                  break;
                                  case '1':  $estatus_string='<span class="label label-danger label-rounded">Pago Fallido</span>';
                                  break;
                                  case '2': $estatus_string='<span class="label label-warning  label-rounded">Pago a Confirmar</span>';
                                  break;
                                  case '3':  $estatus_string='<span class="label label-purple label-rounded">Por Buscar</span>';
                                  break;
                                  case '4':  $estatus_string='<span class="label label-info label-rounded">Por Empaquetar</span>';
                                  break;
                                  case '5': $estatus_string='<span class="label label-warning label-rounded">Por Enviar</span>';
                                  break;
                                  case '6': $estatus_string='<span class="label label-success label-rounded">Enviado</span>';
                                  break;
                                  case '7': $estatus_string='<span class="label label-success label-rounded">Completado</span>';
                                  break;
                                  case '8': $estatus_string='<span class="label label-danger label-rounded">Cancelada</span>';
                                  break;
                                  case '9': $estatus_string='<span class="label label-success label-rounded">Completado</span>';
                                  break;
                                  case '10': $estatus_string='<span class="label label-danger label-rounded">Bajo Revisión</span>';
                                  break;
                                  case '11': $estatus_string='<span class="label label-danger label-rounded">Cancelado</span>';
                                  break;
                                  case '12': $estatus_string='<span class="label label-warning label-rounded">Fondos insuficientes</span>';
                                  break;
                                  default:
                                  $estatus_string='<span class="label label-danger label-rounded">Error</span>';
                                  break;
                                }
                                echo $estatus_string;
                                ?>
                              </td>
                              <td class="txt-oflo"><?=$cliente?></td>
                              <td class="txt-oflo"><?=$telefono?></td>
                              <td class="txt-oflo"><?=$fecha?></td>
                              <td><?=$encomienda?></td>
                              <td><span class="font-medium"><button type="button" class="enlace2 ml-auto" href="javascript:void(0)" data-toggle="modal" data-target="#ver_<?=$id?>">Ver artículos</button></span></td>
                              <td><span class="font-medium"><?=number_format($monto,2,',','.')?></span></td>
                              <td>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#edit_<?=$id?>"><i title="Revisar" data-toggle="tooltip" class="ti-pencil-alt"></i></a>
                                <?php if($estatus=='6'){echo '<a href="javascript:void(0)" data-toggle="modal" data-target="#completed_'.$id.'"><i title="Completar" data-toggle="tooltip" class=" mx-2 text-success ti-check"></i></a>';} ?>
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
                                      <h5 class="modal-title text-dark">Artículos de <b><?=$cliente?></b></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php
                                        $sqla="SELECT INVENTARIOID,CANTIDAD,PRECIO FROM `ITEMS` WHERE PEDIDOID='$id'";
                                        $resultado=$conn->query($sqla);
                                        if($resultado->num_rows>0){
                                          while($rowa=$resultado->fetch_assoc()){
                                            $inventarioId=$rowa['INVENTARIOID'];
                                            $cantidad=$rowa['CANTIDAD'];
                                            $precioProducto=$rowa['PRECIO'];
                                            $sqla2="SELECT i.IDMODELO,i.TALLAID,i.PESO,m.IDPRODUCTO,m.COLOR1,m.COLOR2,m.IMAGEN,p.NOMBRE_P,p.GENERO,p.CATEGORIAID,p.MARCAID,p.ESTATUS FROM `INVENTARIO` i INNER JOIN `MODELOS` m ON i.IDMODELO=m.IDMODELO INNER JOIN `PRODUCTOS` p ON m.IDPRODUCTO=p.IDPRODUCTO WHERE i.IDINVENTARIO='$inventarioId'";
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
                                                      Talla: <b class="text-dark"> <?php echo $cantidad." ".$talla;?></b>
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
                              <!-- Modal ver datos de envio -->
                              <div class="modal fade bd-example-modal-lg" id="edit_<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <div class="row">
                                          <div class="col-auto">
                                            <h5 class="modal-title text-dark">
                                              <?php if($encomienda=="Tienda"){ ?>
                                                Retira en tienda
                                              <?php }else{ ?>
                                                A Enviar por <?=$encomienda?>
                                              <?php } ?>
                                            </h5>
                                          </div>
                                          <div class="col-auto"><?=$estatus_string?></div>
                                        </div>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <div class="row">
                                          <div class="col-12 text-dark">
                                            <b>Datos de Cliente</b>
                                          </div>
                                          <div class="col-12">
                                            <div class="row">
                                              <div class="col-sm-6">
                                                Nombre: <span class="text-dark"><?=$cliente?></span>
                                              </div>
                                              <div class="col-sm-6">
                                                Cédula: <span class="text-dark"><?php echo $ci_cliente;?></span>
                                              </div>
                                              <div class="col-sm-6">
                                                Teléfono: <span class="text-dark"><?php echo $telefono;?></span>
                                              </div>
                                              <div class="col-sm-6">
                                                Email: <span class="text-dark"><?php echo $correo_cliente;?></span>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <?php if($encomienda!="Tienda"){ ?>
                                          <hr>
                                          <div class="row">
                                            <b class="col-auto text-dark">Datos de Envío</b>
                                          </div>
                                          <div class="row">
                                            <div class="col-sm-6">
                                              Estado: <span class="text-dark"><?=$estado?></span>
                                            </div>
                                            <div class="col-sm-6">
                                              Municipio: <span class="text-dark"><?=$municipio?></span>
                                            </div>
                                            <div class="col-sm-6">
                                              Código Postal: <span class="text-dark"><?=$codigopostal?></span>
                                            </div>
                                            <div class="col-12">
                                              Dirección: <span class="text-dark"><?=$direccion?></span>
                                            </div>
                                            <div class="col-12">
                                              Guia: <span class="text-dark"><?=$guia?></span>
                                            </div>
                                          </div>
                                        <?php } ?>
                                        <?php if($facturaFiscal==1){
                                          ?>
                                          <hr>
                                          <div class="row">
                                            <b class="col-auto text-dark">Factura Fiscal</b>
                                          </div>
                                          <div class="row">
                                            <div class="col-sm-6">
                                              Razón Social: <span class="text-dark"><?=$razon_social?></span>
                                            </div>
                                            <div class="col-sm-6">
                                              Rif: <span class="text-dark"><?=$rif?></span>
                                            </div>
                                            <div class="col-12">
                                              Dirección Fiscal: <span class="text-dark"><?=$dir_fiscal?></span>
                                            </div>
                                          </div>
                                        <?php } ?>
                                        <!--h2 class="text-center">Peso: <?=number_format($peso,2,',','.')?> gr</h2-->
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              <?php
                            }
                          }
                        } ?>
                      </tbody>
                    </table>
                  </div>
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
