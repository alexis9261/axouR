<?php
$servername="localhost";
//servidor
/*$username="c1660046_mavic";
$password="fiFUve02ta";
$dbname="c1660046_mavic";*/
//localhost
$username="root";
$password="";
$dbname="rouxa2";
// Create connection
$conn=new mysqli($servername,$username,$password,$dbname);
$conn->set_charset("utf8");
if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
//defino una variable donde se guardara la direccion inicial del proyecto
//--local--

$root_folder="http://localhost/Rouxa";
//--para servidor--
//$root_folder=""; // prints '/home/public_html/'
$nombrePagina="Rouxa";
$imageLogo="logo.png";
