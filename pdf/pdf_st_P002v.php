<?

$cod 		= strtolower(base64_decode($_GET["cod"]));
$idformtto 	= base64_decode($_GET["idformtto"]);

require("../funciones/motor.php");
require("../funciones/funciones.php");
include ('lib/class.ezpdf.php');

$fecha=date("d/m/Y");

$res_form = mysql_query("
SELECT  c.nombre AS nom_centro, c.depto, e.idgrupo, e.inicio, es.departamento, es.provicia, es.codigo, es.nombre AS nom_estacion, h.responsable, h.fechamantenimiento, p.*
FROM formulario_".$cod." p
JOIN evento e 	 ON p.idevento = e.idevento
JOIN estacion es ON e.idestacion = es.idestacion
JOIN centro c ON e.idcentro = c.idcentro
JOIN p002v_formulario h 	 ON p.id = h.id
WHERE p.id = ".$idformtto);
$data_f = mysql_fetch_array($res_form);


$codEs=$data_f['codigo'];
$resultado=mysql_query("SELECT localidad FROM estacion,estacionentel
WHERE estacion.codigo=estacionentel.idsitio
AND estacion.codigo='$codEs'");

$datolocalidad = mysql_fetch_array($resultado);
$localidad=$datolocalidad["localidad"];


$res_grupo = mysql_query("
SELECT CONCAT(u1.nombre,' ', u1.ap_pat) AS user1, CONCAT(u2.nombre,' ', u2.ap_pat) AS user2
FROM grupo g
JOIN usuarios u1 ON g.user1 = u1.id
JOIN usuarios u2 ON g.user2 = u2.id
WHERE g.idgrupo = ".$data_f['idgrupo']);
$data_g = mysql_fetch_array($res_grupo);

$datox=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='pie' AND sub_grupo='pie_pdf'"));
$pie=$datox['descripcion'];
 
$pdf =& new Cezpdf('LETTER','portrait');
$pdf->selectFont('fonts/Helvetica.afm');
$pdf->ezSetCmMargins(1,1,1.5,1);
			
////informacion de la pagina
$datacreator = array ('Title'=>'SISTEMA DE SEGUIMIENTO TECNICO','Author'=>'Ariel Siles Encinas','Subject'=>'ARCHIVO PDF DIMESAT','Creator'=>'ariel.siles@gmail.com','Producer'=>'http://facebook.com/');
$pdf->addInfo($datacreator);

$all = $pdf->openObject();
$pdf->saveState();
//$pdf->ezStartPageNumbers(537,35,10,'right','Pag. {PAGENUM} de {TOTALPAGENUM}');
$pdf->setStrokeColor(1,hexdec ('33')/255,hexdec('00')/255);
$pdf->line(20,32,590,32);
$pdf->line(20,742,590,742);

//$pdf->addTextWrap(12,20,580,9,$pie,'center');
$pdf->restoreState();
$pdf->closeObject();
$pdf->addObject($all,'all');

$data=array(array('title'=>'<b>'.utf8_decode($data_f['titulo']).'</b>'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>555,
		'colGap' => 5,
		'shaded'=> 0,
		'showLines'=> 0,
		'fontSize' => 10,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'title'=>array('justification'=>'center','width'=>555)
		)
	));

$pdf->ezText("\n",10);

$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/
$pdf->ezText(" CM/SCM",8);

$pdf->ezText("\n",4);
//$pdf->ezText("Centro o Subcentro:",10);
$pdf->ezText("\n",30);

$pdf->addText(157, 690, 8, $data_f['nom_centro']);
$pdf->rectangle(155, 685,160,15);

$pdf->addText(320, 690, 8, "Departamento \n");
$pdf->addText(390, 690, 8, $data_f['departamento']);
$pdf->rectangle(388, 685,160,15);

$pdf->addText(45, 670, 9, "Nombr. Responsable \n");
$pdf->addText(157, 670, 8, utf8_decode($data_f['responsable']));
$pdf->rectangle(155, 665,160,15);

$pdf->addText(320, 670, 9, "Provincia \n");
$pdf->addText(390, 668, 8, $data_f['provicia']);
$pdf->rectangle(388, 665,160,15);

$pdf->addText(45, 650, 9, "Fecha de mantenimiento \n");
$pdf->addText(157, 650, 8, $data_f['fechamantenimiento']);
$pdf->rectangle(155, 645,160,15);

$pdf->addText(320, 650, 9, "Localidad \n");
$pdf->addText(390, 648, 8, $localidad);
$pdf->rectangle(388, 645,160,15);

$pdf->addText(45, 630, 9, "Property_id \n");
$pdf->addText(157, 628, 8, $data_f['nom_estacion']);
$pdf->rectangle(155, 625,160,15);

$pdf->addText(320, 630, 9, "ID Sitio \n");
$pdf->addText(390, 628, 8, $data_f['codigo']);
$pdf->rectangle(388, 625,160,15);
$pdf->ezText("\n",10);

/*Lineas rojas*/
$pdf->setStrokeColor(1,hexdec ('33')/255,hexdec('00')/255);

$pdf->line(20,615,590,615);


/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>1. Relevamiento</b>",10);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>     Estructura 1</b>",10);
$data = array(
	array('c1'=>'Estado:',						'c2'=>$data_f['p01']),
	array('c1'=>'Tipo de estructura:',			'c2'=>$data_f['p02']),
	array('c1'=>'Altura de la estructura (m):',	'c2'=>utf8_decode($data_f['p03']))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>480,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>160),
		'c2'=>array('justification'=>'left','width'=>380)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>     Estructura 2</b>",10);
$data = array(
	array('c1'=>'Estado:',						'c2'=>$data_f['p04']),
	array('c1'=>'Tipo de estructura:',			'c2'=>$data_f['p05']),
	array('c1'=>'Altura de la estructura (m):',	'c2'=>utf8_decode($data_f['p06']))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>480,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>160),
		'c2'=>array('justification'=>'left','width'=>380)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);

