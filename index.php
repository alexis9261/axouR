<?php
#Quitar el comentario para entrar en mantenimiento.
#header('Location: mantenimiento/');
session_start();
include 'common/conexion.php';
include 'cambioDolar/index.php';
include 'common/datosGenerales.php';
if(isset($_GET['reset'])){unset($_SESSION['carrito']);}
if(isset($_SESSION['USER'])){
  $user=$_SESSION['USER'];
  $sql="SELECT * FROM FAVORITOS WHERE USERID='$user'";
  $result=$conn->query($sql);
  $array_favoritos=array();
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      array_push($array_favoritos,$row['MODELOID']);
    }
  }
}
//array de categorias principales
$sql="SELECT * FROM CATEGORIAS WHERE `PADRE`=0";
$result=$conn->query($sql);
$id_categorias_padres=array();
$categorias_padres=array();
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    array_push($id_categorias_padres,$row['IDCATEGORIA']);
    array_push($categorias_padres,$row['NOMBRE']);
  }
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="desciption" content="Mavic es una nueva E-commerce Venezolana, creyente de la nueva era digital de venta por internet.">
  <meta name="keywords" content="Suminstros Mavic, Mavic, Mavic vzla">
  <meta name="author" content="Eutuxia, C.A.">
  <meta name="application-name" content="Suministros Mavic."/>
  <link rel="icon" type="image/jpg" sizes="16x16" href="admin/img/<?php echo $imageLogo;?>">
  <link rel="stylesheet" href="admin/assets/vendor/owlcarousel/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="admin/assets/vendor/owlcarousel/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/new.css">
  <link href="admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  <script src="admin/assets/libs/jquery/dist/jquery.min.js"></script>
  <!--script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script-->
  <script src="admin/assets/vendor/owlcarousel/owl.carousel.min.js"></script>
  <!--script>(adsbygoogle = window.adsbygoogle || []).push({google_ad_client: "ca-pub-8952175764108741",enable_page_level_ads: true});</script-->
  <title><?php echo $nombrePagina;?></title>
