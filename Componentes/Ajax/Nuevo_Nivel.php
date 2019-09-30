<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");

	$sql =  "INSERT INTO  NIVELES (Desde1,Hasta1,Desde2,Hasta2,Desde3,Hasta3,Desde4,Hasta4,
                Desde5,Hasta5,Desde6) VALUES(0,0,0,0,0,0,0,0,0,0,0) ;";
	$query_update = mysqli_query($con,$sql);
    if ($query_update) {
        echo "Los Datos Se Han Guardado Con Exito.";
    } else {
        echo "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
	}
	


?>



