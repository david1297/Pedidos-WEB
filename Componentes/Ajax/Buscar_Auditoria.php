<?php
 session_start();
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	$Tipo = mysqli_real_escape_string($con,(strip_tags($_REQUEST['Tipo'], ENT_QUOTES)));
	$Numero = mysqli_real_escape_string($con,(strip_tags($_REQUEST['Numero'], ENT_QUOTES)));
	?>
	<ul id="tabs-swipe-demo" class="tabs">
        <li class="tab col s3"><a class="active" href="#Encabezados">Encabezado</a></li>
        <li class="tab col s3"><a href="#Detalles">Detalle</a></li>
      </ul>
      <div id="Encabezados" class="col s12 ">
        <table class="responsive-table highlight">
          <thead>
            <tr>
                <th>Accion</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Nit</th>
                <th>Dir</th>
                <th>Comentario</th>
                <th>Subtotal</th>
                <th>Iva</th>
                <th>Descuento</th>
                <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql="SELECT * FROM  auditoria_pedidoe  where Tipo ='$Tipo' and Numero = $Numero  order by fecha desc,Hora desc   ";
            $query = mysqli_query($con, $sql);
            while($row=mysqli_fetch_array($query)){
              if ($row['Operacion']=='Creacion'){
                $color='blue-text';
              }else{
                $color='green-text';
              }
              echo '
              
              <tr>
                <td class="'.$color.'">'.$row['Operacion'].'</td>
                <td>'.$row['Fecha'].' '.$row['Hora'].'</td>
                <td>'.$row['USERNAME'].'</td>
                <td>'.$row['Id_N'].'</td>
                <td>'.$row['succliente'].'</td>
                <td>'.$row['Comentario'].'</td>
                <td>$'.number_format($row['Subtotal'],2).'</td>
                <td>$'.number_format($row['Iva'],2).'</td>
                <td>$'.number_format($row['Descuento'],2).'</td>
                <td>$'.number_format($row['Iva']+$row['Subtotal']-$row['Descuento'],2).'</td>
              </tr>
              
              
              
              ';
            }
            ?>
        
            
            
          </tbody>
        </table>
      
      </div>
      <div id="Detalles" class="col s12 ">
        <table class="responsive-table">
          <thead>
            <tr>
                <th>Accion</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Item</th>
                <th>Descripcion</th>
                <th>Cantidad</th>
                <th>Comentario</th>
                <th>Subtotal</th>
                <th>%</th>
                <th>Iva</th>
                <th>Descuento</th>
                <th>Total</th>
                <th>Bonificado</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql="SELECT Fecha,Hora,Operacion,USERNAME,items.Item,Cantidad,COMENTARIO,Subtotal,Tarifa,auditoria_pedidod.Iva,Descuento,Bonificado,
            items.DESCRIPCION
             FROM  auditoria_pedidod  
            inner join items on items.item = auditoria_pedidod.item
            where Tipo ='$Tipo' and Numero = $Numero order by fecha desc,Hora desc  ";
            $query = mysqli_query($con, $sql);
            while($row=mysqli_fetch_array($query)){
              if ($row['Operacion']=='Creacion'){
                $color='blue-text';
              }else{
                if ($row['Operacion']=='Modificado'){
                  $color='blue-grey-text';
                }else{
                  if ($row['Operacion']=='Agregado'){
                    $color='green-text';
                  }else{
                    if ($row['Operacion']=='Eliminado'){
                      $color='red-text';
                    }
                  }
                }
                
              }
              echo '
              
              <tr>
                <td class="'.$color.'">'.$row['Operacion'].'</td>
                <td>'.$row['Fecha'].' '.$row['Hora'].'</td>
                <td>'.$row['USERNAME'].'</td>
                <td>'.$row['Item'].'</td>
                <td>'.$row['DESCRIPCION'].'</td>
                <td>'.$row['Cantidad'].'</td>
                <td>'.$row['COMENTARIO'].'</td>
                <td>$'.number_format($row['Subtotal'],2).'</td>
                <td>'.number_format($row['Tarifa'],2).'%</td>
                <td>$'.number_format($row['Iva'],2).'</td>
                <td>$'.number_format($row['Descuento'],2).'</td>
                <td>$'.number_format($row['Iva']+$row['Subtotal']-$row['Descuento'],2).'</td>
                <td>'.$row['Bonificado'].'</td>

              </tr>
              
              
              
              ';
            }
            ?>
        
            
            
          </tbody>
        </table>
      </div>
	<script>
	 $(document).ready(function(){
	$('.tabs').tabs();
});</script>
