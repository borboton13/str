
<?php
require("../../funciones/motor.php");

$idevento = $_REQUEST['idevento'];

$res_form = mysql_query("SELECT * FROM p019v_relevamientoinfraestructura where idevento=$idevento order by numero ");


					//{field:'numero',title:'No.',width:30},
					// {field:'idsitio',title:'ID_Sitio',width:70,editor:'text'},
					// {field:'nombreestacion',title:'Nombre Estacion',width:150,editor:'text'},
					// {field:'tipoestacion',title:'Tipo de Estacion',width:100,editor:'text'},
					// {field:'latitud',title:'Latitud',width:100,editor:'text'},
					// {field:'longitud',title:'Longitud',width:100,editor:'text'},
					// {field:'altura',title:'Altura',width:70,editor:'text'},
					// {field:'torres',title:'No. Torres',width:70,editor:'text'},
					// {field:'tipotorre',title:'Tipo de torre',width:110,editor:'text'},
					// {field:'alturatorre',title:'Altura Torre',width:100,editor:'text'},
					// {field:'gabinetes',title:'No. Gabinetes',width:100,editor:'text'},
					// {field:'tipogabinetes',title:'Tipo de gabinetes',width:200,editor:'text'},
					// {field:'idevento',title:'idevento',width:100,editor:'text', hidden:'true'},

$v = array();				

	
	while($row = mysql_fetch_array($res_form)) 
	{ 		
		$numero=$row['numero'];
		$idsitio=$row['idsitio'];
		$nombreestacion=$row['nombreestacion'];
		$tipoestacion=$row['tipoestacion'];
		$latitud=$row['latitud'];
		$longitud=$row['longitud'];
		$altura=$row['altura'];
		$torres=$row['torres'];
		$tipotorre=$row['tipotorre'];
		$alturatorre=$row['alturatorre'];
		$gabinetes=$row['gabinetes'];
		$tipogabinetes=$row['tipogabinetes'];
		$idevento=$row['idevento'];


		$v[]=array('numero'=>$numero,
		'idsitio'=>$idsitio,
		'nombreestacion'=>$nombreestacion,
		'tipoestacion'=>$tipoestacion,
		'latitud'=>$latitud,
		'longitud'=>$longitud,
		'altura'=>$altura,
		'torres'=>$torres,
		'tipotorre'=>$tipotorre,
		'alturatorre'=>$alturatorre,
		'gabinetes'=>$gabinetes,
		'tipogabinetes'=>$tipogabinetes,
		'idevento'=>$idevento);
	
	}
	

//$file = 'clientes.json';
	//file_put_contents($file, $json_string);

	$json_string = json_encode($v);
	echo $json_string;

// mysql_free_result();
// 	mysql_close($conexion);
	
	
	
?>