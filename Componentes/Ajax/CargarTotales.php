<?php
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
    $Id_N = $_GET['Id_N'];
      $sql="SELECT * FROM temp_pedidod where Id_N ='$Id_N' and Bonificado='N'";
      $query = mysqli_query($con, $sql);
      $h=1;
      $Total=0;
      $SubTotal=0;
      $Iva=0;
      while($row=mysqli_fetch_array($query)){
        $Total =$Total+ $row['Subtotal'] + $row['Iva'];
        $SubTotal =$SubTotal+ $row['Subtotal'];
        $Iva =$Iva + $row['Iva'];
      }
      $sql =  "UPDATE temp_pedidoe Set Subtotal=$SubTotal,Iva=$Iva where  Id_N ='$Id_N';";
      $query_update = mysqli_query($con,$sql);
      if ($query_update) {
          $messages = "Los Datos Se Han Guardado Con Exito.";
      }
          ?>
          <span class="white-text text-darken-4">Total:&nbsp;</span><span class="white-text text-darken-4">$ <?php echo number_format($Total,2);?></span><br>
          
    
  