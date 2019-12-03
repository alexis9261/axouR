<?php
include_once('../common/sesion.php');
if($_SESSION['nivel']==6 || $_SESSION['nivel']==1){
}else{ header('Location: ../principal.php'); }
require('../../common/conexion.php');
//nombre nombre pagina
$sql="SELECT * FROM `configuracion`";
$result=$conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    if ($row['ATRIBUTO']=="nombrePagina") {
      $nombrePagina=$row['VALOR'];
    }else if ($row['ATRIBUTO']=="imageLogo") {
      $imageLogo=$row['VALOR'];
    }
  }
}
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
        <?php include('../common/navbar2.php'); ?>
        <div class="page-wrapper">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                      <h4 class="page-title">Configuración General</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="../principal.php">Inicio</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Desarrollo</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
              <div class="row justify-content-around">
                  <div class="col-sm-4 text-center">
                    <a class="btn btn-link text-success" href="usuarios.php">Agregar/Eliminar Usuario</a>
                  </div>
                  <div class="col-sm-4 text-center">
                    <a class="btn btn-link text-success" href="categoria.php">Agregar/Eliminar Categoria</a>
                  </div>
                  <div class="col-sm-4 text-center">
                    <a class="btn btn-link text-success" href="colores.php">Agregar/Eliminar Color</a>
                  </div>
              </div>
                <div class="row mt-3">
                  <div class="col-sm-6">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Usuarios en Base de Datos</h4>
                      <h6 class="card-subtitle">Usuarios registrados en la Base de Datos.</h6>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead class="thead-light">
                          <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Permisos</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                          $sql="SELECT * FROM USUARIOS LIMIT 4;";
                          $result = $conn->query($sql);
                          if ($result->num_rows > 0) {
                          // output data of each row
                          while($row = $result->fetch_assoc()) {
                              ?>
                          <tr>
                            <td><?=$row['CORREO']?></td>
                            <td><?=$row['NOMBRE']?></td>
                            <td><?php
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
                          </tr>
                              <?php
                           }
                          }
                            ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Tipos de prendas en Base de Datos</h4>
                      <h6 class="card-subtitle">Estas son los tipos de prendas disponibles para el inventario</h6>
                    </div>
                    <div class="table-responsive">
                      <table class="table table-hover">
                        <thead class="thead-light">
                          <tr class="text-center">
                            <th scope="col">Nombre</th>
                            <th scope="col">Categoria padre</th>
                          </tr>
                        </thead>
                        <tbody>
                              <?php
                              $sql="SELECT c.NOMBRE AS NOMBRE  FROM CATEGORIAS c
                              WHERE c.PADRE=0 LIMIT 5;";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                  ?>
                                  <tr class="text-center">
                                    <td><?=$row['NOMBRE']?></td>
                                    <td>Principal</td>
                                  </tr>
                                  <?php
                                }
                              }
                              ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                  <div class="col-sm-6">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Colores en Base de Datos</h4>
                        <h6 class="card-subtitle">Estos colores serviran de filtro en las busquedas de la página</h6>
                      </div>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead class="thead-light">
                            <tr class="text-center">
                              <th scope="col">Color</th>
                              <th scope="col">Nombre</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql="SELECT * FROM COLOR LIMIT 5;";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0){
                              // output data of each row
                              while($row = $result->fetch_assoc()){
                                ?>
                                <tr class="text-center">
                                  <td><span class="dot3" style="background-color:<?=$row['HEX']?>"></span></td>
                                  <td><?=$row['COLOR']?></td>
                                </tr>
                                <?php
                              }
                            }
                            ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
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
