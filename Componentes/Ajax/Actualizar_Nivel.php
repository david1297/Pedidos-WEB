<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");
$Item=$_GET['Item'];
$Nivel=$_GET['Nivel'];
	$sql =  "UPDATE NIVEL_ITEM Set Nivel= $Nivel where Item =$Item   ;";
	$query_update = mysqli_query($con,$sql);
    if ($query_update) {
        echo "Los Datos Se Han Guardado Con Exito.";
    } else {
        echo "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
	}
?>



