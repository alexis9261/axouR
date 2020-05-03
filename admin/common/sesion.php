<?php
session_start();
if (!isset($_SESSION['USUARIO'])) {
  session_destroy();
  header("Location: $root_folder/admin/index.php");
}
 ?>
