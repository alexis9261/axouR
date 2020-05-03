<?php
$sql="SELECT * FROM `CONFIGURACION`";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    if($row['ATRIBUTO']=="cantidadBanner"){
      $cantidadBanner=$row['VALOR'];
    }else if($row['ATRIBUTO']=="facebook"){
      $facebook=$row['VALOR'];
    }else if($row['ATRIBUTO']=="instagram"){
      $instagram=$row['VALOR'];
    }else if($row['ATRIBUTO']=="twitter"){
      $twitter=$row['VALOR'];
    }else if($row['ATRIBUTO']=="linkedin"){
      $linkedin=$row['VALOR'];
    }
  }
}else{
  $cantidadBanner=1;
  $facebook="";
  $instagram="";
  $twitter="";
  $linkedin="";
}
if(isset($_SESSION['USER'])){
  $correo=$_SESSION['USER'];
  $sql="SELECT * FROM `USUARIOS` WHERE CORREO='$correo' LIMIT 1;";
  $result=$conn->query($sql);
  if($result->num_rows>0){
    while($row=$result->fetch_assoc()){
      $nombre=$row['NOMBRE'];
      $apellido=$row['APELLIDO'];
      $email_user=$row['CORREO'];
      $identidad=$row['DOCUMENTOID'];
      $telefono=$row['TELEFONO'];
    }
  }
}
