

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
	$numero = $_POST['numero'];
	$fabricante = $_POST['fabricante'];
	$existe = $_POST['existe'];
	$estado = $_POST['estado'];
	$modeloequipo = $_POST['modeloequipo'];
	$diametro = $_POST['diametro'];
	$potencia = $_POST['potencia'];
	$nivelrx = $_POST['nivelrx'];
	$observaciones = $_POST['observaciones'];			
	
	$res =mysql_query("update p019_transportesatelital set	
	fabricante='$fabricante',
	existe='$existe',
	estado='$estado',
	modeloequipo='$modeloequipo',
	diametro='$diametro',
	potencia='$potencia',
	nivelrx='$nivelrx',
	observaciones='$observaciones'
	 where idevento=$idevento and numero=$numero");		
	
	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	//mysql_free_result();
	mysql_close($conexion);
?>




 
 




