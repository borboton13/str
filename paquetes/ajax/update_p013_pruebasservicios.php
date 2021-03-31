
<?php
require("../../funciones/motor.php");

//idevento
//idpruebaservicio
//numeroa
//numerob
//pruebaexitosa
//fechahora
//fecha
//hora
//observaciones

	

	$idevento = $_POST['idevento'];
	$idpruebaservicio = $_POST['idpruebaservicio'];	
	$numeroa = $_POST['numeroa'];		
	$numerob = $_POST['numerob'];		
	$pruebaexitosa = $_POST['pruebaexitosa'];			
	$fecha=$_POST["fecha"];
	
	//$fecha = DateTime::createFromFormat("d-m-Y", $_POST["fecha"]);	
	//	$fecha= $fecha->format('Y-m-d');

	$hora = $_POST['hora'];			
	$observaciones = $_POST['observaciones'];
	$newDate = date("Y-m-d", strtotime($_POST['fecha']));
	$fechahora = $newDate." ".$hora;	
	
	//echo($fechahora);
	//$newDate = 

	//$Hoy = date("Y-m-d H:i:s");				
	

	//$Hoy = date("Y-m-d H:i:s");
	
	$res = mysql_query("update p013_pruebasservicios set
numeroa='$numeroa',
numerob='$numerob',
pruebaexitosa='$pruebaexitosa',
fechahora='$fechahora',
fecha='$newDate',
hora='$hora',
observaciones='$observaciones'
where idevento=$idevento and idpruebaservicio=$idpruebaservicio");

	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	mysql_free_result();
	mysql_close($conexion);
?>




 

