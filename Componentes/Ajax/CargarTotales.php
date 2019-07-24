<?php
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
    $Id_N = $_GET['Id_N'];
      $sql="SELECT * FROM TEMP_PEDIDOD where Id_N ='$Id_N' ";
      $query = mysqli_query($con, $sql);
      $h=1;
      $Total=0;
      $SubTotal=0;
      $Iva=0;
      $Bono=0;
      $Descuento=0;
      while($row=mysqli_fetch_array($query)){
        if ($row['Bonificado']=='N'){
          $Descuento=($row['Subtotal']*$row['Descuento']/100);
          $Total =$Total+ $row['Subtotal'] + $row['Iva']-$Descuento;
          $SubTotal =$SubTotal+ $row['Subtotal'];
          $Iva =$Iva + $row['Iva'];
        }else{
          $Bono = $Bono+ $row['Subtotal'];
        }
       
      }
      $sql =  "UPDATE TEMP_PEDIDOE Set Subtotal=$SubTotal,Iva=$Iva,BONOTOTAL=$Bono,Descuento=$Descuento  where  Id_N ='$Id_N';";
      $query_update = mysqli_query($con,$sql);
      if ($query_update) {
          $messages = "Los Datos Se Han Guardado Con Exito.";
      }
          ?>
          <span class="white-text text-darken-4">Total:&nbsp;</span><span class="white-text text-darken-4">$ <?php echo number_format($Total,2);?></span><br>
          
    
  