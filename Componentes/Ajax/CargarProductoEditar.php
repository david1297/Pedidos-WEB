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
                        
                        $sql1="SELECT DESCRIPCION FROM  ITEMS where ITem= $Item ";
		                $query1 = mysqli_query($con, $sql1);
                        $row1=mysqli_fetch_array($query1);
                        $Descipcion=$row1['DESCRIPCION'];
                        if ($Bonificado=='S'){
                            $Check = 'checked="checked"';
                        }else{
                            $Check ='';
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
									</div>
									<div class="row">
										<span class="blue-text text-darken-4">DESCRIPCION:&nbsp;</span>
										<span class="black-text text-darken-4"><?php echo $Descipcion; ?></span>
									</div>
									<div class="row">
										<span class="blue-text text-darken-4">DESCUENTO:&nbsp;</span>
										<span class="black-text text-darken-4"><?php echo number_format($Descuento,2); ?>%</span>
										<input type="text" class="hide" name="Descuento" Id="Descuento" value="<?php echo $Descuento; ?>">
									</div>
									<div class="row">
										<span class="blue-text text-darken-4">PRECIO:&nbsp;</span>
										<span class="black-text text-darken-4"><?php echo number_format($Precio); ?></span>
										<input type="text" class="hide" name="Precio" value="<?php echo $Precio; ?>">
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
      									<input  id="Cantidad" name="Cantidad" type="Number"  value="<?php echo $Cantidad; ?>" min='0'max='99999' onfocus="var H =$(this).val();$(this).val(0); $(this).val(H);">
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
					 $("#FEditarItem").submit(function( event ) { 
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
  						event.preventDefault();
					})
					</script>


						<?php
				}
				?>
				
			<?php
		
	
?>