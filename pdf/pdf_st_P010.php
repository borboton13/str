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
JOIN p010_formulario h 	 ON p.id = h.id
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
//$pdf->setStrokeColor(1,hexdec('33')/255,hexdec('00')/255);
$pdf->setStrokeColor(0,0,0);
//$pdf->line(20,32,590,32);
$pdf->line(20,615,590,615);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>1. Relevamiento</b>",10);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$text_p01 = $data_f['p01'];
$arrays = explode('|', $text_p01);
$arr_f01 = explode(';', $arrays[0]);
$arr_f02 = explode(';', $arrays[1]);
$arr_f03 = explode(';', $arrays[2]);
$arr_f04 = explode(';', $arrays[3]);
$arr_f05 = explode(';', $arrays[4]);
$arr_f06 = explode(';', $arrays[5]);
$arr_f07 = explode(';', $arrays[6]);
$arr_f08 = explode(';', $arrays[7]);

$data = array(
	array('c1'=>'', 'c2'=>'EQUIPO 1', 'c3'=>'EQUIPO 2'),
	array('c1'=>utf8_decode($arr_f01[0]), 'c2'=>utf8_decode($arr_f01[1]), 'c3'=>utf8_decode($arr_f01[2])),
	array('c1'=>utf8_decode($arr_f02[0]), 'c2'=>utf8_decode($arr_f02[1]), 'c3'=>utf8_decode($arr_f02[2])),
	array('c1'=>utf8_decode($arr_f03[0]), 'c2'=>utf8_decode($arr_f03[1]), 'c3'=>utf8_decode($arr_f03[2])),
	array('c1'=>utf8_decode($arr_f04[0]), 'c2'=>utf8_decode($arr_f04[1]), 'c3'=>utf8_decode($arr_f04[2])),
	array('c1'=>utf8_decode($arr_f05[0]), 'c2'=>utf8_decode($arr_f05[1]), 'c3'=>utf8_decode($arr_f05[2])),
	array('c1'=>utf8_decode($arr_f06[0]), 'c2'=>utf8_decode($arr_f06[1]), 'c3'=>utf8_decode($arr_f06[2])),
	array('c1'=>utf8_decode($arr_f07[0]), 'c2'=>utf8_decode($arr_f07[1]), 'c3'=>utf8_decode($arr_f07[2])),
	array('c1'=>utf8_decode($arr_f08[0]), 'c2'=>utf8_decode($arr_f08[1]), 'c3'=>utf8_decode($arr_f08[2]))
);
$options = array('xPos'=>'70',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>550,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>200),
		'c2'=>array('justification'=>'center','width'=>150),
		'c3'=>array('justification'=>'center','width'=>150)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",12);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>2. Mantenimiento Preventivo</b>",10);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$text_p01 = $data_f['p06'];
$arrays = explode('|', $text_p01);
$arr_f01 = explode(';', $arrays[0]);
$arr_f02 = explode(';', $arrays[1]);


$data = array(
	array('c1'=>'', 'c2'=>'Antes de mantenimiento', 'c3'=>'Despues de mantenimiento'),
	array('c1'=>'Medicion de la temperatura ambiente de salas de equipos (*C)', 'c2'=>utf8_decode($arr_f01[1]), 'c3'=>utf8_decode($arr_f01[2])),
	array('c1'=>'Medicion de la temperatura ambiente de las salas de baterias', 'c2'=>utf8_decode($arr_f02[1]), 'c3'=>utf8_decode($arr_f02[2]))

);
$options = array('xPos'=>'70',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>550,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>200),
		'c2'=>array('justification'=>'center','width'=>150),
		'c3'=>array('justification'=>'center','width'=>150)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",12);
/** -------------------------------------------------------------------- **/
$data=array(array('izq'=>'Antes de mantenimiento', 'der'=>'Despues de mantenimiento'));
$pdf->ezTable($data,'','',
	array('xPos'=>'312.5',
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
			'izq'=>array('justification'=>'center','width'=>120),
			'der'=>array('justification'=>'center','width'=>150),
		)
	));
/** -------------------------------------------------------------------- **/
$data=array(array(	'h01'=>'Malo','h02'=>'Bajo','h03'=>'Medio','h04'=>'Alto',
					'h05'=>'Reparado','h06'=>'Ajustado','h07'=>'Cambiado','h08'=>'Pendiente'));
