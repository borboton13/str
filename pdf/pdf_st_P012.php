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
JOIN p012_formulario h 	 ON p.id = h.id
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

$data=array(array('title'=>'<b>'.strtoupper($data_f['titulo']).'</b>'));
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
$pdf->ezText("\n",10);

/*Lineas rojas*/
$pdf->setStrokeColor(1,hexdec ('33')/255,hexdec('00')/255);

$pdf->line(20,615,590,615);

$pdf->ezText("<b>MANTENIMIENTO DE SISTEMAS DE PROTECCION</b>",10);
$pdf->ezText("\n",4);
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
$data=array(array('izq'=>'ANTES MTTO.', 'der'=>'DESPUES MTTO.'));
$pdf->ezTable($data,'','',
	array('xPos'=>'219.5',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 1,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'izq'=>array('justification'=>'center','width'=>123),
			'der'=>array('justification'=>'center','width'=>189),
		)
	));
/** -------------------------------------------------------------------- **/
$data=array(array(	'h00'=>'PARARRAYOS', 'h01'=>'No Existe','h02'=>'Malo','h03'=>'Bajo','h04'=>'Medio','h05'=>'Alto',
					'h06'=>'Bueno','h07'=>'Reparado','h08'=>'Ajustado','h09'=>'Cambiado','h10'=>'Pendiente','h11'=>'Otro'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>400,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 1,
		'fontSize' => 5,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h00'=>array('justification'=>'center','width'=>177),
			'h01'=>array('justification'=>'center','width'=>33),
			'h02'=>array('justification'=>'center','width'=>30),
			'h03'=>array('justification'=>'center','width'=>30),
			'h04'=>array('justification'=>'center','width'=>30),
			'h05'=>array('justification'=>'center','width'=>30),
			'h06'=>array('justification'=>'center','width'=>30),
			'h07'=>array('justification'=>'center','width'=>33),
			'h08'=>array('justification'=>'center','width'=>30),
			'h09'=>array('justification'=>'center','width'=>33),
			'h10'=>array('justification'=>'center','width'=>33),
			'h11'=>array('justification'=>'center','width'=>65)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p01 = $data_f['p01'];
$arrays = explode('|', $text_p01);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[3] != '') $arr_f1[3] = 'X';
if($arr_f1[4] != '') $arr_f1[4] = 'X';
if($arr_f1[5] != '') $arr_f1[5] = 'X';
if($arr_f1[6] != '') $arr_f1[6] = 'X';
if($arr_f1[7] != '') $arr_f1[7] = 'X';
if($arr_f1[8] != '') $arr_f1[8] = 'X';
if($arr_f1[9] != '') $arr_f1[9] = 'X';
if($arr_f1[10] != '') $arr_f1[10] = 'X';

if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[3] != '') $arr_f2[3] = 'X';
if($arr_f2[4] != '') $arr_f2[4] = 'X';
if($arr_f2[5] != '') $arr_f2[5] = 'X';
if($arr_f2[6] != '') $arr_f2[6] = 'X';
if($arr_f2[7] != '') $arr_f2[7] = 'X';
if($arr_f2[8] != '') $arr_f2[8] = 'X';
if($arr_f2[9] != '') $arr_f2[9] = 'X';
if($arr_f2[10] != '') $arr_f2[10] = 'X';