/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>      Estacion</b>",10);
$data = array(
	array('c1'=>'Tipo de Cerramiento perimetral:','c2'=>utf8_decode($data_f['p08'])),
	array('c1'=>'Dimension de la estacion:', 'c2'=>utf8_decode($data_f['p09'])),
	array('c1'=>'Losa equipos (m):', 'c2'=>utf8_decode($data_f['p010'])),
	array('c1'=>'Losa o caseta grupo generador (m):', 'c2'=>utf8_decode($data_f['p011'])),
	array('c1'=>'Caseta de Sereno (m):', 'c2'=>utf8_decode($data_f['p012']))
);
$options = array('xPos'=>'80',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>480,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>160),
		'c2'=>array('justification'=>'left','width'=>380)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);


/** -------------------------------------------------------------------- **/
$pdf->ezText("\n",5);
$pdf->ezText("<b>2. Mantenimiento Preventivo</b>",10);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array( 'der'=>'Acciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'422',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>256,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'der'=>array('justification'=>'center','width'=>120)
		)
	));
	
$data=array(array('izq'=>'DESCRIPCION ESTADO (marque con X)', 'der'=>'Observacion','rep'=>'Reparado','aj'=>'Ajustado','ca'=>'Cambiado','pe'=>'Pendiente'));
$pdf->ezTable($data,'','',
	array('xPos'=>'223',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'izq'=>array('justification'=>'center','width'=>160),
			'der'=>array('justification'=>'center','width'=>40),
			'rep'=>array('justification'=>'center','width'=>30),
			'aj'=>array('justification'=>'center','width'=>30),
			'ca'=>array('justification'=>'center','width'=>30),
			'pe'=>array('justification'=>'center','width'=>30),
		)
	));
	
$text_p07 = $data_f['p07'];
$arrays = explode('|', $text_p07);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);
$arr_f6 = explode(';', $arrays[5]);


if($arr_f1[7] != '') $arr_f1[7] = 'X';
if($arr_f1[8] != '') $arr_f1[8] = 'X';
if($arr_f1[9] != '') $arr_f1[9] = 'X';
if($arr_f1[10] != '') $arr_f1[10] = 'X';


if($arr_f2[7] != '') $arr_f2[7] = 'X';
if($arr_f2[8] != '') $arr_f2[8] = 'X';
if($arr_f2[9] != '') $arr_f2[9] = 'X';
if($arr_f2[10] != '') $arr_f2[10] = 'X';


if($arr_f3[7] != '') $arr_f3[7] = 'X';
if($arr_f3[8] != '') $arr_f3[8] = 'X';
if($arr_f3[9] != '') $arr_f3[9] = 'X';
if($arr_f3[10] != '') $arr_f3[10] = 'X';


if($arr_f4[7] != '') $arr_f4[7] = 'X';
if($arr_f4[8] != '') $arr_f4[8] = 'X';
if($arr_f4[9] != '') $arr_f4[9] = 'X';
if($arr_f4[10] != '') $arr_f4[10] = 'X';


