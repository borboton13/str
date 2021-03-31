<?php
	require("../../funciones/motor.php");

	$idequipofalla=filter_input(INPUT_POST,'idequipofalla');
	//$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = mysqli_query($conexion, "SELECT ticket_tipofalla.idtipofalla, ticket_tipofalla.nombretipofalla FROM ticket_tipofalla,ticket_equipofallatipofalla WHERE ticket_tipofalla.idtipofalla=ticket_equipofallatipofalla.idtipofalla and ticket_equipofallatipofalla.idequipofalla= '".$idequipofalla."'") ;
	//$filas=mysql_fetch_array($res);

	//echo ('alert("asdf");')
	
?>
	<option value="">-Seleccione</option>
	
	<?php
	//while ($ver=mysql_fetch_array($res)) {
	//foreach ($filas as $ver) {	

	while($ver = mysqli_fetch_array($res)){		?>
		<option value="<?= $ver['idtipofalla'] ?>"> <?= $ver['nombretipofalla'] ?></option>
		
	<?php } ?>