<?php
require("../../funciones/motor.php");

$idevento = $_REQUEST['idevento'];


$res_form = mysql_query("SELECT * FROM p013_alarmas WHERE idevento=$idevento order by orden");
//$data_f = mysql_fetch_array($res_form);

$v = array();

					/*{field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},
					{field:'alarma',title:'Listar Alarmas de RBS por LMT, OMT',width:350,editor:'text'},
					{field:'causa',title:'Causa',width:200,editor:'text'},
					{field:'solucion',title:'Solucion',width:450,editor:'text'},
					{field:'observaciones',title:'Observaciones',width:450,editor:'text'},
					{field:'orden',tit
					*/

	
	while($row = mysql_fetch_array($res_form)) 
	{ 
		$idevento=$row['idevento'];
		$alarma=$row['alarma'];
		$causa=$row['causa'];
		$solucion=$row['solucion'];
		$observaciones=$row['observaciones'];
		$orden=$row['orden'];

		$v[]=array('idevento' => $idevento,'alarma'=>$alarma,'causa'=> $causa,'solucion'=>$solucion,'observaciones'=>$observaciones,'orden'=>$orden);
	
	}
	

//$file = 'clientes.json';
	//file_put_contents($file, $json_string);

	$json_string = json_encode($v);
	echo $json_string;

	//mysql_free_result();
	//mysql_close($conexion);
	
	
?>