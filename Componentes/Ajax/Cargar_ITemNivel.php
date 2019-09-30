<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");
$sql1="SELECT ITEM FROM ITEMS";
$query1 = mysqli_query($con, $sql1);
while($row=mysqli_fetch_array($query1)){
    $Item=$row['ITEM'];
    $sql="SELECT COUNT(*) FROM NIVEL_ITEM WHERE Item='$Item';";
    $query = mysqli_query($con, $sql);
    $row1=mysqli_fetch_array($query);
    if($row1[0]==0){
     

	$sql =  "INSERT INTO  NIVEL_ITEM (Item,Nivel) VALUES('$Item',0) ;";
	$query_update = mysqli_query($con,$sql);   

    }
}



?>



