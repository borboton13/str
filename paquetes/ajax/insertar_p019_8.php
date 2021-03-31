


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
	$tecnologia = $_POST['tecnologia'];	
	$fabricante = $_POST['fabricante'];
	$modelo = $_POST['modelo'];
	$tipoacceso = $_POST['tipoacceso'];		
	
	$res =mysql_query("insert into p019_relevamientoserviciomovil values (
	$idevento,
	$numero,
	'$tecnologia',
	'$fabricante',
	'$modelo',
	'$tipoacceso',
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