</head>
<body style="background-color:#f0f0f0;">
  <?php include 'common/menu.php'; include 'common/2domenu.php';?>
  <!--Corousel Library-->
  <div class="owl-carousel owl-theme" id="carousel">
    <?php
        $result=$conn->query("SELECT * FROM `IMAGENES` WHERE `TIPO`='1'");
        if($result->num_rows>0){
          while($rowImg=$result->fetch_assoc()){
            $imagenBanner=$rowImg['URLIMAGEN'];
            $enlace=$rowImg['ENLACE'];
            $target=$rowImg['TARGET'];
            if($enlace!=''){
              ?>
              <a href="<?php echo $enlace;?>" target="<?php echo $target;?>">
                <div class="imagenPpal"><img class="d-block d-sm-none" src="admin/img/<?php echo $imagenBanner;?>" alt=""><img class="img-fluid d-none d-sm-block" src="<?php echo "admin/img/$imagenBanner";?>" alt=""></div>
              </a>
            <?php }else{ ?>
              <div class="imagenPpal"><img class="d-block d-sm-none" src="admin/img/<?php echo $imagenBanner;?>" alt=""><img class="img-fluid d-none d-sm-block" src="<?php echo "admin/img/$imagenBanner";?>" alt=""></div>
            <?php } ?>
            <?php
          }
        }
    ?>
  </div>
  <script>
    $('#carousel').owlCarousel({
      loop:true,
      dots:true,
      mouseDrag: false,
      //movimiento del carousel
      autoplay:true,
      autoplayHoverPause:true,
      autoplayTimeout:4000,
      smartSpeed:1000,
      margin:0,
      responsive:{0:{items:1}}
    })
  </script>
  <!-- Otros Productos 1-->
  <?php if(isset($categorias_padres[0])){ ?>
  <div class="container mt-5">
      <?php
      $id_categoria=$id_categorias_padres[0];
      $sql="SELECT p.NOMBRE_P,p.CATEGORIAID,p.PRECIO,m.IDMODELO,m.IMAGEN FROM PRODUCTOS p INNER JOIN MODELOS m ON p.IDPRODUCTO=m.IDPRODUCTO WHERE p.CATEGORIAID='$id_categoria' AND p.ESTATUS=0 ORDER BY Rand() LIMIT 5";
      $result=$conn->query($sql);
      if($result->num_rows>0){
        ?>
        <h4 class="text-muted mb-2 lead">Todo lo relacionado con <strong><?php echo $categorias_padres[0];?></strong>.</h4>
        <div class="owl-carousel owl-theme py-1 my-2" id="productoCarousel">
        <?php
        while($row=$result->fetch_assoc()){
          $idmodelo=$row['IDMODELO'];
          $titulo=$row['NOMBRE_P'];
          $precio=$row['PRECIO'];
          $img=$row['IMAGEN'];
          ?>
            <div class="item border-product mb-5 mt-3 pb-2 modeloItem" style="position:relative;">
              <a href="vitrina/detalles.php?idmodelo=<?php echo $idmodelo;?>">
                <div class="container-img-product">
                  <img class="img-product" src="admin/inventario/img/<?php echo $img;?>" alt="<?php echo $titulo;?>">
                </div>
                <h5 class="pl-3 mb-0 pt-2 mt-2 precio-items">Bs. <?php echo number_format($precio*$dolar, 2, ',','.');?></h5>
                <small class='text-muted px-3 pb-2' style='background-color:#fff;min-width:100%;'><?php echo $titulo;?></small>
              </a>
              <?php if(isset($_SESSION['ACCESO_USER'])){ ?>
                <?php if(in_array($idmodelo,$array_favoritos)){$select="-select";$class="svg-heart-select";}else{$select="";$class="svg-heart";} ?>
                <span class="favorito-productos-imagen<?php echo $select;?>" id="<?php echo $idmodelo;?>">
                  <svg class="<?php echo $class;?>" width="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"/></svg>
                </span>
              <?php } ?>
            </div>
        <?php } } ?>
    </div>
  </div>
  <script>
    $('#productoCarousel').owlCarousel({
        loop:true,
        dots:false,
        mouseDrag: false,
        margin:15,
        responsive:{0:{items:1},450:{items:2},600:{items:3},1000:{items:5}}
    })
  </script>
  <?php } ?>
  <!-- Otros Productos 2 -->
  <?php if(isset($categorias_padres[1])){ ?>
          <div class="container">
          <?php
          $id_categoria=$id_categorias_padres[1];
          $sql="SELECT p.NOMBRE_P,p.CATEGORIAID,p.PRECIO,m.IDMODELO,m.IMAGEN FROM PRODUCTOS p INNER JOIN MODELOS m ON p.IDPRODUCTO=m.IDPRODUCTO WHERE p.CATEGORIAID='$id_categoria' AND p.ESTATUS=0 ORDER BY Rand() LIMIT 5";
          $result=$conn->query($sql);
          if($result->num_rows>0){
            ?>
            <h4 class="text-muted mb-2 lead">Todo lo relacionado con <strong><?php echo $categorias_padres[1];?></strong>.</h4>
            <div class="owl-carousel owl-theme px-2 py-1 my-2" id="productoCarousel2">
            <?php
            while($row=$result->fetch_assoc()){
              $idmodelo=$row['IDMODELO'];
              $titulo=$row['NOMBRE_P'];
              $precio=$row['PRECIO'];
              $img=$row['IMAGEN'];
            ?>
            <div class="item border-product mb-5 mt-3 pb-2 modeloItem" style="position:relative;">
              <a href="vitrina/detalles.php?idmodelo=<?php echo $idmodelo;?>">
                <div class="container-img-product">
                  <img class="img-product" src="admin/inventario/img/<?php echo $img;?>" alt="<?php echo $titulo;?>">
                </div>
                <h5 class="pl-3 mb-0 pt-2 mt-2 precio-items">Bs. <?php echo number_format($precio*$dolar, 2, ',','.');?></h5>
                <small class='text-muted px-3 pb-2' style='background-color:#fff;min-width:100%;'><?php echo $titulo;?></small>
              </a>
              <?php if(isset($_SESSION['ACCESO_USER'])){ ?>
                <?php if(in_array($idmodelo,$array_favoritos)){$select="-select";$class="svg-heart-select";}else{$select="";$class="svg-heart";} ?>
                <span class="favorito-productos-imagen<?php echo $select;?>" id="<?php echo $idmodelo;?>">
                  <svg class="<?php echo $class;?>" width="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"/></svg>
                </span>
              <?php } ?>
            </div>
        <?php } } ?>
          </div>
        </div>
  <script>
    $('#productoCarousel2').owlCarousel({
        loop:true,
        dots:false,
        mouseDrag: false,
        margin:15,
        responsive:{0:{items:1},450:{items:2},600:{items:3},1000:{items:5}}
    })
  </script>
  <?php } ?>
  <!-- Banner Medio-->
  <section class="principal2 container-fluid d-flex flex-column  justify-content-end pr-4 pb-3">
    <h6 class="display-4 lead text-light" style="font-family: 'Playfair Display', serif;"><span class="text-dark">¡Rouxa es familia!</span></h6>
    <p class="font-italic text-dark h5">Creemos firmemente que tu familia es lo más importante para ti.</p>
  </section>
  <!-- Otros Productos 3 -->
  <?php if(isset($categorias_padres[2])){ ?>
          <div class="container mt-5">
          <?php
          $id_categoria=$id_categorias_padres[2];
          $sql="SELECT p.NOMBRE_P,p.CATEGORIAID,p.PRECIO,m.IDMODELO,m.IMAGEN FROM PRODUCTOS p INNER JOIN MODELOS m ON p.IDPRODUCTO=m.IDPRODUCTO WHERE p.CATEGORIAID='$id_categoria' AND p.ESTATUS=0 ORDER BY Rand() LIMIT 5";
          $result=$conn->query($sql);
          if($result->num_rows>0){
            ?>
            <h4 class="text-muted mb-2 lead">Todo lo relacionado con <strong><?php echo $categorias_padres[2];?></strong>.</h4>
            <div class="owl-carousel owl-theme px-2 py-1 my-2" id="productoCarousel3">
            <?php
            while($row=$result->fetch_assoc()){
              $idmodelo=$row['IDMODELO'];
              $titulo=$row['NOMBRE_P'];
              $precio=$row['PRECIO'];
              $img=$row['IMAGEN'];
            ?>
            <div class="item border-product mb-5 mt-3 pb-2 modeloItem" style="position:relative;">
              <a href="vitrina/detalles.php?idmodelo=<?php echo $idmodelo;?>">
                <div class="container-img-product">
                  <img class="img-product" src="admin/inventario/img/<?php echo $img;?>" alt="<?php echo $titulo;?>">
                </div>
                <h5 class="pl-3 mb-0 pt-2 mt-2 precio-items">Bs. <?php echo number_format($precio*$dolar, 2, ',','.');?></h5>
                <small class='text-muted px-3 pb-2' style='background-color:#fff;min-width:100%;'><?php echo $titulo;?></small>
              </a>
              <?php if(isset($_SESSION['ACCESO_USER'])){ ?>
                <?php if(in_array($idmodelo,$array_favoritos)){$select="-select";$class="svg-heart-select";}else{$select="";$class="svg-heart";} ?>
                <span class="favorito-productos-imagen<?php echo $select;?>" id="<?php echo $idmodelo;?>">
                  <svg class="<?php echo $class;?>" width="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"/></svg>
                </span>
              <?php } ?>
            </div>
        <?php } } ?>
          </div>
        </div>
  <script>
    $('#productoCarousel3').owlCarousel({
        loop:true,
        dots:false,
        mouseDrag: false,
        margin:15,
        responsive:{0:{items:1},450:{items:2},600:{items:3},1000:{items:5}}
    })
  </script>
  <?php } ?>
  <div class="container">
    <div class="jumbotron bg-dark mb-0">
      <h1 class="display-5 text-muted">¡Disfruta de Nuestras Promociones!</h1>
      <hr class="my-4">
      <p class="lead text-white-50" style="font-family: 'Playfair Display', serif;">Enterate de todas las promociones a través de nuestras redes sociales. Envios gratis, precios al Mayor, Promociones Especiales y ¡Mucho más!</p>
      <a class="btn btn-outline-light btn-lg mt-3" href="https://www.instagram.com/rouxavzla/" role="button" target="_blank">Siguenos en Instagram</a>
    </div>
  </div>
  <!-- Otros Productos 4 -->
  <?php if(isset($categorias_padres[3])){ ?>
          <div class="container">
          <?php
          $id_categoria=$id_categorias_padres[3];
          $sql="SELECT p.NOMBRE_P,p.CATEGORIAID,p.PRECIO,m.IDMODELO,m.IMAGEN FROM PRODUCTOS p INNER JOIN MODELOS m ON p.IDPRODUCTO=m.IDPRODUCTO WHERE p.CATEGORIAID='$id_categoria' AND p.ESTATUS=0 ORDER BY Rand() LIMIT 5";
          $result=$conn->query($sql);
          if($result->num_rows>0){
            ?>
            <h4 class="text-muted mb-2 lead">Todo lo relacionado con <strong><?php echo $categorias_padres[3];?></strong>.</h4>
            <div class="owl-carousel owl-theme px-2 py-1 my-2" id="productoCarousel4">
            <?php
            while($row=$result->fetch_assoc()){
              $idmodelo=$row['IDMODELO'];
              $titulo=$row['NOMBRE_P'];
              $precio=$row['PRECIO'];
              $img=$row['IMAGEN'];
            ?>
            <div class="item border-product mb-5 mt-3 pb-2 modeloItem" style="position:relative;">
              <a href="vitrina/detalles.php?idmodelo=<?php echo $idmodelo;?>">
                <div class="container-img-product">
                  <img class="img-product" src="admin/inventario/img/<?php echo $img;?>" alt="<?php echo $titulo;?>">
                </div>
                <h5 class="pl-3 mb-0 pt-2 mt-2 precio-items">Bs. <?php echo number_format($precio*$dolar, 2, ',','.');?></h5>
                <small class='text-muted px-3 pb-2' style='background-color:#fff;min-width:100%;'><?php echo $titulo;?></small>
              </a>
              <?php if(isset($_SESSION['ACCESO_USER'])){ ?>
                <?php if(in_array($idmodelo,$array_favoritos)){$select="-select";$class="svg-heart-select";}else{$select="";$class="svg-heart";} ?>
                <span class="favorito-productos-imagen<?php echo $select;?>" id="<?php echo $idmodelo;?>">
                  <svg class="<?php echo $class;?>" width="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"/></svg>
                </span>
              <?php } ?>
            </div>
        <?php } } ?>
          </div>
        </div>
  <script>
    $('#productoCarousel4').owlCarousel({
        loop:true,
        dots:false,
        mouseDrag: false,
        margin:15,
        responsive:{0:{items:1},450:{items:2},600:{items:3},1000:{items:5}}
    })
  </script>
  <?php } ?>
  <!-- Otros Productos 5 -->
  <?php if(isset($categorias_padres[4])){ ?>
          <div class="container">
          <?php
          $id_categoria=$id_categorias_padres[4];
          $sql="SELECT p.NOMBRE_P,p.CATEGORIAID,p.PRECIO,m.IDMODELO,m.IMAGEN FROM PRODUCTOS p INNER JOIN MODELOS m ON p.IDPRODUCTO=m.IDPRODUCTO WHERE p.CATEGORIAID='$id_categoria' AND p.ESTATUS=0 ORDER BY Rand() LIMIT 5";
          $result=$conn->query($sql);
          if($result->num_rows>0){
            ?>
            <h4 class="text-muted mb-2 lead">Todo lo relacionado con <strong><?php echo $categorias_padres[4];?></strong>.</h4>
            <div class="owl-carousel owl-theme px-2 py-1 my-2" id="productoCarousel6">
            <?php
            while($row=$result->fetch_assoc()){
              $idmodelo=$row['IDMODELO'];
              $titulo=$row['NOMBRE_P'];
              $precio=$row['PRECIO'];
              $img=$row['IMAGEN'];
            ?>
            <div class="item border-product mb-5 mt-3 pb-2 modeloItem" style="position:relative;">
              <a href="vitrina/detalles.php?idmodelo=<?php echo $idmodelo;?>">
                <div class="container-img-product">
                  <img class="img-product" src="admin/inventario/img/<?php echo $img;?>" alt="<?php echo $titulo;?>">
                </div>
                <h5 class="pl-3 mb-0 pt-2 mt-2 precio-items">Bs. <?php echo number_format($precio*$dolar, 2, ',','.');?></h5>
                <small class='text-muted px-3 pb-2' style='background-color:#fff;min-width:100%;'><?php echo $titulo;?></small>
              </a>
              <?php if(isset($_SESSION['ACCESO_USER'])){ ?>
                <?php if(in_array($idmodelo,$array_favoritos)){$select="-select";$class="svg-heart-select";}else{$select="";$class="svg-heart";} ?>
                <span class="favorito-productos-imagen<?php echo $select;?>" id="<?php echo $idmodelo;?>">
                  <svg class="<?php echo $class;?>" width="30px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z"/></svg>
                </span>
              <?php } ?>
            </div>
        <?php } } ?>
          </div>
        </div>
  <script>
    $('#productoCarousel6').owlCarousel({
        loop:true,
        dots:false,
        mouseDrag: false,
        margin:15,
        responsive:{0:{items:1},450:{items:2},600:{items:3},1000:{items:5}}
    })
  </script>
  <?php } ?>
  <!-- Productos varios -->
  <?php if(count($categorias_padres)>1){ ?>
      <?php
      $sql="SELECT * FROM modelos m INNER JOIN productos p ON m.IDPRODUCTO=p.IDPRODUCTO WHERE p.ESTATUS=0 ORDER BY Rand() LIMIT 8";
      $result=$conn->query($sql);
      if($result->num_rows>0){
        ?>
        <div class="container">
          <h4 class="text-muted my-4 lead">Tambien te puede interesar.</h4>
          <div class="owl-carousel owl-theme px-2" id="productoCarousel5">
        <?php while($row=$result->fetch_assoc()){
          $imagen=$row['IMAGEN'];
          $idmodelo=$row['IDMODELO'];
           ?>
          <div class="item border-product mb-5">
            <a href="vitrina/detalles.php?idmodelo=<?php echo $idmodelo;?>">
              <div class="container-img-product-endpage">
                <img class="img-product-endpage" src="admin/inventario/img/<?php echo $imagen;?>" alt="<?php echo $imagen;?>"/>
              </div>
            </a>
          </div>
        <?php } ?>
        </div>
      </div>
        <?php } ?>
  <script>
    $('#productoCarousel5').owlCarousel({
      loop:true,
      dots:false,
      mouseDrag: false,
      margin:15,
      responsive:{0:{items:2},450:{items:3},600:{items:5},1000:{items:8}}
    })
  </script>
  <?php } ?>
  <!-- Maps -->
  <!--div id="mapa_tienda">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15708.03522624633!2d-68.005718!3d10.179939!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x1d47af71967d9a49!2sSuministros+Mavic%2C+C.A!5e0!3m2!1ses!2sve!4v1562178603833!5m2!1ses!2sve" width="100%" height="400px" frameborder="0" style="border:0" allowfullscreen></iframe>
  </div-->
  <script>
    $(document).on('click',"span.favorito-productos-imagen",function(){
      var aux=$(this);
      var id=aux.attr("id");
      $.get('vitrina/ajax_favoritos.php',{id:id,e:1},v,'text');
      function v(r){
        aux.removeClass();
        aux.children("svg").removeClass();
        aux.addClass("favorito-productos-imagen-select");
        aux.children("svg").addClass("svg-heart-select");
      }
    });
    $(document).on('click',"span.favorito-productos-imagen-select",function(){
      var aux=$(this);
      var id=aux.attr("id");
      $.get('vitrina/ajax_favoritos.php',{id:id,e:2},v,'text');
      function v(r){
        aux.removeClass();
        aux.children("svg").removeClass();
        aux.addClass("favorito-productos-imagen");
        aux.children("svg").addClass("svg-heart");
      }
    });
  </script>
  <script>
    window.onload=function(){
      $(".modeloItem").hover(function(e){
        $(this).find(".cantidad-productos-imagen").fadeIn(100);
        $(this).find(".favorito-productos-imagen").fadeIn(100);
      },function(e){
        $(this).find(".cantidad-productos-imagen").fadeOut(50);
        $(this).find(".favorito-productos-imagen").fadeOut(50);
      });
    };
  </script>
  <?php include 'common/footer.php';?>
  <script src="admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
  <script src="admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--script async src="https://www.googletagmanager.com/gtag/js?id=UA-119925583-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'UA-119925583-1');
  </script-->
</body>
</html>
