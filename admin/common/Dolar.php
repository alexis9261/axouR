<?php

  // put your code here
session_start();

if(isset($_SESSION['ACCESO'])){
    if ($_SESSION['ACCESO']==TRUE){

include_once '../Common/conexion.php';

//validar acceso a la cuenta de administrador

//Modificar valor en base de datos
if(isset($_GET['precio'])){
    $precionew= $_GET['precio'];
    $modificado=false;
    
    if(!empty($precionew)){
        $sql="UPDATE `VARIABLES` SET `VALUE`= $precionew WHERE `NOMBRE`='TASAUSD'";
        
        if ($conn->query($sql) === TRUE) {
            $modificado=true;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    
}

//Leer el valor de dolar en base de datos

$sql= "SELECT VALUE FROM VARIABLES WHERE NOMBRE ='TASAUSD' LIMIT 1";


$res= $conn->query($sql);

while($f=$res->fetch_assoc()){
    $precio = $f['VALUE'];
}
                         


?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Rouxa - Dolar</title>
  </head>
  <body>
   
   <div class="container center">
     
     <?php
       if(!empty($modificado)){
           if ($modificado==true){
               ?>
                 <div class="alert alert-success my-5" role="alert">
                  La tasa del dolar ha sido modificada con exito.
                </div>
               <?php
               
           }
           
       }
       ?>
   
     
      <h1 class="my-5 text-center">Precio del dolar en Rouxa</h1>
      
        <div class="p-3 mb-2 bg-info text-white">
            <h4 class="text-center my-4">Precio: <?php echo number_format($precio, 2,',','.')?> bs/USD</h4>
        </div>
         
         
      <form action="Dolar.php" method="get">   
      
        <div class="form-group">
        <label for="Precio">Tasa Bs/USD</label>


        <div class="input-group mb-3">
          <input type="text" class="form-control" id="Precio" name="precio" aria-describedby="emailHelp" placeholder="Precio del dolar en bolivares">

          <div class="input-group-append">
            <span class="input-group-text" id="basic-addon2">Bs</span>
          </div>
        </div>
        <small id="emailHelp" class="form-text text-muted">Los cambios realizados generan modificación de los precios de los productos</small>
      </div>

          <center>
               <input class="btn btn-primary btn-lg" type="submit" value="Modificar Tasa del Dolar">
          </center>
      </form>
    
   </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
<?php 
      }
            }else{
            
            include('index.php');
        }
        
        ?>  