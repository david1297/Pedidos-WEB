<?php
 session_start();
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		$Item = mysqli_real_escape_string($con,(strip_tags($_REQUEST['Item'], ENT_QUOTES)));
		$Nivel = mysqli_real_escape_string($con,(strip_tags($_REQUEST['Nivel'], ENT_QUOTES)));
		$Id_N = mysqli_real_escape_string($con,(strip_tags($_REQUEST['Id_N'], ENT_QUOTES)));
		

		$sTable = "ITEMS";
		$sWhere = "where 1=1";
		if ( $_GET['Item'] != "" ){
				$sWhere.= " and  (ITEM = '$Item' )";	
		}
		
		$sWhere.="  order by DESCRIPCION";
		include 'pagination.php';
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10;
		$adjacents  = 4;
		$offset = ($page - 1) * $per_page;
		$count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './Consultar-Terceros.php';
		$sql="SELECT ITEM,DESCRIPCION,PRICE,PRICE1,PRICE2,PRICE3,PRICE4,PRICE5 FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);

		if ($numrows>0){
			echo mysqli_error($con);
			?>
				


			
				<?php
				while ($row=mysqli_fetch_array($query)){
					if($_SESSION['LISTA_PRECIOS']<>'C'){
						if($_SESSION['LISTA_PRECIOS']=='1'){
							$Precio = $row['PRICE'];
						}else{
							if($_SESSION['LISTA_PRECIOS']=='2'){
								$Precio = $row['PRICE1'];
							}else{
								if($_SESSION['LISTA_PRECIOS']=='3'){
									$Precio = $row['PRICE2'];
								}else{
									if($_SESSION['LISTA_PRECIOS']=='4'){
										$Precio = $row['PRICE3'];
									}else{
										if($_SESSION['LISTA_PRECIOS']=='5'){
											$Precio = $row['PRICE4'];
										}else{
											if($_SESSION['LISTA_PRECIOS']=='6'){
												$Precio = $row['PRICE5'];
											}
										}
									}
								}	
							}
								
						}
					}else{
						if($Nivel=='1'){
							$Precio = $row['PRICE'];
						}else{
							if($Nivel=='2'){
								$Precio = $row['PRICE1'];
							}else{
								if($Nivel=='3'){
									$Precio = $row['PRICE2'];
								}else{
									if($Nivel=='4'){
										$Precio = $row['PRICE3'];
									}else{
										if($Nivel=='5'){
											$Precio = $row['PRICE4'];
										}else{
											if($Nivel=='6'){
												$Precio = $row['PRICE5'];
											}
										}
									}
								}	
							}
								
						}	
					}
					$Des=0;
					
					if ($_SESSION['PMDESCUENTO'] =='S'){
						$QTercero="SELECT Descuento FROM TERCEROS WHERE id_n = '$Id_N'  ";
						$QRest = mysqli_query($con, $QTercero);
						$Resp=mysqli_fetch_array($QRest);
						if ($Resp[0] <> 0){
							$Des=($Precio*$Resp[0]/100) ;
							$Precio = $Precio- ($Precio*$Resp[0]/100);	
						}
					}

						$Item=$row['ITEM'];
						$Descipcion=$row['DESCRIPCION'];
					?>
					<div class="col s12 m12">
						<div class="card">
							<div class="card-image">
								<div class="card-content">
								<form action="#" id="AgregarItem" name="AgregarItem" metod="POST">
									<div class="row">
										<span class="blue-text text-darken-4">ITEM:&nbsp;</span>
										<span class="black-text text-darken-4"><?php echo $Item; ?></span>
										<input type="text" class="hide" name="Item" value="<?php echo $Item; ?>">
										<input type="text" class="hide" name="Id_N" value="<?php echo $Id_N; ?>">
									</div>
									<div class="row">
										<span class="blue-text text-darken-4">DESCRIPCION:&nbsp;</span>
										<span class="black-text text-darken-4"><?php echo $Descipcion; ?></span>
									</div>
									<div class="row">
										<span class="blue-text text-darken-4">DESCUENTO:&nbsp;</span>
										<span class="black-text text-darken-4"><?php echo number_format($Resp[0],2); ?>%</span>
										<input type="text" class="hide" name="Descuento" Id="Descuento" value="<?php echo $Des; ?>">
									</div>
									<div class="row">
										<span class="blue-text text-darken-4">PRECIO:&nbsp;</span>
										<span class="black-text text-darken-4"><?php echo number_format($Precio,2); ?></span>
										<input type="text" class="hide" name="Precio" Id="Precio" value="<?php echo $Precio; ?>">
									</div>
									<div class="row">
									<p>
									<label>
										<input type="checkbox" class="filled-in" name="Cambio" />
										<span>Cambio</span>
									</label>
									</p>
									</div>
									<div class="row input-field">
      									<input id="Cantidad" name="Cantidad" type="Number"  value="1" min='0'max='99999' onfocus="var H =$(this).val();$(this).val(0); $(this).val(H);">
      									<label class="active" for="Cantidad">Cantidad</label>
    								</div>
									<div class="row input-field">
										<textarea id="Comentario" name="Comentario" class="materialize-textarea" rows="2" onfocus="UbiComentario('BuscarItem')"></textarea>
    							    	<label for="Comentario">Comentario</label>
									</div>
									
								</form>
								<div id="Res"></div>
								</div>
							</div>

						</div>
					</div>
					<script>
					 $("#AgregarItem").submit(function( event ) { 
						 var Precio = $('#Precio').val();
						 var Cantidad = $('#Cantidad').val();
						if(Precio==0){
							alert('El Precio No puede ser 0');
						}else{
							if(Cantidad==0 || Cantidad==''){
								alert('la Cantidad No puede ser 0');
							}else{
								var parametros = $(this).serialize();
	 					$.ajax({
		  					type: "POST",
							url: "Componentes/Ajax/AgregarItem.php",
		  					data: parametros,
			 				beforeSend: function(objeto){
			  				},
		  					success: function(datos){
	   							$('#BuscarItem').modal('close');
								   CargarProductos();
							}
  						});
  						
					
							}
						}
						event.preventDefault();
					})	
					</script>


						<?php
				}
				?>
				
			<?php
		}
	}
?>