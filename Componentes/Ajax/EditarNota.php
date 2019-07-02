<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");
$Id_N=$_POST['Id_N'];
$Comentario=$_POST['Comentario'];

	$sql =  "UPDATE temp_pedidoe Set COMENTARIO='$Comentario' where Id_N =$Id_N ;";
	$query_update = mysqli_query($con,$sql);
    if ($query_update) {
        $messages = "Los Datos Se Han Guardado Con Exito.";
    } else {
        $errors = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
	}
	 echo $sql;


?>



