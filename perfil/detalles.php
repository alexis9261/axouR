<?php
session_start();
include '../common/conexion.php';
include '../cambioDolar/index.php';
include '../common/datosGenerales.php';
$array_meses=array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
if(isset($_GET['id'])){$idPedido=$_GET['id'];}else {header('location: compras.php');}
if(isset($_GET['resp'])){$respuesta=$_GET['resp'];}
$sql="SELECT * FROM `pedidos` WHERE IDPEDIDO='$idPedido'";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    $emailUser=$row['EMAILUSER'];
    $estatusPedido=$row['ESTATUS'];
    $fechaPedido=$row['FECHAPEDIDO'];
    $stingDate=substr($fechaPedido,8,2)." de ".$array_meses[intval(substr($fechaPedido,5,2))]." del ".substr($fechaPedido,0,4);
  }
}
/*switch($estatusPedido){
    case '0': $aux= 'Aún no has pagado este pedido.'; $id_s=0;
        break;
    case '1': $aux='El pago que realizaste fue fallido'; $id_s=1;
        break;
    case '2': $aux='El pago que realizaste esta en proceso de revisión'; $id_s=2;
        break;
    case '3': $aux='En las próximas horas estaremos enviando tu pedido'; $id_s=3;
        break;
    case '4': $aux='Estamos preparando tu paquete para enviarlo'; $id_s=4;
        break;
    case '5': $aux='Tu paquete esta pronto a ser enviado'; $id_s=5;
        break;
    case '6': $aux='¡Tu pedido ya fue Enviado! Consulta con la oficina de encominedas'; $id_s=6;
        break;
    case '7': $aux='Completado'; $id_s=7;
        break;
    case '8': $aux='Pago por cupon, Estamos validando.'; $id_s=8;// en este caso, ahora sera compra cancelada por el cliente
        break;
    case '9': $aux='Compra Finalizada con exito, Te esperamos nuevamente.'; $id_s=9;
            break;
    case '10': $aux='Tu pedido se encuentra bajo revisión. Nos estaremos comunicando contigo para solventar el inconveniente.'; $id_s=10;
    break;
    case '11': $aux='La compra con esta LLave digital ha sido cancelada'; $id_s=10;
    break;
    case '12': $aux='Tu pago ha sido insuficiente, esperamos un nuevo pago con el resto del dinero.'; $id_s=10;
    break;
    default:
    $status='Error';
}*/
//Monto Total
$sql="SELECT * FROM `compras` WHERE PEDIDOID='$idPedido' LIMIT 1";
$result=$conn->query($sql);
if($result->num_rows>0){while($row=$result->fetch_assoc()){$montoPedido=$row['MONTO'];}}
//buscar los nombres de las tallas
$nombre_tallas=array();
$id_tallas_bd=array();
$sql="SELECT * FROM `tallas`;";
$res=$conn->query($sql);
if($res->num_rows>0){
  while($row=$res->fetch_assoc()){
    array_push($nombre_tallas,$row['TALLA']);
    array_push($id_tallas_bd,$row['IDTALLA']);
  }
}
//categorias
$sql="SELECT * FROM `categorias` WHERE PADRE=0;";
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
$sql="SELECT * FROM `marcas` LIMIT 8;";
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
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="desciption" content="Rouxa, Tienda virtual de Ropa para Damas, Caballeros y Niños.">
  <meta name="keywords" content="Rouxa, Ropa, Damas, Caballeros, Zapatos, Tienda Virtual">
  <meta name="author" content="Eutuxia, C.A.">
  <meta name="application-name" content="Tienda Virtual de Ropa, <?php echo $nombrePagina;?>."/>
  <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
  <link rel="stylesheet" href="../css/style-main.css">
  <link rel="stylesheet" href="../css/new.css">
  <link rel="stylesheet" href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css">
  <title><?php echo $nombrePagina;?></title>
  <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
