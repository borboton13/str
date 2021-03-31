

					<?php
require("../../funciones/motor.php");

$idevento = $_REQUEST['idevento'];


$res_form = mysql_query("SELECT * FROM p013_relevamientosceldas,p013_formularioestaciones WHERE
p013_relevamientosceldas.idestacionentel=p013_formularioestaciones.idestacionentel AND p013_formularioestaciones.tecnologia ='RED 2G GSM' AND p013_relevamientosceldas.idevento=$idevento ORDER BY orden ");
//$data_f = mysql_fetch_array($res_form);

$v = array();

					/*{field:'orden',title:'Orden',width:100,editor:'text',hidden:true},
					{field:'sector',title:'Sector',width:55},
					{field:'localcellid',title:'Local Cell ID',width:100,editor:'text'},
					{field:'bandamhz',title:'Banda Mhz',width:100,editor:'text'},
					{field:'modelorbs',title:'Modelo RBS',width:100,editor:'text'},

					{field:'tipoantena',title:'Tipo de antena',width:120,editor:'text'},
					{field:'marcaantena',title:'Marca antena',width:105,editor:'text'},
					{field:'modeloantena',title:'Modelo de antena',width:135,editor:'text'},
					{field:'azimuth',title:'Azimuth',width:70,editor:'text'},
					{field:'tiltmecanico',title:'Tilt Mecanico',width:100,editor:'text'},

					{field:'tiltelectrico',title:'Tilt Electrico',width:100,editor:'text'},
					{field:'anguloapertura',title:'Angulo de apertura',width:145,editor:'text'},
					{field:'alturaantena',title:'Altura de antena(m)',width:150,editor:'text'},
					{field:'tieneret',title:'Tiene RET',width:80,editor:'text'},
					{field:'modelorru',title:'Modelo RRU',width:100,editor:'text'},		
					*/

	
	while($row = mysql_fetch_array($res_form)) 
	{ 
		$orden=$row['orden'];
		$sector=$row['sector'];
		$localcellid=$row['localcellid'];
		$bandamhz=$row['bandamhz'];
		$modelorbs=$row['modelorbs'];

		$tipoantena=$row['tipoantena'];
		$marcaantena=$row['marcaantena'];
		$modeloantena=$row['modeloantena'];
		$azimuth=$row['azimuth'];
		$tiltmecanico=$row['tiltmecanico'];

		$tiltelectrico=$row['tiltelectrico'];
		$anguloapertura=$row['anguloapertura'];
		$alturaantena=$row['alturaantena'];
		$tieneret=$row['tieneret'];
		$modelorru=$row['modelorru'];

		$v[]=array('orden' => $orden,
			'sector'=>$sector,			
			'localcellid'=>$localcellid,
			'bandamhz'=>$bandamhz,
			'modelorbs'=> $modelorbs,
			'tipoantena'=>$tipoantena,
			'marcaantena'=>$marcaantena,
			'modeloantena'=>$modeloantena,
			'azimuth'=>$azimuth,
			'tiltmecanico'=> $tiltmecanico,
			'tiltelectrico'=>$tiltelectrico,
			'anguloapertura'=>$anguloapertura,
			'alturaantena'=>$alturaantena,
			'tieneret'=>$tieneret,
			'modelorru'=> $modelorru);
	
	}
	

//$file = 'clientes.json';
	//file_put_contents($file, $json_string);

	$json_string = json_encode($v);
	echo $json_string;

	// mysql_free_result();
	// mysql_close($conexion);
	
	
?>