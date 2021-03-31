
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
	$neorigen = $_POST['neorigen'];
	$nedestino = $_POST['nedestino'];
	$sistema = $_POST['sistema'];
	$fabricante = $_POST['fabricante'];
	$modelo = $_POST['modelo'];
	$fretxorigen = $_POST['fretxorigen'];
	$fretxdestino = $_POST['fretxdestino'];
	$topologia = $_POST['topologia'];
	$azimut = $_POST['azimut'];
	$diametro = $_POST['diametro'];
	$estado = $_POST['estado'];	
	
	$res =mysql_query("insert into p019v_transportemicroondas values(
	$idevento ,
	$numero ,
	'$neorigen',
	'$nedestino',
	'$sistema',
	'$fabricante',
	'$modelo',
	'$fretxorigen',
	'$fretxdestino',
	'$topologia',
	'$azimut',
	'$diametro',
	'$estado',
	0
	)");		
	
	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	//mysql_free_result();
	mysql_close($conexion);
?>




 
 