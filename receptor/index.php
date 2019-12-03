<?php
$Fichero = "registros.txt"; //nombre del fichero donde se guardan los informes.
$ip = $_SERVER["REMOTE_ADDR"]; //guarda en la variable el ip
$fecha = date("Y-m-d;H:i:s"); //fecha y hora (por lo general del servidor)
$sistema = $_SERVER['HTTP_USER_AGENT']; //Esto nos genera varios datos del navegador y del sistema operativo
$conproxy = $_SERVER["HTTP_X_FORWARDED_FOR"]; //En caso de usar proxy para esconderse aqui estaria el ip real
$host= $_SERVER["HTTP_HOST"];
$url= $_SERVER["REQUEST_URI"];
$log = "FECHA: $fecha SISTEMA: $sistema IP: $ip IPPROXY: $conproxy URL: http:// $host $url" ;

$fp = fopen($Fichero, "a" );
fwrite($fp, $log);
fclose($fp);
?>

<?php
  require_once '../Common/conexion.php';
  require_once '../Common/mercadopago.php';

$mp = new MP('1153047962046613', 'i3RGdgCvJXrKT1ceMNOHs4YLNHdgZ9Mj');

if (!isset($_GET["data_id"], $_GET["type"]) || !ctype_digit($_GET["data_id"])) {
    http_response_code(400);
    return;
}

$topic = $_GET["type"];
$merchant_order_info = null;

switch ($topic) {
    case 'payment':
        $payment_info = $mp->get("/v1/payments/".$_GET["data_id"]);
        $merchant_order_info = $mp->get("/merchant_orders/".$payment_info["response"]["order"]["id"]);
        break;
    case 'merchant_order':
        $merchant_order_info = $mp->get("/merchant_orders/".$_GET["data_id"]);
        break;
    default:
        $merchant_order_info = null;
}

if($merchant_order_info == null) {
    echo "Error obtaining the merchant_order";
    die();
}

if ($merchant_order_info["status"] == 200) {

   // If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items
	$paid_amount = 0;

    $id_mp= $merchant_order_info["response"]["external_reference"];
  //  $id_mp=md5($id_mp);

	foreach ($merchant_order_info["response"]["payments"] as  $payment) {
		if ($payment['status'] == 'approved'){
			$paid_amount += $payment['transaction_amount'];
		}
	}
	if($paid_amount >= $merchant_order_info["response"]["total_amount"]){
		if(count($merchant_order_info["response"]["shipments"]) > 0) { // The merchant_order has shipments
  			if($merchant_order_info["response"]["shipments"][0]["status"] == "ready_to_ship"){
        print_r("Totally paid. Print the label and release your item.");
			}
		} else { // The merchant_order don't has any shipments
		//	print_r("Totally paid. Release your item.");

            #Cambia el estatus del pedido - Por Buscar
             $sql0="UPDATE `PEDIDOS` SET `ESTATUS`='3' WHERE  `IDPEDIDO`='$id_mp'";
                if ($conn->query($sql0) === TRUE) {
                } else {
                echo "Error: " . $sql0 . "<br>" . $conn->error;
                }
            #informar al encargado de empaquetar
            $sql1="SELECT CORREO FROM USUARIOS WHERE NIVEL=4 LIMIT 1";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $destino=$row['CORREO']; // dESPACHADOR
                $titulo="Nueva Compra";
                $contenido = '<html>
                              <head>
                              <title>Rouxa</title>
                              </head>
                              <body>
                              <h1>Nueva compra en rouxa</h1>
                              <p>¡Hola! Administrador rouxa,</p>
                              <p>Un nuevo cliente ha realizado una compra, Revisa el tablero de empaquetar, Lo mas pronto posible.</p>
                              <p>Que tenga un Feliz Dia.</p>
                              </body>
                              </html>';
                $headers = "From: Rouxa <Rouxavzla@gmail.com>" . "\r\n";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                mail($destino, $titulo, $contenido, $headers);
            }else{
              $destino='rouxavzla@gmail.com'; // dESPACHADOR
              $titulo="Nueva Compra";
              $contenido = '<html>
                            <head>
                            <title>Rouxa</title>
                            </head>
                            <body>
                            <h1>Nueva compra en rouxa</h1>
                            <p>¡Hola! Administrador rouxa,</p>
                            <p>Un nuevo cliente ha realizado una compra, Revisa el tablero de empaquetar, Lo mas pronto posible.</p>
                            <p>Que tenga un Feliz Dia.</p>
                            </body>
                            </html>';
              $headers = "From: Rouxa <Rouxavzla@gmail.com>" . "\r\n";
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              mail($destino, $titulo, $contenido, $headers);
            }

		}
	} else {
	//	print_r("Not paid yet. Do not release your item.");
        $sql0="UPDATE `PEDIDOS` SET `ESTATUS`='10' WHERE  `IDPEDIDO`='$id_mp'";
                        if ($conn->query($sql0) === TRUE) {
                        } else {
                        echo "Error: " . $sql0 . "<br>" . $conn->error;
                        }
	}
}
?>
