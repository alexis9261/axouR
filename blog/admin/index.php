<?php
//incluir la sesion
include '../../admin/common/sesion.php';
//incluir la conexion a la Base de datos
require '../../common/conexion.php';
//datos generales de la pagina, titulo, icon, etc..
include '../../common/datosGenerales.php';
#edicion de articulo
if(isset($_GET['e'])){$edicion=$_GET['e'];}
#eliminar blog
if(isset($_GET['delete']) & !empty($_GET['delete'])){
  $id_articulo=$_GET['delete'];
  #consigue direcion de imagen de producto
  $sql="SELECT IMAGE FROM ARTICLESBLOG WHERE IDARTICULO='$id_articulo' LIMIT 1";
  $result=$conn->query($sql);
  if($result->num_rows>0){while($row=$result->fetch_assoc()){$imagen=$row['IMAGE'];unlink('img/'.$imagen);}}
  #eliminar producto
  $sql="DELETE FROM ARTICLESBLOG WHERE IDARTICULO='$id_articulo'";
  if($conn->query($sql)===TRUE){$respuesta=1;}else{$respuesta=0;}
}
#paginacion
$perpage=25;
if(isset($_GET['page']) & !empty($_GET['page'])){$curpage=$_GET['page'];}else{$curpage=1;}
$start=($curpage*$perpage) - $perpage;
#necesito el total de elementos
$PageSql="SELECT * FROM ARTICLESBLOG";
$pageres=mysqli_query($conn,$PageSql);
$totalres=mysqli_num_rows($pageres);
$endpage=ceil($totalres/$perpage);
$startpage=1;
$nextpage=$curpage + 1;
$previouspage=$curpage - 1;
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Administración">
  <meta name="author" content="Eutuxia, C.A.">
  <title>Blog - Administración</title>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!-- Bootstrp css and Jquery --->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
