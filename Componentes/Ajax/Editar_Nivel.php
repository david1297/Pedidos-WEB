<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");
$Codigo=$_POST['Codigo'];
$Desde1=$_POST['Desde1'];
$Hasta1=$_POST['Hasta1'];
$Desde2=$_POST['Desde2'];
$Hasta2=$_POST['Hasta2'];
$Desde3=$_POST['Desde3'];
$Hasta3=$_POST['Hasta3'];
$Desde4=$_POST['Desde4'];
$Hasta4=$_POST['Hasta4'];
$Desde5=$_POST['Desde5'];
$Hasta5=$_POST['Hasta5'];
$Desde6=$_POST['Desde6'];


	$sql =  "UPDATE NIVELES Set Desde1=$Desde1,Hasta1 =$Hasta1,Desde2=$Desde2,Hasta2 =$Hasta2,
                Desde3=$Desde3,Hasta3 =$Hasta3,Desde4=$Desde4,Hasta4 =$Hasta4,
                Desde5=$Desde5,Hasta5 =$Hasta5,Desde6=$Desde6 where Codigo =$Codigo ;";
	$query_update = mysqli_query($con,$sql);
    if ($query_update) {
        echo "Los Datos Se Han Guardado Con Exito.";
    } else {
        echo "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
	}
	


?>



