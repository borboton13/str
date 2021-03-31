
<?php
require("../../funciones/motor.php");

$idevento = $_REQUEST['idevento'];

$res_form = mysql_query("SELECT  p019v_tdisptarjetasequipos.orden,
p019v_tdisptarjetasequipos.nombredistarjetasequipos,
p019v_disptarjetasequipos.cantidad,
p019v_disptarjetasequipos.puertosservicio,
p019v_disptarjetasequipos.puertoslibres,
p019v_disptarjetasequipos.iddisptarjetasequipos

from p019v_disptarjetasequipos,p019v_tdisptarjetasequipos
WHERE p019v_disptarjetasequipos.iddisptarjetasequipos=p019v_tdisptarjetasequipos.iddisptarjetasequipos
AND idevento=$idevento
ORDER BY p019v_tdisptarjetasequipos.orden");



	 			// {field:'orden',title:'orden',width:10,hidden:true},
					// {field:'nombredistarjetasequipos',title:'Tarjeta',width:150},					
					// {field:'cantidad',title:'Cantidad',width:150,editor:'text'},													
					// {field:'puertosservicio',title:'Puertos en Servicio',width:300,editor:'text'},								
					// {field:'puertoslibres',title:'Puertos Libres',width:310,editor:'text'},								
					// {field:'iddisptarjetasequipos',title:'iddisptarjetasequipos',width:150,hidden:true},		

$v = array();				

	
	while($row = mysql_fetch_array($res_form)) 
	{ 		
		
		
		
		$orden=$row['orden'];
		$nombredistarjetasequipos=$row['nombredistarjetasequipos'];
		$cantidad=$row['cantidad'];
		$puertosservicio=$row['puertosservicio'];
		$puertoslibres=$row['puertoslibres'];
		$iddisptarjetasequipos=$row['iddisptarjetasequipos'];
		

		

		$v[]=array(		
		'idmantenimientopreventivo'=>$idmantenimientopreventivo,
		'orden'=>$orden,
		'nombredistarjetasequipos'=>$nombredistarjetasequipos,
		'cantidad'=>$cantidad,
		'puertosservicio'=>$puertosservicio,
		'puertoslibres'=>$puertoslibres,
		'iddisptarjetasequipos'=>$iddisptarjetasequipos
				
		);
		
	
	}
	

//$file = 'clientes.json';
	//file_put_contents($file, $json_string);

	$json_string = json_encode($v);
	echo $json_string;

// mysql_free_result();
// 	mysql_close($conexion);
	
	
	
?>






