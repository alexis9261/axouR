<?php
require_once '../../common/conexion.php';
$iscreated=false;
if(isset($_POST['nombre_p'],$_POST['genero'],$_POST['categoria'],$_POST['marca'],$_POST['precio'],$_POST['material'],$_POST['cuello'],$_POST['manga'],$_POST['descripcion'])){
  $nombre_p=$_POST['nombre_p'];
  $genero=$_POST['genero'];
  $categoria=$_POST['categoria'];
  $marca=$_POST['marca'];
  $precio=$_POST['precio']; //double
  $material=$_POST['material'];
  /*Tipos de cuello
  (0) - No aplica
  (1) - Redondo
  (2) - En V
  (3) - Mao
  (4) - Chemise
  */
  $cuello=$_POST['cuello']; //entero
  /*Tipo de manga
  (0) - No aplica
  (1) - Corta
  (2) - Tres Cuarto
  (3) - Larga
  (4) - Sin Manga
  */
  $manga=$_POST['manga']; //Entero
  $descripcion=$_POST['descripcion'];
  $sql="INSERT INTO `PRODUCTOS` (`NOMBRE_P`,`DESCRIPCION`,`GENERO`,`CATEGORIAID`,`PRECIO`,`CUELLO`,`MANGA`,`MATERIAL`,`MARCAID`)
  VALUES ('$nombre_p','$descripcion','$genero','$categoria','$precio','$cuello','$manga','$material','$marca')";
  if($conn->query($sql)===TRUE){
    $iscreated=true;
    $idproducto=mysqli_insert_id($conn);
  }
}
//Agregar Modelo
if(isset($_POST['color_primary'],$_POST['color_secondary'],$_FILES['archivo'])){
  $imagenes=$_FILES['archivo'];
  $iscreated=false;
  $limite_kb=500;
  $color_primario=$_POST['color_primary'];
  $color_secundario=$_POST['color_secondary'];
  for($i=0;$i<count($color_primario);$i++){
    $color1=$color_primario[$i];
    $color2=$color_secundario[$i];
    if($imagenes["error"][$i]==0){
      if($imagenes["size"][$i]<= $limite_kb*1024){
        $ruta='img/';
        $extension_archivo=substr(strrchr($imagenes["name"][$i],"."),1);
        $name_archivo=$nombre_p."_".$categoria."_$i".$genero.".".$extension_archivo;
        $ruta_target=$ruta.$name_archivo;
        $resultado=move_uploaded_file($imagenes["tmp_name"][$i],$ruta_target);
        if($resultado){$iscreated=true;}
      }
    }
    $sql="INSERT INTO `MODELOS` (`IDPRODUCTO`,`COLOR1`,`COLOR2`,`IMAGEN`) VALUES ('$idproducto','$color1','$color2','$name_archivo')";
    if($conn->query($sql)===TRUE){
      $iscreated=true;
      $idmodelo=mysqli_insert_id($conn);
    }
    //Insertar Tallas
    if(isset($_POST['talla'],$_POST['cantidad'],$_POST['peso'])){
      $talla=$_POST['talla'];
      $cantidad=$_POST['cantidad'];
      $peso=$_POST['peso'];
      for($x=0;$x<count($talla);$x++){
        $tallas=explode("_",$talla[$x]);
        if($tallas[0]==($i+1)){
          $talla_sql=$tallas[1];
          $cantidad_sql=$cantidad[$x];
          $peso_sql=$peso[$x];
          $sql="INSERT INTO INVENTARIO (IDMODELO,TALLAID,CANTIDAD,PESO) VALUES ('$idmodelo','$talla_sql','$cantidad_sql','$peso_sql')";
          if($conn->query($sql)===TRUE){$iscreated=true;}else{$iscreated=false;}
        }
      }
    }
  }
}
if($iscreated){header('Location: index.php?r=1');}else{header('Location: index.php?r=0');}
$conn->close();
