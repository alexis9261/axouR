<?php
include '../common/sesion.php';
require '../../common/conexion.php';
$iscreated=false;
$array_id_modelos=$_SESSION['id_modelos'];
$idproducto=$_POST['id_producto'];
//actualizar producto
if(isset($_POST['nombre_p'],$_POST['genero'],$_POST['categoria'],$_POST['marca'],$_POST['precio'],$_POST['material'],$_POST['cuello'],$_POST['manga'],$_POST['descripcion'])){
  $nombre_p=$_POST['nombre_p'];
  $genero=$_POST['genero'];
  $categoria=$_POST['categoria'];
  $marca=$_POST['marca'];
  $precio=$_POST['precio']; //double
  $material=$_POST['material'];
  $cuello=$_POST['cuello']; //entero
  $manga=$_POST['manga']; //Entero
  $descripcion=$_POST['descripcion'];
  $sql="UPDATE `productos` SET `NOMBRE_P`='$nombre_p',`DESCRIPCION`='$descripcion',`GENERO`='$genero',`CATEGORIAID`='$categoria',`PRECIO`='$precio',`CUELLO`='$cuello',`MANGA`='$manga',`MATERIAL`='$material',`MARCAID`='$marca' WHERE `IDPRODUCTO`='$idproducto';";
  if($conn->query($sql)===TRUE){$iscreated=true;}
}
//actualizar y/o insertar modelo
if(isset($_POST['color_primary'],$_POST['color_secondary'],$iscreated)){
  //$imagenes=$_FILES['archivo'];
  //$limite_kb=500;
  $iscreated=false;
  $color_primario=$_POST['color_primary'];
  $color_secundario=$_POST['color_secondary'];
  $modelos=$_POST['id_modelos'];
  for($i=0;$i<count($modelos);$i++){
    $color1=$color_primario[$i];
    $color2=$color_secundario[$i];
    $idmodelo=$array_id_modelos[$i];
    /*if($imagenes["error"][$i]==0){
      if($imagenes["size"][$i]<= $limite_kb*1024){
        $ruta='img/';
        $extension_archivo=substr(strrchr($imagenes["name"][$i],"."),1);
        $name_archivo=$nombre_p."_".$categoria."_$i".$genero.".".$extension_archivo;
        $ruta_target=$ruta.$name_archivo;
        $resultado=move_uploaded_file($imagenes["tmp_name"][$i],$ruta_target);
        if($resultado){$iscreated=true;}
      }
    }*/
    if($idmodelo=="not"){
      $sql="INSERT INTO `modelos` (`IDPRODUCTO`,`COLOR1`,`COLOR2`,`IMAGEN`) VALUES ('$idproducto','$color1','$color2','$name_archivo')";
    }else{$sql="UPDATE `modelos` SET `COLOR1`='$color1',`COLOR2`='$color2' WHERE `IDMODELO`='$idmodelo';";}
    if($conn->query($sql)===TRUE){$iscreated=true;}
    //Editar y/o insertar Tallas
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
          if($idmodelo=="not"){
            $sql="INSERT INTO `inventario` (IDMODELO,TALLAID,CANTIDAD,PESO) VALUES ('$idmodelo','$talla_sql','$cantidad_sql','$peso_sql')";
          }else{
            $sql="UPDATE `inventario` SET `TALLAID`='$talla_sql',`CANTIDAD`='$cantidad_sql',`PESO`='$peso_sql' WHERE `IDMODELO`='$idmodelo';";
          }
          if($conn->query($sql)===TRUE){$iscreated=true;}else{$iscreated=false;}
        }
      }
    }
  }
}
//if($iscreated){header('Location: ver_productos.php?r=1');}else{header('Location: ver_productos.php?r=2');}
$conn->close();
