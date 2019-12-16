<?php
session_start();
include '../common/conexion.php';
include '../cambioDolar/index.php';
include '../common/datosGenerales.php';
$_SESSION['factura']=false;
if(!isset($_SESSION['carrito'])){header('Location: ../index.php');}
if(!isset($_SESSION['USER'])){header('Location: ../login/index.php?c=1');}
if(isset($_SESSION['monto'])){$monto=$_SESSION['monto'];}
if(isset($_SESSION['total_items'])){$cantidad_total=$_SESSION['total_items'];}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="desciption" content="Rouxa, Tienda virtual de Ropa para Damas, Caballeros y Niños.">
  <meta name="keywords" content="Rouxa, Ropa, Damas, Caballeros, Zapatos, Tienda Virtual">
  <meta name="author" content="Eutuxia, C.A.">
  <meta name="application-name" content="Tienda Virtual de Ropa, <?php echo $nombrePagina;?>."/>
  <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
  <link rel="stylesheet" href="../css/new.css">
  <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
  <script src='https://www.google.com/recaptcha/api.js'></script>
  <title><?php echo $nombrePagina;?></title>
  <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
</head>
<body>
  <?php include '../common/menu.php';include '../common/2domenu.php';?>
  <div class="container mb-2">
    <div class="row align-items-center">
      <div class="col-auto text-center">
        <img src="../admin/img/<?php echo $imageLogo;?>" width="40px" height="auto">
      </div>
      <div class="col-auto text-center">
        <h2 style="font-family: 'Playfair Display', serif;">Solicitud de Compra</h2>
      </div>
      <div class="col-auto ml-auto">
        <a class="enlace2" href="index.php"><small>Carrito de compras </small></a> ->
        <small class="text-primary">Datos </small> ->
        <small class="text-muted">Pago</small>
      </div>
    </div>
  </div>
  <hr class="my-0">
    <?php
    if(isset($_SESSION['carrito'])){
      ?>
      <form action="cuentas_bancarias.php" method="POST" onsubmit="return validacion() && captch()">
        <div class="container">
          <div class="row">
            <div class="col-8 pt-3">
              <div class="row mb-4">
                <div class="col-6">
                  <h3 class="lead"><strong>Datos de envío</strong></h3>
                </div>
                <div class="col-auto ml-auto">
                  <span>
                    <input id="istienda" type="checkbox" onclick="Tienda()" name="istienda" value="false">
                    <label for="istienda">Voy a retirar en Tienda</label>
                  </span>
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-2 col-sm-6">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Estado</span>
                  </div>
                  <select class="custom-select input_datos" name="estado" id="estado" onchange="estados()">
                    <option value="Amazonas">Amazonas</option>
                    <option value="Anzoategui">Anzoátegui</option>
                    <option value="Apure">Apure</option>
                    <option value="Aragua">Aragua</option>
                    <option value="Barinas">Barinas</option>
                    <option value="Bolivar">Bolívar</option>
                    <option value="Carabobo">Carabobo</option>
                    <option value="Cojedes">Cojedes</option>
                    <option value="Delta Amacuro">Delta Amacuro</option>
                    <option value="Distrito Capital">Distrito Capital</option>
                    <option value="Falcon">Falcón</option>
                    <option value="Guarico">Guárico</option>
                    <option value="Lara">Lara</option>
                    <option value="Merida">Mérida</option>
                    <option value="Miranda">Miranda</option>
                    <option value="Monagas">Monagas</option>
                    <option value="Nueva Esparta">Nueva Esparta</option>
                    <option value="Portuguesa">Portuguesa</option>
                    <option value="Sucre">Sucre</option>
                    <option value="Tachira">Táchira</option>
                    <option value="Trujillo">Trujillo</option>
                    <option value="Vargas">Vargas</option>
                    <option value="Yaracuy">Yaracuy</option>
                    <option value="Zulia">Zulia</option>
                  </select>
                </div>
                <div class="input-group mb-2 col-sm-6">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Municipio</span>
                  </div>
                  <select class="custom-select input_datos" name="municipio" id="municipio">
                    <option value="Atures">Atures</option>
                    <option value="Alto Orinoco">Alto Orinoco</option>
                    <option value="Atabapo">Atabapo</option>
                    <option value="Autana">Autana</option>
                    <option value="Manapiare">Manapiare</option>
                    <option value="Maroa">Maroa</option>
                    <option value="Río Negro">Río Negro</option>
                  </select>
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-2 col-12">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Dirección</span>
                  </div>
                  <input class="form-control input_datos" type="text" name="direccion" id="direccion" maxlength="254"/>
                </div>
              </div>
              <div class="row">
                <div class="input-group mb-2 col-sm-5">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Código Postal</span>
                  </div>
                  <input class="form-control input_datos" type="text" name="postal" id="postal" maxlength="4"/>
                </div>
                <div class="input-group mb-2 col-sm-7">
                  <div class="input-group-prepend">
                    <label class="input-group-text">Agencia de Encomienda</label>
                  </div>
                  <select name="encomienda" id="encomienda" class="custom-select input_datos" required>
                    <option value="Domesa">Domesa</option>
                    <option value="MRW">MRW</option>
                    <option value="Tealca">Tealca</option>
                    <option value="Zoom">Zoom</option>
                    <option value="Tienda" hidden>Tienda</option>
                  </select>
                </div>
              </div>
              <div class="row ml-3">
                <small class="text-muted"><input id="isfacture" type="checkbox" onclick="Factura()" name="isfacture" value="true"> <label for="isfacture">Yo, deseo factura fiscal</label> </small>
              </div>
              <?php
              $razonSocial='';
              $rif='';
              $dirFiscal='';
              $sql="SELECT RAZONSOCIAL,RIFCI,DIRFISCAL FROM `usuarios` WHERE CORREO='$email_user'";
              $result=$conn->query($sql);
              if($result->num_rows>0){
                while($row=$result->fetch_assoc()){
                  $razonSocial=$row['RAZONSOCIAL'];
                  $rif=$row['RIFCI'];
                  $dirFiscal=$row['DIRFISCAL'];
                }
              }
               ?>
              <div class="row">
                <div class="input-group mb-2 col-sm-6">
                  <input type="text" placeholder="Razon Social" name="razon-social" id="razon-social" style="display: none" class="form-control" maxlength="255" value="<?php echo $razonSocial;?>">
                </div>
                <div class="input-group mb-2 col-sm-6">
                  <select class="text-center" name="type-identidad" id="type-identidad" style="display: none; border: 1px solid #ddd; width:20%; border-radius: 4px 0 0 4px;">
                    <option>J</option>
                    <option>P</option>
                    <option>G</option>
                  </select>
                  <input type="text" placeholder="Registro Único de Información Fiscal(RIF)" name="doc-identidad" id="doc-identidad" maxlength="22" style="display:none;" class="form-control" value="<?php echo $rif;?>">
                </div>
                <div class="input-group mb-2 col-12">
                  <input type="text" placeholder="Dirección Fiscal" name="dir-fiscal" id="dir-fiscal" style="display: none" class="form-control" maxlength="255" value="<?php echo $dirFiscal;?>">
                </div>
              </div>
              <div id="auxiliares"></div>
            </div>
            <div class="col-4 border_lateral pt-3">
              <h3 class="lead mb-4"><strong>Vas a comprar (<?php echo $cantidad_total;?>) artículo(s)</strong></h3>
              <?php
              $datos=$_SESSION['carrito'];
              $peso=0;
              foreach($datos as $d){
                $cantidad=$d['Cantidad'];
                $id_inventario=$d['Id'];
                $id_modelo=$d['IdModelo'];
                $titulo=$d['Nombre'];
                $imagen=$d['Imagen'];
                $talla=$d['Talla'];
                $precio=$d['Precio'];
                $total_modelo=$cantidad*$precio;
                $sql="SELECT * FROM TALLAS WHERE TALLA='$talla' LIMIT 1";
                $res=$conn->query($sql);
                if($res->num_rows>0){while($f=$res->fetch_assoc()){$id_talla=$f["IDTALLA"];}}
                ?>
                <div class="row">
                  <div class="col-3 text-center">
                    <img class="img-fluid" src="../admin/inventario/img/<?php echo $imagen;?>" width="50px" height="50px">
                  </div>
                  <div class="col-9">
                    <div class="row">
                      <small><?php echo substr($titulo,0,20);?></small>
                      <span class="ml-auto ">Bs. <?php echo number_format($total_modelo*round($dolar),2,',','.');?></span>
                    </div>
                    <div class="row">
                      <small class="text-muted"><?php echo $cantidad." (".$talla.")";?></small>
                    </div>
                  </div>
                </div>
                <br>
              <?php } ?>
              <hr class="mt-0">
              <div class="container mb-3">
                <div class="row justify-content-between align-items-center">
                  <strong class="col-auto lead">
                    Total:
                  </strong>
                  <strong class="col-auto">
                    Bs. <?php echo number_format($monto*round($dolar),2,',','.');?>
                  </strong>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr class="my-0">
        <div class="row justify-content-center mb-2 mt-4">
          <div class="col-auto text-center mb-3">
            <button class="btn btn-outline-success px-5" type="submit">Confirmar</button>
          </div>
          <div class="col-auto text-center mb-3">
            <a class="btn btn-outline-danger" href="../index.php">Cancelar</a>
          </div>
        </div>
        <input type="hidden" name="monto" value="<?php echo $monto;?>">
      </form>
    <?php }else{ ?>
      <div class="container">
        <div class="row justify-content-center py-5">
          <h2 class="">No hay productos añadidos en el carrito</h2>
        </div>
        <div class="row justify-content-center my-5">
          <a href="../index.php" class="btn btn-outline-dark col-4">Volver</a>
        </div>
      </div>
    <?php } ?>
    <?php include '../common/footer.php';?>
    <script>
      function captch(){
        var response = grecaptcha.getResponse();
        if(response.length == 0){
          alert("Captcha no verificado")
          return false;
        }else{ return true; }
      }
    </script>
    <script>
      function Factura(){
        var checkBox=document.getElementById("isfacture");
        var text1=document.getElementById("doc-identidad");
        var text2=document.getElementById("type-identidad");
        var text3=document.getElementById("dir-fiscal");
        var text4=document.getElementById("razon-social");
        // If the checkbox is checked, display the output text
        if (checkBox.checked==true){
          text1.style.display = "block";
          text2.style.display = "block";
          text3.style.display = "block";
          text4.style.display = "block";
        } else {
          text1.style.display = "none";
          text2.style.display = "none";
          text3.style.display = "none";
          text4.style.display = "none";
        }
      }
    </script>
    <!-- Municipios -->
    <script>
      function estados(){
        $('#municipio option').each(function(){$(this).remove();});
        var state=$('#estado').val();
        $.get('ajax_municipios.php',{state:state},verificar,'text');
        function verificar(respuesta){
          var municipios=respuesta.split(",");
          $.each(municipios,function(i,resultado){
            $('#municipio').append("<option value='"+resultado+"'>"+resultado+'</option>');
          });
        }
      };
    </script>
    <script>
      function Tienda(){
        var checkBox=document.getElementById("istienda");
        if(checkBox.checked==false){
          $("#estado").prop('disabled',false);
          $("#estado").val("");
          $("#municipio").prop('disabled',false);
          $("#municipio").val("");
          $("#direccion").prop('disabled',false);
          $("#direccion").val("").removeAttr("readonly");
          $("#postal").prop('disabled',false);
          $("#postal").val("").removeAttr("readonly");
          $("#encomienda").prop('disabled',false);
          $("#encomienda").val("");
          $("#auxiliares").empty();
        }else{
          $("#estado").val("Carabobo");
          $("#municipio").val("San Diego");
          $("#direccion").val("Sector Campo Solo, Calle 12, Local 2");
          $("#postal").val("1012");
          $("#encomienda").val("Tienda");
          $("#direccion").prop('readonly',"readonly");
          $("#postal").prop('readonly',"readonly");
          $("#estado").prop('disabled',true);
          $("#municipio").prop('disabled',true);
          $("#encomienda").prop('disabled',true);
          $("#auxiliares").append("<input type='hidden' name='encomienda_aux' value='Tienda'><input type='hidden' name='estado_aux' value='Carabobo'><input type='hidden' name='municipio_aux' value='San Diego'>");
        }
      }
    </script>
    <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
  </html>
