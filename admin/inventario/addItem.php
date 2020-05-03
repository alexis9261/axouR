<?php
require_once '../../common/conexion.php';
$iscreated=false;
$respuesta=0;
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
  $sql="INSERT INTO `PRODUCTOS` (`NOMBRE_P`,`DESCRIPCION`,`GENERO`,`CATEGORIAID`,`PRECIO`,`MATERIAL`,`MARCAID`,`MANGA`,`CUELLO`,`ESTATUS`)
  VALUES ('$nombre_p','$descripcion','$genero','$categoria','$precio','$material','$marca','$manga','$cuello','0')";
  if($conn->query($sql)===TRUE){
    $iscreated=true;
    $idproducto=mysqli_insert_id($conn);
    $respuesta=1;
  }else{$respuesta=2;}
}else{$respuesta=3;}
//Agregar Modelo
if(isset($_POST['color_primary'],$_POST['color_secondary'],$_FILES['archivo'],$iscreated)){
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
        if($resultado){$iscreated=true;$respuesta=1;}else{$respuesta=5;}
      }
    }
    $sql="INSERT INTO `MODELOS` (`IDPRODUCTO`,`COLOR1`,`COLOR2`,`IMAGEN`) VALUES ('$idproducto','$color1','$color2','$name_archivo')";
    if($conn->query($sql)===TRUE){
      $iscreated=true;
      $idmodelo=mysqli_insert_id($conn);
      $respuesta=1;
    }else{$respuesta=6;}
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
          if($conn->query($sql)===TRUE){$iscreated=true;$respuesta=1;}else{$iscreated=false;$respuesta=7;}
        }
      }
    }
  }
}else{$respuesta=4;}
if($iscreated){
  if($respuesta==1){
    header('Location: index.php?r=1');
  }elseif($respuesta==2){
    header('Location: index.php?r=2');
  }elseif($respuesta==3){
    header('Location: index.php?r=3');
  }elseif($respuesta==4){
    header('Location: index.php?r=4');
  }elseif($respuesta==5){
    header('Location: index.php?r=5');
  }elseif($respuesta==6){
    header('Location: index.php?r=6');
  }elseif($respuesta==7){
    header('Location: index.php?r=7');
  }else{
    header('Location: index.php?r=0');
  }
}else{header('Location: index.php?r=0');}
$conn->close();
