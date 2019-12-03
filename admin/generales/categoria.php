<?php
include '../common/sesion.php';
if($_SESSION['nivel']==6 || $_SESSION['nivel']==1){
}else{ header('Location: ../principal.php');}
require '../../common/conexion.php';
include '../../common/datosGenerales.php';
#paginacion
$perpage=25;
if(isset($_GET['page']) & !empty($_GET['page'])){$curpage=$_GET['page'];}else{$curpage=1;}
$start=($curpage*$perpage)-$perpage;
#necesito el total de elementos
$PageSql="SELECT * FROM CATEGORIAS";
$pageres=mysqli_query($conn, $PageSql);
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
  <meta name="description" content="Administración de la E-Comerce Rouxa.">
  <meta name="author" content="Eutuxia Web, C.A.">
  <link rel="icon" type="image/jpg" sizes="16x16" href="../img/<?php echo $imageLogo;?>">
  <title><?php echo $nombrePagina;?> - Administración</title>
  <link href="../dist/css/style.min.css" rel="stylesheet">
  <link href="../../css/new.css" rel="stylesheet">
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
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
          <div class="col-auto align-self-center">
            <h4 class="page-title">Categorias</h4>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Agregar Categorias</h4>
                <h6 class="card-subtitle">Estas son las categorias que estarán disponibles al momento de agregar productos en el sistema</h6>
                <h6>Ademas, estas serán visibles en el segundo (2do) menu de la pagina principal. Unicamente serán visibles aquellas cuya <b>Categoria Padre</b> sea "Principal"</h6>
              </div>
                <div class="row px-3">
                  <div class="input-group mb-3 col-sm-5">
                    <div class="input-group-append">
                      <span class="input-group-text"><b>Nombre de categoria</b></span>
                    </div>
                    <input type="text" id="nombre_categoria" class="form-control text-secondary" placeholder="Ej: Impresoras" required>
                  </div>
                  <div class="input-group mb-3 col-sm-5">
                    <div class="input-group-append">
                      <span class="input-group-text" data-toggle="tooltip" title="Indica de cual categoria dependerá, en caso de ser principal no dependerá de ninguna categoria."><b>Categoria Padre</b></span>
                    </div>
                    <select class="form-control text-secondary" id="padre_categoria" required>
                      <option value="0">Principal</option>
                      <?php
                      $sql="SELECT IDCATEGORIA, NOMBRE FROM CATEGORIAS ORDER BY IDCATEGORIA";
                      $result = $conn->query($sql);
                      if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()){
                          #variabes
                          $id=$row['IDCATEGORIA'];
                          $nombre=$row['NOMBRE'];
                          echo "<option value='$id'>$nombre</option>";
                        }
                      }
                      ?>
                    </select>
                  </div>
                  <div class="col-2 mb-3">
                    <button type="button" class="btn btn-outline-primary" id="agregar_cat">Agregar</button>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <script>
          $("#agregar_cat").click(function(){
            var nombre_categoria=$("#nombre_categoria").val();
            var padre_categoria=$("#padre_categoria").val();
            $.get('ajax_categorias.php',{nombre:nombre_categoria,padre:padre_categoria,band:1},verificar,'text');
            function verificar(respuesta){
            if(respuesta==1){
            const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
            toast({type:'success',title:'¡La categoria fue agregada Exitosamente!'})
            }else{
            const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
            toast({type:'error',title:'¡Hubo un pequeño problema! \n Inténtalo de nuevo'})
            }
          }
          });
        </script>
        <div class="row justify-content-center">
          <div class="col-12">
            <div class="card">
              <div class="card-body  p-0 p-2">
                <h4 class="card-title">Categorias en el Sistema</h4>
                <h6 class="card-subtitle">A continuación todas las categorias que se encuentrán registradas en el sistema</h6>
              </div>
              <?php
              $sql="SELECT * FROM CATEGORIAS ORDER BY IDCATEGORIA LIMIT $start, $perpage";
              $result=$conn->query($sql);
              if($result->num_rows>0){?>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead class="thead-light">
                      <tr  class="text-center">
                        <th scope="col">Nombre de categoria</th>
                        <th scope="col">Categoria padre</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while($row=$result->fetch_assoc()){
                        $idpadre=$row['PADRE'];
                        $nombre=$row['NOMBRE'];
                        $id=$row['IDCATEGORIA'];
                        #CONSEGIR NOMBRE DEL PADRE
                        if($idpadre>0){
                          $sql2="SELECT NOMBRE FROM CATEGORIAS WHERE IDCATEGORIA='$idpadre' LIMIT 1";
                          $result2=$conn->query($sql2);
                          if($result2->num_rows>0){while($row2=$result2->fetch_assoc()){$padre=$row2['NOMBRE'];}}
                        }else{$padre='Principal';}
                        ?>
                        <tr class="text-center">
                          <td class="p-0 p-2"><?=$nombre?></td>
                          <td class="p-0 p-2"><?=$padre?></td>
                          <td class="p-0 p-2"><a href="javascript:void(0)" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#eli_<?=$id?>">Eliminar</a></td>
                        </tr>
                        <!-- Modal Eliminar -->
                        <div class="modal fade" id="eli_<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">¿Desea eliminar la categoria?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close_modal<?=$id?>">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="container">
                                  <div class="row justify-content-around">
                                    <div class="col-auto">
                                      <b>Categoria:</b> <?=$nombre?>
                                    </div>
                                    <div class="col-auto">
                                      <b>Categoria Padre:</b> <?=$padre?>
                                    </div>
                                  </div>
                                </div>
                              </br>
                              Tenga en cuenta no se podrá agregar prendas de este tipo al sistema.</br>
                              Consulte con su supervisor antes de realizar esta acción.
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <a href="#" class="btn btn-primary" id="eliminar<?=$id?>">Eliminar</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <script>
                        $("#eliminar<?=$id?>").click(function(){
                          var id_categoria=<?=$id?>;
                          $.get('ajax_categorias.php',{delete:id_categoria,band:0},verificar,'text');
                          function verificar(respuesta){
                          if(respuesta==1){
                          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
                          toast({type:'success',title:'¡La categoria fue eliminada Exitosamente!'});
                          }else{
                          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
                          toast({type:'error',title:'¡Hubo un pequeño problema! \n Inténtalo de nuevo'})
                          }
                          $("#close_modal<?=$id?>").click();
                        }
                        });
                      </script>
                    <?php } ?>
                  </tbody>
                </table>
                <center>
                  <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                      <?php if($curpage != $startpage){ ?>
                        <li class="page-item">
                          <a class="page-link" href="?page=<?php echo $startpage ?>" tabindex="-1" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">firts</span>
                          </a>
                        </li>
                      <?php }
                      if($curpage>=2){ ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
                      <?php } ?>
                      <li class="page-item active"><a class="page-link" href="?page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
                      <?php if($curpage!=$endpage){ ?>
                        <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
                      <?php }
                      if($curpage!=$endpage){ ?>
                        <li class="page-item">
                          <a class="page-link" href="?page=<?php echo $endpage ?>" aria-label="Next">
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
                <h6 class="text-center text-secondary">Sin Categorias</h6>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
    <?php include '../common/footer.php';?>
  </div>
</div>
<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../dist/js/custom.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@7.29.0/dist/sweetalert2.all.min.js'></script>
</body>
</html>
