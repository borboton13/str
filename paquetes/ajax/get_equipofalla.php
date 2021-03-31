<?php
	require("../../funciones/motor.php");

	$idsistemafalla=filter_input(INPUT_POST,'idsistemafalla');
	//$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = mysqli_query($conexion, "SELECT idequipofalla, nombreequipofalla FROM ticket_equipofalla WHERE idsistemafalla= '".$idsistemafalla."'") ;
	//$filas=mysql_fetch_array($res);

	//echo ('alert("asdf");')
	
?>
	<option value="">-Seleccione</option>
	
	<?php
	//while ($ver=mysql_fetch_array($res)) {
	//foreach ($filas as $ver) {	

	while($ver = mysqli_fetch_array($res)){		?>
		<option value="<?= $ver['idequipofalla'] ?>"> <?=  $ver['nombreequipofalla'] ?></option>
		
	<?php } ?>

