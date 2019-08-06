<?php
 session_start();
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");


		$Id = mysqli_real_escape_string($con,(strip_tags($_REQUEST['Id'], ENT_QUOTES)));
		

		
		$sql="SELECT * FROM  TEMP_PEDIDOD where Id= $Id ";
		$query = mysqli_query($con, $sql);
				while ($row=mysqli_fetch_array($query)){
                        $Item=$row['Item'];
                        $Precio=$row['Precio'];
                        $Bonificado=$row['Bonificado'];
                        $Cantidad=$row['Cantidad'];
                        $COMENTARIO=$row['COMENTARIO'];
                        $Descuento=$row['Descuento'];
						if ($_SESSION['PMDESCUENTO'] =='S'){
							
								$Descuento1='<div class="row">
								<span class="blue-text text-darken-4">DESCUENTO:&nbsp;</span>
								<span class="black-text text-darken-4">'.number_format($Descuento,2).'%</span>
								<input type="text" class="hide" name="Descuento" Id="Descuento" value="'.$Descuento.'">
							</div>'	;
							
						}else{
							$Descuento1='';
						}



                        $sql1="SELECT ITEM,DESCRIPCION,PRICE,PRICE1,PRICE2,PRICE3,PRICE4,PRICE5 FROM  ITEMS where ITem= $Item ";
		                $query1 = mysqli_query($con, $sql1);
                        $row1=mysqli_fetch_array($query1);
                        $Descipcion=$row1['DESCRIPCION'];
                        if ($Bonificado=='S'){
                            $Check = 'checked="checked"';
                        }else{
                            $Check ='';
						}
						if($_SESSION['MODIPRECIOS']=='True'){
							$Modifica ='';
						}else{
							$Modifica ='Readonly=Readonly';
						}
						$Lista='';
						if($_SESSION['PERMISOPRECIO']=='S'){
							$Lista="ondblclick='ListaPecios()'";
						}

						$QConfi="SELECT ManejoExistencia FROM CONFIGURACION ";
						$ResConfi = mysqli_query($con, $QConfi);
						$Resp=mysqli_fetch_array($ResConfi);
						$ManejoExistencia =$Resp[0]; 
						if ($ManejoExistencia=='S'){
							$QExis="SELECT SALDO FROM EXISTENCIA WHERE ITEM ='$Item' AND BODEGA ='".$_SESSION['BODEGA']."' ";
							$ResExis = mysqli_query($con, $QExis);
							$Resp=mysqli_fetch_array($ResExis);
							$Saldo = $Resp[0];

							$QExis="SELECT SUM(CANTIDAD) AS CANTIDAD FROM TEMP_PEDIDOD WHERE ITEM ='$Item' AND BODEGA ='".$_SESSION['BODEGA']."' AND Id <> $Id ";
							$ResExis = mysqli_query($con, $QExis);
							$Resp=mysqli_fetch_array($ResExis);
							$Saldo = $Saldo-$Resp['CANTIDAD'];
							$Existencia='
							<div class="row">
								<span class="blue-text text-darken-4">EXISTENCIA:&nbsp;</span>
								<span class="black-text text-darken-4">'.number_format($Saldo,2).'</span>
							</div>';
							if ($_SESSION['PMSINEXISTENCIA'] <>'S'){
								$ManejoExistencia='S';	
							}else{
								$ManejoExistencia='N';	
							}
						}else{
							$Existencia='';	
							$Saldo=0;
						}

					?>
                    <div class="modal-content">
					<div class="col s12 m12">
						
								<div class="card-content">
								<form action="#" id="FEditarItem" name="FEditarItem" metod="POST">
									<div class="row">
										<span class="blue-text text-darken-4">ITEM:&nbsp;</span>
										<span class="black-text text-darken-4"><?php echo $Item; ?></span>
										<input type="text" class="hide" name="Item" value="<?php echo $Item; ?>">
										<input type="text" class="hide" name="Id" value="<?php echo $Id; ?>">
										<input type="text" class="hide" name="ManejoExistencia" id="ManejoExistenciaE" value="<?php echo $ManejoExistencia; ?>">
										<input type="text" class="hide" name="Saldo" id="SaldoE" value="<?php echo $Saldo; ?>">
									</div>
									<div class="row">
										<span class="blue-text text-darken-4">DESCRIPCION:&nbsp;</span>
										<span class="black-text text-darken-4"><?php echo $Descipcion; ?></span>
									</div>
									
									<?php
									echo $Descuento1;
									echo $Existencia;
									?>
									<div class="row">	
										<div class="input-field col m6 s12" id='InputPrecio'>
											<input type="number" class="" name="Precio" Id="PrecioE" value="<?php echo $Precio; ?>" <?php echo $Modifica.' '.$Lista;?> >
          									<label for="PrecioE">PRECIO</label>
        								</div>
										<?php
										if($_SESSION['PERMISOPRECIO']=='S'){
										?>
										<div class="input-field col m6 s12" id='SelectPrecio'>
										<a class='dropdown-trigger btn hide white' href='#' data-target='SPrecioE' id='APrecioE' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
											<!-- Dropdown Structure -->
											<ul id='SPrecioE' class='dropdown-content ' onblur="$('#APrecioE').addClass('hide');$('#InputPrecio').removeClass('hide');">
											<li  onclick="$('#PrecioE').val('<?php echo $row1['PRICE']; ?>');"><a href="#!">$<?php echo number_format($row1['PRICE'],2); ?></a></li>
											<li  onclick="$('#PrecioE').val('<?php echo $row1['PRICE1']; ?>');"><a href="#!">$<?php echo number_format($row1['PRICE1'],2); ?></a></li>
											<li  onclick="$('#PrecioE').val('<?php echo $row1['PRICE2']; ?>');"><a href="#!">$<?php echo number_format($row1['PRICE2'],2); ?></a></li>
											<li  onclick="$('#PrecioE').val('<?php echo $row1['PRICE3']; ?>');"><a href="#!">$<?php echo number_format($row1['PRICE3'],2); ?></a></li>
											<li  onclick="$('#PrecioE').val('<?php echo $row1['PRICE4']; ?>');"><a href="#!">$<?php echo number_format($row1['PRICE4'],2); ?></a></li>
											<li  onclick="$('#PrecioE').val('<?php echo $row1['PRICE5']; ?>');"><a href="#!">$<?php echo number_format($row1['PRICE5'],2); ?></a></li>
											</ul>
										</div>
										<?php
										}
										?>
										
									</div>
									<div class="row">
									<p>
									<label>
										<input type="checkbox" class="filled-in" name="Cambio" <?php echo $Check; ?>>
										<span>Cambio</span>
									</label>
									</p>
									</div>
									<div class="row input-field">
      									<input  id="CantidadE" name="Cantidad" type="Number"  value="<?php echo $Cantidad; ?>" min='0'max='99999' onfocus="var H =$(this).val();$(this).val(0); $(this).val(H);">
      									<label class="active" for="Cantidad">Cantidad</label>
    								</div>
									<div class="row ">
									<label for="Comentario">Comentario</label>
										<textarea id="Comentario" name="Comentario" class="materialize-textarea" rows="2"onfocus="UbiComentario('EditarItem')"><?php echo $COMENTARIO; ?></textarea>
    							    	
									</div>
									<a class="waves-effect waves-light btn-small red" onclick="EliminarItem(<?php echo $Id;?>)"><i class="material-icons right">delete</i>Eliminar</a>
								</form>
								<div id="Res"></div>
								</div>
							</div>

						
					</div>
					<script>
					 $(document).ready(function(){
					  $('select').formSelect();
					  $('.dropdown-trigger').dropdown();
					 })
					 $("#FEditarItem").submit(function( event ) { 
						var Precio = $('#Precio').val();
						 var Cantidad = $('#Cantidad').val();
						 var ManejoExistencia = $('#ManejoExistencia').val();
						 var Saldo = $('#Saldo').val();
						if(Precio==0){
							alert('El Precio No puede ser 0');
						}else{
							if(Cantidad==0 || Cantidad==''){
								alert('la Cantidad No puede ser 0');
							}else{
								if (ManejoExistencia=='S'&& Cantidad >Saldo){
									alert('la Cantidad No puede Superar la Existencia');	
								}else{
									var parametros = $(this).serialize();
									$.ajax({
										type: "POST",
										url: "Componentes/Ajax/EditarItem.php",
										data: parametros,
										beforeSend: function(objeto){
										},
										success: function(datos){
										
											$('#EditarItem').modal('close');
											CargarProductos();
										}
									});
								}
							}
						}
 						
  						event.preventDefault();
					})
					$("#PrecioE").dblclick(function(){
					$('#APrecioE').removeClass('hide');
					document.getElementById("APrecioE").click();
					$('#APrecioE').click();
    				})
					</script>


						<?php
				}
				?>
				
			<?php
		
	
?>