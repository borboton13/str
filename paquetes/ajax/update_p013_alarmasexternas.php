

<?php
require("../../funciones/motor.php");		

	$idevento  = $_POST['idevento'];
	$idverificaralarmaexterna = $_POST['idverificaralarmaexterna'];
	$estado  = $_POST['estado'];
	$observaciones = $_POST['observaciones'];
			
	

	//$Hoy = date("Y-m-d H:i:s");
	
	$res = mysql_query("update p013_verificacionalarmasexternas set
	estado = '$estado',		
	observaciones = '$observaciones'		
	where idevento=$idevento and idverificaralarmaexterna=$idverificaralarmaexterna");


	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{             
		echo ("2");
	}
	mysql_free_result();
	mysql_close($conexion);
?>




 