if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f3[2] != '') $arr_f3[2] = 'X';
if($arr_f3[3] != '') $arr_f3[3] = 'X';
if($arr_f3[4] != '') $arr_f3[4] = 'X';
if($arr_f3[5] != '') $arr_f3[5] = 'X';
if($arr_f3[6] != '') $arr_f3[6] = 'X';
if($arr_f3[7] != '') $arr_f3[7] = 'X';
if($arr_f3[8] != '') $arr_f3[8] = 'X';
if($arr_f3[9] != '') $arr_f3[9] = 'X';
if($arr_f3[10] != '') $arr_f3[10] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6], 'c8'=>$arr_f1[7], 'c9'=>$arr_f1[8], 'c10'=>$arr_f1[9], 'c11'=>$arr_f1[10], 'c12'=>$arr_f1[11]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6], 'c8'=>$arr_f2[7], 'c9'=>$arr_f2[8], 'c10'=>$arr_f2[9], 'c11'=>$arr_f2[10], 'c12'=>$arr_f2[11]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4], 'c6'=>$arr_f3[5], 'c7'=>$arr_f3[6], 'c8'=>$arr_f3[7], 'c9'=>$arr_f3[8], 'c10'=>$arr_f3[9], 'c11'=>$arr_f3[10], 'c12'=>$arr_f3[11])
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
		'c1'=>array('justification'=>'left','width'=>177),
		'c2'=>array('justification'=>'center','width'=>33),
		'c3'=>array('justification'=>'center','width'=>30),
		'c4'=>array('justification'=>'center','width'=>30),
		'c5'=>array('justification'=>'center','width'=>30),
		'c6'=>array('justification'=>'center','width'=>30),
		'c7'=>array('justification'=>'center','width'=>30),
		'c8'=>array('justification'=>'center','width'=>33),
		'c9'=>array('justification'=>'center','width'=>30),
		'c10'=>array('justification'=>'center','width'=>33),
		'c11'=>array('justification'=>'center','width'=>33),
		'c12'=>array('justification'=>'center','width'=>65)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",4);
/** -------------------------------------------------------------------- **/
$data=array(array('izq'=>'ANTES MTTO.', 'der'=>'DESPUES MTTO.'));
$pdf->ezTable($data,'','',
	array('xPos'=>'219.5',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>206,
		'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 1,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'izq'=>array('justification'=>'center','width'=>123),
			'der'=>array('justification'=>'center','width'=>189),
		)
	));
/** -------------------------------------------------------------------- **/
$data=array(array(	'h00'=>'MALLA DE TIERRA', 'h01'=>'No Existe','h02'=>'Malo','h03'=>'Bajo','h04'=>'Medio','h05'=>'Alto',
	'h06'=>'Bueno','h07'=>'Reparado','h08'=>'Ajustado','h09'=>'Cambiado','h10'=>'Pendiente','h11'=>'Otro'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>400,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 1,
		'fontSize' => 5,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'h00'=>array('justification'=>'center','width'=>177),
			'h01'=>array('justification'=>'center','width'=>33),
			'h02'=>array('justification'=>'center','width'=>30),
			'h03'=>array('justification'=>'center','width'=>30),
			'h04'=>array('justification'=>'center','width'=>30),
			'h05'=>array('justification'=>'center','width'=>30),
			'h06'=>array('justification'=>'center','width'=>30),
			'h07'=>array('justification'=>'center','width'=>33),
			'h08'=>array('justification'=>'center','width'=>30),
			'h09'=>array('justification'=>'center','width'=>33),
			'h10'=>array('justification'=>'center','width'=>33),
			'h11'=>array('justification'=>'center','width'=>65)
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
$arr_f6 = explode(';', $arrays[5]);
$arr_f7 = explode(';', $arrays[6]);
$arr_f8 = explode(';', $arrays[7]);
$arr_f9 = explode(';', $arrays[8]);
$arr_f10 = explode(';', $arrays[9]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f1[2] != '') $arr_f1[2] = 'X';
if($arr_f1[3] != '') $arr_f1[3] = 'X';
if($arr_f1[4] != '') $arr_f1[4] = 'X';
if($arr_f1[5] != '') $arr_f1[5] = 'X';
if($arr_f1[6] != '') $arr_f1[6] = 'X';
if($arr_f1[7] != '') $arr_f1[7] = 'X';
if($arr_f1[8] != '') $arr_f1[8] = 'X';
if($arr_f1[9] != '') $arr_f1[9] = 'X';
if($arr_f1[10] != '') $arr_f1[10] = 'X';

if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f2[2] != '') $arr_f2[2] = 'X';
if($arr_f2[3] != '') $arr_f2[3] = 'X';
if($arr_f2[4] != '') $arr_f2[4] = 'X';
if($arr_f2[5] != '') $arr_f2[5] = 'X';
if($arr_f2[6] != '') $arr_f2[6] = 'X';
if($arr_f2[7] != '') $arr_f2[7] = 'X';
if($arr_f2[8] != '') $arr_f2[8] = 'X';
if($arr_f2[9] != '') $arr_f2[9] = 'X';
if($arr_f2[10] != '') $arr_f2[10] = 'X';

if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f3[2] != '') $arr_f3[2] = 'X';
if($arr_f3[3] != '') $arr_f3[3] = 'X';
if($arr_f3[4] != '') $arr_f3[4] = 'X';
if($arr_f3[5] != '') $arr_f3[5] = 'X';
if($arr_f3[6] != '') $arr_f3[6] = 'X';
if($arr_f3[7] != '') $arr_f3[7] = 'X';
if($arr_f3[8] != '') $arr_f3[8] = 'X';
if($arr_f3[9] != '') $arr_f3[9] = 'X';
if($arr_f3[10] != '') $arr_f3[10] = 'X';

