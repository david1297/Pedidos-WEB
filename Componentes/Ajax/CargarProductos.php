<?php
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
$Id_N = $_GET['Id_N'];
      $sql="SELECT * FROM temp_pedidod where Id_N ='$Id_N' and Estado <>'Eliminado' ";
      $query = mysqli_query($con, $sql);
      $h=1;
      while($row=mysqli_fetch_array($query)){
          $Item =$row['Item'];
          $Cantidad= $row['Cantidad'];
          $Subtotal= $row['Subtotal'];
          $Iva= $row['Iva'];
          $Descuento= $row['Descuento'];
          $Id= $row['Id'];
          $Bonificado= $row['Bonificado'];
          $COMENTARIO= $row['COMENTARIO'];
          $sql1="SELECT DESCRIPCION FROM Items where ITem ='$Item' ";
          $query1 = mysqli_query($con, $sql1);
          $row1=mysqli_fetch_array($query1);
          $Descripcion = $row1['DESCRIPCION'];
          if ($h==1){
            ?>
            <div class="row">
            <?php
          }else{
            if ($h%2 <> 0){
              ?>
              </div>
              <div class="row">
              <?php

            }
          }
          ?>
          <div class="col s12 m6">
            <div class="card">
              <div class="card-image">
                <div class="card-content">
                  <span class="blue-text text-darken-4">ITEM:&nbsp;</span><span class="black-text text-darken-4"><?php echo $Item;?></span><br>
                  <span class="blue-text text-darken-4">DESCRIPCION:&nbsp;</span><span class="black-text text-darken-4"><?php echo $Descripcion;?></span><br>
                  <span class="blue-text text-darken-4">CANTIDAD:&nbsp;</span><span class="black-text text-darken-4"><?php echo number_format($Cantidad,2);?></span><br>
                  <span class="blue-text text-darken-4">TOTAL:&nbsp;</span><span class="black-text text-darken-4">$&nbsp;<?php echo number_format($Subtotal+$Iva,2);?></span><br>
                  <?php
                  if($Bonificado=='S'){
                    ?> 
                    <span class="orange-text text-darken-4">PARA CAMBIO&nbsp;</span>
                    <?php
                  }
                  ?>
                </div>
                <a class="btn-floating halfway-fab waves-effect waves-light cyan accent-4" onclick="EdiarItem(<?php echo $Id;?>)"><i class="material-icons">mode_edit</i></a>
              </div>
              <div class="card-content">

              <div class="row">
              <span class="blue-text text-darken-4">COMENTARIO:&nbsp;</span>
                <span class="black-text text-darken-4"><?php echo $COMENTARIO;?></span>
              </div>
              </div>

            </div>
          </div>
          
      <?php
      $h=$h+1;
      }
    
    ?>
    </div>