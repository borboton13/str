<?
$id_st_cronograma_informes = base64_decode($_GET["id_st_cronograma_informes"]);
$pro_key="f001";

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
JOIN p001v_formulario h 	 ON p.id = h.id
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
$pdf->ezText("\n",5);

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

$pdf->ezText("<b>1. Relevamiento</b>",10);
$data = array(
	array('c1'=>'Dirección:',				'c2'=>utf8_decode($data_f['p01'])),
	array('c1'=>'Tipo de estación:',		'c2'=>utf8_decode($data_f['p02'])),
	array('c1'=>'Propiedad:',				'c2'=>utf8_decode($data_f['p03'])),
	array('c1'=>'Requiere desmalezado?:',	'c2'=>utf8_decode($data_f['p04'])),
	array('c1'=>'Horarios de accesibilidad al sitio:',	'c2'=>utf8_decode($data_f['p05']))
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
$pdf->ezText("\n",3);

$data=array(array('izq'=>'Temporada Seca', 'der'=>'Temporada Lluvia'));
$pdf->ezTable($data,'','',
	array('xPos'=>'102',
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
			'izq'=>array('justification'=>'center','width'=>102),
			'der'=>array('justification'=>'center','width'=>102),
			)
	));

$text_p06 = $data_f['p06'];
$arrays = explode('|', $text_p06);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);

$data = array(
	array('c1'=>'Tipo de acceso', 'c2'=>'Distancia Km', 'c3'=>'Tiempo en hrs', 'c4'=>'Distancia Km', 'c5'=>'Tiempo en hrs', 'c6'=>'Observaciones'),
	array('c1'=>$arr_f1[0], 'c2'=>utf8_decode($arr_f1[1]), 'c3'=>utf8_decode($arr_f1[2]), 'c4'=>utf8_decode($arr_f1[3]), 'c5'=>utf8_decode($arr_f1[4]), 'c6'=>utf8_decode($arr_f1[5])),
	array('c1'=>$arr_f2[0], 'c2'=>utf8_decode($arr_f2[1]), 'c3'=>utf8_decode($arr_f2[2]), 'c4'=>utf8_decode($arr_f2[3]), 'c5'=>utf8_decode($arr_f2[4]), 'c6'=>utf8_decode($arr_f2[5])),
	array('c1'=>$arr_f3[0], 'c2'=>utf8_decode($arr_f3[1]), 'c3'=>utf8_decode($arr_f3[2]), 'c4'=>utf8_decode($arr_f3[3]), 'c5'=>utf8_decode($arr_f3[4]), 'c6'=>utf8_decode($arr_f3[5])),
	array('c1'=>$arr_f4[0], 'c2'=>utf8_decode($arr_f4[1]), 'c3'=>utf8_decode($arr_f4[2]), 'c4'=>utf8_decode($arr_f4[3]), 'c5'=>utf8_decode($arr_f4[4]), 'c6'=>utf8_decode($arr_f4[5])),
	array('c1'=>$arr_f5[0], 'c2'=>utf8_decode($arr_f5[1]), 'c3'=>utf8_decode($arr_f5[2]), 'c4'=>utf8_decode($arr_f5[3]), 'c5'=>utf8_decode($arr_f5[4]), 'c6'=>utf8_decode($arr_f5[5]))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>60),
		'c2'=>array('justification'=>'center','width'=>52),
		'c3'=>array('justification'=>'center','width'=>50),
		'c4'=>array('justification'=>'center','width'=>52),
		'c5'=>array('justification'=>'center','width'=>50),
		'c6'=>array('justification'=>'center','width'=>150)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array(	'h01'=>'Malo','h02'=>'Bueno','h03'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'280',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>400,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 5,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>35),
			'h02'=>array('justification'=>'center','width'=>35),
			'h03'=>array('justification'=>'center','width'=>70)
		)
	));

$text_p07 = $data_f['p07'];
$arrays = explode('|', $text_p07);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);


if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[1] != '') $arr_f1[1] = 'X';



if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[1] != '') $arr_f2[1] = 'X';


