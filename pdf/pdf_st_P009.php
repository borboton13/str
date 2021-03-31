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
JOIN p009_formulario h 	 ON p.id = h.id
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
//$pdf->line(20,670,590,670);
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
/** -------------------------------------------------------------------- **/
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
$pdf->ezText("\n",15);

/*Lineas rojas*/
$pdf->setStrokeColor(1,hexdec ('33')/255,hexdec('00')/255);

$pdf->line(20,615,590,615);

/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>1. Relevamiento</b>",10);

/** -------------------------------------------------------------------- **/
$data = array(
	array('c1'=>'Tiene Rectificador:',	'c2'=>utf8_decode($data_f['p01'])),
	array('c1'=>'Estado:',				'c2'=>utf8_decode($data_f['p02'])),
	array('c1'=>'Marca:',				'c2'=>utf8_decode($data_f['p03'])),
	array('c1'=>'Modelo:',				'c2'=>utf8_decode($data_f['p04'])),
	array('c1'=>'Serie:',				'c2'=>utf8_decode($data_f['p05'])),
	array('c1'=>'Voltaje (V):',			'c2'=>utf8_decode($data_f['p06'])),
	array('c1'=>'Capacidad (KVA):',		'c2'=>utf8_decode($data_f['p07'])),
	array('c1'=>'Cantidad de módulos:',	'c2'=>utf8_decode($data_f['p08']))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>0,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 10,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>200),
		'c2'=>array('justification'=>'left','width'=>350)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>2. Mantenimiento Preventivo</b>",10);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$data=array(array('izq'=>'ANTES MTTO.', 'der'=>'DESPUES MTTO.'));
$pdf->ezTable($data,'','',
	array('xPos'=>'242',
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
			'izq'=>array('justification'=>'center','width'=>151),
			'der'=>array('justification'=>'center','width'=>150),
		)
	));
/** -------------------------------------------------------------------- **/
$text_p09 = $data_f['p09'];
$arrays = explode('|', $text_p09);
$arr_f01 = explode(';', $arrays[0]);
$arr_f02 = explode(';', $arrays[1]);
$arr_f03 = explode(';', $arrays[2]);
$arr_f04 = explode(';', $arrays[3]);

$data = array(
	array('c1'=>'', 'c2'=>'Fase 1', 'c3'=>'Fase 2', 'c4'=>'Fase 3', 'c5'=>'Fase 1', 'c6'=>'Fase 2', 'c7'=>'Fase 3'),
	array('c1'=>utf8_decode($arr_f01[0]), 'c2'=>utf8_decode($arr_f01[1]), 'c3'=>utf8_decode($arr_f01[2]), 'c4'=>utf8_decode($arr_f01[3]), 'c5'=>utf8_decode($arr_f01[4]), 'c6'=>utf8_decode($arr_f01[5]), 'c7'=>utf8_decode($arr_f01[6])),
	array('c1'=>utf8_decode($arr_f02[0]), 'c2'=>utf8_decode($arr_f02[1]), 'c3'=>utf8_decode($arr_f02[2]), 'c4'=>utf8_decode($arr_f02[3]), 'c5'=>utf8_decode($arr_f02[4]), 'c6'=>utf8_decode($arr_f02[5]), 'c7'=>utf8_decode($arr_f02[6])),
	array('c1'=>utf8_decode($arr_f03[0]), 'c2'=>utf8_decode($arr_f03[1]), 'c3'=>utf8_decode($arr_f03[2]), 'c4'=>utf8_decode($arr_f03[3]), 'c5'=>utf8_decode($arr_f03[4]), 'c6'=>utf8_decode($arr_f03[5]), 'c7'=>utf8_decode($arr_f03[6])),
	array('c1'=>utf8_decode($arr_f04[0]), 'c2'=>utf8_decode($arr_f04[1]), 'c3'=>utf8_decode($arr_f04[2]), 'c4'=>utf8_decode($arr_f04[3]), 'c5'=>utf8_decode($arr_f04[4]), 'c6'=>utf8_decode($arr_f04[5]), 'c7'=>utf8_decode($arr_f04[6]))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>550,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>200),
		'c2'=>array('justification'=>'center','width'=>50),
		'c3'=>array('justification'=>'center','width'=>50),
		'c4'=>array('justification'=>'center','width'=>50),
		'c5'=>array('justification'=>'center','width'=>50),
		'c6'=>array('justification'=>'center','width'=>50),
		'c7'=>array('justification'=>'center','width'=>50)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$data = array(
	array('c1'=>'Corriente DC hacia la carga técnica de la estación [A]:',			'c2'=>utf8_decode($data_f['p10'])),
	array('c1'=>'Corriente DC hacia el banco de baterías de la estación [A]:',		'c2'=>utf8_decode($data_f['p11'])),
	array('c1'=>'Configuración de Parametros:',										'c2'=>utf8_decode($data_f['p12'])),
	array('c1'=>'Verificar y controlar la distribución de AC/DC en tableros:',		'c2'=>utf8_decode($data_f['p13'])),
	array('c1'=>'Revisión de sobrecalentamiento del cableado en AC/DC:',			'c2'=>utf8_decode($data_f['p14'])),
	array('c1'=>'Alarmas Activas:',													'c2'=>utf8_decode($data_f['p15']))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>0,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 10,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>300),
		'c2'=>array('justification'=>'left','width'=>250)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>