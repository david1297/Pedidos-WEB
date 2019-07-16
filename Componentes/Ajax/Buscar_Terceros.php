<?php
 session_start();
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		$Tercero = mysqli_real_escape_string($con,(strip_tags($_REQUEST['Tercero'], ENT_QUOTES)));
		$ModificaV = $_SESSION['MODIFICAVEND'];
		$sql="SELECT id_n,company FROM  TERCEROS where  (company like '%$Tercero%' or id_n like '%$Tercero%') group by  id_n,company order by company";
		$query = mysqli_query($con, $sql);
		$row=mysqli_fetch_array($query);
			$id_n=$row['id_n'];
			$Nombre=$row['company'];

		$sTable = "PEDIDOE";
		$sWhere = "where  Id_N ='$id_n'";
		?>
			<a class="waves-effect waves-light btn green" onclick="NuevoPedido('<?php echo $id_n;?>')"><i class="material-icons left">add</i>Nuevo</a>
			
			<?php
			$sql1="SELECT count(*) as Cantidad FROM TEMP_PEDIDOD where Id_N = '$id_n' ";
			$query1 = mysqli_query($con, $sql1);
			$row1=mysqli_fetch_array($query1);
			if ($row1[0]<>0 ){
				?>
				<a class="waves-effect waves-light btn green" onclick="location.href='pedido.php?T=<?php echo $id_n;?>'">
					<i class="material-icons left">mode_edit</i>Pendiente
				</a>

				<?php
			}
		?>
			<a class="waves-effect waves-light btn green" onclick="Cartera('<?php echo $id_n;?>')"><i class="material-icons left">assessment</i>Cartera</a>
		<?php	
		
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
		$sql="SELECT  Tipo,Numero,Fecha,(Subtotal+Iva) as Total,Estado FROM  $sTable $sWhere and  (month(fecha) <= month(curdate()) or month(fecha) >=  month(curdate())-1) order by fecha desc,Numero desc LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
	
		if ($numrows>0){
			echo mysqli_error($con);
			
		

			?>
			
			<div class="table-responsive">
			  <table class="table table-hover">
				<tr  class="warning">
					<th>Tipo</th>
					<th>N°</th>
					<th>Total</th>
					<th>Fecha</th>
					<th>Estado</th>
					<th class='text-right'>Editar</th>
				</tr>
				<?php
				
				while($row=mysqli_fetch_array($query)){
					$Tipo=$row['Tipo'];
					$Numero=$row['Numero'];
					$Fecha=$row['Fecha'];
					$Total=$row['Total'];
					$Estado=$row['Estado'];
					?>
					<tr>
						<td class="text-center"><?php echo $Tipo; ?></td>
						<td class="text-center"><?php echo $Numero; ?></td>
						<td class="text-center">$<?php echo number_format($Total,2); ?></td>
						<td class="text-center"><?php echo $Fecha; ?></td>
						<td class="text-center"><?php echo $Estado; ?></td>
								
						<td class="text-right">
						<?php
						if ($Estado =='PENDIENTE'){
							?>
							<a href="#" class='btn btn-default green' title='Editar Campañas' onclick="EditarPedido('<?php echo $Tipo;?>',<?php echo $Numero;?>,'<?php echo $id_n;?>')"><i class="material-icons">keyboard_arrow_right</i></a> 
							<?php
						}else{
							?>
							<a href="#" class='btn btn-default red' title='Editar Campañas' onclick="EditarPedido('<?php echo $Tipo;?>',<?php echo $Numero;?>,'<?php echo $id_n;?>')"><i class="material-icons">keyboard_arrow_right</i></a> 		
							<?php

						}
						?>
							
						</td>
					</tr>
					<?php
				}
				
				
				?>
				<tr>
					<td colspan=7><span class="pull-right"><?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>