if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f4[2] != '') $arr_f4[2] = 'X';
if($arr_f4[3] != '') $arr_f4[3] = 'X';
if($arr_f4[4] != '') $arr_f4[4] = 'X';
if($arr_f4[5] != '') $arr_f4[5] = 'X';
if($arr_f4[6] != '') $arr_f4[6] = 'X';
if($arr_f4[7] != '') $arr_f4[7] = 'X';
if($arr_f4[8] != '') $arr_f4[8] = 'X';
if($arr_f4[9] != '') $arr_f4[9] = 'X';
if($arr_f4[10] != '') $arr_f4[10] = 'X';

if($arr_f5[1] != '') $arr_f5[1] = 'X';
if($arr_f5[2] != '') $arr_f5[2] = 'X';
if($arr_f5[3] != '') $arr_f5[3] = 'X';
if($arr_f5[4] != '') $arr_f5[4] = 'X';
if($arr_f5[5] != '') $arr_f5[5] = 'X';
if($arr_f5[6] != '') $arr_f5[6] = 'X';
if($arr_f5[7] != '') $arr_f5[7] = 'X';
if($arr_f5[8] != '') $arr_f5[8] = 'X';
if($arr_f5[9] != '') $arr_f5[9] = 'X';
if($arr_f5[10] != '') $arr_f5[10] = 'X';

if($arr_f6[1] != '') $arr_f6[1] = 'X';
if($arr_f6[2] != '') $arr_f6[2] = 'X';
if($arr_f6[3] != '') $arr_f6[3] = 'X';
if($arr_f6[4] != '') $arr_f6[4] = 'X';
if($arr_f6[5] != '') $arr_f6[5] = 'X';
if($arr_f6[6] != '') $arr_f6[6] = 'X';
if($arr_f6[7] != '') $arr_f6[7] = 'X';
if($arr_f6[8] != '') $arr_f6[8] = 'X';
if($arr_f6[9] != '') $arr_f6[9] = 'X';
if($arr_f6[10] != '') $arr_f6[10] = 'X';

if($arr_f7[1] != '') $arr_f7[1] = 'X';
if($arr_f7[2] != '') $arr_f7[2] = 'X';
if($arr_f7[3] != '') $arr_f7[3] = 'X';
if($arr_f7[4] != '') $arr_f7[4] = 'X';
if($arr_f7[5] != '') $arr_f7[5] = 'X';
if($arr_f7[6] != '') $arr_f7[6] = 'X';
if($arr_f7[7] != '') $arr_f7[7] = 'X';
if($arr_f7[8] != '') $arr_f7[8] = 'X';
if($arr_f7[9] != '') $arr_f7[9] = 'X';
if($arr_f7[10] != '') $arr_f7[10] = 'X';

