<?php
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
    $Id_N = $_GET['Id_N'];
    $Fecha = $_GET['Fecha'];

      $sql =  "UPDATE TEMP_PEDIDOE Set FechaEntrega='".date("Y/m/d",strtotime($Fecha))."' where  Id_N ='$Id_N';";

      $query_update = mysqli_query($con,$sql);
     ?>
  