$data = array(
	array('c1'=>utf8_decode($arr_f1[0]), 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>utf8_decode($arr_f1[3])),
	array('c1'=>utf8_decode($arr_f2[0]), 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>utf8_decode($arr_f2[3]))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 6,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>238),
		'c2'=>array('justification'=>'center','width'=>35),
		'c3'=>array('justification'=>'center','width'=>35),
		'c4'=>array('justification'=>'center','width'=>70)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/
$pdf->ezText("\n",5);
$pdf->ezText("<b>2. Mantenimiento Preventivo</b>",10);
$pdf->ezText("\n",5);
$data=array(array(	'hx'=>'LIMPIEZA DE EQUIPOS Y AMBIENTES:','h01'=>'No Existe','h02'=>'Ejecutado','h03'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>400,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 2,
		'fontSize' => 5,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
		    'hx'=>array('justification'=>'center','width'=>238),
			'h01'=>array('justification'=>'center','width'=>35),
			'h02'=>array('justification'=>'center','width'=>35),
			'h03'=>array('justification'=>'center','width'=>70)
			)
	));

$text_p08 = $data_f['p08'];
$arrays = explode('|', $text_p08);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);
$arr_f6 = explode(';', $arrays[5]);
$arr_f7 = explode(';', $arrays[6]);
$arr_f8 = explode(';', $arrays[7]);
$arr_f9 = explode(';', $arrays[8]);
$arr_f10 = explode(';', $arrays[9]);
$arr_f11 = explode(';', $arrays[10]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';


if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';


if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f3[2] != '') $arr_f3[2] = 'X';


if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f4[2] != '') $arr_f4[2] = 'X';

if($arr_f5[1] != '') $arr_f5[1] = 'X';
if($arr_f5[2] != '') $arr_f5[2] = 'X';


if($arr_f6[1] != '') $arr_f6[1] = 'X';
if($arr_f6[2] != '') $arr_f6[2] = 'X';


if($arr_f7[1] != '') $arr_f7[1] = 'X';
if($arr_f7[2] != '') $arr_f7[2] = 'X';


if($arr_f8[1] != '') $arr_f8[1] = 'X';
if($arr_f8[2] != '') $arr_f8[2] = 'X';


if($arr_f9[1] != '') $arr_f9[1] = 'X';
if($arr_f9[2] != '') $arr_f9[2] = 'X';


if($arr_f10[1] != '') $arr_f10[1] = 'X';
if($arr_f10[2] != '') $arr_f10[2] = 'X';


$data = array(
	array('c1'=>utf8_decode($arr_f1[0]), 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>utf8_decode($arr_f1[3])),
	array('c1'=>utf8_decode($arr_f2[0]), 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>utf8_decode($arr_f2[3])),
	array('c1'=>utf8_decode($arr_f3[0]), 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>utf8_decode($arr_f3[3])),
	array('c1'=>utf8_decode($arr_f4[0]), 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>utf8_decode($arr_f4[3])),
	array('c1'=>utf8_decode($arr_f5[0]), 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>utf8_decode($arr_f5[3])),
	array('c1'=>utf8_decode($arr_f6[0]), 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2], 'c4'=>utf8_decode($arr_f6[3])),
	array('c1'=>utf8_decode($arr_f7[0]), 'c2'=>$arr_f7[1], 'c3'=>$arr_f7[2], 'c4'=>utf8_decode($arr_f7[3])),
	array('c1'=>utf8_decode($arr_f8[0]), 'c2'=>$arr_f8[1], 'c3'=>$arr_f8[2], 'c4'=>utf8_decode($arr_f8[3])),
	array('c1'=>utf8_decode($arr_f9[0]), 'c2'=>$arr_f9[1], 'c3'=>$arr_f9[2], 'c4'=>utf8_decode($arr_f9[3])),
    array('c1'=>utf8_decode($arr_f10[0]), 'c2'=>$arr_f10[1], 'c3'=>$arr_f10[2],'c4'=>utf8_decode($arr_f10[3]))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 6,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>238),
		'c2'=>array('justification'=>'center','width'=>35),
		'c3'=>array('justification'=>'center','width'=>35),
		'c4'=>array('justification'=>'center','width'=>70)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);

