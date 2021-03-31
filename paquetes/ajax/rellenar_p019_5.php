
<?php
require("../../funciones/motor.php");

$idevento = $_REQUEST['idevento'];

$res_form = mysql_query("SELECT * FROM p019_transportesatelital  where idevento=$idevento order by numero ");

	 			// {field:'numero',title:'No.',width:30},
					// {field:'fabricante',title:'Fabricante',width:150,editor:'text'},					
					// {field:'existe',title:'Existe',width:70,editor:'text'},
					// {field:'estado',title:'Estado',width:90,editor:'text'},
					// {field:'modeloequipo',title:'Modelo Equipo',width:120,editor:'text'},
					// {field:'diametro',title:'Diametro Antena',width:120,editor:'text'},
					// {field:'potencia',title:'Potencia BUC',width:100,editor:'text'},
					// {field:'nivelrx',title:'Nivel de Rx',width:110,editor:'text'},
					// {field:'observaciones',title:'Observaciones',width:410,editor:'text'},
					// {field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},

$v = array();				

	
	while($row = mysql_fetch_array($res_form)) 
	{ 		
		
		
		
		$numero=$row['numero'];
		$fabricante=$row['fabricante'];
		$existe=$row['existe'];
		$estado=$row['estado'];
		$modeloequipo=$row['modeloequipo'];
		$diametro=$row['diametro'];
		$potencia=$row['potencia'];
		$nivelrx=$row['nivelrx'];
		$observaciones=$row['observaciones'];
		$idevento=$row['idevento'];

		

		$v[]=array(
		'numero'=>$numero,
		'fabricante'=>$fabricante,
		'existe'=>$existe,
		'estado'=>$estado,
		'modeloequipo'=>$modeloequipo,
		'diametro'=>$diametro,
		'potencia'=>$potencia,
		'nivelrx'=>$nivelrx,
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


