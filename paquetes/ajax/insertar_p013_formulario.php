
<?php
require("../../funciones/motor.php");

	date_default_timezone_set('America/La_Paz');

	$idevento = $_POST['idevento'];
	$responsable = $_POST['responsable'];		
	$fechamantenimiento = $_POST['fechamantenimiento'];		
	$radiobase = $_POST['radiobase'];		
	$estado = $_POST['estado'];		
	$vendor = $_POST['vendor'];		
	$tipotransporte = $_POST['tipotransporte'];		
	$saltoanterior = $_POST['saltoanterior'];		
	$interface = $_POST['interface'];		
	$equipotransmision = $_POST['equipotransmision'];		
	$energiaprincipal = $_POST['energiaprincipal'];		
	$energiarespaldo = $_POST['energiarespaldo'];	
	$idestacion = $_POST['idestacion'];
	

	$Hoy = date("Y-m-d H:i:s");
	$res = mysql_query("INSERT INTO p013_formulario VALUES('$idevento','$responsable','$fechamantenimiento','$radiobase','$estado','$vendor','$tipotransporte','$saltoanterior','$interface','$equipotransmision','$energiaprincipal','$energiarespaldo','$idestacion','$Hoy')");
	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	//mysql_free_result();
	mysql_close($conexion);
?>




 
 