 <?php

$iscreated=false;
$archivo = "N_Producto.txt";
$C = 0;

$fp = fopen($archivo,"r");
$C = fgets($fp, 26);
fclose($fp);

++$C;
$fp = fopen($archivo,"w+");
fwrite($fp, $C, 26);
fclose($fp);
/*El contador C sera usado para darle nombre a las imagenes de los productos*/
if(isset($_FILES['archivo'])){
          // put your code here
 if($_FILES["archivo"]["error"]>0){ echo "error al cargar alchivo"; }
 else{
     $limite_kb = 500;
     if ($_FILES["archivo"]["size"]<= $limite_kb*1024){
         $ruta='../imagen/';
         $archivo = substr(strrchr($_FILES["archivo"]["name"], "."), 1);
         $archivo=$ruta.md5($C).'.'.$archivo;

         if(!file_exists($ruta)){ mkdir($ruta); }
         if(!file_exists($archivo)){
             $resultado=move_uploaded_file($_FILES["archivo"]["tmp_name"], $archivo);
             if ($resultado){
                 echo "<p>Archivo guardado</p>";
                 $iscreated=true;
             }else{ echo "Error al guardar el archivo"; }
         }else{ echo "Archivo ya existe"; }
     }else{ echo "Archivo  excede de tamaño"; }
 }
}
