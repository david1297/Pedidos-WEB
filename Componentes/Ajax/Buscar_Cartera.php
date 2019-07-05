<?php
 session_start();
	require_once ("../../config/db.php");
	require_once ("../../config/conexion.php");
	$Id_N = mysqli_real_escape_string($con,(strip_tags($_REQUEST['Id_N'], ENT_QUOTES)));

	$sql="SELECT * FROM  Cartera where  Id_N = '$Id_N'";
	$query = mysqli_query($con, $sql);
	?>
	<div class="row">
	<?php
	while($row=mysqli_fetch_array($query)){
		?>
		
			<div class="col s12 m12">
			<div class="card-panel ">
			<span class="black-text">Tipo:&nbsp;</span><span class="black-text"><?php echo $row['Cruce'];?></span><br>
			<span class="black-text">Numero:&nbsp;</span><span class="black-text"><?php echo $row['Invc'];?></span><br>
			<span class="black-text">Saldo:&nbsp;</span><span class="black-text">$<?php echo  number_format($row['Saldo'],2);?></span><br>

			</div>
			</div>
		
		<?php
	}
	


?>
</div>