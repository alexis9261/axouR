<?php
//incluir la conexion a la Base de datos
require '../common/conexion.php';
//datos generales de la pagina, titulo, icon, etc..
include '../common/datosGenerales.php';
 ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Blog</title>
    <!-- Bootstrp css and Jquery --->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container">
      <h1>Blog</h1>
      <p>Este es un blog generico para publicar articulos realcionados a algun tema en especifico.</p>

<main role="main" class="container">
  <div class="row">
    <div class="col-md-8 blog-main">
      <h3 class="pb-4 mb-4 font-italic border-bottom">
        Blog
      </h3>
      <?php
      if(isset($_GET['id']) && !empty($_GET['id'])){
        $id_articulo=$_GET['id'];
        $sql="SELECT * FROM ARTICLESBLOG WHERE IDARTICULO=$id_articulo";
        $result=$conn->query($sql);
        if($result->num_rows>0){
          while($row=$result->fetch_assoc()){
            $id_articulo=$row['IDARTICULO'];
            $titulo=ucwords($row['TITLE']);
            $descripcion=ucwords($row['DESCRIPTION']);
            $contenido=ucwords($row['CONTENT']);
            $fecha=$row['DATE'];
            $imagen=$row['IMAGE'];
            $autor=$row['AUTOR'];
            $keywords=$row['KEYWORDS'];
            ?>
            <h2 class="blog-post-title"><?php echo $titulo;?></h2>
            <p class="blog-post-meta"><?php echo $fecha;?> by <a href="#"><?php echo $autor;?></a></p>
            <img src="admin/img/<?php echo $imagen;?>" width="150px">
            <p><?php echo $descripcion;?></p>
            <hr>
            <p><?php echo nl2br($contenido);?></p>
            <hr>
            <?php
          }
        }
      }
      ?>

    </div><!-- /.blog-main -->


  </div><!-- /.row -->
</main><!-- /.container -->
<footer class="blog-footer">

  <p>
    <a href="#">Back to top</a>
  </p>
</footer>
<!-- Bootstrp js and sweetalert2 --->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@7.29.0/dist/sweetalert2.all.min.js'></script>
</body>
</html>
