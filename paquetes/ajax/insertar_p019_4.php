
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
	$numero = $_POST['numero'];
	$mediotransporte = $_POST['mediotransporte'];
	$existe = $_POST['existe'];
	$estadoequipo = $_POST['estadoequipo'];
	$cantidadpuertosrbs = $_POST['cantidadpuertosrbs'];
	$hilotx = $_POST['hilotx'];
	$hilorx = $_POST['hilorx'];
	$observaciones = $_POST['observaciones'];
	
	
	$res =mysql_query("insert into p019_transportefibra values (
	$idevento,
	$numero,
	'$mediotransporte',
	'$existe',
	'$estadoequipo',
	'$cantidadpuertosrbs',
	'$hilotx',
	'$hilorx',
	'$observaciones',
	0)");		
	
	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	//mysql_free_result();
	mysql_close($conexion);
?>




 
 