if($arr_f8[1] != '') $arr_f8[1] = 'X';
if($arr_f8[2] != '') $arr_f8[2] = 'X';
if($arr_f8[3] != '') $arr_f8[3] = 'X';
if($arr_f8[4] != '') $arr_f8[4] = 'X';
if($arr_f8[5] != '') $arr_f8[5] = 'X';
if($arr_f8[6] != '') $arr_f8[6] = 'X';
if($arr_f8[7] != '') $arr_f8[7] = 'X';
if($arr_f8[8] != '') $arr_f8[8] = 'X';
if($arr_f8[9] != '') $arr_f8[9] = 'X';
if($arr_f8[10] != '') $arr_f8[10] = 'X';

if($arr_f9[1] != '') $arr_f9[1] = 'X';
if($arr_f9[2] != '') $arr_f9[2] = 'X';
if($arr_f9[3] != '') $arr_f9[3] = 'X';
if($arr_f9[4] != '') $arr_f9[4] = 'X';
if($arr_f9[5] != '') $arr_f9[5] = 'X';
if($arr_f9[6] != '') $arr_f9[6] = 'X';
if($arr_f9[7] != '') $arr_f9[7] = 'X';
if($arr_f9[8] != '') $arr_f9[8] = 'X';
if($arr_f9[9] != '') $arr_f9[9] = 'X';
if($arr_f9[10] != '') $arr_f9[10] = 'X';

