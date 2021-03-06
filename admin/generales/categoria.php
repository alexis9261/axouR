<?php
include '../common/sesion.php';
if($_SESSION['nivel']==6 || $_SESSION['nivel']==1){}else{ header('Location: ../principal.php');}
require '../../common/conexion.php';
include '../../common/datosGenerales.php';
if(isset($_GET['estatus']) && !empty($_GET['estatus'])){$estatus=$_GET['estatus'];}else{$estatus=0;}
//pausar o activar categoria
$activar=3;
$pausar=3;
if(isset($_GET['id']) && !empty($_GET['id'])){
  $Id_categoria=$_GET['id'];
  if(isset($_GET['band'])){
    $band=$_GET['band'];
    if($band==0){
      $sql="UPDATE `CATEGORIAS` SET `ESTATUS`=1 WHERE IDCATEGORIA=$Id_categoria";
      if($conn->query($sql)===TRUE){$pausar=1;}else{$pausar=2;}
    }elseif($band==1){
      $sql="UPDATE `CATEGORIAS` SET `ESTATUS`=0 WHERE IDCATEGORIA=$Id_categoria";
      if($conn->query($sql)===TRUE){$activar=1;}else{$activar=2;}
    }
  }
}
#paginacion
$perpage=25;
if(isset($_GET['page']) & !empty($_GET['page'])){$curpage=$_GET['page'];}else{$curpage=1;}
$start=($curpage*$perpage)-$perpage;
#necesito el total de elementos
$PageSql="SELECT * FROM categorias";
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
  <link href="../assets/dist/css/style.min.css" rel="stylesheet">
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
          <div class="col-auto ml-auto">
            <?php if (isset($_GET['estatus']) && $_GET['estatus']==1){ ?>
                <a href="?estatus=0">Ver activas</a>
            <?php }else{ ?>
              <a href="?estatus=1">Ver pausadas</a>
            <?php } ?>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4>Estas categorias estarán disponibles para agregar productos.</h4>
              </div>
                <div class="row px-3">
                  <div class="input-group mb-3 col-sm-5">
                    <div class="input-group-append">
                      <span class="input-group-text" title="Estas categorias serán visibles en el segundo (2do) menu de la pagina principal." data-toggle="tooltip"><b>Nombre de categoria</b></span>
                    </div>
                    <input type="text" id="nombre_categoria" class="form-control text-secondary" placeholder="Ej: Franelas" required maxlength="30">
                  </div>
                  <div class="input-group mb-3 col-sm-5">
                    <div class="input-group-append">
                      <span class="input-group-text" data-toggle="tooltip" title="Unicamente serán visibles aquellas cuya 'Categoria Padre' sea 'Principal'"><b>Categoria Padre</b></span>
                    </div>
                    <select class="form-control text-secondary" id="padre_categoria" required>
                      <option value="0">Principal</option>
                      <?php
                      $sql="SELECT IDCATEGORIA,NOMBRE FROM CATEGORIAS WHERE ESTATUS=0 ORDER BY IDCATEGORIA";
                      $result=$conn->query($sql);
                      if($result->num_rows > 0){
                        while($row=$result->fetch_assoc()){
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
              <div class="card-body p-0 p-2">
                <?php if (isset($_GET['estatus']) && $_GET['estatus']==1){ ?>
                  <h4 class="card-title">Categorias Pausadas</h4>
                <?php }else{ ?>
                  <h4 class="card-title">Categorias Activas</h4>
                <?php } ?>
              </div>
              <?php
              $sql="SELECT * FROM CATEGORIAS WHERE ESTATUS=$estatus ORDER BY IDCATEGORIA LIMIT $start, $perpage";
              $result=$conn->query($sql);
              if($result->num_rows>0){ ?>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead class="thead-light">
                      <tr class="text-center">
                        <th class="text-center">#</th>
                        <th scope="col">Nombre de categoria</th>
                        <th scope="col">Categoria padre</th>
                        <th scope="col"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $cont=0;
                      while($row=$result->fetch_assoc()){
                        ++$cont;
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
                          <td class="p-0 p-2 font-weight-bold"><?=$cont?></td>
                          <td class="p-0 p-2"><?=$nombre?></td>
                          <td class="p-0 p-2"><?=$padre?></td>
                          <td class="p-0 p-2">
                            <?php if (isset($_GET['estatus']) && $_GET['estatus']==1){ ?>
                              <a class="btn btn-link" href="?id=<?php echo $id;?>&band=1">
                                <svg title="Activar" data-toggle="tooltip" xmlns="http://www.w3.org/2000/svg" width='14px' viewBox="0 0 448 512"><path fill="#4aff36" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"/></svg>
                            <?php }else{ ?>
                              <a class="btn btn-link" href="?id=<?php echo $id;?>&band=0">
                                <svg title="Pausar" data-toggle="tooltip" xmlns="http://www.w3.org/2000/svg" width='14px' viewBox="0 0 448 512"><path fill="#ff5922" d="M144 479H48c-26.5 0-48-21.5-48-48V79c0-26.5 21.5-48 48-48h96c26.5 0 48 21.5 48 48v352c0 26.5-21.5 48-48 48zm304-48V79c0-26.5-21.5-48-48-48h-96c-26.5 0-48 21.5-48 48v352c0 26.5 21.5 48 48 48h96c26.5 0 48-21.5 48-48z"/></svg>
                            <?php } ?>
                            </a>
                          </td>
                        </tr>
                        <!-- alert Activar -->
                        <script>
                        $(document).ready(function(){
                          var activar=<?php echo $activar;?>;
                          if(activar==1){
                            const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
                            toast({type:'success',title:'¡La categoria fue activada exitosamente!'})
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
                            toast({type:'success',title:'¡La categoria fue pausada exitosamente!'})
                          }else if(pausar==2){
                            const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
                            toast({type:'error',title:'¡Hubo un pequeño problema! \n Inténtalo de nuevo'})
                          }
                        });
                        </script>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
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
            <?php }else{ ?>
              <div class="card">
                <h6 class="text-center text-secondary">Sin Categorias</h6>
              </div>
            <?php } ?>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="../assets/dist/js/custom.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@7.29.0/dist/sweetalert2.all.min.js'></script>
</body>
</html>
