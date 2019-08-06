<?php
session_start();
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");
require_once ("../../classes/Auditoria.php");

$Id_N=$_GET['Id_N'];

$sql="SELECT * FROM TEMP_PEDIDOE where Id_N ='$Id_N' ";
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
$FechaEntrega = $row['FechaEntrega'];


if ($Numero<>0){
	$Numero_PE = $Numero;	
	$sql=mysqli_query($con, "select Fecha,Hora,USERNAME,IDVEND from PEDIDOE where Tipo= '$Tipo' and Numero = $Numero_PE  ");
	$rw=mysqli_fetch_array($sql);
	$Fecha = $rw['Fecha'];
	$Hora = $rw['Hora'];
	$USERNAME = $rw['USERNAME'];
	$IDVEND = $rw['IDVEND'];
	$OPeracion = 'Editar';
}else{
	$sql=mysqli_query($con, "select LAST_INSERT_ID(Numero) as last,CURDATE() as Fecha,curTime() as Hora from PEDIDOE where Tipo= '$Tipo' order by Numero desc limit 0,1 ");
	$rw=mysqli_fetch_array($sql);
	$Numero_PE=$rw['last']+1;
	$sql=mysqli_query($con, "select CURDATE() as Fecha,curTime() as Hora  ");
	$rw=mysqli_fetch_array($sql);
	$Fecha = $rw['Fecha'];
	$Hora = $rw['Hora'];
	$USERNAME = $_SESSION['USERNAME'];
	$IDVEND = $_SESSION['IDVEND'];
	$OPeracion = 'Nuevo';
}

if($OPeracion == 'Editar'){
	EditarE($Tipo,$Numero_PE,$Id_N);
	$sql =  "DELETE FROM  PEDIDOE where Numero =$Numero_PE and Tipo ='$Tipo';";
	$query_update = mysqli_query($con,$sql);
	EditarD($Tipo,$Numero_PE,$Id_N);
	$sql =  "DELETE FROM  PEDIDOD where Numero =$Numero_PE and Tipo ='$Tipo';";
	$query_update = mysqli_query($con,$sql);	
}

$sql =  "INSERT INTO PEDIDOE (Tipo,Numero,Id_N,succliente,Subtotal,Iva,Descuento,Comentario,Fecha,FechaEntrega,Hora,USERNAME,IDVEND,SINC,Estado,BONOTOTAL,Terms) VALUES 
('$Tipo',$Numero_PE,'$Id_N',$succliente,$Subtotal,$Iva,$Descuento,'$Comentario','$Fecha','$FechaEntrega','$Hora','$USERNAME',$IDVEND,'S','PENDIENTE',$BONOTOTAL,'$Terms');";
$query_update = mysqli_query($con,$sql);

	

if ($OPeracion == 'Nuevo'){
	NuevoE($Tipo,$Numero_PE);
}	
$QConfi="SELECT ManejoExistencia FROM CONFIGURACION ";
$ResConfi = mysqli_query($con, $QConfi);
$Resp=mysqli_fetch_array($ResConfi);
$ManejoExistencia =$Resp[0]; 



$sql="SELECT * FROM TEMP_PEDIDOD where Id_N ='$Id_N' and Estado <> 'Eliminado' ";
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

	$sql =  "INSERT INTO PEDIDOD (Tipo,Numero,Id_N,Item,Cantidad,Subtotal,Iva,Descuento,Bonificado,COMENTARIO,Precio,Bodega,Tarifa) VALUES 
	('$Tipo',$Numero_PE,'$Id_N','$Item',$Cantidad,$Subtotal,$Iva,$Descuento,'$Bonificado','$COMENTARIO',$Precio,'$Bodega',$Tarifa);";
	$query_update = mysqli_query($con,$sql);

	$sql =  "INSERT INTO PEDIDOD (Tipo,Numero,Id_N,Item,Cantidad,Subtotal,Iva,Descuento,Bonificado,COMENTARIO,Precio,Bodega,Tarifa) VALUES 
	('$Tipo',$Numero_PE,'$Id_N','$Item',$Cantidad,$Subtotal,$Iva,$Descuento,'$Bonificado','$COMENTARIO',$Precio,'$Bodega',$Tarifa);";
	$query_update = mysqli_query($con,$sql);
	if ($ManejoExistencia=='S'){
		$sql =  "UPDATE EXISTENCIA SET SALDO = SALDO - $Cantidad WHERE ITEM= '$Item' AND BODEGA ='$Bodega';";
		$query_update = mysqli_query($con,$sql);	
	}

}

if ($OPeracion == 'Nuevo'){
	NuevoD($Tipo,$Numero_PE);
}	


$sql =  "DELETE FROM  TEMP_PEDIDOE where Id_N =$Id_N;";
$query_update = mysqli_query($con,$sql);
$sql =  "DELETE FROM  TEMP_PEDIDOD where Id_N =$Id_N and id<>0;";
$query_update = mysqli_query($con,$sql);
$sql =  "UPDATE PEDIDOE SET SINC = 'N' WHERE Tipo= '$Tipo' AND Numero =$Numero_PE;";
$query_update = mysqli_query($con,$sql);


?>



