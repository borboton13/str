
<?php
require("../../funciones/motor.php");

$idevento = $_REQUEST['idevento'];

$res_form = mysql_query("SELECT * from p019v_relevamientoserviciomovil WHERE idevento=$idevento ORDER BY numero");



	 			// {field:'numero',title:'No.',width:30},					
					// {field:'tecnologia',title:'Tecnologia',width:370,editor:'text'},													
					// {field:'fabricante',title:'Fabricante',width:300,editor:'text'},								
					// {field:'modelo',title:'Modelo',width:300,editor:'text'},								
					// {field:'tipoacceso',title:'Tipo de Acceso',width:200,editor:'text'},								
					// {field:'idevento',title:'idevento',width:150,hidden:true},		

$v = array();				

	
	while($row = mysql_fetch_array($res_form)) 
	{ 		
		
		
		
		$numero=$row['numero'];
		$tecnologia=$row['tecnologia'];
		$fabricante=$row['fabricante'];
		$modelo=$row['modelo'];
		$tipoacceso=$row['tipoacceso'];
		$idevento=$row['idevento'];

		
		

		

		$v[]=array(				
		'orden'=>$orden,
		'numero'=>$numero,
		'tecnologia'=>$tecnologia,
		'fabricante'=>$fabricante,
		'modelo'=>$modelo,
		'tipoacceso'=>$tipoacceso,
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






