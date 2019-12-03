<?php
include '../common/sesion.php';
if($_SESSION['nivel']==6 || $_SESSION['nivel']==1){}else{header('Location: ../principal.php');}
require '../../common/conexion.php';
include '../../common/datosGenerales.php';
#paginacion
$perpage=25;
if(isset($_GET['page']) & !empty($_GET['page'])){$curpage=$_GET['page'];}else{$curpage=1;}
$start=($curpage * $perpage) - $perpage;
#necesito el total de elementos
$PageSql="SELECT * FROM MARCAS";
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
  <meta name="description" content="Administración de <?php echo $nombrePagina;?>.">
  <meta name="author" content="Eutuxia Web, C.A.">
  <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
  <title><?php echo $nombrePagina;?> - Administración</title>
  <link href="../dist/css/style.min.css" rel="stylesheet">
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
            <h4 class="page-title">Tallas</h4>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h6>Todos tus productos se regirán por estas tallas.</h6>
              </div>
                <div class="row justify-content-center mb-3">
                  <div class="input-group col-6">
                    <div class="input-group-append">
                      <span class="input-group-text" data-toggle="tooltip" title="Ej. Ford"><b>Nombre de la Talla</b></span>
                    </div>
                    <input type="text" id="nombre_talla" class="form-control text-secondary" placeholder="Ingrese el nombre de la talla" required>
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn btn-outline-primary" id="agregar_talla">Agregar</button>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <script>
          $("#agregar_talla").click(function(){
            var nombre_talla=$("#nombre_talla").val();
            $.get('ajax_tallas.php',{talla:nombre_talla,band:1},verificar,'text');
            function verificar(respuesta){
            if(respuesta==1){
            const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
            toast({type:'success',title:'¡La talla fue agregada Exitosamente!'});
            }else{
            const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
            toast({type:'error',title:'¡Hubo un pequeño problema! \n Inténtalo de nuevo'});
            }
          }
          });
        </script>
        <?php
        $sql="SELECT * FROM TALLAS LIMIT $start,$perpage";
        $result=$conn->query($sql);
        if($result->num_rows>0){
          ?>
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="card">
                <div class="card-body p-0 p-2">
                  <h4 class="card-title">Tallas registradas</h4>
                  <h6 class="card-subtitle"></h6>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover">
                    <thead class="thead-light">
                      <tr  class="text-center">
                        <th scope="col">Nombre de la Talla</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      while($row=$result->fetch_assoc()){
                        $idtalla=$row['IDTALLA'];
                        $nombreTalla=$row['TALLA'];
                        ?>
                        <tr class="text-center">
                          <td class="p-0 p-2"><?php echo $nombreTalla;?></td>
                          <td class="p-0 p-2"><a href="javascript:void(0)" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#eli<?php echo $idtalla;?>">Eliminar</a></td>
                        </tr>
                        <div class="modal fade" id="eli<?php echo $idtalla;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">¿Desea eliminar la talla?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="close<?php echo $idtalla;?>">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <div class="container">
                                  <div class="row justify-content-around">
                                    <div class="col-auto">
                                      <?php echo $nombreTalla;?>
                                    </div>
                                  </div>
                                </div>
                              </br>
                              Tenga en cuenta no se podrá filtrar en la pagina por esta talla.</br>
                              Consulte con su supervisor antes de realizar esta acción.
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                              <a href="#" class="btn btn-primary" id="eliminar<?php echo $idtalla;?>">Eliminar</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <script>
                        $("#eliminar<?php echo $idtalla;?>").click(function(){
                          var id_talla=<?php echo $idtalla;?>;
                          $.get('ajax_marcas.php',{delete:id_talla,band:0},verificar,'text');
                          function verificar(respuesta){
                          if(respuesta==1){
                          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
                          toast({type:'success',title:'¡La talla fue eliminada Exitosamente!'})
                          }else{
                          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
                          toast({type:'error',title:'¡Hubo un pequeño problema! \n Inténtalo de nuevo'})
                          }
                          $("#close<?php echo $idtalla;?>").click();
                        }
                        });
                      </script>
                    </tr>
                    <?php
                  }
                  ?>
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
                    if($curpage >=2){ ?>
                      <li class="page-item"><a class="page-link" href="?page=<?php echo $previouspage ?>"><?php echo $previouspage ?></a></li>
                    <?php }  ?>
                    <li class="page-item active"><a class="page-link" href="?page=<?php echo $curpage ?>"><?php echo $curpage ?></a></li>
                    <?php if($curpage != $endpage){ ?>
                      <li class="page-item"><a class="page-link" href="?page=<?php echo $nextpage ?>"><?php echo $nextpage ?></a></li>
                    <?php }
                    if($curpage != $endpage){ ?>
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
          </div>
        </div>
      </div>
    <?php }else{ ?>
      <h4 class="card-title text-center">No hay tallas registradas</h4>
    <?php } ?>
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
