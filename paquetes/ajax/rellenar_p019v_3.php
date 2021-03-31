
<?php
require("../../funciones/motor.php");

$idevento = $_REQUEST['idevento'];

$res_form = mysql_query("SELECT * FROM p019v_transportemicroondas where idevento=$idevento order by numero ");

	 			// 	{field:'numero',title:'No.',width:30},
					// {field:'neorigen',title:'NE_Origen',width:70,editor:'text'},
					// {field:'nedestino',title:'NE_Destino',width:70,editor:'text'},
					// {field:'fabricante',title:'Fabricante',width:100,editor:'text'},
					// {field:'modelo',title:'Modelo',width:100,editor:'text'},
					// {field:'fretorigen',title:'Frecuencia Tx-Origen',width:140,editor:'text'},
					// {field:'fretdestino',title:'Frecuencia Tx-Destino',width:140,editor:'text'},
					// {field:'topologia',title:'Topologia Radio MW 1+1,1+0,2+0,XPIC, HTBY, SD',width:340,editor:'text'},
					// {field:'azimut',title:'Azimut',width:70,editor:'text'},
					// {field:'diametro',title:'Diametro',width:70,editor:'text'},
					// {field:'estado',title:'Estado',width:70,editor:'text'},															
					// {field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},
					// {field:'action',title:'Action',width:80,align:'center', 

$v = array();				

	
	while($row = mysql_fetch_array($res_form)) 
	{ 		
		
		
		
		$numero=$row['numero'];
		$neorigen=$row['neorigen'];
		$nedestino=$row['nedestino'];
		$sistema=$row['sistema'];
		$fabricante=$row['fabricante'];
		$modelo=$row['modelo'];
		$fretxorigen=$row['fretxorigen'];
		$fretxdestino=$row['fretxdestino'];
		$topologia=$row['topologia'];
		$azimut=$row['azimut'];
		$diametro=$row['diametro'];
		$estado=$row['estado'];
		$idevento=$row['idevento'];
		
		

		$v[]=array(
		'numero'=>$numero,
		'neorigen'=>$neorigen,
		'nedestino'=>$nedestino,
		'sistema'=>$sistema,
		'fabricante'=>$fabricante,
		'modelo'=>$modelo,
		'fretxorigen'=>$fretxorigen,
		'fretxdestino'=>$fretxdestino,
		'topologia'=>$topologia,
		'azimut'=>$azimut,
		'diametro'=>$diametro,
		'estado'=>$estado,
		'idevento'=>$idevento	);
		
	
	}
	

//$file = 'clientes.json';
	//file_put_contents($file, $json_string);

	$json_string = json_encode($v);
	echo $json_string;

// mysql_free_result();
// 	mysql_close($conexion);
	
	
	
?>


