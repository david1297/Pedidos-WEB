<?php
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
    $Id_N = $_GET['Id_N'];
    $Dir = $_GET['Dir'];
      $sql =  "UPDATE TEMP_PEDIDOE Set succliente=$Dir where  Id_N ='$Id_N';";
      $query_update = mysqli_query($con,$sql);
     ?>
  