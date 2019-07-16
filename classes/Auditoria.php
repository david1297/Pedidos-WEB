<?php
function NuevoE($Tipo,$Numero){
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
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

	$sql =  "INSERT INTO AUDITORIA_PEDIDOE (Tipo,Numero,Id_N,succliente,Subtotal,Iva,Descuento,Comentario,USERNAME,IDVEND,Fecha,Hora,Operacion) VALUES 
    ('$Tipo',$Numero,'$Id_N',$succliente,$Subtotal,$Iva,$Descuento,'$Comentario','".$_SESSION['USERNAME']."',$IDVEND,CURDATE(),curTime(),'Creacion');";
    $query_update = mysqli_query($con,$sql);
    echo $sql;
}
function EditarE($Tipo,$Numero,$Id_N){
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
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

    $sql="SELECT * FROM  TEMP_PEDIDOE  where Id_N ='$Id_N'  ";
    $query = mysqli_query($con, $sql);
    $row=mysqli_fetch_array($query);
    $Tipot = $row['Tipo'];
    $Numerot = $row['Numero'];
    $Id_Nt = $row['Id_N'];
    $succlientet = $row['succliente'];
    $Subtotalt = $row['Subtotal'];
    $Ivat = $row['Iva'];
    $Descuentot = $row['Descuento'];
    $Comentariot = $row['Comentario'];
    $USERNAMEt = $row['USERNAME'];
    $IDVENDt = $row['IDVEND'];
    if(($succlientet<>$succliente)|| ($Subtotalt<>$Subtotal)||($Ivat<>$Iva)||($Descuentot<>$Descuento)||($Comentariot<>$Comentario)||($IDVENDt<>$IDVEND) ){
        $sql =  "INSERT INTO AUDITORIA_PEDIDOE (Tipo,Numero,Id_N,succliente,Subtotal,Iva,Descuento,Comentario,USERNAME,IDVEND,Fecha,Hora,Operacion) VALUES 
        ('$Tipo',$Numero,'$Id_N',$succlientet,$Subtotalt,$Ivat,$Descuentot,'$Comentariot','".$_SESSION['USERNAME']."',$IDVEND,CURDATE(),curTime(),'Modificacion');";
        $query_update = mysqli_query($con,$sql);
    }   
}
function NuevoD($Tipo,$Numero){
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $sql="SELECT * FROM PEDIDOD  where Tipo ='$Tipo' and Numero = $Numero ";
    $query = mysqli_query($con, $sql);
    while($row=mysqli_fetch_array($query)){
    $Id_N = $row['Id_N'];
    $Item = $row['Item'];
    $Tipo = $row['Tipo'];
    $Numero = $row['Numero'];
    $Cantidad = $row['Cantidad'];
    $Subtotal = $row['Subtotal'];
    $Iva = $row['Iva'];
    $Descuento = $row['Descuento'];
    $Bonificado = $row['Bonificado'];
    $Comentario = $row['COMENTARIO'];
    $Precio = $row['Precio'];
    $Bodega = $row['Bodega'];
    $Tarifa = $row['Tarifa'];
    
    $sql =  "INSERT INTO AUDITORIA_PEDIDOD (Tipo,Numero,Id_N,Item,Cantidad,Subtotal,Iva,Descuento,Bonificado,COMENTARIO,Precio,Bodega,Tarifa,USERNAME,Fecha,Hora,Operacion) VALUES 
        ('$Tipo',$Numero,'$Id_N','$Item',$Cantidad,$Subtotal,$Iva,$Descuento,'$Bonificado','$Comentario',$Precio,'$Bodega',$Tarifa,'".$_SESSION['USERNAME']."',CURDATE(),curTime(),'Creacion');";
        $query_update = mysqli_query($con,$sql);
    }    
}
function EditarD($Tipo,$Numero,$Id_N){
    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
    $sql="SELECT * FROM TEMP_PEDIDOD where Id_N ='$Id_N'and Estado <>'-' ";
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
        $Estado = $row['Estado'];

        $sql =  "INSERT INTO AUDITORIA_PEDIDOD (Tipo,Numero,Id_N,Item,Cantidad,Subtotal,Iva,Descuento,Bonificado,COMENTARIO,Precio,Bodega,Tarifa,USERNAME,Fecha,Hora,Operacion) VALUES 
        ('$Tipo',$Numero,'$Id_N','$Item',$Cantidad,$Subtotal,$Iva,$Descuento,'$Bonificado','$Comentario',$Precio,'$Bodega',$Tarifa,'".$_SESSION['USERNAME']."',CURDATE(),curTime(),'$Estado');";
        $query_update = mysqli_query($con,$sql);
    }

}
?>