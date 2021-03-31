<?php
require("../../funciones/motor.php");

$idevento = $_REQUEST['idevento'];


$res_form = mysql_query("SELECT * FROM p013_verificacionalarmasexternas,p013_tverificacionalarmasexternas WHERE p013_verificacionalarmasexternas.idverificaralarmaexterna=p013_tverificacionalarmasexternas.idverificaralarmaexterna and idevento=$idevento order by orden");
//$data_f = mysql_fetch_array($res_form);

$v = array();

					/*{field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},
					{field:'idverificaralarmaexterna',title:'idverificaralarmaexterna',width:100,editor:'text',hidden:true},
					{field:'nombreverificaralarmaexterna',title:'Verificar alarmas externas',width:600},
					{field:'estado',title:'estado',width:100,editor:'text'},
					{field:'observaciones',title:'observaciones',width:750,editor:'text'},
					{field:'orden',title:'orden',width:100,editor:'text',hidden:true},									
					
					*/

	
	while($row = mysql_fetch_array($res_form)) 
	{ 
		$idevento=$row['idevento'];
		$idverificaralarmaexterna=$row['idverificaralarmaexterna'];
		$nombreverificaralarmaexterna=$row['nombreverificaralarmaexterna'];
		$estado=$row['estado'];
		$observaciones=$row['observaciones'];
		$orden=$row['orden'];

		$v[]=array('idevento' => $idevento,'idverificaralarmaexterna'=>$idverificaralarmaexterna,'nombreverificaralarmaexterna'=> $nombreverificaralarmaexterna,'estado'=>$estado,'observaciones'=>$observaciones,'orden'=>$orden);
	
	}
	

//$file = 'clientes.json';
	//file_put_contents($file, $json_string);

	$json_string = json_encode($v);
	echo $json_string;

//mysql_free_result();
//	mysql_close($conexion);
	
	
	
?>