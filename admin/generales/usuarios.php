<?php
include('../common/sesion.php');
if($_SESSION['nivel']==6 || $_SESSION['nivel']==1){
}else{ header('Location: ../principal.php'); }
require '../../common/conexion.php';
include '../../common/datosGenerales.php';
if(isset($_GET['nombre'],$_GET['apellido'],$_GET['email'], $_GET['clave'], $_GET['nivel'] )){
    $nombre= $_GET['nombre'].' '.  $_GET['apellido'];
    $correo= $_GET['email'];
    $clave= md5($_GET['clave']);
    $nivel= $_GET['nivel'];
   $sql = "INSERT INTO `USUARIOS`(`NOMBRE`, `CORREO`, `CLAVE`, `NIVEL`) VALUES ('$nombre','$correo','$clave', '$nivel')";
if($conn->query($sql) === TRUE){
    echo "<center>Nuevo USUARIO registrado</center>";
    header('Location: ./usuarios.php');
   }else{ echo "Error: " . $sql . "<br>" . $conn->error;}
}
#paginacion y eliinacion de productos
if(isset($_GET['delete']) & !empty($_GET['delete'])){
    $idusuario=$_GET['delete'];
    #eliminar USURIO
    $sql ="DELETE FROM USUARIOS WHERE IDUSUARIO='$idusuario'";
       if($conn->query($sql) === TRUE){
           }else{ echo '<script> alert("Error:'. $sql . '<br>'. $conn->error.'"); </script>'; }
}
$perpage  = 10;
if(isset($_GET['page']) & !empty($_GET['page'])){
	$curpage = $_GET['page'];
}else{ $curpage = 1;}
$start = ($curpage * $perpage) - $perpage;
#necesito el total de elementos
$PageSql = "SELECT * FROM USUARIOS";
$pageres = mysqli_query($conn, $PageSql);
$totalres = mysqli_num_rows($pageres);
$endpage = ceil($totalres/$perpage);
$startpage = 1;
$nextpage = $curpage + 1;
$previouspage = $curpage - 1;
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Administración de <?php echo $nombrePagina;?>.">
  <meta name="author" content="Eutuxia Web, C.A.">
  <link rel="icon" type="image/jpg" sizes="16x16" href="../img/<?php echo $imageLogo;?>">
  <title><?php echo $nombrePagina;?> - Administración</title>
  <link href="../dist/css/style.min.css" rel="stylesheet">
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
        <?php include('../common/navbar.php'); ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Usuarios</h4>
                    </div>
                    <!--div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="../principal.php">Inicio</a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Desarrollo</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Agregar/Eliminar Usuarios</li>
                                </ol>
                            </nav>
                        </div>
                    </div-->
                </div>
            </div>
            <div class="container-fluid">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Crear o Eliminar usuarios para la Administración.</h4>
                      <h6 class="card-subtitle">Acá se registrarán todos los usarios que tendrán permisos para accerder al la parte administrativa.</h6>
                    </div>
                    <form action="" method="GET">
                      <div class="row px-3">
                        <div class="input-group mb-3 col-sm-4">
                          <div class="input-group-append">
                            <span class="input-group-text"><b>Nombre</b></span>
                          </div>
                          <input type="text" name="nombre" class="form-control text-secondary" placeholder="Ingrese el nombre" required>
                        </div>
                        <div class="input-group mb-3 col-sm-4">
                          <div class="input-group-append">
                            <span class="input-group-text"><b>Apellido</b></span>
                          </div>
                          <input type="text" name="apellido" class="form-control text-secondary" placeholder="Ingrese el apellido" required>
                        </div>
                        <div class="input-group mb-3 col-sm-4">
                          <div class="input-group-prepend">
                            <label class="input-group-text"><b>Perfil</b></label>
                          </div>
                          <select name="nivel" class="custom-select text-secondary">
                            <option value="1">Administrador</option>
                            <option value="2">Supervisor</option>
                            <option value="3">Vendedor</option>
                            <option value="4">Despachador</option>
                            <option value="5">Visitante</option>
                            <option value="6">Desarrollador</option>
                            <option value="7">Almacenista</option>
                          </select>
                        </div>
                        <div class="input-group mb-3 col-sm-5">
                          <div class="input-group-append">
                            <span class="input-group-text"><b>Correo</b></span>
                          </div>
                          <input type="email" name="email" class="form-control text-secondary" required>
                        </div>
                        <div class="input-group mb-3 col-sm-5">
                          <div class="input-group-append">
                            <span class="input-group-text"><b>Password</b></span>
                          </div>
                          <input type="password" name="clave" class="form-control text-secondary" required>
                        </div>
                        <div class="col-2">
                          <button type="submit" class="btn btn-outline-primary">Agregar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php
                  $sql = "SELECT * FROM USUARIOS LIMIT $start, $perpage";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
              ?>
              <div class="row mt-1">
                <div class="col-12">
                  <div class="table-responsive">
                      <table class="table table-hover">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Permisos</th>
                            <th scope="col"></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php while($row = $result->fetch_assoc()) { ?>
                            <tr>
                              <td class="p-0 p-2"><?=$row['CORREO']?></td>
                              <td class="p-0 p-2"><?=$row['NOMBRE']?></td>
                              <td class="p-0 p-2"><?php
                              switch($row['NIVEL']){
                                case 1:
                                echo 'Administrador';
                                break;
                                case 2:
                                echo 'Supervisor';
                                break;
                                case 3:
                                echo 'Vendedor';
                                break;
                                case 4:
                                echo 'Despachador';
                                break;
                                case 5:
                                echo 'Visitante';
                                break;
                                case 6:
                                echo 'Desarrollador';
                                break;
                                case 7:
                                echo 'Almacenista';
                                break;
                              }?></td>
                              <td class="p-0 p-2"><a class="btn btn-outline-danger btn-sm" href="?delete=<?=$row['IDUSUARIO']?>" >Eliminar</a></td>
                            </tr>
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
              <?php }else{ ?>
                <div class="card-body">
                  <h4 class="card-title text-center">Sin usuarios en Base de Datos</h4>
                </div>
              <?php } ?>
            </div>
            <?php include('../common/footer.php'); ?>
        </div>
    </div>
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../dist/js/custom.min.js"></script>
</body>
</html>
<?php $conn->close(); ?>
