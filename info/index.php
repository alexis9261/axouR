<?php
session_start();
include '../common/conexion.php';
include '../common/datosGenerales.php';
 ?>
<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta name="desciption" content="<?php echo $nombrePagina;?>, Tienda virtual de Ropa para Damas, Caballeros y Niños.">
    <meta name="keywords" content="<?php echo $nombrePagina;?>, Ropa, Damas, Caballeros, Zapatos, Tienda Virtual">
    <meta name="author" content="Eutuxia, C.A.">
    <meta name="application-name" content="Tienda Virtual de Ropa, <?php echo $nombrePagina;?>."/>
    <link rel="icon" type="image/jpg" sizes="16x16" href="<?php echo $root_folder;?>/admin/img/<?php echo $imageLogo;?>">
    <link rel="stylesheet" href="../css/new.css">
    <link href="../admin/assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?php echo $nombrePagina;?></title>
  </head>
  <body>
    <?php include '../common/menu.php'; include '../common/2domenu.php'; ?>
   <div style="min-height:100vh; background: #fff;">
    <?php
        if($_GET){
             switch($_GET['id']){
                 case 1:
                     ?>
         <div class="container-fluid p-3">
            <h1 id="letrap" class="text-primary text-center">
              Ventas Al Mayor
            </h1>
            <hr class="my-4">
         </div>
         <div class="container-fluid">
           <div class="row justify-content-center">
             <div class="col-sm-8 text-center">
                <div class="container" id="ac1">
                  <div class="row justify-content-center">
                    <div id="uno">
                        <a href="javascript:void(0)" class="btn btn-link mb-2" data-toggle="collapse" data-target="#cuno" aria-expanded="true" aria-controls="collapseOne">
                            ¿A partir de cuantas piezas?
                        </a>
                    </div>
                    <div id="cuno" class="collapse" aria-labelledby="uno" data-parent="#ac1">
                      <div>
                        Las ventas Al Mayor se tomarán en cuenta a partir de 12 piezas.
                      </div>
                    </div>
                  </div>
                  <hr class="hr">
                  <div class="row justify-content-center">
                    <div id="tres">
                        <a href="javascript:void(0)" class="btn btn-link mb-2" data-toggle="collapse" data-target="#ctres" aria-expanded="false" aria-controls="collapseThree">
                          ¿Puedo elegir diferentes modelos?
                        </a>
                    </div>
                    <div id="ctres" class="collapse" aria-labelledby="tres" data-parent="#ac1">
                      <div>
                        Si, Puedes seleccionar todos los modelos y productos que desees, siempre y cuando sea a partir de 12 piezas.
                      </div>
                    </div>
                  </div>
                  <hr class="hr">
                  <div class="row justify-content-center">
                    <div id="cuatro">
                        <a href="javascript:void(0)" class="btn btn-link mb-2 d-block" data-toggle="collapse" data-target="#ccuatro" aria-expanded="false" aria-controls="collapseThree">
                          ¿Las tallas pueden ser variadas?
                        </a>
                    </div>
                    <div id="ccuatro" class="collapse" aria-labelledby="cuatro" data-parent="#ac1">
                      <div>
                        Por supuesto, puedes seleccionar las tallas que desees.<br>
                        En cualquier combinación que quieras elegir.
                      </div>
                    </div>
                  </div>
                  <hr class="hr">
                  <div class="row justify-content-center">
                    <div class="d-block" id="cinco">
                        <a href="javascript:void(0)" class="btn btn-link mb-2" data-toggle="collapse" data-target="#ccinco" aria-expanded="false" aria-controls="collapseThree">
                          ¿Cuales son las ofertas que podré obtener?
                        </a>
                    </div>
                    <div id="ccinco" class="collapse" aria-labelledby="cinco" data-parent="#ac1">
                      <div>
                        Son las mejores ofertas:<br>
                        - A partir de 1 Docena (12 piezas) hasta 4 Docenas, Recibirás un descuento del 5%.<br>
                        - A partir de 5 Docenas hasta 9 Docenas, recibirás un descuento del 8%.<br>
                        - A partir de 10 Docenas en adelante, recibirás un descuento del 10%.
                      </div>
                    </div>
                  </div>
                  <hr class="hr">
                </div>
              </div>
            </div>
          </div>
          <div class="container text-center my-3">
            <a class="btn btn-outline-dark" href="index.php">Volver</a>
          </div>
                     <?php
                     break;
                 case 2:
                       ?>
     <div class="container p-3">
        <h1 id="letrap" class="text-primary  text-center">
          Envíos y entregas
        </h1>
        <hr class="my-4">
     </div>
     <div class="container">
       <div class="row justify-content-center">
         <div class="col-8 text-center">
          <div class="container" id="accordionExample">
            <div class="row justify-content-center">
              <div id="hone">
                  <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#one" aria-expanded="true" aria-controls="collapseOne">
                    ¿Cuánto tiempo tardan en hacer los envíos?
                  </a>
              </div>
              <div id="one" class="collapse" aria-labelledby="hone" data-parent="#accordionExample">
                <div>
                  Los envíos los realizamos de 24 a 48 horas, a partir de la confirmación en nuestras cuentas el pago del pedido.
                </div>
              </div>
            </div>
            <hr class="hr">
            <div class="row justify-content-center">
              <div id="htwo">
                  <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#two" aria-expanded="false" aria-controls="collapseTwo">
                    ¿Cuánto tardará mi pedido en llegar?
                  </a>
              </div>
              <div id="two" class="collapse" aria-labelledby="htwo" data-parent="#accordionExample">
                <div>
                  Todo dependerá de la empresa de encomiendas, del lugar de destino, y de la fecha en la cual se realiza el envío (feriados, fin de semana). En promedio tarda de 2 a 7 días en llegar.
                </div>
              </div>
            </div>
            <hr class="hr">
            <div class="row justify-content-center">
              <div id="hthree">
                  <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#three" aria-expanded="false" aria-controls="collapseThree">
                    ¿Cómo se cancela el costo del envío?
                  </a>
              </div>
              <div id="three" class="collapse" aria-labelledby="hthree" data-parent="#accordionExample">
                <div>
                  Todos los envíos son realizados con cobro en destino, si desea otro medio de envío, consulte con en <a href="../contacto/atencion.php" target="_blank">atencion cercana</a>.
                </div>
              </div>
            </div>
            <hr class="hr">
            <div class="row justify-content-center">
              <div id="hfour">
                  <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#four" aria-expanded="false" aria-controls="collapseThree">
                    ¿Cómo realizan los envíos?
                  </a>
              </div>
              <div id="four" class="collapse" aria-labelledby="hfour" data-parent="#accordionExample">
                <div>
                  Todos los envíos son realizados con cobro en destino, si desea otro medio de envío, consulte con nosotros.
                </div>
              </div>
            </div>
            <hr class="hr">
            <div class="row justify-content-center">
              <div id="hfive">
                  <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#five" aria-expanded="false" aria-controls="collapseThree">
                    ¿A qué hora realizan los envíos?
                  </a>
              </div>
              <div id="five" class="collapse" aria-labelledby="hfive" data-parent="#accordionExample">
                <div>
                  Todos los envíos son realizados de Lunes a Viernes a las 3:00PM. Sin Excepción.
                </div>
              </div>
            </div>
            <hr class="hr">
            <div class="row justify-content-center">
              <div id="hsix">
                  <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#six" aria-expanded="false" aria-controls="collapseThree">
                    ¿Podrian enviar mi pedido pago?
                  </a>
              </div>
              <div id="six" class="collapse" aria-labelledby="hsix" data-parent="#accordionExample">
                <div>
                  Si, los pedidos los podemos enviar pagos desde la oficina de encomiendas. Sin embargo el cliente deberá cancelar el monto del envío antes de nosotros realizarlo.
                </div>
              </div>
            </div>
            <hr class="hr">
            <div class="row justify-content-center">
              <div id="hseven">
                  <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#seven" aria-expanded="false" aria-controls="collapseThree">
                    ¿Cómo realizan los envíos?
                  </a>
              </div>
              <div id="seven" class="collapse" aria-labelledby="hseven" data-parent="#accordionExample">
                <div>
                  Todos los envíos son realizados con cobro en destino, si desea otro medio de envío, consulte con nosotros.
                </div>
              </div>
            </div>
            <hr class="hr">
            <div class="row justify-content-center">
              <div id="height">
                  <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#eight" aria-expanded="false" aria-controls="collapseThree">
                    ¿Cómo compruebo el estado de mi pedido?
                  </a>
              </div>
              <div id="eight" class="collapse" aria-labelledby="height" data-parent="#accordionExample">
                <div>
                  El estado de tu pedido lo puedes conocer entrando a tu perfil, en la sección "Mis compras".
                </div>
              </div>
            </div>
            <hr class="hr">
            <div class="row justify-content-center">
              <div id="hnine">
                  <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#nine" aria-expanded="false" aria-controls="collapseThree">
                    ¿Pueden hacer envíos a otro País?
                  </a>
              </div>
              <div id="nine" class="collapse" aria-labelledby="hnine" data-parent="#accordionExample">
              <div>
                 Si, pero debes contactarnos antes de realizar la compra.
              </div>
            </div>
            <hr class="hr">
            </div>
          </div>
        </div>
      </div>
     </div>
     <div class="container text-center my-3">
       <a class="btn btn-outline-dark" href="index.php">Volver</a>
     </div>
                     <?php
                      break;
                 case 3:
                       ?>
       <div class="container p-3">
          <h1 id="letrap" class="text-primary  text-center">
            Devoluciones y Reembolsos
          </h1>
          <hr class="my-4">
       </div>
       <div class="container">
         <div class="row justify-content-center">
           <div class="col-8 text-center">
            <div class="container" id="accordionExample">
              <div class="row justify-content-center">
                <div id="hone">
                    <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#one" aria-expanded="true" aria-controls="collapseOne">
                      ¿Puedo devolver un producto que no me haya gustado?
                    </a>
                </div>
                <div id="one" class="collapse" aria-labelledby="hone" data-parent="#accordionExample">
                  <div>
                    No, Sólo podrás devolver los productos que te hayan llegado con defectos de fabrica.
                  </div>
                </div>
              </div>
              <hr class="hr">
              <div class="row justify-content-center">
                <div id="htwo">
                    <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#two" aria-expanded="false" aria-controls="collapseTwo">
                      ¿Cuánto tiempo tengo para realizar una devolución?
                    </a>
                </div>
                <div id="two" class="collapse" aria-labelledby="htwo" data-parent="#accordionExample">
                  <div>
                    Tienes 15 días para realizar la devolución de tu pedido. Contados a partir del momento en que retiras el pedido en la oficina de la empresa de encomiendas.
                  </div>
                </div>
              </div>
              <hr class="hr">
              <div class="row justify-content-center">
                <div id="hthree">
                    <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#three" aria-expanded="false" aria-controls="collapseThree">
                      ¿Puedo devolver la mercancía y pedir a cambio mi dinero de vuelta?
                    </a>
                </div>
                <div id="three" class="collapse" aria-labelledby="hthree" data-parent="#accordionExample">
                  <div>
                    No, los reembolsos solo lo hacemos si la mercancía cuenta con defectos de fabrica.
                  </div>
                </div>
              </div>
              <hr class="hr">
              <div class="row justify-content-center">
                <div id="hfour">
                  <h5 class="mb-0">
                    <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#four" aria-expanded="false" aria-controls="collapseThree">
                      ¿Me abonarán los gastos de envío si realizo la devolución de un producto?
                    </a>
                  </h5>
                </div>
                <div id="four" class="collapse" aria-labelledby="hfour" data-parent="#accordionExample">
                  <div>
                    No, los gastos del envío son montos pagados a la empresa de encomiendas, por lo cual nosotros no podemos devolver ese costo.
                  </div>
                </div>
              </div>
              <hr class="hr">
              <div class="row justify-content-center">
                <div id="hfive">
                    <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#five" aria-expanded="false" aria-controls="collapseThree">
                      ¿Se puede cambiar un producto por otro?
                    </a>
                </div>
                <div id="five" class="collapse" aria-labelledby="hfive" data-parent="#accordionExample">
                  <div>
                    Si, pero deberás cancelar la diferencia. Ademas que deberás pagar el costo del nuevo envío.
                  </div>
                </div>
              </div>
              <hr class="hr">
              <div class="row justify-content-center">
                <div id="hsix">
                    <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#six" aria-expanded="false" aria-controls="collapseThree">
                      ¿Cuándo recibiré el reembolso?
                    </a>
                </div>
                <div id="six" class="collapse" aria-labelledby="hsix" data-parent="#accordionExample">
                  <div>
                    Recibirás el rembolso en un plazo de 14 días naturales a partir de que: <br>
                    Hayamos recibido el pedido devuelto en nuestros almacenes; o
                    nos comuniques tu decisión de revocar el contrato de compra. En ese plazo de 14 días (a) deberás enviarnos una prueba de que has devuelto tu pedido o (b) recibiremos tu pedido online en nuestro almacén. <br>
                    Una vez hayas entregado el paquete al servicio de mensajería, tardará entre 3 - 5 días laborables en llegar a nuestro almacén. Cuando recibamos los productos devueltos, nos colocaremos en contacto contigo.
                  </div>
                </div>
              </div>
              <hr class="hr">
              <div class="row justify-content-center">
                <div id="hseven">
                    <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#seven" aria-expanded="false" aria-controls="collapseThree">
                      ¿Qué debo hacer si el paquete fue robado o extraviado por la agencia de encomiendas?
                    </a>
                </div>
                <div id="seven" class="collapse" aria-labelledby="hseven" data-parent="#accordionExample">
                  <div>
                    Deberás ponerte en contacto con la agencia de encomiendas, y presentarles tu situación para que puedan solucionar tu problema. <?php echo $nombrePagina;?>, C.A. no se hace responsable por los problemas ocasionados por la(s) empresa(s) de encomienda.
                  </div>
                </div>
              </div>
              <hr class="hr">
            </div>
          </div>
        </div>
       </div>
       <div class="container text-center my-3">
         <a class="btn btn-outline-dark" href="index.php">Volver</a>
       </div>
                     <?php
                     break;
                 case 4:
                       ?>
       <div class="container p-3">
          <h1 id="letrap"  class="text-primary text-center">
            Métodos de pago
          </h1>
          <hr class="my-4">
       </div>
       <div class="container">
         <div class="row justify-content-center">
           <div class="col-8 text-center">
              <div class="container" id="ac1">
                <div class="row justify-content-center">
                  <div id="onei">
                    <h5 class="mb-0">
                      <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#cone" aria-expanded="true" aria-controls="collapseOne">
                        ¿Qué métodos de pago aceptan?
                      </a>
                    </h5>
                  </div>
                  <div id="cone" class="collapse" aria-labelledby="onei" data-parent="#ac1">
                    <div class="card-body">
                      Actualmente, aceptamos solo transferencias bancarias a nuestras cuentas bancarias.
                    </div>
                  </div>
                </div>
                <hr class="hr">
                <div class="row justify-content-center">
                  <div id="twoi">
                      <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#ctwo" aria-expanded="false" aria-controls="collapseTwo">
                        ¿Comó reporto una transacción bancaria?
                      </a>
                  </div>
                  <div id="ctwo" class="collapse" aria-labelledby="twoi" data-parent="#ac1">
                    <div>
                      Para registrar una transacción bancaria, debes dirigirte a tu perfil, a la sección "Mis compras", alli debes ir a la compra correspondiente y registrar el pago en el boton azul "Registrar un pago".
                    </div>
                  </div>
                </div>
                <hr class="hr">
                <div class="row justify-content-center">
                  <div id="tres">
                      <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#ctres" aria-expanded="false" aria-controls="collapseThree">
                        ¿Puedo pagar mi pedido con dinero en efectivo o cheque?
                      </a>
                  </div>
                  <div id="ctres" class="collapse" aria-labelledby="tres" data-parent="#ac1">
                    <div>
                      No aceptamos cheques, giros bancarios o dinero en efectivo como pago por tu pedido. Los métodos de pago aceptados se indican en los terminos y condiciones.
                    </div>
                  </div>
                </div>
                <hr class="hr">
                <div class="row justify-content-center">
                  <div id="tres3">
                      <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#ctres3" aria-expanded="false" aria-controls="collapseThree">
                        ¿Puedo pagar mi pedido con mas de una transacción bancaria?
                      </a>
                  </div>
                  <div id="ctres3" class="collapse" aria-labelledby="tres3" data-parent="#ac1">
                    <div>
                      Si, puedes reportar más de un pago por transacción bancaria en la plataforma, Pero recuerda que debes cancelar el monto total de la transaccion lo mas pronto posible. Nos reservamos el derecho a cancelar la compra si has prolongado por mucho tiempo el pago total.
                    </div>
                  </div>
                </div>
                <hr class="hr">
              </div>
            </div>
          </div>
        </div>
        <div class="container text-center my-3">
          <a class="btn btn-outline-dark" href="index.php">Volver</a>
        </div>
                     <?php
                      break;

                 case 5:
                       ?>
       <div class="container p-3">
          <h1 id="letrap"  class="text-primary text-center">
            Seguimiento de pedidos
          </h1>
          <hr class="my-4">
       </div>
       <div class="container">
         <div class="row justify-content-center">
           <div class="col-sm-8 text-center">
            </div>
          </div>
        </div>
        <div class="container text-center my-3">
          <a class="btn btn-outline-dark" href="index.php">Volver</a>
        </div>
                     <?php
                     break;
                 case 6:
                       ?>
                       <div class="container p-3">
                          <h1 id="letrap"  class="text-primary text-center">
                            Vendedores
                          </h1>
                          <hr class="my-4">
                       </div>
                     <?php
                      break;
                 case 7:
                       ?>
                       <div class="container p-3">
                          <h1 id="letrap"  class="text-primary text-center">
                            Promociones
                          </h1>
                          <hr class="my-4">
                       </div>
                     <?php
                     break;
                 case 8:
                       ?>
       <div class="container p-3">
          <h1 id="letrap" class="text-primary text-center">
            Retiros en tienda
          </h1>
          <hr class="my-4">
       </div>
       <div class="container">
         <div class="row justify-content-center">
           <div class="col-8 text-center">
              <div class="container" id="ac1">
                <hr class="hr">
                <div class="row justify-content-center">
                  <div id="twoi">
                      <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#ctwo" aria-expanded="false" aria-controls="collapseTwo">
                        ¿Donde esta ubicada su tienda Fisica?
                      </a>
                  </div>
                  <div id="ctwo" class="collapse" aria-labelledby="twoi" data-parent="#ac1">
                    <div>
                      Nuestra tienda esta ubicada en la Calle 95-A, Av Lara Nro. Civico 103-50 CC Gran Bazar Nivel PA,
                      Local Mini Local 65-66-67, Sector Candelaria, Valencia, Carabobo. Zona Postal 2001.
                    </div>
                  </div>
                </div>
                <hr class="hr">
                <div class="row justify-content-center">
                  <div id="tresi">
                      <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#ctres" aria-expanded="false" aria-controls="collapseTwo">
                        ¿A que Horario puedo retirar por tienda Fisica?
                      </a>
                  </div>
                  <div id="ctres" class="collapse" aria-labelledby="twoi" data-parent="#ac1">
                    <div>
                      Puede retirar su pedido, de Lunes a Viernes. En Horario de 9:00 AM a 12:00 PM y 2:00 PM a 5:30PM.
                    </div>
                  </div>
                </div>
                <hr class="hr">
              </div>
            </div>
          </div>
        </div>
        <div class="container text-center my-3">
          <a class="btn btn-outline-dark" href="index.php">Volver</a>
        </div>
                     <?php
                      break;
                 case 9:
                       ?>
       <div class="container p-3">
          <h1 id="letrap"  class="text-primary text-center">
            Información de <?php echo $nombrePagina;?>
          </h1>
          <hr class="my-4">
       </div>
       <div class="container">
         <div class="row justify-content-center">
           <div class="col-8 text-center">
              <div class="container" id="ac1">
                <div class="row justify-content-center">
                  <div id="onei">
                      <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#cone" aria-expanded="true" aria-controls="collapseOne">
                        ¿Qué es <?php echo $nombrePagina;?>?
                      </a>
                  </div>
                  <div id="cone" class="collapse" aria-labelledby="onei" data-parent="#ac1">
                    <div>
                      <?php echo $nombrePagina;?> es la Tienda virtual (E-commerce) de la empresa Venezolana <?php echo $nombrePagina;?> C.A., fabricante de ropa de alta calidad y confort, cumpliendo con los estándares exigidos por nuestros clientes nacionales e internacionales.
                    </div>
                  </div>
                </div>
                <hr class="hr">
                <div class="row justify-content-center">
                  <div id="twoi">
                      <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#ctwo" aria-expanded="false" aria-controls="collapseTwo">
                        ¿Cuál es la visión de <?php echo $nombrePagina;?> C.A.?
                      </a>
                  </div>
                  <div id="ctwo" class="collapse" aria-labelledby="twoi" data-parent="#ac1">
                    <div>
                      <?php echo $nombrePagina;?> C.A. tiene como vision: "Vestir a las comunidades del nuevo continente considerando sus culturas y raíces originarias".
                    </div>
                  </div>
                </div>
                <hr class="hr">
                <div class="row justify-content-center">
                  <div id="tres">
                      <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#ctres" aria-expanded="false" aria-controls="collapseThree">
                        ¿Que intereses sociales persigue <?php echo $nombrePagina;?> C.A?
                      </a>
                  </div>
                  <div id="ctres" class="collapse" aria-labelledby="tres" data-parent="#ac1">
                    <div>
                      <?php echo $nombrePagina;?> C.A. cree en la familia como pilar fundamental de la sociedad. Por lo que, el fortalecimiento de valores familiares en la sociedad Venezolana es el principal interes social de la empresa.
                    </div>
                  </div>
                </div>
                <hr class="hr">
              </div>
            </div>
          </div>
        </div>
        <div class="container text-center my-3">
          <a class="btn btn-outline-dark" href="index.php">Volver</a>
        </div>
              <?php
                      break;
                  case 10:
                        ?>
              <div class="container p-3">
              <h1 id="letrap" class="text-primary text-center">
                Publicar en <?php echo $nombrePagina;?>
              </h1>
              <hr class="my-4">
              </div>
              <div class="container">
              <div class="row justify-content-center">
              <div class="col-8 text-center">
               <div class="container" id="ac1">
                 <div class="row justify-content-center">
                   <div id="onei">
                       <a href="javascript:void(0)" class="btn btn-link" data-toggle="collapse" data-target="#cone" aria-expanded="true" aria-controls="collapseOne">
                         ¿Puedo publicar mi ropa en la página de <?php echo $nombrePagina;?>?
                       </a>
                   </div>
                   <div id="cone" class="collapse" aria-labelledby="onei" data-parent="#ac1">
                     <div>
                       Si, por supuesto puedes publicar todos los modelos y diseños que tengas.
                     </div>
                   </div>
                 </div>
                 <hr class="hr">
                 <div class="row justify-content-center">
                   <div id="twoi">
                       <a href="javascript:void(0)" class="btn btn-link collapsed" data-toggle="collapse" data-target="#ctwo" aria-expanded="false" aria-controls="collapseTwo">
                         ¿Como podría publicar en la página?
                       </a>
                   </div>
                   <div id="ctwo" class="collapse" aria-labelledby="twoi" data-parent="#ac1">
                     <div>
                       Para publicar en nuestra página, debes ponerte en contacto con nosotros. Ve a <a href="../contacto/atencion.php">Atención cercana</a> y pregunta que debes
                       hacer para poder publicar todos tus diseños en nuestra página.
                     </div>
                   </div>
                 </div>
                 <hr class="hr">
               </div>
              </div>
              </div>
              </div>
              <div class="container text-center my-3">
              <a class="btn btn-outline-dark" href="index.php">Volver</a>
              </div>
                      <?php
                       break;
                 default:
                       ?>
                       <div class="container">
                          <h1 id="letrap" class="text-primary">
                            No hay Preguntas frecuentes resgistradas.
                          </h1>
                        </div>
                     <?php
                     break;
             }
        }else{
              ?>
              <div class="container p-3">
                <h1 class="text-center text-primary mb-5">Preguntas Frecuentes(FAQ)</h1>
                <div class="row justify-content-center mt-5">
                  <div class="col-sm-5">
                    <div class="bg-dark row p-3 justify-content-center">
                      <a href="index.php?id=9" class="text-white">Información de <?php echo $nombrePagina;?></a>
                    </div>
                    <div class="bg-dark row p-3 justify-content-center">
                      <a href="index.php?id=2" class="text-white">Envíos</a>
                    </div>
                    <div class="bg-dark row p-3 justify-content-center">
                      <a href="index.php?id=3" class="text-white">Devoluciones y Reembolsos</a>
                    </div>
                    <div class="bg-dark row p-3 justify-content-center">
                      <a href="index.php?id=4" class="text-white">Métodos de pago</a>
                    </div>
                    <div class="bg-dark row p-3 justify-content-center">
                      <a href="index.php?id=8" class="text-white">Retiros en tienda</a>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="bg-dark row p-3 justify-content-center">
                      <a href="index.php?id=1" class="text-white">Al Mayor</a>
                    </div>
                    <div class="bg-dark row p-3 justify-content-center">
                      <a href="index.php?id=5" class="text-white">Seguimiento de Pedidos</a>
                    </div>
                    <div class="bg-dark row p-3 justify-content-center">
                      <a href="index.php?id=6" class="text-white">Vendedores</a >
                    </div>
                    <div class="bg-dark row p-3 justify-content-center">
                      <a href="index.php?id=7" class="text-white">Promociones</a>
                    </div>
                    <div class="bg-dark row p-3 justify-content-center">
                      <a href="index.php?id=10" class="text-white">Publicar en <?php echo $nombrePagina;?></a>
                    </div>
                  </div>
                </div>
               </div>
         <?php
        }
        ?>
   </div>
   <?php include_once '../common/footer.php';?>
     <script src="../admin/assets/libs/jquery/dist/jquery.min.js"></script>
     <script src="../admin/assets/libs/popper.js/dist/umd/popper.min.js"></script>
     <script src="../admin/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
