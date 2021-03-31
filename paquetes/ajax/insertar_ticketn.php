
<?php
require("../../funciones/motor.php");

	date_default_timezone_set('America/La_Paz');

	$ticket=$_POST['ticket'];
	$idnodo=$_POST['idnodo'];
	$fecha_inicio_rif=$_POST['fecha_inicio_rif'];
	$hora_inicio_rif=$_POST['hora_inicio_rif'];
	$fecha_fin_rif=$_POST['fecha_fin_rif'];
	$hora_fin_rif=$_POST['hora_fin_rif'];
	$fecha_not_dim=$_POST['fecha_not_dim'];
	$hora_not_dim=$_POST['hora_not_dim'];
	$fecha_not_sitio=$_POST['fecha_not_sitio'];
	$hora_not_sitio=$_POST['hora_not_sitio'];
	$observaciones=$_POST['observaciones'];
	$descripcionfalla=$_POST['descripcionfalla'];
	$idtecnologia=$_POST['idtecnologia'];
	$idafectacionservicio=$_POST['idafectacionservicio'];
	$idsistemafalla=$_POST['idsistemafalla'];
	$idtipofalla=$_POST['idtipofalla'];
	$idequipofalla=$_POST['idequipofalla'];
	$idatencion=$_POST['idatencion'];
	$idestacion=$_POST['idestacion'];
	$idsolucion=$_POST['idsolucion'];

	$Hoy = date("Y-m-d H:i:s");
	$texto="insert into st_ticketn(
ticket,
idnodo,
fecha_inicio_rif,
hora_inicio_rif,
fecha_fin_rif,
hora_fin_rif,
fecha_not_dim,
hora_not_dim,
fecha_not_sitio,
hora_not_sitio,
observaciones,
descripcionfalla,
idtecnologia,
idafectacionservicio,
idsistemafalla,
idtipofalla,
idequipofalla,
idatencion,
idestacion,
idsolucion,
datecreated)
values(
'$ticket',
$idnodo,
'$fecha_inicio_rif',
'$hora_inicio_rif',
'$fecha_fin_rif',
'$hora_fin_rif',
'$fecha_not_dim',
'$hora_not_dim',
'$fecha_not_sitio',
'$hora_not_sitio',
'$observaciones',
'$descripcionfalla',
$idtecnologia,
$idafectacionservicio,
'$idsistemafalla',
'$idtipofalla',
'$idequipofalla',
$idatencion,
'$idestacion',
'$idsolucion',
'$Hoy')";
	$res = mysqli_query($conexion, $texto);
	
	if(mysqli_affected_rows()>0){
		echo "1";
	}
	else{
		echo ($texto);
	}
	mysqli_free_result();
	mysqli_close($conexion);
?>




 
 