</head>
<body>
  <?php include '../common/menu.php';include '../common/2domenu.php'; ?>
  <div class="container mb-3">
    <div class="row bg-light py-3 px-3" style="border-radius:5px;">
      <h3 class="lead"><strong>Detalles de la compra realizada el <?php echo $stingDate;?>
        <?php if ($estatusPedido==8){ ?>
          - <span class="text-danger"> Compra Cancelada</span>
        <?php } ?>
      </strong></h3>
      <span class="col-auto ml-auto"><a href="compras.php">Compras</a> - Detalles</span>
    </div>
    <div class="container mt-4 mb-5 pb-5">
      <div class="row">
        <div class="col-10">
          <?php
          $sql="SELECT INVENTARIOID,CANTIDAD,PRECIO FROM `items` WHERE PEDIDOID='$idPedido'";
          $result=$conn->query($sql);
          if($result->num_rows>0){
            while($row=$result->fetch_assoc()){
              $inventarioId=$row['INVENTARIOID'];
              $cantidad=$row['CANTIDAD'];
              $precioProducto=$row['PRECIO'];
              $sql2="SELECT i.IDMODELO,i.TALLAID,i.PESO,m.IDPRODUCTO,m.COLOR1,m.COLOR2,m.IMAGEN,p.NOMBRE_P,p.GENERO,p.CATEGORIAID,p.MARCAID,p.ESTATUS FROM `inventario` i INNER JOIN `modelos` m ON i.IDMODELO=m.IDMODELO INNER JOIN `productos` p ON m.IDPRODUCTO=p.IDPRODUCTO WHERE i.IDINVENTARIO='$inventarioId'";
              $result2=$conn->query($sql2);
              if($result2->num_rows>0){
                while($row2=$result2->fetch_assoc()){
                  $idModelo=$row2['IDMODELO'];
                  $tallaId=$row2['TALLAID'];
                  $talla=$nombre_tallas[array_search($tallaId,$id_tallas_bd)];
                  $titulo=$row2['PESO'];
                  $color1=$row2['COLOR1'];
                  $color2=$row2['COLOR2'];
                  $imagen=$row2['IMAGEN'];
                  $titulo=$row2['NOMBRE_P'];
                  $genero=$row2['GENERO'];
                  $categoriaId=$row2['CATEGORIAID'];
                  $categoria=$categorias_padre[array_search($categoriaId,$id_categorias)];
                  $marcaId=$row2['MARCAID'];
                  $marca=$nombres_marcas[array_search($marcaId,$id_marcas)];
                  $estatus=$row2['ESTATUS'];
                }
              }
                ?>
                <div class="row mb-2">
                  <div class="col-2 text-center">
                    <img src="../admin/inventario/img/<?php echo $imagen;?>" alt="<?php echo $titulo;?>" width="70vw">
                  </div>
                  <div class="col-8">
                    <div class="row">
                      <div class="col-7 px-0">
                        <div class="row">
                          <span><a href="../vitrina/detalles.php?idmodelo=<?php echo $idModelo;?>"><?php echo $titulo;?></a></span>
                        </div>
                        <div class="row">
                          <small>Talla: <?php echo $cantidad.$talla;?></small>
                        </div>
                      </div>
                      <div class="col-5 ml-auto">
                        <div class="row justify-content-end">
                          <small class="text-muted"><a class="enlace2" href="../vitrina/index.php?categ=<?php echo $categoriaId;?>"><?php echo $categoria;?></a>
                            <a class="enlace2" href="../vitrina/index.php?marca=<?php echo $marcaId;?>"><?php echo $marca;?></a> de
                            <a class="enlace2" href="../vitrina/index.php?genero=<?php echo $genero;?>">
                              <?php if($genero==1){echo "Damas";}elseif($genero==2){echo "Caballeros";} ?>
                            </a>
                          </small>
                        </div>
                        <div class="row justify-content-end">
                          <?php echo number_format($precioProducto,2,',','.');?> Bs
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
            }
          }
          ?>
        </div>
          <div class="col-2 ml-auto">
            <div class="row justify-content-end">
              <span>Monto total de la compra</span>
            </div>
            <h2 class="row justify-content-end text_monto_details text-muted">
              <?php echo number_format($montoPedido,2,',','.');?> Bs
            </h2>
            <?php
            $sql="SELECT * FROM pagos WHERE IDPEDIDO='$idPedido';";
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_assoc()){
                $pago=$row['MONTO'];
                $moneda=$row['MONEDA'];
                $fechaPago=$row['FECHAPAGO'];
                $estatus_pago=$row['ESTATUS'];
                if($estatus_pago==0){
                  ?>
                  <h5 class="row justify-content-end lead text-primary" title="Pago realizado el <?php echo $fechaPago;?>" data-toggle="tooltip">
                  <?php }elseif($estatus_pago==1){ ?>
                    <h5 class="row justify-content-end lead text-success" title="Pago realizado el <?php echo $fechaPago;?>" data-toggle="tooltip">
                      <span class="pr-1"><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' width='15px'><path fill='#33e222' d='M504 256c0 136.967-111.033 248-248 248S8 392.967 8 256 119.033 8 256 8s248 111.033 248 248zM227.314 387.314l184-184c6.248-6.248 6.248-16.379 0-22.627l-22.627-22.627c-6.248-6.249-16.379-6.249-22.628 0L216 308.118l-70.059-70.059c-6.248-6.248-16.379-6.248-22.628 0l-22.627 22.627c-6.248 6.248-6.248 16.379 0 22.627l104 104c6.249 6.249 16.379 6.249 22.628.001z'/></svg></span>
                  <?php }elseif($estatus_pago==2){ ?>
                    <h5 class="row justify-content-end lead text-danger" title="Pago en revisión, se pondrán en contacto pronto contigo." data-toggle="tooltip">
                      <span class="pr-1"><svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' width='15px'><path fill='#e2282c' d='M504 256c0 136.997-111.043 248-248 248S8 392.997 8 256C8 119.083 119.043 8 256 8s248 111.083 248 248zm-248 50c-25.405 0-46 20.595-46 46s20.595 46 46 46 46-20.595 46-46-20.595-46-46-46zm-43.673-165.346l7.418 136c.347 6.364 5.609 11.346 11.982 11.346h48.546c6.373 0 11.635-4.982 11.982-11.346l7.418-136c.375-6.874-5.098-12.654-11.982-12.654h-63.383c-6.884 0-12.356 5.78-11.981 12.654z'/></svg></span>
                  <?php } ?>
                  <?php echo number_format($pago,2,',','.')." $moneda";?>
                </h5>
                <?php
              }
            }
             ?>
            <div class="row justify-content-end mt-2">
              <?php if ($estatusPedido==8){ ?>
                <button class="btn btn-primary btn-sm px-5" type="button" data-toggle='modal' data-target='.modal_pago' id="pagar" disabled>Registrar pago</button>
              <?php }else{ ?>
                <button class="btn btn-primary btn-sm px-5" type="button" data-toggle='modal' data-target='.modal_pago' id="pagar">Registrar pago</button>
              <?php } ?>
            </div>
            <div class="row justify-content-end mt-2">
              <?php if ($estatusPedido==8){ ?>
                <button class="btn btn-danger btn-sm px-5" type="button" data-toggle='modal' data-target='.modal_cancelar' id="cancelar_compra" disabled>Compra Cancelada</button>
              <?php }else{ ?>
                <button class="btn btn-danger btn-sm px-5" type="button" data-toggle='modal' data-target='.modal_cancelar' id="cancelar_compra">Cancelar compra</button>
              <?php } ?>
            </div>
          </div>
        </div>
        <div class="row my-2">
          <button class="btn btn-link" type="button" data-toggle='modal' data-target='.modal_envios'>Ver datos de envios</button>
        </div>
      </div>
      <!-- Modal Registrar Pago -->
      <div class='modal fade modal_pago' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
          <div class='modal-content container'>
            <div class='modal-header'>
              <h5 class='modal-title'>Puedes realizar una transferencia nuestras cuentas bancarias</h5>
              <button class='close' type='button' data-dismiss='modal' aria-label='Close' id="close_modal_pago"><span aria-hidden='true'>×</span></button>
            </div>
            <form action="../carrito/procesar_pago.php" method="post">
              <div class='modal-body'>
                <div class="container mb-0">
                  <div class="row">
                    <h6 class="col-sm-6"><b>Banesco</b></h6>
                    <h6 class="col-sm-6"><b>N°</b> 0134 0464 03 4641026277</h6>
                    <h6 class="col-sm-6"><b>Mercantil</b></h6>
                    <h6 class="col-sm-6"><b>N°</b>0105 0283 7512 83148412</h6>
                    <h6 class="col-sm-6"><b>Provincial</b></h6>
                    <h6 class="col-sm-6"><b>N°</b> 0108 0558 9901 00043593</h6>
                    <h6 class="col-sm-6"><b>Del Tesoro</b></h6>
                    <h6 class="col-sm-6"><b>N°</b> 0163 0217 1121 73013146</h6>
                  </div>
                  <hr>
                  <div class="row">
                    <h6 class="col-sm-4 text-center"><b>Titular: </b>Alpargata Skate, C.A.</h6>
                    <h6 class="col-sm-4 text-center"><b>Tipo: </b>Corriente</h6>
                    <h6 class="col-sm-4 text-center"><b>RIF: </b>J-XXXXXXX</h6>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="input-group mb-2 col-sm-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text" data-toggle="tooltip" title="Desde donde realizaste la trasnferencia">Banco emisor</span>
                      </div>
                      <select class="custom-select input_datos text-dark" name="banco_e">
                        <option value="Banesco">Banesco</option>
                        <option value="Mercantil">Mercantil</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Tesoro">Del Tesoro</option>
                        <option value="Provincial">Provincial</option>
                        <option value="100% Banco">100% Banco</option>
                        <option value="Bancaribe">Bancaribe</option>
                        <option value="Banco Activo">Banco Activo</option>
                        <option value="Bicentenario">Bicentenario</option>
                        <option value="BNC">Banco Nacional de Credito</option>
                        <option value="Venezolano de Crédito">Venezolano de Crédito</option>
                        <option value="BOD">BOD</option>
                        <option value="Fondo Común">Fondo Común</option>
                        <option value="Banplus">Banplus</option>
                        <option value="Exterior">Banco Exterior</option>
                        <option value="Caroní">Caroní</option>
                        <option value="Banco Plaza">Banco Plaza</option>
                        <option value="Del Sur">Del Sur</option>
                        <option value="Bancrecer">Bancrecer</option>
                      </select>
                    </div>
                    <div class="input-group mb-2 col-sm-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text" data-toggle="tooltip" title="Hacia donde realizaste la trasnferencia">Banco receptor</span>
                      </div>
                      <select class="custom-select input_datos text-dark" name="banco_r">
                        <option value="Banesco">Banesco</option>
                        <option value="Mercantil">Mercantil</option>
                        <option value="Venezuela">Venezuela</option>
                        <option value="Tesoro">Del Tesoro</option>
                      </select>
                    </div>
                  </div>
                  <div class="row">
                    <div class="input-group flex-nowrap mb-2 col-sm-6">
                      <div class="input-group-prepend">
                        <span class="input-group-text" data-toggle="tooltip" title="Lo que transferite">Monto</span>
                      </div>
                      <input class="form-control input_datos text-dark" type="number" step="1" name="monto" placeholder="Inserte el Monto Transferido" maxlength="255" required/>
                    </div>
                    <div class="input-group col-sm-6 mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Fecha de transacción</span>
                      </div>
                      <input class="form-control text-dark" type="date" name="fechapago" required/>
                    </div>
                    <div class="input-group mb-2 col-12">
                      <div class="input-group-prepend">
                        <span class="input-group-text" data-toggle="tooltip" title="Referencia de la trasnferencia">Referencia</span>
                      </div>
                      <input class="form-control input_datos text-dark" type="text" name="referencia" placeholder="Inserte la Referencia de la Transacción" maxlength="255" required/>
                    </div>
                  </div>
                  <input type="hidden" name="id_pedido" value="<?php echo $idPedido;?>">
                </div>
              </div>
              <div class='modal-footer'>
                <button class="btn btn-secondary btn-sm px-5" type="button" data-dismiss='modal'>Volver</button>
                <button class="btn btn-primary btn-sm px-5" type="submit" id="pago">Registrar Pago</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Modal Cancelar Pedido -->
      <div class='modal fade modal_cancelar' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class='modal-dialog' role='document'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title'>Cancelar Compra</h5>
              <button class='close' type='button' data-dismiss='modal' aria-label='Close' id="close_modal_cancelar"><span aria-hidden='true'>×</span></button>
            </div>
            <div class='modal-body '>
              <div class="row px-2">
                <span>Comentanos porque cancelas la compra. <small class="text-muted"> Queremos Mejorar!! ;)</small> </span>
                <textarea class="form-control textarea_cancelar" rows="3" id="text_cancelar" maxlength="150" required></textarea>
                <small class="text-muted">Quedan <span id="numero">150</span> caracteres.</small>
              </div>
            </div>
            <div class='modal-footer'>
              <button class="btn btn-secondary btn-sm px-5" type="button" data-dismiss='modal'>Volver</button>
              <button class="btn btn-danger btn-sm px-4" type="button" id="cancelar">Cancelar Compra</button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal datos de envio -->
      <?php
      $sql="SELECT ESTADO,MUNICIPIO,DIRECCION,CODIGOPOSTAL,RECEPTOR,CIRECEPTOR,TELFRECEPTOR,ENCOMIENDA,GUIA,FACTFISCAL FROM envios WHERE PEDIDOID='$idPedido' LIMIT 1;";
      $result=$conn->query($sql);
      if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
          $estado=$row['ESTADO'];
          $municipio=$row['MUNICIPIO'];
          $direccion=$row['DIRECCION'];
          $codigopostal=$row['CODIGOPOSTAL'];
          $correo_user=$row['RECEPTOR'];
          $ci_cliente=$row['CIRECEPTOR'];
          $telefono=$row['TELFRECEPTOR'];
          $encomienda=$row['ENCOMIENDA'];
          $guia=$row['GUIA'];
          $facturaFiscal=$row['FACTFISCAL'];
          if($facturaFiscal==1){
            $sql="SELECT RAZONSOCIAL,RIFCI,DIRFISCAL FROM usuarios WHERE CORREO='$correo_user' LIMIT 1";
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_assoc()){
                $razon_social=$row['RAZONSOCIAL'];
                $rif=$row['RIFCI'];
                $dir_fiscal=$row['DIRFISCAL'];
              }
            }
          }
        }
      }
      $cliente=ucwords($nombre)." ".ucwords($apellido);
       ?>
      <div class="modal fade modal_envios" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-dark">
                  <?php if($encomienda=="Tienda"){ ?>
                    Retirarás en la tienda
                  <?php }else{ ?>
                    Tu paquete será enviado por <?=$encomienda?>
                  <?php } ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php if($encomienda!="Tienda"){ ?>
                <div class="row">
                  <div class="col-12 text-dark">
                    <b>Será enviado a:</b>
                  </div>
                  <div class="col-12">
                    <div class="row">
                      <div class="col-sm-6 text-muted">
                        Nombre: <span class="text-dark"><?=$cliente?></span>
                      </div>
                      <div class="col-sm-6 text-muted">
                        Cédula: <span class="text-dark"><?php echo $ci_cliente;?></span>
                      </div>
                      <div class="col-sm-6 text-muted">
                        Teléfono: <span class="text-dark"><?php echo $telefono;?></span>
                      </div>
                    </div>
                  </div>
                </div>
                <hr>
                <?php } ?>
                  <div class="row">
                    <?php if($encomienda=="Tienda"){ ?>
                      <b class="col-auto text-dark">Dirección de la tienda</b>
                    <?php }else { ?>
                      <b class="col-auto text-dark">Datos de Envío</b>
                    <?php } ?>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 text-muted">
                      Estado: <span class="text-dark"><?=$estado?></span>
                    </div>
                    <div class="col-sm-6 text-muted">
                      Municipio: <span class="text-dark"><?=$municipio?></span>
                    </div>
                    <div class="col-sm-6 text-muted">
                      Código Postal: <span class="text-dark"><?=$codigopostal?></span>
                    </div>
                    <div class="col-12 text-muted">
                      Dirección: <span class="text-dark"><?=$direccion?></span>
                    </div>
                  </div>
                  <hr>
                <?php if($facturaFiscal==1){ ?>
                  <div class="row">
                    <b class="col-auto text-dark">Factura Fiscal</b>
                  </div>
                  <div class="row">
                    <div class="col-sm-6 text-muted">
                      Razón Social: <span class="text-dark"><?=$razon_social?></span>
                    </div>
                    <div class="col-sm-6 text-muted">
                      Rif: <span class="text-dark"><?=$rif?></span>
                    </div>
                    <div class="col-12 text-muted">
                      Dirección Fiscal: <span class="text-dark"><?=$dir_fiscal?></span>
                    </div>
                  </div>
                <?php } ?>
                <?php if($guia!=""){ ?>
                  <div class="row">
                    <div class="col-12 text-muted">
                      Guia: <span class="text-dark"><?=$guia?></span>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      <!--div class='modal fade modal_envios' tabindex='-1' role='dialog' aria-hidden='true'>
        <div class='modal-dialog modal-lg'>
          <div class='modal-content container'>
            <div class='modal-header'>
              <h5 class='modal-title'>Tu paquete será enviado por </h5>
              <button class='close' type='button' data-dismiss='modal' aria-label='Close' id="close_modal_pago"><span aria-hidden='true'>×</span></button>
            </div>
            <div class='modal-body'>
              <div class="row">
                <div class="input-group mb-2 col-sm-6">
                  <div class="input-group-prepend">
                    <span class="input-group-text" data-toggle="tooltip" title="Desde donde realizaste la trasnferencia">Banco emisor</span>
                  </div>
                </div>
                <div class="input-group mb-2 col-sm-6">
                  <div class="input-group-prepend">
                    <span class="input-group-text" data-toggle="tooltip" title="Hacia donde realizaste la trasnferencia">Banco receptor</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div-->
      <!-- Caracteres faltanes -->
      <script>
        $(document).ready(function(){
          var total_letras=150;
          $('#text_cancelar').keyup(function(){
            var longitud=$(this).val().length;
            var resto=total_letras - longitud;
            $('#numero').html(resto);
          });
        });
      </script>
      <!-- Cancelar compra -->
      <script>
        $(document).on('click',"#cancelar",function(){
          var text=$("#text_cancelar").val();
          if(text==""){
            const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
            toast({type:'info',title:'¡Debes colocar un motivo!'})
          }else {
            var id_pedido=<?php echo $idPedido;?>;
            $.get('ajax_cancelar_compra.php',{id_pedido:id_pedido,text:text},v,'text');
            function v(r){
              $("#close_modal_cancelar").click();
              if(r==1){
                const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
                toast({type:'success',title:'¡La compra fue cancelada!'})
                $("#text_cancelar").prop('disabled', true);
                $("#pagar").prop('disabled', true);
                $("#cancelar_compra").prop('disabled', true);
              }else{
                const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
                toast({type:'error',title:'¡Hubo un pequeño problema! \n Inténtalo de nuevo'})
              }
            }
          }
        });
      </script>
    </div>
    <!-- Pago registrado -->
    <script>
      $(document).ready(function(){
        <?php
          if(isset($_GET['resp'])){
            $respuesta=$_GET['resp'];
            if($respuesta==0){
              ?>
              const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
              toast({type:'success',title:'¡Su pago fu registrado exitosamente!'})
              <?php
            }else if($respuesta==2){
              ?>
              const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
              toast({type:'error',title:'El pago no se registro \n Inténtalo de nuevo'})
            <?php } ?>
          <?php } ?>
      });
    </script>
  <?php include '../common/footer.php';?>
  <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../admin/assets/libs/popper.js/dist/popper.min.js"></script>
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@7.29.0/dist/sweetalert2.all.min.js'></script>
</body>
</html>
