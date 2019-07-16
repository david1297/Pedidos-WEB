<?php
session_start();
require_once ("../../config/db.php");
require_once ("../../config/conexion.php");
$Usuario=$_GET['Usuario'];
$Clave=$_GET['Clave'];

$sql="SELECT count(*) FROM ADMINISTRADORES where Usuario ='$Usuario' and  Clave ='$Clave'";
$query = mysqli_query($con, $sql);
$row=mysqli_fetch_array($query);
if($row[0]>=1 ){
    echo 'True';
    $_SESSION['Auditoria']='True';
}else{
    echo 'False';
    $_SESSION['Auditoria']='False';
}


?>