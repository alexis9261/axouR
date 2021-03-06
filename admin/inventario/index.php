<?php
include '../common/sesion.php';
require '../../common/conexion.php';
$array_tallas=array();
$array_colores=array();
$sql="SELECT * FROM TALLAS";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    array_push($array_tallas,$row['IDTALLA']."|".$row['TALLA']);
  }
}
$sql="SELECT * FROM COLOR";
$result=$conn->query($sql);
if($result->num_rows>0){
  while($row=$result->fetch_assoc()){
    array_push($array_colores,$row['IDCOLOR']."|".$row['COLOR']);
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
  <link href="../assets/dist/css/style.min.css" rel="stylesheet">
  <link href="../../css/new.css" rel="stylesheet">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
</head>
<body>
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
      <?php include '../common/navbar.php';?>
      <div class="page-wrapper">
        <div class="page-breadcrumb">
          <div class="row">
            <div class="col-auto align-self-center">
              <h4 class="page-title">Inventario</h4>
            </div>
          </div>
        </div>
        <div class="container-fluid">
          <form action="addItem.php" method="POST" enctype="multipart/form-data" id="formulario">
            <div class="row mt-3">
              <div class="input-group mb-3 col-sm-12">
                <div class="input-group-append">
                  <span class="input-group-text"><b>Título</b></span>
                </div>
                <input type="text" name="nombre_p" class="form-control text-dark" placeholder="Ingrese el nombre (Max. 60 letras)" required maxlength="60">
              </div>
              <div class="input-group mb-3 col-sm-3">
                <div class="input-group-prepend">
                  <label class="input-group-text"><b>Genero</b></label>
                </div>
                <select name="genero" class="custom-select text-dark">
                  <option value="1">Dama</option>
                  <option value="2">Caballero</option>
                  <option value="3">Niño</option>
                  <option value="4">Niña</option>
                </select>
              </div>
              <div class="input-group mb-3 col-sm-3">
                <div class="input-group-prepend">
                  <label class="input-group-text"><b>Prenda</b></label>
                </div>
                <select name="categoria" class="custom-select text-dark">
                  <?php
                  $sql="SELECT IDCATEGORIA,NOMBRE FROM CATEGORIAS WHERE PADRE=0";
                  $result=$conn->query($sql);
                  if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                      $id=$row['IDCATEGORIA'];
                      $nombre=$row['NOMBRE'];
                      ?>
                      <option value="<?php echo $id; ?>"><?php echo $nombre; ?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="input-group mb-3 col-sm-3">
                <div class="input-group-prepend">
                  <label class="input-group-text"><b>Marca</b></label>
                </div>
                <select class="custom-select text-dark" name="marca">
                  <?php
                  $sql="SELECT * FROM MARCAS";
                  $result=$conn->query($sql);
                  if($result->num_rows>0){
                    while($row=$result->fetch_assoc()){
                      ?>
                      <option value="<?php echo $row['IDMARCA'];?>"><?php echo $row['NOMBREMARCA'];?></option>
                      <?php
                    }
                  }
                  ?>
                </select>
              </div>
              <div class="input-group mb-3 col-sm-3">
                <div class="input-group-append">
                  <span class="input-group-text"><b>Precio</b></span>
                </div>
                <input type="number" name="precio" class="form-control text-dark" placeholder="Precio al detal" required>
                <div class="input-group-append" title="Dólares" data-toggle="tooltip">
                  <span class="input-group-text"><b>$</b></span>
                </div>
              </div>
            </div>
            <hr>
            <h4 class="ml-4">Caracteristicas</h4>
            <div class="row">
              <div class="input-group mb-3 col-sm-4">
                <div class="input-group-append">
                  <span class="input-group-text"><b>Material</b></span>
                </div>
                <input type="text" name="material" class="form-control text-dark" placeholder="Ej: Algodon" required maxlength="25">
              </div>
              <div class="input-group mb-3 col-sm-3">
                <div class="input-group-prepend">
                  <label class="input-group-text"><b>Cuello</b></label>
                </div>
                <select name="cuello" class="custom-select text-dark">
                  <option value="0">No Aplica</option>
                  <option value="1">Redondo</option>
                  <option value="2">En V</option>
                  <option value="3">Mao</option>
                  <option value="4">Chemise</option>
                </select>
              </div>
              <div class="input-group mb-3 col-sm-3">
                <div class="input-group-prepend">
                  <label class="input-group-text"><b>Manga</b></label>
                </div>
                <select name="manga" class="custom-select text-dark">
                  <option value="0">No Aplica</option>
                  <option value="1">Corta</option>
                  <option value="2">3/4</option>
                  <option value="3">Larga</option>
                  <option value="4">Sin Manga</option>
                </select>
              </div>
            </div>
            <hr>
            <div class="row">
              <div class="col-auto">
                <h4 class="ml-4">Modelos</h4>
              </div>
              <span class="ml-auto mr-3 enlace2" id="agregar_modelo">Agregar Modelo</span>
            </div>
            <div class="container-fluid" id="container_modelos">
              <div class="row">
                <span class="col-auto ml-4 mt-2" id="image_preview0"></span>
                <span class="text-primary ml-auto modelos">Modelo 1</span>
                <div class="col-12 ml-4">
                  <label class="text_modelo_imagen labelModeloImage" for="modeloImage0" id="0">Seleccionar Imagen</label>
                  <input class="form-group modeloImage" name="archivo[]" type="file" required hidden="hidden" id="modeloImage0"/>
                </div>
                <div class="input-group mb-3 col-sm-4">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Color principal</b></label>
                  </div>
                  <select class="custom-select text-dark" name="color_primary[]" required>
                    <?php
                    $sql="SELECT * FROM COLOR";
                    $result=$conn->query($sql);
                    if($result->num_rows>0){
                      while($row=$result->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row['IDCOLOR'];?>"><?php echo $row['COLOR'];?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-sm-4">
                  <div class="input-group-prepend">
                    <label class="input-group-text"><b>Color secundario</b></label>
                  </div>
                  <select class="custom-select text-dark" name="color_secondary[]" required>
                    <?php
                    $sql="SELECT * FROM COLOR";
                    $result=$conn->query($sql);
                    if($result->num_rows>0){
                      while($row=$result->fetch_assoc()){
                        ?>
                        <option value="<?php echo $row['IDCOLOR'];?>"><?php echo $row['COLOR'];?></option>
                        <?php
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Talla</b></span>
                  </div>
                  <select name="talla[]" class="form-control text-dark" required>
                    <?php
                    foreach($array_tallas as $value){
                      $tallas=explode("|", $value);
                      ?>
                      <option value="1_<?php echo $tallas[0];?>"><?php echo $tallas[1];?></option>
                      <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Cantidad</b></span>
                  </div>
                  <input type="number" name="cantidad[]" class="form-control text-dark" min="1" required>
                </div>
                <div class="input-group mb-3 col-sm-3">
                  <div class="input-group-append">
                    <span class="input-group-text"><b>Peso (gr)</b></span>
                  </div>
                  <input type="number" name="peso[]" step="0.1" min="0.1" class="form-control text-dark">
                </div>
              </div>
              <span class="ml-auto enlace2 agregar_talla" id='t_1'>Agregar Talla</span>
            </div>
            <hr>
            <h4 class="ml-4">Descripción</h4>
            <div class="row">
              <div class="input-group mb-3 col-12">
                <textarea class="form-control text-dark" name="descripcion" placeholder="Describa el producto..." rows="8" cols="80" required></textarea>
              </div>
            </div>
            <div class="row justify-content-center mb-3">
              <button type="submit" class="btn btn-outline-primary">Agregar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Modal esperar -->
    <input type="hidden" data-toggle="modal" data-target="#loader_modal" id="loader_now">
    <div class="modal fade" id="loader_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" id="loader_real">
      <div class="modal-dialog" role="document">
        <div class="modal-content bg-transparent mt-5 pt-5" style="border:0px;">
          <button type="button" class="close bg-transparent" data-dismiss="modal" aria-label="Close" id="close_loader"></button>
          <div class="container mt-5 text-center text-white">
            <strong>
              Espere <br>
              ¡¡Puede tardar unos segundos!!
            </strong>
          </div>
        </div>
      </div>
    </div>
    <script>
      $("#formulario").submit(function(){
        $("#loader_now").click();
        $(this).submit();
      });
    </script>
    <!-- Agregar Modelos -->
    <script>
      $(document).on('click','#agregar_modelo',function(){
        var modelos = document.getElementsByClassName("modelos").length + 1;
        var string_array_tallas="<?php foreach($array_tallas as $value){echo "$value,";} ?>";
        var array_tallas=string_array_tallas.split(',');
        var string_options_tallas="";
        for (var i=0;i<(array_tallas.length-1);i++){
          var tallas=array_tallas[i].split('|');
          string_options_tallas=string_options_tallas+"<option value='"+modelos+"_"+tallas[0]+"'>"+tallas[1]+"</option>";
        }
        var string_array_colores="<?php foreach($array_colores as $value){echo "$value,";} ?>";
        var array_colores=string_array_colores.split(',');
        var string_options_colores="";
        for (var i=0;i<(array_colores.length-1);i++){
          var colores=array_colores[i].split('|');
          string_options_colores=string_options_colores+"<option value='"+colores[0]+"'>"+colores[1]+"</option>";
        }
        $('#container_modelos').append("<div class='row'><span class='col-auto ml-4 mt-2' id='image_preview"+(modelos-1)+"'></span><span class='text-primary ml-auto modelos'>Modelo "+modelos+"</span><div class='col-12 ml-4'><label class='text_modelo_imagen labelModeloImage' for='modeloImage"+(modelos-1)+"' id='"+(modelos-1)+"'>Seleccionar Imagen</label><input class='form-group modeloImage' name='archivo[]' type='file' required hidden='hidden' id='modeloImage"+(modelos-1)+"'></div><div class='input-group mb-3 col-sm-4'><div class='input-group-prepend'><label class='input-group-text'><b>Color principal</b></label></div><select class='custom-select text-dark' name='color_primary[]'>"+string_options_colores+"</select></div><div class='input-group mb-3 col-sm-4'><div class='input-group-prepend'><label class='input-group-text'><b>Color secundario</b></label></div><select class='custom-select text-dark' name='color_secondary[]'>"+string_options_colores+"</select></div></div><div class='row'><div class='input-group mb-3 col-sm-3'><div class='input-group-append'><span class='input-group-text'><b>Talla</b></span></div><select name='talla[]' class='form-control text-dark' required>"+string_options_tallas+"</select></div><div class='input-group mb-3 col-sm-3'><div class='input-group-append'><span class='input-group-text'><b>Cantidad</b></span></div><input type='number' name='cantidad[]' class='form-control text-dark' min='1' required></div><div class='input-group mb-3 col-sm-3'><div class='input-group-append'><span class='input-group-text'><b>Peso (gr)</b></span></div><input type='number' name='peso[]' step='0.1' min='0.1' class='form-control text-dark'></div></div><span class='ml-auto enlace2 agregar_talla' id='t_"+modelos+"'>Agregar Talla</span>");
      });
    </script>
    <!-- Agregar Talla -->
    <script>
      $(document).on('click','span.agregar_talla',function(){
        var string_array_tallas="<?php foreach($array_tallas as $value){echo "$value,";} ?>";
        var array_tallas=string_array_tallas.split(',');
        var string_options_tallas="";
        var id=$(this).attr("id").split('_')[1];
        for (var i=0;i<(array_tallas.length-1);i++){
          var tallas=array_tallas[i].split('|');
          string_options_tallas=string_options_tallas+"<option value='"+id+"_"+tallas[0]+"'>"+tallas[1]+"</option>";
        }
        $(this).before("<div class='row'><div class='input-group mb-3 col-sm-3'><div class='input-group-append'><span class='input-group-text'><b>Talla</b></span></div><select name='talla[]' class='form-control text-dark' required>"+string_options_tallas+"</select></div><div class='input-group mb-3 col-sm-3'><div class='input-group-append'><span class='input-group-text'><b>Cantidad</b></span></div><input type='number' name='cantidad[]' class='form-control text-dark' min='1' required></div><div class='input-group mb-3 col-sm-3'><div class='input-group-append'><span class='input-group-text'><b>Peso (gr)</b></span></div><input type='number' name='peso[]' step='0.1' min='0.1' class='form-control text-dark'></div><svg class='svg-danger enlace2 trash_svg' xmlns='http://www.w3.org/2000/svg' width='15px' viewBox='0 0 448 512'><path d='M0 84V56c0-13.3 10.7-24 24-24h112l9.4-18.7c4-8.2 12.3-13.3 21.4-13.3h114.3c9.1 0 17.4 5.1 21.5 13.3L312 32h112c13.3 0 24 10.7 24 24v28c0 6.6-5.4 12-12 12H12C5.4 96 0 90.6 0 84zm415.2 56.7L394.8 467c-1.6 25.3-22.6 45-47.9 45H101.1c-25.3 0-46.3-19.7-47.9-45L32.8 140.7c-.4-6.9 5.1-12.7 12-12.7h358.5c6.8 0 12.3 5.8 11.9 12.7z'/></svg></div>");
      });
      //eliminar talla
      $(document).on('click','svg.trash_svg',function(){
        $(this).parent().remove();
      });
    </script>
    <!-- Preview Banner Medio -->
    <script>
      function readFileBanner(input,id){
        $("#file_preview"+id).remove();
        if(input.files && input.files[0]){
          var reader=new FileReader();
          reader.onload=function(e){
            var filePreview=document.createElement('img');
            filePreview.id='file_preview'+id;
            filePreview.setAttribute("width","100");
            filePreview.src = e.target.result;
            var previewZone = document.getElementById('image_preview'+id);
            previewZone.appendChild(filePreview);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }
      $(document).on('click','label.labelModeloImage',function(){
        var id=parseInt($(this).attr("id"));
        var fileUpload=document.getElementsByClassName("modeloImage")[id];
        fileUpload.onchange=function(e){
          var imgPath=$(this)[0].value;
          var extn=imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          if(extn=="png" || extn=="jpg" || extn=="jpeg"){
            readFileBanner(e.srcElement,id);
          }else{
            const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:4000});
            toast({type:'error',title:"¡Desbes subir imagenes tipo jpg, jpge o png"})
          }
        }
      });
    </script>
    <script>
      $(document).ready(function(){
        <?php if(isset($_GET['r'])){ ?>
          var respuesta=<?php echo $_GET['r'];?>;
        <?php } ?>
        if(respuesta=='1'){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'success',title:'¡El producto fue creado Exitosamente!'})
        }else if(respuesta=='2'){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'error',title:'¡No se pudo crear el producto! \n Inténtalo de nuevo'})
        }else if(respuesta=='3'){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'error',title:'¡Falto algún valor por llenar! \n Inténtalo de nuevo'})
        }else if(respuesta=='4'){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'error',title:'¡Falto alguna imagen! \n Inténtalo de nuevo'})
        }else if(respuesta=='5'){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'error',title:'¡No se pudo subir la imagen! \n Inténtalo de nuevo'})
        }else if(respuesta=='6'){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'error',title:'¡No se pudieron crear los modelos! \n Inténtalo de nuevo'})
        }else if(respuesta=='7'){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'error',title:'¡No se pudo agregar el producto al inventario! \n Inténtalo de nuevo'})
        }else if(respuesta=='0'){
          const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:3500});
          toast({type:'error',title:'¡Hubo un error! \n Inténtalo de nuevo'})
        }
      });
    </script>
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../assets/dist/js/custom.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@7.29.0/dist/sweetalert2.all.min.js'></script>
</body>
</html>
