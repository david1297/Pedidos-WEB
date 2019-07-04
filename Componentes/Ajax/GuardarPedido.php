<?php
session_start();
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");
require_once ("../../classes/Auditoria.php");

$Id_N=$_GET['Id_N'];

$sql="SELECT * FROM temp_pedidoe where Id_N ='$Id_N' ";
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
$BONOTOTAL = $row['BONOTOTAL'];
$Terms = $row['Terms'];


if ($Numero<>0){
	$Numero_PE = $Numero;	
	$sql=mysqli_query($con, "select Fecha,Hora,USERNAME,IDVEND from pedidoe where Tipo= '$Tipo' and Numero = $Numero_PE  ");
	$rw=mysqli_fetch_array($sql);
	$Fecha = $rw['Fecha'];
	$Hora = $rw['Hora'];
	$USERNAME = $rw['USERNAME'];
	$IDVEND = $rw['IDVEND'];
	$OPeracion = 'Editar';
}else{
	$sql=mysqli_query($con, "select LAST_INSERT_ID(Numero) as last,CURDATE() as Fecha,curTime() as Hora from pedidoe where Tipo= '$Tipo' order by Numero desc limit 0,1 ");
	$rw=mysqli_fetch_array($sql);
	$Numero_PE=$rw['last']+1;
	$Fecha = $rw['Fecha'];
	$Hora = $rw['Hora'];
	$USERNAME = $_SESSION['USERNAME'];
	$IDVEND = $_SESSION['IDVEND'];
	$OPeracion = 'Nuevo';
}

if($OPeracion == 'Editar'){
	EditarE($Tipo,$Numero_PE,$Id_N);
	$sql =  "DELETE FROM  pedidoe where Numero =$Numero_PE and Tipo ='$Tipo';";
	$query_update = mysqli_query($con,$sql);
	EditarD($Tipo,$Numero_PE,$Id_N);
	$sql =  "DELETE FROM  pedidod where Numero =$Numero_PE and Tipo ='$Tipo';";
	$query_update = mysqli_query($con,$sql);	
}

$sql =  "INSERT INTO pedidoe (Tipo,Numero,Id_N,succliente,Subtotal,Iva,Descuento,Comentario,Fecha,Hora,USERNAME,IDVEND,SINC,Estado,BONOTOTAL,Terms) VALUES 
('$Tipo',$Numero_PE,'$Id_N',$succliente,$Subtotal,$Iva,$Descuento,'$Comentario','$Fecha','$Hora','$USERNAME',$IDVEND,'N','PENDIENTE',$BONOTOTAL,'$Terms');";
$query_update = mysqli_query($con,$sql);

if ($OPeracion == 'Nuevo'){
	NuevoE($Tipo,$Numero_PE);
}	

$sql="SELECT * FROM temp_pedidod where Id_N ='$Id_N' and Estado <> 'Eliminado' ";
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

	$sql =  "INSERT INTO pedidod (Tipo,Numero,Id_N,Item,Cantidad,Subtotal,Iva,Descuento,Bonificado,COMENTARIO,Precio,Bodega,Tarifa) VALUES 
	('$Tipo',$Numero_PE,'$Id_N','$Item',$Cantidad,$Subtotal,$Iva,$Descuento,'$Bonificado','$COMENTARIO',$Precio,'$Bodega',$Tarifa);";
	$query_update = mysqli_query($con,$sql);
}
if ($OPeracion == 'Nuevo'){
	NuevoD($Tipo,$Numero_PE);
}	


$sql =  "DELETE FROM  temp_pedidoe where Id_N =$Id_N;";
$query_update = mysqli_query($con,$sql);
$sql =  "DELETE FROM  temp_pedidod where Id_N =$Id_N and id<>0;";
$query_update = mysqli_query($con,$sql);
?>



