

<?php
require("../../funciones/motor.php");

	date_default_timezone_set('America/La_Paz');
	/*
	idevento:idevento,
	responsable:responsable,
	fechamantenimiento:fechamantenimiento,				
	observaciones:observaciones
	*/

	$idevento = $_POST['idevento'];
	$idmantenimientopreventivo = $_POST['idmantenimientopreventivo'];
	$estadoinicial = $_POST['estadoinicial'];
	$revisado = $_POST['revisado'];
	
	
	$res =mysql_query("update p019v_mantenimientopreventivo set	
	estadoinicial='$estadoinicial',
	revisado='$revisado'
	where idevento=$idevento and idmantenimientopreventivo=$idmantenimientopreventivo	");		
	
	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	//mysql_free_result();
	mysql_close($conexion);
?>




 
 




