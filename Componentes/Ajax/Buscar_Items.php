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
							$Des=$Resp[0];
							//$Precio = $Precio- ($Precio*$Resp[0]/100);
							$Descuento='<div class="row">
							<span class="blue-text text-darken-4">DESCUENTO:&nbsp;</span>
							<span class="black-text text-darken-4">'.number_format($Des,2).'%</span>
							<input type="text" class="hide" name="Descuento" Id="Descuento" value="'.$Des.'">
						</div>'	;
						}
					}else{
						$Descuento='';
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
						$Item=$row['ITEM'];
						$Descipcion=$row['DESCRIPCION'];
					
					$QConfi="SELECT ManejoExistencia FROM CONFIGURACION ";
					$ResConfi = mysqli_query($con, $QConfi);
					$Resp=mysqli_fetch_array($ResConfi);
					$ManejoExistencia =$Resp[0]; 

					if ($ManejoExistencia=='S'){
						$QExis="SELECT SALDO FROM EXISTENCIA WHERE ITEM ='$Item' AND BODEGA ='".$_SESSION['BODEGA']."' ";
						$ResExis = mysqli_query($con, $QExis);
						$Resp=mysqli_fetch_array($ResExis);
						$Saldo = $Resp[0];

						$QExis="SELECT SUM(CANTIDAD) AS CANTIDAD FROM TEMP_PEDIDOD WHERE ITEM ='$Item' AND BODEGA ='".$_SESSION['BODEGA']."' ";
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
										<input type="text" class="hide" name="ManejoExistencia" id="ManejoExistencia" value="<?php echo $ManejoExistencia; ?>">
										<input type="text" class="hide" name="Saldo" id="Saldo" value="<?php echo $Saldo; ?>">
									</div>
									<div class="row">
										<span class="blue-text text-darken-4">DESCRIPCION:&nbsp;</span>
										<span class="black-text text-darken-4"><?php echo $Descipcion; ?></span>
									</div>
									
									<?php
									echo $Descuento;
									echo $Existencia;
									?>
									<div class="row">	
										<div class="input-field col m6 " id='InputPrecio'>
											<input type="number" class="" name="Precio" Id="Precio" value="<?php echo $Precio; ?>" <?php echo $Modifica.' '.$Lista;?> >
          									<label for="Precio">PRECIO</label>
        								</div>
										<?php
										if($_SESSION['PERMISOPRECIO']=='S'){
										?>
										<div class="input-field col m6" id='SelectPrecio'>
										<a class='dropdown-trigger btn hide white' href='#' data-target='SPrecio' id='APrecio' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
											<!-- Dropdown Structure -->
											<ul id='SPrecio' class='dropdown-content ' onblur="$('#APrecio').addClass('hide');$('#InputPrecio').removeClass('hide');">
											<li  onclick="$('#Precio').val('<?php echo $row['PRICE']; ?>');"><a href="#!">$<?php echo number_format($row['PRICE'],2); ?></a></li>
											<li  onclick="$('#Precio').val('<?php echo $row['PRICE1']; ?>');"><a href="#!">$<?php echo number_format($row['PRICE1'],2); ?></a></li>
											<li  onclick="$('#Precio').val('<?php echo $row['PRICE2']; ?>');"><a href="#!">$<?php echo number_format($row['PRICE2'],2); ?></a></li>
											<li  onclick="$('#Precio').val('<?php echo $row['PRICE3']; ?>');"><a href="#!">$<?php echo number_format($row['PRICE3'],2); ?></a></li>
											<li  onclick="$('#Precio').val('<?php echo $row['PRICE4']; ?>');"><a href="#!">$<?php echo number_format($row['PRICE4'],2); ?></a></li>
											<li  onclick="$('#Precio').val('<?php echo $row['PRICE5']; ?>');"><a href="#!">$<?php echo number_format($row['PRICE5'],2); ?></a></li>
											</ul>
										</div>
										<?php
										}
										?>
										
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
					 $(document).ready(function(){
					  $('select').formSelect();
					  $('.dropdown-trigger').dropdown();
					 })
					 $("#SPrecio").on("click",function(){
  var se=$(this);
  se.hide();
});
$("#Precio").dblclick(function(){
	
	$('#APrecio').removeClass('hide');
	document.getElementById("APrecio").click();
	$('#APrecio').click();


    })
					 $("#AgregarItem").submit(function( event ) { 
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