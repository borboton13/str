<?php
require("../../funciones/motor.php");



	$idevento = $_POST['idevento'];		
	$numero=$_POST['numero'];
	$idsitio=$_POST['idsitio'];
	$nombreestacion=$_POST['nombreestacion'];
	$tipoestacion=$_POST['tipoestacion'];
	$latitud=$_POST['latitud'];
	$longitud=$_POST['longitud'];
	$altura=$_POST['altura'];
	$torres=$_POST['torres'];
	$tipotorre=$_POST['tipotorre'];
	$alturatorre=$_POST['alturatorre'];
	$gabinetes=$_POST['gabinetes'];
	$tipogabinetes=$_POST['tipogabinetes'];
	

	$res = mysql_query("insert into p019v_relevamientoinfraestructura values (
	$idevento,
	$numero,
	'$idsitio',
	'$nombreestacion',
	'$tipoestacion',
	'$latitud',
	'$longitud',
	'$altura',
	'$torres',
	'$tipotorre',
	'$alturatorre',
	'$gabinetes',
	'$tipogabinetes',
	0)");

	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2" );
	}
	//mysql_free_result();
	mysql_close($conexion);
	
?>

