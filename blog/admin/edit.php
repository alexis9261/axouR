<?php
//incluir la sesion
include '../../admin/common/sesion.php';
//incluir la conexion a la Base de datos
require '../../common/conexion.php';
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Eutuxia, C.A.">
  <title>Blog - Administración</title>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
    <div id="main-wrapper" data-navbarbg="skin6" data-theme="light" data-layout="vertical" data-sidebartype="full" data-boxed-layout="full">
        <div class="page-wrapper">
          <div class="page-breadcrumb">
            <div class="row">
              <div class="col-auto align-self-center">
                <h4 class="page-title">Blog - Editar Articulo</h4>
              </div>
            </div>
          </div>
          <?php
          if(isset($_GET['id']) && !empty($_GET['id'])){
            $id_articulo=$_GET['id'];
            $sql="SELECT * FROM ARTICLESBLOG WHERE IDARTICULO=$id_articulo";
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_assoc()){
                $id_articulo=$row['IDARTICULO'];
                $titulo=ucwords($row['TITLE']);
                $descripcion=ucwords($row['DESCRIPTION']);
                $contenido=ucwords($row['CONTENT']);
                $imagen=$row['IMAGE'];
                $autor=$row['AUTOR'];
                $keywords=$row['KEYWORDS'];
                ?>
                <div class="container-fluid">
                    <div class="row mt-1">
                      <div class="input-group mb-3 col-12">
                        <div class="input-group-append">
                          <span class="input-group-text"><b>Titulo del articulo</b></span>
                        </div>
                        <input type="text" name="title" class="form-control text-dark" required maxlength="255" value="<?php echo $titulo;?>">
                      </div>
                      <div class="input-group mb-3 col-12">
                        <div class="input-group-append">
                          <span class="input-group-text"><b>Autor</b></span>
                        </div>
                        <input type="text" name="autor" class="form-control text-dark" required maxlength="255" value="<?php echo $autor;?>">
                      </div>
                      <div class="input-group mb-3 col-12">
                        <div class="input-group-append">
                          <span class="input-group-text" title="Descripcion Corta" data-toggle="tooltip"><b>Descripcion del articulo</b></span>
                        </div>
                        <input type="text" name="description" class="form-control text-dark" required maxlength="255" value="<?php echo $descripcion;?>">
                      </div>
                      <div class="input-group mb-3 col-12">
                        <div class="input-group-append">
                          <span class="input-group-text" title="Serviran para el posicionamiento(SEO), deberan estar separadas por comas(,)" data-toggle="tooltip"><b>Palabras Clave</b></span>
                        </div>
                        <input type="text" name="keywords" class="form-control text-dark" required maxlength="255" placeholder="Ej. casas, apartamentos, casa en alquiler" value="<?php echo $keywords;?>">
                      </div>
                      <span class="ml-3 mb-2"><b>Contenido</b></span>
                      <div class="input-group mb-3 col-12">
                        <textarea class="form-control text-dark" id="content" rows="10" type="text" required><?php echo $contenido;?></textarea>
                      </div>
                      <form enctype="multipart/form-data" id="formulario" method="post">
                      <div class="col-12">
                        <div class="d-inline" id="file-preview-zone" style="width: 200px; heigth:50px;">
                          <img class="p-0 m-0" width="150px" src="img/<?php echo $imagen;?>" id="file-preview" />
                          <input type="hidden" name="bandera" value="1">
                        </div>
                        <div class="d-inline" id="divFileUpload">
                          <label class="btn btn-link" for="file-upload">Seleccionar Imagen</label>
                          <input class="form-group" id="file-upload" type="file" accept="image/*" hidden="hidden" name='imagen'/>
                        </div>
                      </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                      <a href="index.php" class="btn btn-outline-danger px-4 mr-5">Cancelar</a>
                      <button type="submit" class="btn btn-outline-primary">Aceptar</button>
                    </div>
                    </form>
                    <input type="hidden" name="id" value="<?php echo $id_articulo;?>">
                </div>
                <!-- Preview Imagen -->
                <script>
                  function readFile(input){
                    $("#file-preview-zone").empty();
                    if(input.files && input.files[0]){
                      var reader=new FileReader();
                      reader.onload=function(e){
                        var filePreview=document.createElement('img');
                        filePreview.id='file-preview';
                        filePreview.setAttribute("width","150");
                        //e.target.result contents the base64 data from the image uploaded
                        filePreview.src=e.target.result;
                        var previewZone=document.getElementById('file-preview-zone');
                        previewZone.appendChild(filePreview);
                      }
                      reader.readAsDataURL(input.files[0]);
                    }
                  }
                  var fileUpload=document.getElementById('file-upload');
                  fileUpload.onchange=function(e){
                    var imgPath=$(this)[0].value;
                    var extn=imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                    if (extn=="png" || extn=="jpg" || extn=="jpeg") {
                      readFile(e.srcElement);
                    }else{
                      const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:4000});
                      toast({type:'error',title:"¡Desbes subir imagenes tipo jpg, jpge o png"})
                    }
                  }
                </script>
                <!-- Enviar Logo -->
                <script>
                  $(document).ready(function(){
                    $("#formulario").on('submit',function(e){
                      e.preventDefault();
                      var formData=new FormData(this);
                      var id=$('input[name=id]').val();
                      var titulo=$('input[name=title]').val();
                      var autor=$('input[name=autor]').val();
                      var description=$('input[name=description]').val();
                      var keywords=$('input[name=keywords]').val();
                      var content=$('#content').val();
                      var bandera=$('input[name=bandera]').val();
                      formData.append("id",id);
                      formData.append("titulo",titulo);
                      formData.append("autor",autor);
                      formData.append("description",description);
                      formData.append("keywords",keywords);
                      formData.append("content",content);
                      if(bandera==1){formData.append("bandera",bandera);}
                      $.ajax({
                        type:'POST',
                        url:'ajax_edit_blog.php',
                        data:formData,
                        contentType:false,
                        cache:false,
                        processData:false,
                        success:function(respuesta){
                          if(respuesta=='1'){
                            const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:4000});
                            toast({type:'success',title:"¡Fue editada exitosamente!"});
                            window.location="index.php?a=1";
                          }else{
                            const toast=swal.mixin({toast:true,position:'top-end',showConfirmButton:false,timer:4000});
                            toast({type:'error',title:"Hubo un error! \n Vuelve a intentarlo."})
                          }
                        }
                      });
                    });
                  });
                </script>
                <?php
              }
            }
          }
          ?>
<?php include '../../admin/common/footer.php';?>
</div>
</div>
<!-- Bootstrp js and sweetalert2 --->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src='https://cdn.jsdelivr.net/npm/sweetalert2@7.29.0/dist/sweetalert2.all.min.js'></script>
</body>
</html>
