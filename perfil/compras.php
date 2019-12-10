<?php
session_start();
include '../common/conexion.php';
include '../cambioDolar/index.php';
include '../common/datosGenerales.php';
$array_meses=array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
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
  <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <title><?php echo $nombrePagina;?></title>
</head>
<body>
  <?php
  include '../common/menu.php';
  include '../common/2domenu.php';
  ?>
  <div class="container mb-5">
    <div class="row bg-light py-3 px-3" style="border-radius:5px;">
      <h3 class="lead"><strong>Mis Compras</strong></h3>
    </div>
    <div class="container mt-4 mb-2">
      <?php
      $sql="SELECT * FROM `pedidos` WHERE EMAILUSER='$correo' ORDER BY FECHAPEDIDO DESC";
      $result=$conn->query($sql);
      if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
          $band=0;//bandera para colocar una imagen
          $idPedido=$row['IDPEDIDO'];
          $estatusPedido=$row['ESTATUS'];
          $fechaPedido=$row['FECHAPEDIDO'];
          $stingDate=substr($fechaPedido,8,2)." de ".$array_meses[intval(substr($fechaPedido,5,2))]." del ".substr($fechaPedido,0,4);
          ?>
          <div class="row mt-4">
            <div class="col-9">
              <h3 class="lead"><strong>Compra realizada el <?php echo $stingDate;?>
                <?php if ($estatusPedido==8){ ?>
                  - <span class="text-danger"> Compra Cancelada</span>
                <?php } ?>
              </strong></h3>
            </div>
            <div class="col-3 ml-auto">
              <div class="row justify-content-end">
                <a href="detalles.php?id=<?php echo $idPedido;?>">Ver Detalles de la compra</a>
              </div>
            </div>
          <?php
          $sql2="SELECT i.INVENTARIOID,i.CANTIDAD,t.IDMODELO,t.TALLAID FROM `items` i INNER JOIN `inventario` t ON i.INVENTARIOID=t.IDINVENTARIO WHERE i.PEDIDOID='$idPedido'";
          $result2=$conn->query($sql2);
          if($result2->num_rows>0){
            while($row2=$result2->fetch_assoc()){
              $inventarioId=$row2['INVENTARIOID'];
              $cantidad=$row2['CANTIDAD'];
              $idModelo=$row2['IDMODELO'];
              $tallaId=$row2['TALLAID'];
              $talla=$nombre_tallas[array_search($tallaId,$id_tallas_bd)];
              $sql3="SELECT p.NOMBRE_P,m.IMAGEN FROM `productos` p INNER JOIN `modelos` m ON p.IDPRODUCTO=m.IDPRODUCTO WHERE m.IDMODELO='$idModelo' LIMIT 1";
              $result3=$conn->query($sql3);
              if($result3->num_rows>0){
                while($row3=$result3->fetch_assoc()){
                  $titulo=$row3['NOMBRE_P'];
                  $imagen=$row3['IMAGEN'];
                }
              }
              if($band==0){
                $band=1;
                ?>
                <div class="col-2 text-center">
                  <img src="../admin/inventario/img/<?php echo $imagen;?>" alt="<?php echo $titulo;?>" width="100vw">
                </div>
                <div class="col-8">
              <?php } ?>
                <div class="row">
                  <span>(<?php echo $cantidad.$talla;?>) <a href="../vitrina/detalles.php?idmodelo=<?php echo $idModelo?>"><?php echo $titulo;?></a></span>
                </div>
              <?php
            }
          }
          $sql4="SELECT * FROM `compras` WHERE PEDIDOID='$idPedido' LIMIT 1";
          $result4=$conn->query($sql4);
          if($result4->num_rows>0){
            while($row4=$result4->fetch_assoc()){
              $montoPedido=$row4['MONTO'];
            }
          }
          ?>
        </div>
        <div class="col-2 ml-auto">
          <div class="row justify-content-end">
            <?php echo number_format($montoPedido,2,',','.');?> Bs
          </div>
          <?php
          $sql4="SELECT * FROM `pagos` WHERE IDPEDIDO='$idPedido'";
          $result4=$conn->query($sql4);
          if($result4->num_rows>0){
            while($row4=$result4->fetch_assoc()){
              $pago=$row4['MONTO'];
              $moneda=$row4['MONEDA'];
              $estatusPago=$row4['ESTATUS'];
              if($estatusPago==0){
                $colorPago="primary";
                $title_pago="Pago esperando a ser confirmado";
              }elseif($estatusPago==1){
                $colorPago="success";
                $title_pago="Pago Confirmado";
              }else{
                $colorPago="danger";
                $title_pago="Pago no confirmado";
              }
              ?>
              <div class="row text-<?php echo $colorPago;?> justify-content-end" title="<?php echo $title_pago;?>" data-toggle="tooltip">
                <?php echo number_format($pago,2,',','.')." $moneda";?>
              </div>
              <?php
            }
          }
           ?>
        </div>
      </div>
          <?php
        }
      }else{
        ?>
        <div class="breadcrumb mb-5">
          No tienes compras registradas.
        </div>
        <!-- Otros Productos -->
        <hr>
        <div class="container mt-5">
          <div class="row mt-4">
            <h4 style="font-size:30px;font-weight:500;">¡Realiza una compra con nosotros!</h4>
          </div>
          <div class="row">
            <?php
            $rand=rand();
            $sql="SELECT p.NOMBRE_P,p.PRECIO,m.IDMODELO,m.IMAGEN FROM PRODUCTOS p INNER JOIN MODELOS m ON p.IDPRODUCTO=m.IDPRODUCTO ORDER BY Rand($rand) LIMIT 6";
            $result=$conn->query($sql);
            $cant_products=$result->num_rows;
            if($cant_products>0){
              ?>
              <article class="container my-3">
                <div class="row">
                  <?php while($row=$result->fetch_assoc()){
                    $idmodelo_seg=$row['IDMODELO'];
                    $titulo_seg=$row['NOMBRE_P'];
                    $imagen_seg=$row['IMAGEN'];
                    $precio=$row['PRECIO'];
                    ?>
                    <div class="col-sm-4 col-md-3 col-lg-2 container-product">
                      <div class="container-img-product-secundarias">
                        <a href="../vitrina/detalles.php?idmodelo=<?php echo $idmodelo_seg;?>"><img class="img-product-secundarias" src="../admin/inventario/img/<?php echo $imagen_seg;?>" alt="<?php echo $titulo_seg;?>"></a>
                      </div>
                      <div class="pb-3" style="background-color:#ffffff;">
                        <a href="../vitrina/detalles.php?idmodelo=<?php echo $idmodelo_seg;?>"><div class="title-product px-2" title="<?php echo $titulo_seg;?>"><?php echo $titulo_seg;?></div></a>
                        <div class="px-2 mt-2 precio-items-secundarios"><!--$ <?php echo number_format($precio,2, ',', '.');?> <br-->
                          Bs. <?php echo number_format($precio*$dolar,2, ',', '.');?></div>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                </article>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
    </div>
  </div>
  <?php include '../common/footer.php';?>
  <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
