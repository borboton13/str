
<?php
require("../../funciones/motor.php");

	//date_default_timezone_set('America/La_Paz');

	$idevento = $_POST['idevento'];
	$idestacionentel = $_POST['idestacionentel'];		
	$nombrebts = $_POST['nombreestacionentel'];		
	$tecnologia = $_POST['tecnologia'];		
	$configuracion = $_POST['configuracion'];				

	//$Hoy = date("Y-m-d H:i:s");
	
	$res = mysql_query("update p013_formularioestaciones set
		configuracion='$configuracion' where idevento=$idevento and idestacionentel=$idestacionentel ");

	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	mysql_free_result();
	mysql_close($conexion);
?>




 
 