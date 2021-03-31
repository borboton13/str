


<?php
require("../../funciones/motor.php");



	$idevento = $_POST['idevento'];
	$idverificacionfisica = $_POST['idverificacionfisica'];		
	$revisado = $_POST['revisado'];				
	$observacionesverificacion = $_POST['observacionesverificacion'];				
	$res = mysql_query("INSERT INTO p013_verificacionfisica VALUES('$idevento','$idverificacionfisica','$revisado','$observacionesverificacion')");

	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2" );
	}
	//mysql_free_result();
	mysql_close($conexion);
	
?>




 
 