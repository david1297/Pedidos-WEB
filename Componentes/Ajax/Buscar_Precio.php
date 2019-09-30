<?php

	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	$Item = $_GET['Item'];
	$Cantidad = $_GET['Cantidad'];
	$sql="SELECT Nivel FROM  NIVEL_ITEM where Item= '$Item' ";
	$query = mysqli_query($con, $sql);
	$row=mysqli_fetch_array($query);
	$Nivel= $row[0];
	$sql="SELECT * FROM  NIVELES where Codigo= $Nivel ";
	$query = mysqli_query($con, $sql);
	$row=mysqli_fetch_array($query);
	$sql1="SELECT * FROM  ITEMS where ITEM= '$Item' ";
	$query1 = mysqli_query($con, $sql1);
	$row1=mysqli_fetch_array($query1);
	if(($Cantidad>= $row['Desde1'])&&($Cantidad<=$row['Hasta1'])){
		Echo '-'.$row1['PRICE'];
	}else{
		if(($Cantidad>= $row['Desde2'])&&($Cantidad<=$row['Hasta2'])){
			Echo '-'.$row1['PRICE1'];
		}else{
			if(($Cantidad>= $row['Desde3'])&&($Cantidad<=$row['Hasta3'])){
				Echo '-'.$row1['PRICE2'];
			}else{
				if(($Cantidad>= $row['Desde4'])&&($Cantidad<=$row['Hasta4'])){
					Echo '-'.$row1['PRICE3'];
				}else{
					if(($Cantidad>= $row['Desde5'])&&($Cantidad<=$row['Hasta5'])){
						Echo '-'.$row1['PRICE4'];
					}else{
						if(($Cantidad>= $row['Desde6'])){
							Echo '-'.$row1['PRICE5'];
						}else{
							Echo '-'.'0';
						}
					}
				}
			}
		}
	}
?>