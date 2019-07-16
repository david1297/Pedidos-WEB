<?php
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");

$Id=$_GET['Id'];
    $sql="SELECT Estado FROM  TEMP_PEDIDOD  where Id =$Id ";
    $query = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($query);
    if($row[0]=='Agregado'){
        $sql =  "DELETE FROM  TEMP_PEDIDOD where Id =$Id;";
        $query_update = mysqli_query($con,$sql);
    }else{
        $sql =  "UPDATE  TEMP_PEDIDOD SET Estado='Eliminado' where Id =$Id;";
        $query_update = mysqli_query($con,$sql);
    }
	
    

?>



