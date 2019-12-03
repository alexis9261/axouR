<?php
require '../../common/conexion.php';
//el valor respuesta sera el que se manejara en el archivo edit.php, en la llamada ajax
$respuesta=0;
//debo agregar la imagen
if(isset($_POST['id'])){
  $id_articulo=$_POST['id'];
  $titulo=$_POST['titulo'];
  $descripcion=$_POST['description'];
  $contenido=$_POST['content'];
  $keywords=$_POST['keywords'];
  $autor=$_POST['autor'];
  if(isset($_FILES['imagen']) && !isset($_POST['bandera'])){
    //elimino la imagen anterior
    $result=$conn->query("SELECT * FROM ARTICLESBLOG WHERE IDARTICULO=$id_articulo");
    if($result->num_rows>0){
      $row=$result->fetch_assoc();
      $ruta_imagen=$row['IMAGE'];
      unlink("img/$ruta_imagen");
    }
    $limite_kb=2000;
    if($_FILES["imagen"]["size"]<= $limite_kb*1024){
      $valid_extensions=array("jpeg","jpg","png");
      $ruta='img/';
      $extension=substr(strrchr($_FILES["imagen"]["name"], "."), 1);
      $name_archivo=$_FILES["imagen"]["name"];
      $archivo=$ruta.$name_archivo;
      if((($_FILES["imagen"]["type"]=="image/png") || ($_FILES["imagen"]["type"]=="image/jpg") || ($_FILES["imagen"]["type"]=="image/jpeg")) && in_array($extension,$valid_extensions)){
        $resultado=move_uploaded_file($_FILES["imagen"]["tmp_name"],$archivo);
        if($resultado){$respuesta=1;}else{$respuesta=3;}}else{$respuesta=4;}
    }else{$respuesta=5;}
    if($respuesta==1){
      $sql="UPDATE `ARTICLESBLOG` SET `TITLE`='$titulo',`IMAGE`='$name_archivo',`DESCRIPTION`='$descripcion',`CONTENT`='$contenido',`KEYWORDS`='$keywords',`AUTOR`='$autor' WHERE IDARTICULO=$id_articulo";
      if($conn->query($sql)===TRUE){$respuesta=1;}
    }
  }else{
    $sql="UPDATE `ARTICLESBLOG` SET `TITLE`='$titulo',`DESCRIPTION`='$descripcion',`CONTENT`='$contenido',`KEYWORDS`='$keywords',`AUTOR`='$autor' WHERE IDARTICULO=$id_articulo";
    if($conn->query($sql)===TRUE){$respuesta=1;}
  }
}
echo "$respuesta";
$conn->close();