/**----------------------batman------------------------**/


$pdf->ezText("\n",5);
$data=array(array(	'hx'=>'VERIFICACIÓN DE AMBIENTES:','h01'=>'No Existe','h02'=>'Existe','h03'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>400,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 2,
		'fontSize' => 5,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
		    'hx'=>array('justification'=>'center','width'=>238),
			'h01'=>array('justification'=>'center','width'=>35),
			'h02'=>array('justification'=>'center','width'=>35),
			'h03'=>array('justification'=>'center','width'=>70)
			)
	));

$text_p11 = $data_f['p11'];
$arrays = explode('|', $text_p11);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';


if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';


if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f3[2] != '') $arr_f3[2] = 'X';


if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f4[2] != '') $arr_f4[2] = 'X';


$data = array(
	array('c1'=>utf8_decode($arr_f1[0]), 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>utf8_decode($arr_f1[3])),
	array('c1'=>utf8_decode($arr_f2[0]), 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>utf8_decode($arr_f2[3])),
	array('c1'=>utf8_decode($arr_f3[0]), 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>utf8_decode($arr_f3[3])),
	array('c1'=>utf8_decode($arr_f4[0]), 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>utf8_decode($arr_f4[3]))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 6,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>238),
		'c2'=>array('justification'=>'center','width'=>35),
		'c3'=>array('justification'=>'center','width'=>35),
		'c4'=>array('justification'=>'center','width'=>70)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/**---------------------------batman-------------------**/
/** -------------------------------------------------------------------- **/
$data=array(array(	'hx'=>'VERIFICACIÓN DE SISTEMA DE ILUMINACIÓN:','h01'=>'No Existe','h02'=>'Correcta','h03'=>'Incorrecta','h04'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>400,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 2,
		'fontSize' => 5,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
		    'hx'=>array('justification'=>'center','width'=>238),
			'h01'=>array('justification'=>'center','width'=>35),
			'h02'=>array('justification'=>'center','width'=>35),
			'h03'=>array('justification'=>'center','width'=>35),
			'h04'=>array('justification'=>'center','width'=>70)
			)
	));


$text_p09 = $data_f['p09'];
$arrays = explode('|', $text_p09);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[3] != '') $arr_f1[3] = 'X';

if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[3] != '') $arr_f2[3] = 'X';

if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f3[2] != '') $arr_f3[2] = 'X';
if($arr_f3[3] != '') $arr_f3[3] = 'X';


if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f4[2] != '') $arr_f4[2] = 'X';
if($arr_f4[3] != '') $arr_f4[3] = 'X';

$data = array(
	array('c1'=>utf8_decode($arr_f1[0]), 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>utf8_decode($arr_f1[4])),
	array('c1'=>utf8_decode($arr_f2[0]), 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>utf8_decode($arr_f2[4])),
	array('c1'=>utf8_decode($arr_f3[0]), 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>utf8_decode($arr_f3[4])),
	array('c1'=>utf8_decode($arr_f4[0]), 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>utf8_decode($arr_f4[4]))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 6,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>238),
		'c2'=>array('justification'=>'center','width'=>35),
		'c3'=>array('justification'=>'center','width'=>35),
		'c4'=>array('justification'=>'center','width'=>35),
		'c5'=>array('justification'=>'center','width'=>70)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",30);
/** -------------------------------------------------------------------- **/

$data=array(array(	'hx'=>'ESTRUCTURA METÁLICA:','h01'=>'No Existe','h02'=>'Correcta','h03'=>'Incorrecta','h04'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>400,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 2,
		'fontSize' => 5,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
		    'hx'=>array('justification'=>'center','width'=>238),
			'h01'=>array('justification'=>'center','width'=>35),
			'h02'=>array('justification'=>'center','width'=>35),
			'h03'=>array('justification'=>'center','width'=>35),
			'h04'=>array('justification'=>'center','width'=>70)
			)
	));

