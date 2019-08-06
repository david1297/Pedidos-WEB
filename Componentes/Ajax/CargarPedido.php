<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");

$Id_N=$_GET['Id_N'];
$Tipo=$_GET['Tipo'];
$Numero=$_GET['Numero'];

$sql =  "DELETE FROM  TEMP_PEDIDOE  where Id_N =$Id_N;";
$query_update = mysqli_query($con,$sql);
if ($query_update) {
	$sql =  "DELETE FROM  TEMP_PEDIDOD where Id_N =$Id_N and id<>0;";
	$query_update = mysqli_query($con,$sql);
	if ($query_update) {
		$messages = "Los Datos Se Han Guardado Con Exito.";
	}
} else {
	$errors = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
}
$sql="SELECT * FROM  PEDIDOE  where Tipo ='$Tipo' and Numero = $Numero ";
$query = mysqli_query($con, $sql);
$row=mysqli_fetch_array($query);
$Tipo = $row['Tipo'];
$Numero = $row['Numero'];
$Id_N = $row['Id_N'];
$succliente = $row['succliente'];
$Subtotal = $row['Subtotal'];
$Iva = $row['Iva'];
$Descuento = $row['Descuento'];
$Comentario = $row['Comentario'];
$USERNAME = $row['USERNAME'];
$IDVEND = $row['IDVEND'];
$BONOTOTAL = $row['BONOTOTAL'];
$Terms = $row['Terms'];
$FechaEntrega = $row['FechaEntrega'];





	$sql =  "INSERT INTO TEMP_PEDIDOE (Tipo,Numero,Id_N,succliente,Subtotal,Iva,Descuento,Comentario,USERNAME,IDVEND,BONOTOTAL,Terms,FechaEntrega) VALUES 
	('$Tipo',$Numero,'$Id_N',$succliente,$Subtotal,$Iva,$Descuento,'$Comentario','$USERNAME',$IDVEND,$BONOTOTAL,'$Terms','$FechaEntrega');";
	$query_update = mysqli_query($con,$sql);
    if ($query_update) {
        $messages = "Los Datos Se Han Guardado Con Exito.";
    } else {
        $errors = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
	}
	 echo $sql;

	 $sql="SELECT * FROM PEDIDOD  where Tipo ='$Tipo' and Numero = $Numero ";
$query = mysqli_query($con, $sql);
while($row=mysqli_fetch_array($query)){
$Item = $row['Item'];
$Cantidad = $row['Cantidad'];
$Subtotal = $row['Subtotal'];
$Iva = $row['Iva'];
$Descuento = $row['Descuento'];
$Bonificado = $row['Bonificado'];
$COMENTARIO = $row['COMENTARIO'];
$Precio = $row['Precio'];
$Bodega = $row['Bodega'];
$Tarifa = $row['Tarifa'];


$sql =  "INSERT INTO TEMP_PEDIDOD (Id_N,Item,Cantidad,Subtotal,Iva,Descuento,Bonificado,COMENTARIO,Precio,Bodega,Tarifa,Estado) VALUES 
	('$Id_N','$Item',$Cantidad,$Subtotal,$Iva,$Descuento,'$Bonificado','$COMENTARIO',$Precio,'$Bodega',$Tarifa,'-');";
	$query_update = mysqli_query($con,$sql);
    if ($query_update) {
        $messages = "Los Datos Se Han Guardado Con Exito.";
    } else {
        $errors = "Lo sentimos , el registro falló. Por favor, regrese y vuelva a intentarlo.<br>";
	}
	 echo $sql;

}




	


?>



