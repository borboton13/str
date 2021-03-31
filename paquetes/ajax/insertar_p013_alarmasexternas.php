

<?php
require("../../funciones/motor.php");

	date_default_timezone_set('America/La_Paz');
	

	$idevento  = $_POST['idevento'];
	$idverificaralarmaexterna = $_POST['idverificaralarmaexterna'];
	$estado  = $_POST['estado'];
	$observaciones = $_POST['observaciones'];
			
	

	//$Hoy = date("Y-m-d H:i:s");
	
	$res = mysql_query("INSERT INTO p013_verificacionalarmasexternas VALUES('$idevento','$idverificaralarmaexterna','$estado','$observaciones')");


	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	//mysql_free_result();
	mysql_close($conexion);
?>




 