if($arr_f10[1] != '') $arr_f10[1] = 'X';
if($arr_f10[2] != '') $arr_f10[2] = 'X';
if($arr_f10[3] != '') $arr_f10[3] = 'X';
if($arr_f10[4] != '') $arr_f10[4] = 'X';
if($arr_f10[5] != '') $arr_f10[5] = 'X';
if($arr_f10[6] != '') $arr_f10[6] = 'X';
if($arr_f10[7] != '') $arr_f10[7] = 'X';
if($arr_f10[8] != '') $arr_f10[8] = 'X';
if($arr_f10[9] != '') $arr_f10[9] = 'X';
if($arr_f10[10] != '') $arr_f10[10] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6], 'c8'=>$arr_f1[7], 'c9'=>$arr_f1[8], 'c10'=>$arr_f1[9], 'c11'=>$arr_f1[10], 'c12'=>$arr_f1[11]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6], 'c8'=>$arr_f2[7], 'c9'=>$arr_f2[8], 'c10'=>$arr_f2[9], 'c11'=>$arr_f2[10], 'c12'=>$arr_f2[11]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4], 'c6'=>$arr_f3[5], 'c7'=>$arr_f3[6], 'c8'=>$arr_f3[7], 'c9'=>$arr_f3[8], 'c10'=>$arr_f3[9], 'c11'=>$arr_f3[10], 'c12'=>$arr_f3[11]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4], 'c6'=>$arr_f4[5], 'c7'=>$arr_f4[6], 'c8'=>$arr_f4[7], 'c9'=>$arr_f4[8], 'c10'=>$arr_f4[9], 'c11'=>$arr_f4[10], 'c12'=>$arr_f4[11]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3], 'c5'=>$arr_f5[4], 'c6'=>$arr_f5[5], 'c7'=>$arr_f5[6], 'c8'=>$arr_f5[7], 'c9'=>$arr_f5[8], 'c10'=>$arr_f5[9], 'c11'=>$arr_f5[10], 'c12'=>$arr_f5[11]),
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2], 'c4'=>$arr_f6[3], 'c5'=>$arr_f6[4], 'c6'=>$arr_f6[5], 'c7'=>$arr_f6[6], 'c8'=>$arr_f6[7], 'c9'=>$arr_f6[8], 'c10'=>$arr_f6[9], 'c11'=>$arr_f6[10], 'c12'=>$arr_f6[11]),
	array('c1'=>$arr_f7[0], 'c2'=>$arr_f7[1], 'c3'=>$arr_f7[2], 'c4'=>$arr_f7[3], 'c5'=>$arr_f7[4], 'c6'=>$arr_f7[5], 'c7'=>$arr_f7[6], 'c8'=>$arr_f7[7], 'c9'=>$arr_f7[8], 'c10'=>$arr_f7[9], 'c11'=>$arr_f7[10], 'c12'=>$arr_f7[11]),
	array('c1'=>$arr_f8[0], 'c2'=>$arr_f8[1], 'c3'=>$arr_f8[2], 'c4'=>$arr_f8[3], 'c5'=>$arr_f8[4], 'c6'=>$arr_f8[5], 'c7'=>$arr_f8[6], 'c8'=>$arr_f8[7], 'c9'=>$arr_f8[8], 'c10'=>$arr_f8[9], 'c11'=>$arr_f8[10], 'c12'=>$arr_f8[11]),
	array('c1'=>$arr_f9[0], 'c2'=>$arr_f9[1], 'c3'=>$arr_f9[2], 'c4'=>$arr_f9[3], 'c5'=>$arr_f9[4], 'c6'=>$arr_f9[5], 'c7'=>$arr_f9[6], 'c8'=>$arr_f9[7], 'c9'=>$arr_f9[8], 'c10'=>$arr_f9[9], 'c11'=>$arr_f9[10], 'c12'=>$arr_f9[11]),
	array('c1'=>$arr_f10[0], 'c2'=>$arr_f10[1], 'c3'=>$arr_f10[2], 'c4'=>$arr_f10[3], 'c5'=>$arr_f10[4], 'c6'=>$arr_f10[5], 'c7'=>$arr_f10[6], 'c8'=>$arr_f10[7], 'c9'=>$arr_f10[8], 'c10'=>$arr_f10[9], 'c11'=>$arr_f10[10], 'c12'=>$arr_f10[11])
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
		'c1'=>array('justification'=>'left','width'=>177),
		'c2'=>array('justification'=>'center','width'=>33),
		'c3'=>array('justification'=>'center','width'=>30),
		'c4'=>array('justification'=>'center','width'=>30),
		'c5'=>array('justification'=>'center','width'=>30),
		'c6'=>array('justification'=>'center','width'=>30),
		'c7'=>array('justification'=>'center','width'=>30),
		'c8'=>array('justification'=>'center','width'=>33),
		'c9'=>array('justification'=>'center','width'=>30),
		'c10'=>array('justification'=>'center','width'=>33),
		'c11'=>array('justification'=>'center','width'=>33),
		'c12'=>array('justification'=>'center','width'=>65)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/
$pdf->ezText("\n",3);
$text_p01 = $data_f['p06'];
$arrays = explode('|', $text_p01);
$arr_f01 = explode(';', $arrays[0]);
$arr_f02 = explode(';', $arrays[1]);
$arr_f03 = explode(';', $arrays[2]);
$arr_f04 = explode(';', $arrays[3]);


$data = array(
	array('c1'=>'Mediciones', 'c2'=>'ANTES DE MTTO.', 'c3'=>'DESPUES DE MTTO.'),
	array('c1'=>'Valor de tierra en la malla ubicada en la base de la torre en Ohms (maximo es 10 Ohm)[Ohm]', 'c2'=>$arr_f01[1], 'c3'=>$arr_f01[2]),
	array('c1'=>'Valor de tierra en el distribuidor de tierra de la malla alrededor de la sala de equipos (maximo es 10 Ohm)[Ohm]', 'c2'=>$arr_f02[1], 'c3'=>$arr_f02[2]),
	array('c1'=>'Medida de Potencial entre el sistema de tierra y neutro[V]', 'c2'=>$arr_f03[1], 'c3'=>$arr_f03[2]),
	array('c1'=>'Medida Potencial entre el neutro y masa[V]', 'c2'=>$arr_f04[1], 'c3'=>$arr_f04[2])


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


$pdf->ezStream();
?>