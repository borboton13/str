

<?php
require("../../funciones/motor.php");

	

	$idevento = $_POST['idevento'];
	$observacion = $_POST['observacion'];	
	//$observacion =str_replace("'","",$observacion];	
	$orden = $_POST['orden'];		
	
			
	

	//$Hoy = date("Y-m-d H:i:s");
	
	$res = mysql_query("update p013_observaciones set
	observacion = '$observacion'		
	where idevento=$idevento and orden=$orden");

	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	mysql_free_result();
	mysql_close($conexion);
?>




 

