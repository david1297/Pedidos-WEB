<?php
 session_start();
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");


		$Id_N = mysqli_real_escape_string($con,(strip_tags($_REQUEST['Id_N'], ENT_QUOTES)));
		

		
		$sql="SELECT Comentario FROM  TEMP_PEDIDOE where Id_N= $Id_N ";
		$query = mysqli_query($con, $sql);
		$row=mysqli_fetch_array($query);
                        
                        $Comentario=$row['Comentario'];
					?>
                    <div class="modal-content">
					<div class="col s12 m12">
						
								<div class="card-content">
								<form action="#" id="FNota" name="FNota" metod="POST">
								<input type="text" class="hide" name="Id_N" value="<?php echo $Id_N; ?>">	
									
									
									<div class="row ">
									<label for="Comentario">Comentario</label>
										<textarea id="Comentario" name="Comentario" class="materialize-textarea" rows="4"onfocus="UbiComentario()"><?php echo $Comentario; ?></textarea>
    							    	
									</div>
								</form>
								<div id="Res"></div>
								</div>
							</div>

						
					</div>
					<script>
					 $("#FNota").submit(function( event ) { 
 						var parametros = $(this).serialize();
	 					$.ajax({
		  					type: "POST",
							url: "Componentes/Ajax/EditarNota.php",
		  					data: parametros,
			 				beforeSend: function(objeto){
			  				},
		  					success: function(datos){
	   							$('#Nota').modal('close');
								  
							}
  						});
  						event.preventDefault();
					})
					</script>


						<?php
				
				?>
				
			<?php
		
	
?>