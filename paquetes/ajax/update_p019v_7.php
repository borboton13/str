

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
	$iddisptarjetasequipos=$_POST['iddisptarjetasequipos'];
	$cantidad=$_POST['cantidad'];		
	$puertosservicio=$_POST['puertosservicio'];
	$puertoslibres=$_POST['puertoslibres'];			
	
	$res =mysql_query("update p019v_disptarjetasequipos set		                           	
	cantidad='$cantidad',
	puertosservicio='$puertosservicio',
	puertoslibres='$puertoslibres'
	where idevento=$idevento and iddisptarjetasequipos =$iddisptarjetasequipos  
	");		
	
	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	//mysql_free_result();
	mysql_close($conexion);
?>




 
 




