
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
	$responsable = $_POST['responsable'];		
	$fechamantenimiento = $_POST['fechamantenimiento'];			
	$observaciones = $_POST['observaciones'];	

	$Hoy = date("Y-m-d H:i:s");
	$res =mysql_query("INSERT INTO p002_formulario VALUES('$idevento','$responsable','$fechamantenimiento','$observaciones','$Hoy')");		
	
	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	//mysql_free_result();
	mysql_close($conexion);
?>




 
 