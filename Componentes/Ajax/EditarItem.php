<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");
$Item=$_POST['Item'];
$Precio=$_POST['Precio'];
$Cantidad=$_POST['Cantidad'];
$Comentario=$_POST['Comentario'];
$Id=$_POST['Id'];

$Subtotal = $Cantidad * $Precio;
$sql="SELECT PORCENTAJE FROM items where ITEM ='$Item' ";
$query = mysqli_query($con, $sql);
$row=mysqli_fetch_array($query);
$Porcentaje = $row['PORCENTAJE'];

$Iva = $Subtotal*($Porcentaje/100);

	
	if (isset($_POST['Cambio'])){
		$Bonificado='S';
	}else{
		$Bonificado='N';
	}
	$sql="SELECT Estado FROM  temp_pedidod  where Id =$Id ";
    $query = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($query);
    if($row[0]=='Agregado'){
		$sql =  "UPDATE temp_pedidod Set Cantidad=$Cantidad,Subtotal=$Subtotal,Iva=$Iva,Bonificado='$Bonificado',
		COMENTARIO='$Comentario',Precio=$Precio where Id =$Id
		and (Cantidad<>$Cantidad or Bonificado<>'$Bonificado' or COMENTARIO<>'$Comentario' );"; 
    }else{
		$sql =  "UPDATE temp_pedidod Set Cantidad=$Cantidad,Subtotal=$Subtotal,Iva=$Iva,Bonificado='$Bonificado',
		COMENTARIO='$Comentario',Precio=$Precio, Estado = 'Modificado' where Id =$Id
		and (Cantidad<>$Cantidad or Bonificado<>'$Bonificado' or COMENTARIO<>'$Comentario' );"; 
    }

	

	$query_update = mysqli_query($con,$sql);
  

	 echo $sql;


?>



