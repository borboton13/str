
<?php
require("../../funciones/motor.php");

	date_default_timezone_set('America/La_Paz');

	$idevento = $_POST['idevento'];
	$idestacionentel = $_POST['idestacionentel'];		
	$orden = $_POST['orden'];		
	$sector = $_POST['sector'];		
	$localcellid = $_POST['localcellid'];		
	$bandamhz = $_POST['bandamhz'];		
	$modelorbs = $_POST['modelorbs'];		
	$tipoantena = $_POST['tipoantena'];		
	$marcaantena = $_POST['marcaantena'];		
	$modeloantena=$_POST['modeloantena'];
	$azimuth = $_POST['azimuth'];		
	$tiltmecanico = $_POST['tiltmecanico'];		
	$tiltelectrico = $_POST['tiltelectrico'];
	$anguloapertura = $_POST['anguloapertura'];
	$alturaantena = $_POST['alturaantena'];
	$tieneret = $_POST['tieneret'];
	$modelorru = $_POST['modelorru'];
	

	//$Hoy = date("Y-m-d H:i:s");
	
	$res = mysql_query("update p013_relevamientosceldas set 
	localcellid='$localcellid',
	bandamhz='$bandamhz',
	modelorbs='$modelorbs',
	tipoantena='$tipoantena',
	marcaantena='$marcaantena',
	modeloantena='$modeloantena',
	azimuth='$azimuth',
	tiltmecanico='$tiltmecanico',
	tiltelectrico='$tiltelectrico',
	anguloapertura='$anguloapertura',
	alturaantena='$alturaantena',
	tieneret='$tieneret',
	modelorru='$modelorru' where idevento=$idevento and idestacionentel=$idestacionentel and orden=$orden");

	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	mysql_free_result();
	mysql_close($conexion);
?>




 
 