if($arr_f5[7] != '') $arr_f5[7] = 'X';
if($arr_f5[8] != '') $arr_f5[8] = 'X';
if($arr_f5[9] != '') $arr_f5[9] = 'X';
if($arr_f5[10] != '') $arr_f5[10] = 'X';

if($arr_f6[7] != '') $arr_f6[7] = 'X';
if($arr_f6[8] != '') $arr_f6[8] = 'X';
if($arr_f6[9] != '') $arr_f6[9] = 'X';
if($arr_f6[10] != '') $arr_f6[10] = 'X';



$data = array(


	array('c1'=>'Verificar la verticalidad de la estructura.', 'c2'=>'Vertical', 'c3'=>utf8_decode($arr_f1[3]), 'c4'=>'Inclinado', 'c5'=>utf8_decode($arr_f1[5]), 'c6'=>utf8_decode($arr_f1[6]), 'c7'=>$arr_f1[7], 'c8'=>$arr_f1[8], 'c9'=>$arr_f1[9], 'c10'=>$arr_f1[10]),
	
	array('c1'=>'Verificar si no existe puntos de oxidacion en la estructura y tomar fotografias en caso de encontrar anormalidades.', 'c2'=>'Oxidado', 'c3'=>utf8_decode($arr_f2[3]), 'c4'=>'Sin oxidacion', 'c5'=>utf8_decode($arr_f2[5]), 'c6'=>utf8_decode($arr_f2[6]), 'c7'=>$arr_f2[7], 'c8'=>$arr_f2[8], 'c9'=>$arr_f2[9], 'c10'=>$arr_f2[10]),
	
	array('c1'=>'Verificar la tension de los cables  de arriostramiento (Solo en torres arriostradas)', 'c2'=>'Tenso', 'c3'=>utf8_decode($arr_f3[3]), 'c4'=>'Suelto', 'c5'=>utf8_decode($arr_f3[5]), 'c6'=>utf8_decode($arr_f3[6]), 'c7'=>$arr_f3[7], 'c8'=>$arr_f3[8], 'c9'=>$arr_f3[9], 'c10'=>$arr_f3[10]),
	
	array('c1'=>'Verificar el estado del pintado de la estructura y adjuntar fotografias en caso de encontrar anormalidades', 'c2'=>'Pintado', 'c3'=>utf8_decode($arr_f4[3]), 'c4'=>'Despintado', 'c5'=>utf8_decode($arr_f4[5]), 'c6'=>utf8_decode($arr_f4[6]), 'c7'=>$arr_f4[7], 'c8'=>$arr_f4[8], 'c9'=>$arr_f4[9], 'c10'=>$arr_f4[10]),
	
	array('c1'=>'Verificar si existe hundimiento del terreno o esta estable.', 'c2'=>'Hundimiento', 'c3'=>utf8_decode($arr_f5[3]), 'c4'=>'Estable', 'c5'=>utf8_decode($arr_f5[5]), 'c6'=>utf8_decode($arr_f5[6]), 'c7'=>$arr_f5[7], 'c8'=>$arr_f5[8], 'c9'=>$arr_f5[9], 'c10'=>$arr_f5[10]),
	
	array('c1'=>'Verificar si los Pernos Principales estan ajustados', 'c2'=>'Ajustado', 'c3'=>utf8_decode($arr_f6[3]), 'c4'=>'Desajustado', 'c5'=>utf8_decode($arr_f6[5]), 'c6'=>utf8_decode($arr_f6[6]), 'c7'=>$arr_f6[7], 'c8'=>$arr_f6[8], 'c9'=>$arr_f6[9], 'c10'=>$arr_f6[10])
	);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 7,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
	    'a1'=>array('justification'=>'left','width'=>123),   
		'c1'=>array('justification'=>'left','width'=>180),
		'c2'=>array('justification'=>'center','width'=>40),
		'c3'=>array('justification'=>'center','width'=>40),
		'c4'=>array('justification'=>'center','width'=>40),
		'c5'=>array('justification'=>'center','width'=>40),
		'c6'=>array('justification'=>'center','width'=>40),
		'c7'=>array('justification'=>'center','width'=>30),
		'c8'=>array('justification'=>'center','width'=>30),
		'c9'=>array('justification'=>'center','width'=>30),
		'c10'=>array('justification'=>'center','width'=>30),
		'c11'=>array('justification'=>'center','width'=>30)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/
$pdf->ezText("\n",10);
$pdf->ezText(utf8_decode("<b>Otras observaciones:  </b>"),10);
$pdf->ezText("\n",1);

$data = array(
	
	array('c1'=>utf8_decode($data_f['p013']))  	
);	 	
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>500,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>500)								
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",4);


/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>