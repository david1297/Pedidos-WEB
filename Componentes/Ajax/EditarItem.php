<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");
$Item=$_POST['Item'];
$Precio=$_POST['Precio'];
$Cantidad=$_POST['Cantidad'];
$Comentario=$_POST['Comentario'];
$Id=$_POST['Id'];


$sql="SELECT * FROM TEMP_PEDIDOD where Id =$Id ";
$query = mysqli_query($con, $sql);
$row=mysqli_fetch_array($query);
$Porcentaje = $row['Tarifa'];
$Descuento = $row['Descuento'];
$Subtotal = ($Cantidad * $Precio);
$Base = ($Cantidad * $Precio)-(($Precio*$Descuento/100)*$Cantidad);

$Iva = $Base*($Porcentaje/100);

	
	if (isset($_POST['Cambio'])){
		$Bonificado='S';
	}else{
		$Bonificado='N';
	}
	$sql="SELECT Estado FROM  TEMP_PEDIDOD  where Id =$Id ";
    $query = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($query);
    if($row[0]=='Agregado'){
		$sql =  "UPDATE TEMP_PEDIDOD Set Cantidad=$Cantidad,Subtotal=$Subtotal,Iva=$Iva,Bonificado='$Bonificado',
		COMENTARIO='$Comentario',Precio=$Precio where Id =$Id
		and (Cantidad<>$Cantidad or Bonificado<>'$Bonificado' or COMENTARIO<>'$Comentario' or Precio<>$Precio);"; 
    }else{
		$sql =  "UPDATE TEMP_PEDIDOD Set Cantidad=$Cantidad,Subtotal=$Subtotal,Iva=$Iva,Bonificado='$Bonificado',
		COMENTARIO='$Comentario',Precio=$Precio, Estado = 'Modificado' where Id =$Id
		and (Cantidad<>$Cantidad or Bonificado<>'$Bonificado' or COMENTARIO<>'$Comentario'  or Precio<>$Precio);"; 
    }

	

	$query_update = mysqli_query($con,$sql);
  

	 echo $sql;


?>



