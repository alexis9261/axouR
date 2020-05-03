<?php
include '../common/conexion.php';
include '../common/datosGenerales.php';
if(isset($_POST['correo'])){
  //$email=$_SESSION['USUARIO'];
  $pass=0;
  $usua=0;
    if($_POST['correo']!=null && $_POST['clave']!=null){
      $user=$_POST['correo'];
      $clave=$_POST['clave'];
      $sql="SELECT * FROM ADMIN_USUARIOS WHERE CORREO='$user'";
      $res=$conn->query($sql);
      if($row=$res->fetch_assoc()){//usuario registrado
        $clave=md5($clave);
        if($clave==$row['CLAVE']){//usuario loggeado
          session_start();
          $_SESSION['ACCESO']=TRUE;
          $_SESSION['USUARIO']=$_POST['correo'];
          header ('Location:principal.php');
        }else{ $pass=1; }
      }else{ $usua=1; }
    }
}
    session_start();
    if(isset($_SESSION['USUARIO'])){
      header('Location:principal.php');
    }else{ session_destroy(); }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title><?php echo $nombrePagina;?>- Administración</title>
  <link rel="icon" type="image/jpg" sizes="16x16" href="img/<?php echo $imageLogo;?>">
  <link href="assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <?php
  if(isset($_POST['correo'])){
    //$email=$_SESSION['USUARIO'];
    $pass=0;
    $usua=0;
      if($_POST['correo']!=null && $_POST['clave']!=null){
        $user=$_POST['correo'];
        $clave=$_POST['clave'];
        $sql="SELECT * FROM ADMIN_USUARIOS WHERE CORREO='$user'";
        $res=$conn->query($sql);
        if($row=$res->fetch_assoc()){//usuario registrado
          $clave=md5($clave);
          if($clave==$row['CLAVE']){//usuario loggeado
            session_start();
            $_SESSION['ACCESO']=TRUE;
            $_SESSION['USUARIO']=$_POST['correo'];
            header ('Location:principal.php');
          }else{ $pass=1; }
        }else{ $usua=1; }
      }
    }
      ?>
  <div class="container">
    <div class="text-center">
      <img src="img/<?php echo $imageLogo;?>" onerror="this.remove()" style="max-width:200px;">
    </div>
    <div class="row">
      <div class="card card-login mx-auto mt-3 col-md-6 col-sm-10">
        <div class="card-header">Iniciar sesión</div>
        <div class="card-body">
          <form action="index.php" method="POST">
            <div class="form-group">
              <label for="exampleInputEmail1" id="usuario">Correo</label>
              <input class="form-control" id="exampleInputEmail1" name="correo" type="text" aria-describedby="emailHelp" placeholder="Coloque el correo" required>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1" id="pass">Password</label>
              <input class="form-control" id="exampleInputPassword1" name="clave" type="password" placeholder="Password" required>
            </div>
            <div class="form-group">
              <div class="form-check">
                <label class="form-check-label">
                <input class="form-check-input" type="checkbox">Recordar Password</label>
              </div>
            </div>
              <button class="btn btn-outline-success btn-block" id="inicar" type="submit">Iniciar</button>
          </form>
          <div class="text-center mt-3">
            <a class="d-block small" href="forgot-password.html">¿Olvido el Password?</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
  var passw = <?php echo $pass;?>;
  var usuario = <?php echo $usua;?>;
  $("#iniciar").click(function(){
    if(passw == 1){ document.getElementById("pass").innerHTML = "Password "+" <span class='text-danger'>¡Contraseña Incorrecta!</span>"; }
    if(usuario == 1){ document.getElementById("usuario").innerHTML = "Correo "+" <span class='text-danger'>Correo Incorrecto!</span>"; }
  });
  </script>
</body>
</html>
