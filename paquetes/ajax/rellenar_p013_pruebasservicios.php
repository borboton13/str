<?php
require("../../funciones/motor.php");

$idevento = $_REQUEST['idevento'];


$res_form = mysql_query("SELECT p013_pruebasservicios.idevento,p013_pruebasservicios.idpruebaservicio,p013_tpruebasservicios.nombrepruebaservicio,
p013_pruebasservicios.numeroa,p013_pruebasservicios.numerob,p013_pruebasservicios.pruebaexitosa,p013_pruebasservicios.fecha,
p013_pruebasservicios.hora,p013_pruebasservicios.observaciones,p013_tpruebasservicios.orden 
FROM p013_pruebasservicios,p013_tpruebasservicios WHERE p013_pruebasservicios.idpruebaservicio=p013_tpruebasservicios.idpruebaservicio and idevento=$idevento order by orden");
//$data_f = mysql_fetch_array($res_form);

$v = array();

					/*{field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},
					{field:'idpruebaservicio',title:'idpruebaservicio',width:100,editor:'text',hidden:true},					
					{field:'nombrepruebaservicio',title:'Prueba de servicio',width:300},
					{field:'numeroa',title:'Numero A',width:150,editor:'text'},
					{field:'numerob',title:'Numero B',width:150,editor:'text'},
					{field:'pruebaexitosa',title:'Prueba exitosa?',width:150,editor:'text'},
					{field:'fecha',title:'Fecha (dd-mm-YYYY)',width:170,editor:'text'},
					{field:'hora',title:'Hora (24 Hrs)',width:110,editor:'text'},
					{field:'observaciones',title:'Observaciones',width:420,editor:'text'},
					{field:'orden',title:'orden',width:100,editor:'text',hidden:true},		
					*/

	
	while($row = mysql_fetch_array($res_form)) 
	{ 
		$idevento=$row['idevento'];
		$idpruebaservicio=$row['idpruebaservicio'];
		$nombrepruebaservicio=$row['nombrepruebaservicio'];
		$numeroa=$row['numeroa'];
		$numerob=$row['numerob'];
		$pruebaexitosa=$row['pruebaexitosa'];
		$fecha=$row['fecha'];
		$hora=$row['hora'];
		$observaciones=$row['observaciones'];
		$orden=$row['orden'];

		$v[]=array('idevento' => $idevento,'idpruebaservicio'=>$idpruebaservicio,'nombrepruebaservicio'=> $nombrepruebaservicio,'numeroa'=>$numeroa,'numerob'=>$numerob,
'pruebaexitosa'=> $pruebaexitosa,'fecha'=>$fecha,'hora'=>$hora,'observaciones'=>$observaciones,'orden'=>$orden);
	
	}
	

//$file = 'clientes.json';
	//file_put_contents($file, $json_string);

	$json_string = json_encode($v);
	echo $json_string;

	// mysql_free_result();
	// mysql_close($conexion);
	
	
?>