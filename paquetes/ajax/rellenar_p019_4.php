
<?php
require("../../funciones/motor.php");

$idevento = $_REQUEST['idevento'];

$res_form = mysql_query("SELECT * FROM p019_transportefibra  where idevento=$idevento order by numero ");

	 			// {field:'numero',title:'No.',width:30,editor:'text'},
					// {field:'mediotransporte',title:'Medio de Transporte',width:140,editor:'text'},
					// {field:'existe',title:'Existe',width:60,editor:'text'},
					// {field:'estadoequipo',title:'Estado del Equipo Tx',width:140,editor:'text'},
					// {field:'cantidadpuertosrbs',title:'Cantidad de puertos RBS',width:150,editor:'text'},
					// {field:'hilotx',title:'Etiqueta de puerto RBS-Hilo Tx From',width:215,editor:'text'},
					// {field:'hilorx',title:'Etiqueta de puerto RBS-Hilo Rx To',width:200,editor:'text'},
					// {field:'observaciones',title:'Observaciones',width:270,editor:'text'},
					// {field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},	

$v = array();				

	
	while($row = mysql_fetch_array($res_form)) 
	{ 		
		
		
		
		$numero=$row['numero'];
		$mediotransporte=$row['mediotransporte'];
		$existe=$row['existe'];
		$estadoequipo=$row['estadoequipo'];
		$cantidadpuertosrbs=$row['cantidadpuertosrbs'];
		$hilotx=$row['hilotx'];
		$hilorx=$row['hilorx'];
		$observaciones=$row['observaciones'];
		$idevento=$row['idevento'];				

		$v[]=array(
		'numero'=>$numero,
		'mediotransporte'=>$mediotransporte,
		'existe'=>$existe,
		'estadoequipo'=>$estadoequipo,
		'cantidadpuertosrbs'=>$cantidadpuertosrbs,
		'hilotx'=>$hilotx,
		'hilorx'=>$hilorx,
		'observaciones'=>$observaciones,
		'idevento'=>$idevento
		);
		
	
	}
	

//$file = 'clientes.json';
	//file_put_contents($file, $json_string);

	$json_string = json_encode($v);
	echo $json_string;

// mysql_free_result();
// 	mysql_close($conexion);
	
	
	
?>