</head>
<body>
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <div class="page-wrapper">
          <div class="page-breadcrumb">
            <div class="row">
              <div class="col-auto align-self-center">
                <h4 class="page-title">Blog - Añadir/Eliminar Articulos</h4>
              </div>
            </div>
          </div>
            <div class="container-fluid">
              <form action="addArticle.php" method="POST" enctype="multipart/form-data">
                <div class="row mt-1">
                  <div class="input-group mb-3 col-12">
                    <div class="input-group-append">
                      <span class="input-group-text"><b>Titulo del articulo</b></span>
                    </div>
                    <input type="text" name="title" class="form-control text-secondary" required maxlength="255">
                  </div>
                  <div class="input-group mb-3 col-12">
                    <div class="input-group-append">
                      <span class="input-group-text"><b>Autor</b></span>
                    </div>
                    <input type="text" name="autor" class="form-control text-secondary" required maxlength="255">
                  </div>
                  <div class="input-group mb-3 col-12">
                    <div class="input-group-append">
                      <span class="input-group-text" title="Descripcion Corta" data-toggle="tooltip"><b>Descripcion del articulo</b></span>
                    </div>
                    <input type="text" name="description" class="form-control text-secondary" required maxlength="255">
                  </div>
                  <div class="input-group mb-3 col-12">
                    <div class="input-group-append">
                      <span class="input-group-text" title="Serviran para el posicionamiento(SEO), deberan estar separadas por comas(,)" data-toggle="tooltip"><b>Palabras Clave</b></span>
                    </div>
                    <input type="text" name="keywords" class="form-control text-secondary" required maxlength="255" placeholder="Ej. casas, apartamentos, casa en alquiler">
                  </div>
                  <span class="ml-3 mb-2"><b>Contenido</b></span>
                  <div class="input-group mb-3 col-12">
                    <textarea class="form-control" name="content" rows="7" type="text" required></textarea>
                  </div>
                  <div class="col-12">
                    <input class="form-group" name="imagen" type="file" required>
                  </div>
                </div>
                <div class="row justify-content-center mb-3">
                  <button type="submit" class="btn btn-outline-primary">Agregar</button>
                </div>
              </form>
                <div class="row mt-1">
                  <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Blogs en la pagina</h4>
                    </div>
                    <?php
                    $sql="SELECT * FROM ARTICLESBLOG LIMIT $start,$perpage";
                    $result=$conn->query($sql);
                    if($result->num_rows>0){
                      ?>
                      <div class="container">
                            <?php
                                $x=1;
                                while($row=$result->fetch_assoc()){
                                  $id_articulo=$row['IDARTICULO'];
                                   ?>
                                   <div class="row align-items-center">
                                     <strong class="col-1"><?php echo $x;?></strong>
                                     <div class="col-1 "><img src="img/<?php echo $row['IMAGE'];?>" width="35px"></div>
                                     <div class="col-9">
                                       <div class="row">
                                         <div class="col-9 text-dark">
                                           <a href="../article.php?id=<?php echo $id_articulo;?>" target="_blank">
                                             <?php echo ucwords($row['TITLE']);?>
                                           </a>
                                         </div>
                                         <div class="col-3 ml-auto">
                                           <small><?php echo $row['DATE'];?></small>
                                         </div>
                                       </div>
                                       <div class="row ml-1">
                                         <small><?php echo ucwords($row['AUTOR']);?></small>
                                       </div>
                                     </div>
                                     <div class="col-1">
                                       <a href="edit.php?id=<?php echo $id_articulo;?>" class="btn btn-outline-success btn-sm">Editar</a>
                                         <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#eli<?php echo $id_articulo;?>">Eliminar</a>
                                     </div>
                                   </div>
                                   <hr>
                                   <!-- Modal Eliminar -->
                                  <div class="modal fade" id="eli<?php echo $id_articulo;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title">¿Desea eliminar el articulo?</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="container">
                                            <div class="row">
                                              <div class="col-2">
                                                <img src="img/<?php echo $row['IMAGE'];?>" width="20px">
                                              </div>
                                              <div class="col-12"><?php echo $row['TITLE'];?></div>
                                              <div class="col-12"><?php echo ucwords($row['DESCRIPTION']);?></div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                          <a href="index.php?delete=<?php echo $id_articulo;?>" class="btn btn-primary">Eliminar</a>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <?php
                                  ++$x;
                                } ?>
                      <center>
                        <nav aria-label="Page navigation example">
                          <ul class="pagination justify-content-center">
                            <?php if($curpage!=$startpage){ ?>
                              <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $startpage;?>" tabindex="-1" aria-label="Previous">
                                  <span aria-hidden="true">&laquo;</span>
                                  <span class="sr-only">firts</span>
                                </a>
                              </li>
                            <?php } ?>
                            <?php if($curpage>=2){ ?>
                              <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage;?>"><?php echo $previouspage;?></a></li>
                            <?php } ?>
                            <li class="page-item active"><a class="page-link" href="?page=<?php echo $curpage;?>"><?php echo $curpage;?></a></li>
                            <?php if($curpage!=$endpage){ ?>
                              <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage;?>"><?php echo $nextpage;?></a></li>
                            <?php } ?>
                            <?php if($curpage!=$endpage){ ?>
                              <li class="page-item">
                                <a class="page-link" href="?page=<?php echo $endpage;?>" aria-label="Next">
                                  <span aria-hidden="true">&raquo;</span>
                                  <span class="sr-only">Last</span>
                                </a>
                              </li>
                            <?php } ?>
                          </ul>
                        </nav>
                      </center>
                    </div>
        <?php }else{ ?>
          <div class="card">
            <div class="card-title text-center">
              <h5>Sin articulos en la pagina</h5>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php include '../../admin/common/footer.php';?>
</div>
</div>
<script>
  $(document).ready(function(){
    <?php if(isset($_GET['r'])){ ?>
      var respuesta=<?php echo $_GET['r'];?>;
    <?php } ?>
    if(respuesta=='1'){
      const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
      toast({type:'success',title:'¡El articulo fue agregado Exitosamente!'})
    }else{
      const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
      toast({type:'error',title:'¡Hubo un pequeño problema! \n Inténtalo de nuevo'})
    }
  });
</script>
<script>
  $(document).ready(function(){
    <?php if(isset($_GET['delete'])){ ?>
      var respuesta=<?php echo $respuesta;?>;
    <?php } ?>
    if(respuesta=='1'){
      const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
      toast({type:'success',title:'¡El articulo fue eliminado Exitosamente!'})
    }else{
      const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
      toast({type:'error',title:'¡Hubo un pequeño problema! \n Inténtalo de nuevo'})
    }
  });
</script>
<!-- Editar articulo -->
<script>
$(document).ready(function(){
<?php if(isset($_GET['a'])){ ?>
  var respuesta=1;
<?php } ?>
if(respuesta=='1'){
const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
toast({type:'success',title:'¡El articulo fue editado Exitosamente!'})
}
});
</script>
<!-- Bootstrp js and sweetalert2 --->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@7.29.0/dist/sweetalert2.all.min.js'></script>
</body>
</html>
