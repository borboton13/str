

<?php
require("../../funciones/motor.php");

	

	$idevento = $_POST['idevento'];
	$orden = $_POST['orden'];	
	$alarma = $_POST['alarma'];	
	//$alarma =str_replace("'","",$alarma];		
	$causa = $_POST['causa'];		
	$solucion = $_POST['solucion'];	
	//$solucion =str_replace("'","",$solucion];					
	$observaciones = $_POST['observaciones'];
	//$observaciones =str_replace("'","",$observaciones];					
			
	

	//$Hoy = date("Y-m-d H:i:s");
	
	$res = mysql_query("update p013_alarmas set
	alarma = '$alarma',		
	causa = '$causa',		
	solucion = '$solucion',			
	observaciones = '$observaciones'
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




 

