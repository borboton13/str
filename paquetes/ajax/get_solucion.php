<?php
	require("../../funciones/motor.php");

	$idequipofalla=filter_input(INPUT_POST,'idequipofalla');
	$idtipofalla=filter_input(INPUT_POST,'idtipofalla');
	
	//$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = mysqli_query($conexion, "SELECT ticket_solucion.idsolucion,ticket_solucion.nombresolucion FROM ticket_equipofalla,ticket_tipofallasolucion,ticket_tipofalla,ticket_solucion WHERE ticket_equipofalla.idequipofalla=ticket_tipofallasolucion.idequipofalla and
	ticket_tipofalla.idtipofalla=ticket_tipofallasolucion.idtipofalla AND
	ticket_solucion.idsolucion=ticket_tipofallasolucion.idsolucion and
	ticket_equipofalla.idequipofalla='". $idequipofalla ."' and
	ticket_tipofalla.idtipofalla='".$idtipofalla."' ORDER BY ticket_equipofalla.nombreequipofalla") ;


	//$filas=mysql_fetch_array($res);

	//echo ('alert("asdf");')
	
?>
	<option value="">-Seleccione</option>
	
	<?php
	//while ($ver=mysql_fetch_array($res)) {
	//foreach ($filas as $ver) {	

	while($ver = mysqli_fetch_array($res)){		?>
		<option value="<?= $ver['idsolucion'] ?>"> <?= $ver['nombresolucion'] ?></option>
		
	<?php } ?>
