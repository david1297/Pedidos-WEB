<?php
session_start();
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");
$Item=$_POST['Item'];
$Precio=$_POST['Precio'];
$Cantidad=$_POST['Cantidad'];
$Comentario=$_POST['Comentario'];
$Id_N=$_POST['Id_N'];
$Subtotal = $Cantidad * $Precio;
$sql="SELECT PORCENTAJE,IVA FROM ITEMS where ITEM ='$Item' ";
$query = mysqli_query($con, $sql);
$row=mysqli_fetch_array($query);
$Porcentaje = $row['PORCENTAJE'];
$Tarifa = $row['PORCENTAJE'];

$Iva = $Subtotal*($Porcentaje/100);

	
	if (isset($_POST['Cambio'])){
		$Bonificado='S';
	}else{
		$Bonificado='N';
	}

	$sql =  "INSERT INTO TEMP_PEDIDOD (Id_N,Item,Cantidad,Subtotal,Iva,Descuento,Bonificado,COMENTARIO,Precio,Bodega,Tarifa,Estado) VALUES 
	('$Id_N','$Item',$Cantidad,$Subtotal,$Iva,0,'$Bonificado','$Comentario',$Precio,'".$_SESSION['BODEGA']."',$Tarifa,'Agregado');";
	$query_update = mysqli_query($con,$sql);
    if ($query_update) {
        $messages = "Los Datos Se Han Guardado Con Exito.";
    } else {
        $errors = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
	}
	 echo $sql;


?>



