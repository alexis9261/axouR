<?php
$servername="66.97.37.59";
//servidor
/*$username="id4956438_rouxa";
$password="rouxarouxabd";
$dbname="id4956438_rouxa";*/
//localhost
$username="carlos";
$password="Cm20184865";
$dbname="ROUXA";
// Create connection
$conn=new mysqli($servername,$username,$password,$dbname);
$conn->set_charset("utf8");
if($conn->connect_error){die("Connection failed: ".$conn->connect_error);}
//defino una variable donde se guardara la direccion inicial del proyecto
//--local--
//$root_folder="http://localhost/Rouxa/";
//--para servidor--
$root_folder=""; // prints '/var/www/axouR/'
$nombrePagina="Rouxa";
$imageLogo="logo.png";
