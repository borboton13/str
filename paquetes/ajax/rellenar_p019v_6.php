
<?php
require("../../funciones/motor.php");

$idevento = $_REQUEST['idevento'];

$res_form = mysql_query("SELECT  
p019v_mantenimientopreventivo.idmantenimientopreventivo,
p019v_tmantenimientopreventivo.nombremantenimiento,
p019v_mantenimientopreventivo.estadoinicial,
p019v_mantenimientopreventivo.revisado
FROM p019v_mantenimientopreventivo,p019v_tmantenimientopreventivo  where idevento=$idevento and  
p019v_mantenimientopreventivo.idmantenimientopreventivo=p019v_tmantenimientopreventivo.idmantenimientopreventivo
ORDER BY p019v_mantenimientopreventivo.idmantenimientopreventivo");



	 			// {field:'idmantenimientopreventivo',title:'',width:10,hidden:true},					
					// {field:'nombremantenimiento',title:'',width:750},								
					// {field:'estadoinicial',title:'Estado Inicial',width:300,editor:'text'},								
					// {field:'revisado',title:'Revisado',width:150,editor:'text'},	

$v = array();				

	
	while($row = mysql_fetch_array($res_form)) 
	{ 		
		
		
		
		$idmantenimientopreventivo=$row['idmantenimientopreventivo'];
		$nombremantenimiento=$row['nombremantenimiento'];
		$estadoinicial=$row['estadoinicial'];
		$revisado=$row['revisado'];
		

		

		$v[]=array(		
		'idmantenimientopreventivo'=>$idmantenimientopreventivo,
		'nombremantenimiento'=>$nombremantenimiento,
		'estadoinicial'=>$estadoinicial,		
		'revisado'=>$revisado			
		);
		
	
	}
	

//$file = 'clientes.json';
	//file_put_contents($file, $json_string);

	$json_string = json_encode($v);
	echo $json_string;

// mysql_free_result();
// 	mysql_close($conexion);
	
	
	
?>