$pdf->ezTable($data,'','',
	array('xPos'=>'312.5',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>400,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 2,
		'fontSize' => 6,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h01'=>array('justification'=>'center','width'=>30),
			'h02'=>array('justification'=>'center','width'=>30),
			'h03'=>array('justification'=>'center','width'=>30),
			'h04'=>array('justification'=>'center','width'=>30),
			'h05'=>array('justification'=>'center','width'=>37),
			'h06'=>array('justification'=>'center','width'=>37),
			'h07'=>array('justification'=>'center','width'=>38),
			'h08'=>array('justification'=>'center','width'=>38)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p02 = $data_f['p02'];
$arrays = explode('|', $text_p02);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);


if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[3] != '') $arr_f1[3] = 'X';
if($arr_f1[4] != '') $arr_f1[4] = 'X';
if($arr_f1[5] != '') $arr_f1[5] = 'X';
if($arr_f1[6] != '') $arr_f1[6] = 'X';
if($arr_f1[7] != '') $arr_f1[7] = 'X';
if($arr_f1[8] != '') $arr_f1[8] = 'X';

if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[3] != '') $arr_f2[3] = 'X';
if($arr_f2[4] != '') $arr_f2[4] = 'X';
if($arr_f2[5] != '') $arr_f2[5] = 'X';
if($arr_f2[6] != '') $arr_f2[6] = 'X';
if($arr_f2[7] != '') $arr_f2[7] = 'X';
if($arr_f2[8] != '') $arr_f2[8] = 'X';

if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f3[2] != '') $arr_f3[2] = 'X';
if($arr_f3[3] != '') $arr_f3[3] = 'X';
if($arr_f3[4] != '') $arr_f3[4] = 'X';
if($arr_f3[5] != '') $arr_f3[5] = 'X';
if($arr_f3[6] != '') $arr_f3[6] = 'X';
if($arr_f3[7] != '') $arr_f3[7] = 'X';
if($arr_f3[8] != '') $arr_f3[8] = 'X';

if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f4[2] != '') $arr_f4[2] = 'X';
if($arr_f4[3] != '') $arr_f4[3] = 'X';
if($arr_f4[4] != '') $arr_f4[4] = 'X';
if($arr_f4[5] != '') $arr_f4[5] = 'X';
if($arr_f4[6] != '') $arr_f4[6] = 'X';
if($arr_f4[7] != '') $arr_f4[7] = 'X';
if($arr_f4[8] != '') $arr_f4[8] = 'X';

if($arr_f5[1] != '') $arr_f5[1] = 'X';
if($arr_f5[2] != '') $arr_f5[2] = 'X';
if($arr_f5[3] != '') $arr_f5[3] = 'X';
if($arr_f5[4] != '') $arr_f5[4] = 'X';
if($arr_f5[5] != '') $arr_f5[5] = 'X';
if($arr_f5[6] != '') $arr_f5[6] = 'X';
if($arr_f5[7] != '') $arr_f5[7] = 'X';
if($arr_f5[8] != '') $arr_f5[8] = 'X';


$data = array(
	array('c1'=>utf8_decode($arr_f1[0]), 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6], 'c8'=>$arr_f1[7], 'c9'=>$arr_f1[8]),
	array('c1'=>utf8_decode($arr_f2[0]), 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6], 'c8'=>$arr_f2[7], 'c9'=>$arr_f2[8]),
	array('c1'=>utf8_decode($arr_f3[0]), 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4], 'c6'=>$arr_f3[5], 'c7'=>$arr_f3[6], 'c8'=>$arr_f3[7], 'c9'=>$arr_f3[8]),
	array('c1'=>utf8_decode($arr_f4[0]), 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4], 'c6'=>$arr_f4[5], 'c7'=>$arr_f4[6], 'c8'=>$arr_f4[7], 'c9'=>$arr_f4[8]),
	array('c1'=>utf8_decode($arr_f5[0]), 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3], 'c5'=>$arr_f5[4], 'c6'=>$arr_f5[5], 'c7'=>$arr_f5[6], 'c8'=>$arr_f5[7], 'c9'=>$arr_f5[8])

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
		'c1'=>array('justification'=>'left','width'=>270),
		'c2'=>array('justification'=>'center','width'=>30),
		'c3'=>array('justification'=>'center','width'=>30),
		'c4'=>array('justification'=>'center','width'=>30),
		'c5'=>array('justification'=>'center','width'=>30),
		'c6'=>array('justification'=>'center','width'=>37),
		'c7'=>array('justification'=>'center','width'=>37),
		'c8'=>array('justification'=>'center','width'=>38),
		'c9'=>array('justification'=>'center','width'=>38)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>