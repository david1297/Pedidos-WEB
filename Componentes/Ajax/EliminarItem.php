<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");

$Id=$_GET['Id'];

	$sql =  "UPDATE  temp_pedidod SET Estado='Eliminado' where Id =$Id;";
	$query_update = mysqli_query($con,$sql);
    if ($query_update) {
        $messages = "Los Datos Se Han Guardado Con Exito.";
    } else {
        $errors = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
	}
	 echo $sql;


?>



