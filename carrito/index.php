<?php
session_start();
include '../common/conexion.php';
include '../cambioDolar/index.php';
include '../common/datosGenerales.php';
if(isset($_SESSION['carrito'])){
  $arreglo=$_SESSION['carrito'];
  if(isset($_POST["id"],$_POST["cantidad"],$_POST["talla"])){
    $cantidad=$_POST['cantidad'];
    $idmodelo=$_POST["id"];
    $tallaEinventario=explode("|",$_POST["talla"]);
    $talla=$tallaEinventario[0];
    $idInventario=$tallaEinventario[1];
    $sql="SELECT * FROM TALLAS WHERE IDTALLA=$talla LIMIT 1";
    $res=$conn->query($sql);
    if($res->num_rows>0){while($f=$res->fetch_assoc()){$talla=$f["TALLA"];}}
    #consulta si el articulo se repite.
    $encontro=false;
    $i=0;
    foreach($arreglo as $a){
      if($a['Id']==$idInventario){
        $catch=$i;
        $encontro=true;
        $nombre=$a['Nombre'];
        $precio=$a['Precio'];
        $imagen=$a['Imagen'];
        $genero=$a['Genero'];
        $categoria=$a['Categoria'];
        $color1=$a['Color1'];
        $color2=$a['Color2'];
        if($a['Talla']==$talla){$cantidad=$cantidad+$a['Cantidad'];}
      }
      $i++;
    }
    if(isset($catch)){
      unset($arreglo[$catch]);
      $arreglo=array_values($arreglo);
      $_SESSION['carrito']=$arreglo;
    }
    if($encontro==true){
      $newarreglo=array('Id'=>$idInventario,'Nombre'=>$nombre,'Precio'=>$precio,'Genero'=>$genero,'Categoria'=>$categoria,'Imagen'=>$imagen,'Cantidad'=>$cantidad,'Talla'=>$talla,'Color1'=>$color1,'Color2'=>$color2);
      array_push($arreglo,$newarreglo);
      $_SESSION['carrito']=$arreglo;
    }else{
      $sql="SELECT * FROM MODELOS WHERE IDMODELO=$idmodelo LIMIT 1";
      $res=$conn->query($sql);
      if($res->num_rows>0){
        while($f=$res->fetch_assoc()){
          $id_producto=$f["IDPRODUCTO"];
          $color1=$f["COLOR1"];
          $color2=$f["COLOR2"];
          $imagen=$f["IMAGEN"];
        }
      }
      $sql="SELECT * FROM PRODUCTOS WHERE IDPRODUCTO=$id_producto LIMIT 1";
      $res=$conn->query($sql);
      if($res->num_rows>0){
        while($f=$res->fetch_assoc()){
          $nombre=$f["NOMBRE_P"];
          $precio=$f["PRECIO"];
          $genero=$f["GENERO"];
          $categoria=$f["CATEGORIAID"];
        }
      }
      $newarreglo=array('Id'=>$idInventario,'IdModelo'=>$idmodelo,'Nombre'=>$nombre,'Precio'=>$precio,'Genero'=>$genero,'Categoria'=>$categoria,'Imagen'=>$imagen,'Cantidad'=>$cantidad,'Talla'=>$talla,'Color1'=>$color1,'Color2'=>$color2);
      array_push($arreglo,$newarreglo);
      $_SESSION['carrito']=$arreglo;
    }
  }
}else{
  if(isset($_POST["id"],$_POST["cantidad"],$_POST["talla"])){
    $idmodelo=$_POST["id"];
    $cantidad=$_POST["cantidad"];
    $tallaEinventario=explode("|",$_POST["talla"]);
    $talla=$tallaEinventario[0];
    $idInventario=$tallaEinventario[1];
    $sql="SELECT * FROM TALLAS WHERE IDTALLA=$talla LIMIT 1";
    $res=$conn->query($sql);
    if($res->num_rows>0){while($f=$res->fetch_assoc()){$talla=$f["TALLA"];}}
    $sql="SELECT * FROM MODELOS WHERE IDMODELO=$idmodelo LIMIT 1";
    $res=$conn->query($sql);
    if($res->num_rows>0){
      while($f=$res->fetch_assoc()){
        $id_producto=$f["IDPRODUCTO"];
        $color1=$f["COLOR1"];
        $color2=$f["COLOR2"];
        $imagen=$f["IMAGEN"];
      }
    }
    $sql="SELECT * FROM PRODUCTOS WHERE IDPRODUCTO=$id_producto LIMIT 1";
    $res=$conn->query($sql);
    if($res->num_rows>0){
      while($f=$res->fetch_assoc()){
        $nombre=$f["NOMBRE_P"];
        $precio=$f["PRECIO"];
        $genero=$f["GENERO"];
        $categoria=$f["CATEGORIAID"];
      }
    }
    $arreglo[]=array('Id'=>$idInventario,'IdModelo'=>$idmodelo,'Nombre'=>$nombre,'Precio'=>$precio,'Genero'=>$genero,'Categoria'=>$categoria,'Imagen'=>$imagen,'Cantidad'=>$cantidad,'Talla'=>$talla,'Color1'=>$color1,'Color2'=>$color2);
    $_SESSION['carrito']=$arreglo;
  }
}
if(isset($_GET['delete']) and !empty($_GET['delete'])){
  $iddelete=$_GET['delete'];
  $i=0;
  foreach($arreglo as $a){
    if(($a['Id']==$iddelete)){$catch=$i;}
    $i++;
  }
  if(isset($catch)){
    unset($arreglo[$catch]);
    $arreglo= array_values($arreglo);
    $_SESSION['carrito']=$arreglo;
  }
  if(count($_SESSION['carrito'])==0){session_destroy();}
  header('Location: index.php');
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
  <title><?php echo $nombrePagina;?> - Carrito de Compras</title>
</head>
<body>
  <?php
  include '../common/menu.php';
  include '../common/2domenu.php';
  if(isset($_SESSION['carrito']) and count($_SESSION['carrito'])>0){ ?>
    <div class="container mt-3">
      <div class="row">
        <div class="col-12 breadcrumb text-muted">
          Completa todas tus compras en nuestra plataforma y disfruta de nuestros descuentos.
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-7 mt-2">
          <div class="row justify-content-between bg-light py-2 mb-3">
            <div class="col-auto"><h5 id="title"></h5></div>
            <div class="col-auto"><a href="../vitrina/index.php">Seguir Comprando</a></div>
          </div>
    <?php
    $datos=$_SESSION['carrito'];
    $monto=0;
    $peso=0;
    $cantidad_total=0;
    $i=0;
    foreach($datos as $d){
      $i++;
      $cantidad=$d['Cantidad'];
      $cantidad_total+=$cantidad;
      $id_inventario=$d['Id'];
      $id_modelo=$d['IdModelo'];
      $titulo=$d['Nombre'];
      $imagen=$d['Imagen'];
      $talla=$d['Talla'];
      $precio=$d['Precio'];
      $total_modelo=$cantidad*$precio;
      $monto+=$total_modelo;
      $sql="SELECT * FROM TALLAS WHERE TALLA='$talla' LIMIT 1";
      $res=$conn->query($sql);
      if($res->num_rows>0){while($f=$res->fetch_assoc()){$id_talla=$f["IDTALLA"];}}
      ?>
      <div class="row">
        <div class="col-3 text-center">
          <img class="img-fluid" src="../admin/inventario/img/<?php echo $imagen;?>" width="110px" height="110px">
        </div>
        <div class="col-9 my-2">
          <div class="row">
            <small><a class="enlace2" href="<?php echo $root_folder;?>/vitrina/detalles.php?idmodelo=<?php echo $id_modelo;?>" target="_blank"><?php echo $titulo;?></a></small>
            <span class="ml-auto pr-4">Bs. <?php echo number_format($total_modelo*$dolar,2,',','.');?> </span>
          </div>
          <div class="row">
            <small>TALLA: <span class="text-muted"><?php echo " ".$talla;?></span></small>
          </div>
          <div class="row">
            <small>CANTIDAD: <span class="text-muted"><?php echo " ".$cantidad;?></span></small>
          </div>
          <div class="row mt-4">
            <!--button type="button" class="enlace2 mr-4" href="javascript:void(0)" data-toggle="modal" data-target="#edit<?php echo $i;?>">Editar</button-->
            <button type="button" class="enlace2" href="javascript:void(0)" data-toggle="modal" data-target="#del<?php echo $i;?>">Eliminar</button>
          </div>
        </div>
      </div>
      <!-- modal Eliminar-->
      <div class="modal" id="del<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="closeSesionLabel">Eliminar Producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ¿Seguro que desea eliminar este articulo(s) del carrito?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancelar</button>
              <a href="index.php?delete=<?php echo $d['Id'];?>" class="btn btn-outline-danger">Eliminar</a>
            </div>
          </div>
        </div>
      </div>
      <!-- modal Editar -->
      <!--div class="modal fade bd-example-modal-lg" id="edit<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="closeSesionLabel">Editar Producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-7 text-center">
                    <img class="img-fluid" src="../admin/inventario/img/<?php echo $imagen; ?>" width="300px" height="300px">
                  </div>
                  <div class="col-4">
                    <div class="container-fluid">
                      <div class="row">
                        <div class="col-12">
                          <p class="text-muted">Categoria</p>
                          <h5><b><?php echo $titulo;?></b></h5>
                        </div>
                        <div class="col-12 mb-2">
                          <h3 class="lead">Bs. <?=number_format($d['Precio']*$dolar,2,',','.')?></h3>
                        </div>
                      </div>
                      <form action="" method="POST" onsubmit="return validacion()">
                        <div class="row">
                          <div class="col-12 mt-2">
                            Cantidad <br class="mb-2">
                            <?php
                            $sql="SELECT * FROM INVENTARIO WHERE IDMODELO=$id_modelo AND TALLAID=$id_talla";
                            $res=$conn->query($sql);
                            if($res->num_rows>0){while($row=$res->fetch_assoc()){$maxima=$row['CANTIDAD'];}}
                            ?>
                            <input type="number" max="<?=$maxima?>" min="1" maxlength="4" value="<?php echo $d['Cantidad']; ?>" name="cantidad" id="cant" width="50px" required/>
                          </div>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id_modelo;?>">
                        <div class="row mt-3">
                          <div class="col-12">
                            <button class="btn btn-outline-dark" type="submit">Actualizar artículo</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div-->
      <hr>
      <?php }
      $_SESSION['monto']=$monto;
      $_SESSION['total_items']=$cantidad_total;
       ?>
    <div class="text-secondary text-center">
      <form action="../index.php">
        <input type="hidden" name="reset">
        <input class="enlace2" type="submit" value="Vaciar carrito">
      </form>
    </div>
  </div>
  <div class="col-md-4 mt-2">
    <div class="container" style="border:1px solid #dadada;border-radius:5px;">
      <div class="row my-3 py-3 pl-2">
        <h5 class="text-dark">Resumen</h5>
      </div>
      <hr class="hr">
      <div class="row text-dark my-2 justify-content-between">
        <p class="col-6"><b>Total:</b></p>
        <p class="col-auto"><b><?php echo number_format($monto*$dolar,2,',','.');?> Bs.S</b></p>
      </div>
      <div class="row justify-content-center">
        <a class="btn btn-link btn-lg" href="datos_compra.php">Comprar</a>
      </div>
    </div>
  </div>
</div>
</div>
  <?php }else{ ?>
    <div class="container mt-3">
      <div class="row">
        <div class="col-12 breadcrumb text-muted">
          Completa todas tus compras en nuestra plataforma y disfruta de nuestros descuentos.
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-7 mt-2">
          <div class="breadcrumb text-muted">
            No tienes productos en el carrrito.
          </div>
          <div class="text-secondary text-center">
            <p><small></small></p>
          </div>
          <hr>
        </div>
        <div class="col-md-4 ">
          <div class="container" style="border: 1px solid #dadada;border-radius:5px;">
            <div class="row my-3 py-3 pl-2">
              <h5 class="text-dark">Resumen</h5>
            </div>
            <hr class="hr">
            <div class="row text-dark my-2 justify-content-between">
              <p class="col-6"><b>Total:</b></p>
              <p class="col-auto"><b>0.0 Bs.S</b></p>
            </div>
            <div class="row justify-content-center">
              <form action="datos_compra.php">
                <input class="btn btn-link btn-lg" type="submit" value="Comprar">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-center my-5">
      <a class="btn btn-outline-dark" href="../index.php">Seguir comprando</a>
    </div>
  <?php } ?>
  <!-- Otros Productos -->
  <hr>
  <div class="container mt-5">
    <div class="row mt-4">
      <h4 style="font-size:30px;font-weight:500;">Tambien te puede interesar.</h4>
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
  <?php include '../common/footer.php';?>
  <script type="text/javascript">
    var cantidad = <?php echo $cantidad_total; ?>;
    document.getElementById("title").innerHTML = "Tu Carrito ("+cantidad+")";
  </script>
  <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