$text_p10 = $data_f['p10'];
$arrays = explode('|', $text_p10);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);
$arr_f6 = explode(';', $arrays[5]);
$arr_f7 = explode(';', $arrays[6]);
$arr_f8 = explode(';', $arrays[7]);
$arr_f9 = explode(';', $arrays[8]);
$arr_f10 = explode(';', $arrays[9]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[3] != '') $arr_f1[3] = 'X';

if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[3] != '') $arr_f2[3] = 'X';

if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f3[2] != '') $arr_f3[2] = 'X';
if($arr_f3[3] != '') $arr_f3[3] = 'X';


if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f4[2] != '') $arr_f4[2] = 'X';
if($arr_f4[3] != '') $arr_f4[3] = 'X';

if($arr_f5[1] != '') $arr_f5[1] = 'X';
if($arr_f5[2] != '') $arr_f5[2] = 'X';
if($arr_f5[3] != '') $arr_f5[3] = 'X';

if($arr_f6[1] != '') $arr_f6[1] = 'X';
if($arr_f6[2] != '') $arr_f6[2] = 'X';
if($arr_f6[3] != '') $arr_f6[3] = 'X';

if($arr_f7[1] != '') $arr_f7[1] = 'X';
if($arr_f7[2] != '') $arr_f7[2] = 'X';
if($arr_f7[3] != '') $arr_f7[3] = 'X';

if($arr_f8[1] != '') $arr_f8[1] = 'X';
if($arr_f8[2] != '') $arr_f8[2] = 'X';
if($arr_f8[3] != '') $arr_f8[3] = 'X';

if($arr_f9[1] != '') $arr_f9[1] = 'X';
if($arr_f9[2] != '') $arr_f9[2] = 'X';
if($arr_f9[3] != '') $arr_f9[3] = 'X';

if($arr_f10[1] != '') $arr_f10[1] = 'X';
if($arr_f10[2] != '') $arr_f10[2] = 'X';
if($arr_f10[3] != '') $arr_f10[3] = 'X';


$data = array(
	array('c1'=>utf8_decode($arr_f1[0]), 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>utf8_decode($arr_f1[4])),
	array('c1'=>utf8_decode($arr_f2[0]), 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>utf8_decode($arr_f2[4])),
	array('c1'=>utf8_decode($arr_f3[0]), 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>utf8_decode($arr_f3[4])),
	array('c1'=>utf8_decode($arr_f4[0]), 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>utf8_decode($arr_f4[4])),
	array('c1'=>utf8_decode($arr_f5[0]), 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3], 'c5'=>utf8_decode($arr_f5[4])),
	array('c1'=>utf8_decode($arr_f6[0]), 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2], 'c4'=>$arr_f6[3], 'c5'=>utf8_decode($arr_f6[4])),
	array('c1'=>utf8_decode($arr_f7[0]), 'c2'=>$arr_f7[1], 'c3'=>$arr_f7[2], 'c4'=>$arr_f7[3], 'c5'=>utf8_decode($arr_f7[4])),
	array('c1'=>utf8_decode($arr_f8[0]), 'c2'=>$arr_f8[1], 'c3'=>$arr_f8[2], 'c4'=>$arr_f8[3], 'c5'=>utf8_decode($arr_f8[4])),
	array('c1'=>utf8_decode($arr_f9[0]), 'c2'=>$arr_f9[1], 'c3'=>$arr_f9[2], 'c4'=>$arr_f9[3], 'c5'=>utf8_decode($arr_f9[4])),
	array('c1'=>utf8_decode($arr_f10[0]), 'c2'=>$arr_f10[1], 'c3'=>$arr_f10[2], 'c4'=>$arr_f10[3], 'c5'=>utf8_decode($arr_f10[4]))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 6,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>238),
		'c2'=>array('justification'=>'center','width'=>35),
		'c3'=>array('justification'=>'center','width'=>35),
		'c4'=>array('justification'=>'center','width'=>35),
		'c5'=>array('justification'=>'center','width'=>70)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/
$pdf->ezText("\n",10);
$pdf->ezText(utf8_decode("<b>Otras observaciones:  </b>"),10);
$pdf->ezText("\n",5);

$data = array(
	array('c1'=>utf8_decode($data_f['observaciones']))
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

$pdf->ezStream();
?>