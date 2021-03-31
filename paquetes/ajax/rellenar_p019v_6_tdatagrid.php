

					<?php
require("../../funciones/motor.php");


$res_form = mysql_query("SELECT * FROM p019v_tmantenimientopreventivo ORDER BY orden ");
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
		$nombremantenimiento=$row['nombremantenimiento'];
		$estadoinicial=$row['estadoinicial'];
		$revisado=$row['revisado'];
		$idmantenimientopreventivo=$row['idmantenimientopreventivo'];

		$v[]=array('nombremantenimiento' => $nombremantenimiento,
			'estadoinicial'=>$estadoinicial,			
			'nombremantenimiento'=>$nombremantenimiento,
			'revisado'=>$revisado,
			'idmantenimientopreventivo'=> $idmantenimientopreventivo);
	
	}
	

//$file = 'clientes.json';
	//file_put_contents($file, $json_string);

	$json_string = json_encode($v);
	echo $json_string;

// mysql_free_result();
// 	mysql_close($conexion);
	
	
	
?>