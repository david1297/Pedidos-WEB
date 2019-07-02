<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");

$Id_N=$_GET['Id_N'];



	$sql =  "DELETE FROM  temp_pedidoe where Id_N =$Id_N;";
	$query_update = mysqli_query($con,$sql);
    if ($query_update) {
        $sql =  "DELETE FROM  temp_pedidod where Id_N =$Id_N and id<>0;";
        $query_update = mysqli_query($con,$sql);
        if ($query_update) {
            $messages = "Los Datos Se Han Guardado Con Exito.";
        }
    } else {
        $errors = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
	}
	 echo $sql;


?>



