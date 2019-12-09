<?php
session_start();
include '../common/conexion.php';
include '../cambioDolar/index.php';
include '../common/datosGenerales.php';
$array_meses=array('','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
if(isset($_GET['id'])){$idPedido=$_GET['id'];}
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
//Monto Total
$sql="SELECT * FROM `compras` WHERE PEDIDOID='$idPedido' LIMIT 1";
$result=$conn->query($sql);
if($result->num_rows>0){while($row=$result->fetch_assoc()){$montoPedido=$row['MONTO'];}}
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
  <?php include '../common/menu.php';include '../common/2domenu.php'; ?>
  <div class="container mb-5">
    <div class="row bg-light py-3 px-3" style="border-radius:5px;">
      <h3 class="lead"><strong>Detalles de la compra realizada el <?php echo $stingDate;?></strong></h3>
      <span class="col-auto ml-auto"><a href="compras.php">Compras</a> - Detalles</span>
    </div>
    <div class="container mt-4 mb-2">
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
              //$sql3="SELECT p.NOMBRE_P,p.GENERO,p.CATEGORIAID,p.PRECIO,m.IMAGEN FROM `productos` p INNER JOIN `modelos` m ON p.IDPRODUCTO=m.IDPRODUCTO WHERE m.IDMODELO='$idModelo' LIMIT 1";
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
                <div class="row mt-4">
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
            <div class="row justify-content-end mt-2">
              <button class="btn btn-primary btn-sm px-5" type="button">Registrar pago</button>
            </div>
            <div class="row justify-content-end mt-2">
              <button class="btn btn-danger btn-sm px-5" type="button" name="button">Cancelar compra</button>
            </div>
          </div>
        </div>
      </div>
        <!--div class="breadcrumb mb-5">
          Mira tus compras  &nbsp; <a href="compras.php"> aqui</a>.
        </div-->
    </div>
  <?php include '../common/footer.php';?>
  <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
