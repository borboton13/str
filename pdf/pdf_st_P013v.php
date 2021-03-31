<?php

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
JOIN p013v_formulario h ON p.id = h.id
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
 
$pdf = new Cezpdf('LETTER','portrait');
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
$pdf->ezText("\n",2);
/** -------------------------------------------------------------------- **/
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
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>1. RELEVAMIENTO</b>",10);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('izq'=>'TECNOLOGIA', 'der'=>'GSM', 'to'=>'UMTS', 'bo'=>'UMTS'));
$pdf->ezTable($data,'','',
	array('xPos'=>'55',
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
			'izq'=>array('justification'=>'center','width'=>250),
			'der'=>array('justification'=>'center','width'=>90),
			'to'=>array('justification'=>'center','width'=>90),
			'bo'=>array('justification'=>'center','width'=>90)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p19 = $data_f['p19'];
$arrays = explode('|', $text_p19);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);
$arr_f6 = explode(';', $arrays[5]);
$arr_f7 = explode(';', $arrays[6]);


$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3]),
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2], 'c4'=>$arr_f6[3]),
	array('c1'=>$arr_f7[0], 'c2'=>$arr_f7[1], 'c3'=>$arr_f7[2], 'c4'=>$arr_f7[3])
	
	
);
$options = array('xPos'=>'55',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>250),
		'c2'=>array('justification'=>'center','width'=>90),
		'c3'=>array('justification'=>'center','width'=>90),
		'c4'=>array('justification'=>'center','width'=>90)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b> Antena Radio Base</b>",10);
$pdf->ezText("\n",5);

/** -------------------------------------------------------------------- **/
$data=array(array('un'=>'N', 'dos'=>'Tipo de Antena', 'tres'=>'Sector', 'ca'=>'Tecnologias', 'ce'=>'Modelo', 'cf'=>'Tilt Mecanico', 'cg'=>'RET', 'ch'=>'Tilt Electrico', 'ci'=>'Altura (m)', 'cj'=>'TMA'));
$pdf->ezTable($data,'','',
	array('xPos'=>'55',
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
			'un'=>array('justification'=>'left','width'=>20),
			'dos'=>array('justification'=>'left','width'=>50),
			'tres'=>array('justification'=>'left','width'=>34),
		    'ca'=>array('justification'=>'center','width'=>170),
		    'ce'=>array('justification'=>'center','width'=>45),
		    'cf'=>array('justification'=>'center','width'=>45),
		    'cg'=>array('justification'=>'center','width'=>45),
		    'ch'=>array('justification'=>'center','width'=>45),
		    'ci'=>array('justification'=>'center','width'=>45),
		    'cj'=>array('justification'=>'center','width'=>45)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p23 = $data_f['p23'];
$arrays = explode('|', $text_p23);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);
$arr_f6 = explode(';', $arrays[5]);
$arr_f7 = explode(';', $arrays[6]);
$arr_f8 = explode(';', $arrays[7]);
$arr_f9 = explode(';', $arrays[8]);

$text_p24 = $data_f['p24'];
$arrays = explode('|', $text_p24);
$arr_fa = explode(';', $arrays[0]);
$arr_fb = explode(';', $arrays[1]);
$arr_fc = explode(';', $arrays[2]);
$arr_fd = explode(';', $arrays[3]);
$arr_fe = explode(';', $arrays[4]);
$arr_ff = explode(';', $arrays[5]);
$arr_fg = explode(';', $arrays[6]);
$arr_fh = explode(';', $arrays[7]);
$arr_fi = explode(';', $arrays[8]);
$arr_fj = explode(';', $arrays[9]);
$arr_fk = explode(';', $arrays[10]);
$arr_fl = explode(';', $arrays[11]);
$arr_fm = explode(';', $arrays[12]);
$arr_fn = explode(';', $arrays[13]);
$arr_fo = explode(';', $arrays[14]);


$text_p25 = $data_f['p25'];
$arrays = explode('|', $text_p25);
$arr_fa1 = explode(';', $arrays[0]);
$arr_fa2 = explode(';', $arrays[1]);
$arr_fa3 = explode(';', $arrays[2]);
$arr_fa4 = explode(';', $arrays[3]);
$arr_fa5 = explode(';', $arrays[4]);
$arr_fa6 = explode(';', $arrays[5]);
$arr_fa7 = explode(';', $arrays[6]);


$text_p26 = $data_f['p26'];
$arrays = explode('|', $text_p26);
$arr_fa8 = explode(';', $arrays[0]);
$arr_fa9 = explode(';', $arrays[1]);
$arr_fa10 = explode(';', $arrays[2]);
$arr_fa11 = explode(';', $arrays[3]);
$arr_fa12 = explode(';', $arrays[4]);
$arr_fa13 = explode(';', $arrays[5]);
$arr_fa14 = explode(';', $arrays[6]);
$arr_fa15 = explode(';', $arrays[7]);
$arr_fa16 = explode(';', $arrays[8]);


$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=> $arr_fa[0],'c5'=> $arr_fa[1], 'c6'=> $arr_fa[2], 'c7'=> $arr_fa1[0], 'c8'=> $arr_fa8[0], 'c9'=> $arr_fa8[1], 'c10'=>  $arr_fa8[2], 'c11'=> $arr_fa8[3],'c12'=> $arr_fa8[4],'c13'=> $arr_fa8[5]),
	
	array('c1'=>'', 'c2'=>'', 'c3'=>'','c4'=> $arr_fb[0],'c5'=> $arr_fb[1], 'c6'=> $arr_fb[2], 'c7'=>'', 'c8'=>'', 'c9'=> '', 'c10'=> '', 'c11'=> '','c12'=> '','c13'=>''),
	
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=> $arr_fc[0],'c5'=> $arr_fc[1], 'c6'=> $arr_fc[2], 'c7'=> $arr_fa2[0], 'c8'=> $arr_fa9[0], 'c9'=> $arr_fa9[1], 'c10'=>  $arr_fa9[2], 'c11'=> $arr_fa9[3],'c12'=> $arr_fa9[4],'c13'=> $arr_fa9[5]),
	
	array('c1'=>'', 'c2'=>'', 'c3'=>'','c4'=> $arr_fd[0],'c5'=> $arr_fd[1], 'c6'=> $arr_fd[2], 'c7'=>'', 'c8'=>'', 'c9'=> '', 'c10'=> '', 'c11'=> '','c12'=> '','c13'=>''),
	
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=> $arr_fe[0],'c5'=> $arr_fe[1], 'c6'=> $arr_fe[2], 'c7'=> $arr_fa3[0], 'c8'=> $arr_fa10[0], 'c9'=> $arr_fa10[1], 'c10'=>  $arr_fa10[2], 'c11'=> $arr_fa10[3],'c12'=> $arr_fa10[4],'c13'=> $arr_fa10[5]),
	
	array('c1'=>'', 'c2'=>'', 'c3'=>'','c4'=> $arr_ff[0],'c5'=> $arr_ff[1], 'c6'=> $arr_ff[2], 'c7'=>'', 'c8'=>'', 'c9'=> '', 'c10'=> '', 'c11'=> '','c12'=> '','c13'=>''),
	
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=> $arr_fg[0],'c5'=> $arr_fg[1], 'c6'=> $arr_fg[2], 'c7'=> $arr_fa4[0], 'c8'=> $arr_fa11[0], 'c9'=> $arr_fa11[1], 'c10'=>  $arr_fa11[2], 'c11'=> $arr_fa11[3],'c12'=> $arr_fa11[4],'c13'=> $arr_fa11[5]),
	
	array('c1'=>'', 'c2'=>'', 'c3'=>'','c4'=> $arr_fh[0],'c5'=> $arr_fh[1], 'c6'=> $arr_fh[2], 'c7'=>'', 'c8'=>'', 'c9'=> '', 'c10'=> '', 'c11'=> '','c12'=> '','c13'=>''),
	
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=> $arr_fi[0],'c5'=> $arr_fi[1], 'c6'=> $arr_fi[2], 'c7'=> $arr_fa5[0], 'c8'=> $arr_fa12[0], 'c9'=> $arr_fa12[1], 'c10'=>  $arr_fa12[2], 'c11'=> $arr_fa12[3],'c12'=> $arr_fa12[4],'c13'=> $arr_fa12[5]),
	
	array('c1'=>'', 'c2'=>'', 'c3'=>'','c4'=> $arr_fj[0],'c5'=> $arr_fj[1], 'c6'=> $arr_fj[2], 'c7'=>'', 'c8'=>'', 'c9'=> '', 'c10'=> '', 'c11'=> '','c12'=> '','c13'=>''),
	
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2], 'c4'=> $arr_fk[0],'c5'=> $arr_fk[1], 'c6'=> $arr_fk[2], 'c7'=> $arr_fa6[0], 'c8'=> $arr_fa13[0], 'c9'=> $arr_fa13[1], 'c10'=>  $arr_fa13[2], 'c11'=> $arr_fa13[3],'c12'=> $arr_fa13[4],'c13'=> $arr_fa13[5]),
	
	array('c1'=>'', 'c2'=>'', 'c3'=>'','c4'=> $arr_fl[0],'c5'=> $arr_fl[1], 'c6'=> $arr_fl[2], 'c7'=>'', 'c8'=>'', 'c9'=> '', 'c10'=> '', 'c11'=> '','c12'=> '','c13'=>''),
	
	array('c1'=>$arr_f7[0], 'c2'=>$arr_f7[1], 'c3'=>$arr_f7[2], 'c4'=> $arr_fm[0],'c5'=> $arr_fm[1], 'c6'=> $arr_fm[2], 'c7'=> $arr_fa7[0], 'c8'=> $arr_fa14[0], 'c9'=> $arr_fa14[1], 'c10'=>  $arr_fa14[2], 'c11'=> $arr_fa14[3],'c12'=> $arr_fa14[4],'c13'=> $arr_fa14[5]),
	
    array('c1'=>$arr_f8[0], 'c2'=>$arr_f8[1], 'c3'=>$arr_f8[2], 'c4'=> $arr_fn[0],'c5'=> $arr_fn[1], 'c6'=> $arr_fn[2], 'c7'=> '', 'c8'=> $arr_fa15[0], 'c9'=> $arr_fa15[1], 'c10'=>  $arr_fa15[2], 'c11'=> $arr_fa15[3],'c12'=> $arr_fa15[4],'c13'=> $arr_fa15[5]),
    
    array('c1'=>$arr_f9[0], 'c2'=>$arr_f9[1], 'c3'=>$arr_f9[2], 'c4'=> $arr_fo[0],'c5'=> $arr_fo[1], 'c6'=> $arr_fo[2], 'c7'=> '', 'c8'=> $arr_fa16[0], 'c9'=> $arr_fa16[1], 'c10'=>  $arr_fa16[2], 'c11'=> $arr_fa16[3],'c12'=> $arr_fa16[4],'c13'=> $arr_fa16[5])
	
);
$options = array('xPos'=>'55',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>20),
		'c2'=>array('justification'=>'center','width'=>50),
		'c3'=>array('justification'=>'center','width'=>34),
		'c4'=>array('justification'=>'center','width'=>40),
		'c5'=>array('justification'=>'center','width'=>40),
		'c6'=>array('justification'=>'center','width'=>40),
		'c7'=>array('justification'=>'center','width'=>50),
		'c8'=>array('justification'=>'center','width'=>45),
		'c9'=>array('justification'=>'center','width'=>45),
		'c10'=>array('justification'=>'center','width'=>45),
		'c11'=>array('justification'=>'center','width'=>45),
		'c12'=>array('justification'=>'center','width'=>45),
		'c13'=>array('justification'=>'center','width'=>45)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);

/** -------------------------------------------------------------------- **/
$pdf->ezText(utf8_decode("<b>Pruebas de servicio:  </b>"),10);
$pdf->ezText("\n",5);
$data=array(array('h01'=>'Pruebas de servicio', 'h02'=>'Numero de A', 'h03'=>'Numero de B', 'h04'=>'Hora', 'h05'=>'GSM', 'h06'=>'UMTS', 'h07'=>'LTE'));
$pdf->ezTable($data,'','',
	array('xPos'=>'55',
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
			'h01'=>array('justification'=>'center','width'=>140),
			'h02'=>array('justification'=>'center','width'=>60),
			'h03'=>array('justification'=>'center','width'=>60),
			'h04'=>array('justification'=>'center','width'=>60),
			'h05'=>array('justification'=>'center','width'=>60),
			'h06'=>array('justification'=>'center','width'=>60),
			'h07'=>array('justification'=>'center','width'=>60)
		)
	));

$text_p16 = $data_f['p16'];
$arrays = explode('|', $text_p16);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3], 'c5'=>$arr_f1[4], 'c6'=>$arr_f1[5], 'c7'=>$arr_f1[6]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3], 'c5'=>$arr_f2[4], 'c6'=>$arr_f2[5], 'c7'=>$arr_f2[6]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3], 'c5'=>$arr_f3[4], 'c6'=>$arr_f3[5], 'c7'=>$arr_f3[6]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2], 'c4'=>$arr_f4[3], 'c5'=>$arr_f4[4], 'c6'=>$arr_f4[5], 'c7'=>$arr_f4[6]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2], 'c4'=>$arr_f5[3], 'c5'=>$arr_f5[4], 'c6'=>$arr_f5[5], 'c7'=>$arr_f5[6])
);
$options = array('xPos'=>'55',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>140),
		'c2'=>array('justification'=>'left','width'=>60),
		'c3'=>array('justification'=>'left','width'=>60),
		'c4'=>array('justification'=>'left','width'=>60),
		'c5'=>array('justification'=>'left','width'=>60),
		'c6'=>array('justification'=>'left','width'=>60),
		'c7'=>array('justification'=>'left','width'=>60)
	)
);
$pdf->ezTable($data, '','',$options);
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
$pdf->ezText("\n",35);
$pdf->ezText("<b> Reporte Fotografico en Alta Definicion</b>",10);
$pdf->ezText("\n",5);
$text_p21 = $data_f['p21'];
$arrays = explode('|', $text_p21);
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
$arr_f12 = explode(';', $arrays[11]);

$text_p22 = $data_f['p22'];
$arrays = explode('|', $text_p22);
$arr_fa = explode(';', $arrays[0]);
$arr_fb = explode(';', $arrays[1]);
$arr_fc = explode(';', $arrays[2]);
$arr_fd = explode(';', $arrays[3]);
$arr_fe = explode(';', $arrays[4]);
$arr_ff = explode(';', $arrays[5]);
$arr_fg = explode(';', $arrays[6]);
$arr_fh = explode(';', $arrays[7]);
$arr_fi = explode(';', $arrays[8]);
$arr_fj = explode(';', $arrays[9]);
$arr_fk = explode(';', $arrays[10]);
$arr_fl = explode(';', $arrays[11]);


if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f5[1] != '') $arr_f5[1] = 'X';

if($arr_f6[1] != '') $arr_f6[1] = 'X';
if($arr_f7[1] != '') $arr_f7[1] = 'X';
if($arr_f8[1] != '') $arr_f8[1] = 'X';
if($arr_f9[1] != '') $arr_f9[1] = 'X';
if($arr_f10[1] != '') $arr_f10[1] = 'X';

if($arr_f11[1] != '') $arr_f11[1] = 'X';
if($arr_f12[1] != '') $arr_f12[1] = 'X';



if($arr_fa[1] != '') $arr_fa[1] = 'X';
if($arr_fb[1] != '') $arr_fb[1] = 'X';
if($arr_fc[1] != '') $arr_fc[1] = 'X';
if($arr_fd[1] != '') $arr_fd[1] = 'X';
if($arr_fe[1] != '') $arr_fe[1] = 'X';

if($arr_ff[1] != '') $arr_ff[1] = 'X';
if($arr_fg[1] != '') $arr_fg[1] = 'X';
if($arr_fh[1] != '') $arr_fh[1] = 'X';
if($arr_fi[1] != '') $arr_fi[1] = 'X';
if($arr_fj[1] != '') $arr_fj[1] = 'X';

if($arr_fk[1] != '') $arr_fk[1] = 'X';
if($arr_fl[1] != '') $arr_fl[1] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1],'c3'=> $arr_fa[0],'c4'=>  $arr_fa[1]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1],'c3'=> $arr_fb[0],'c4'=>  $arr_fb[1]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1],'c3'=> $arr_fc[0],'c4'=>  $arr_fc[1]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1],'c3'=> $arr_fd[0],'c4'=>  $arr_fd[1]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1],'c3'=> $arr_fe[0],'c4'=>  $arr_fe[1]),
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1],'c3'=> $arr_ff[0],'c4'=>  $arr_ff[1]),
	array('c1'=>$arr_f7[0], 'c2'=>$arr_f7[1],'c3'=> $arr_fg[0],'c4'=>  $arr_fg[1]),
	array('c1'=>$arr_f8[0], 'c2'=>$arr_f8[1],'c3'=> $arr_fh[0],'c4'=>  $arr_fh[1]),
	array('c1'=>$arr_f9[0], 'c2'=>$arr_f9[1],'c3'=> $arr_fi[0],'c4'=>  $arr_fi[1]),
	array('c1'=>$arr_f10[0], 'c2'=>$arr_f10[1],'c3'=> $arr_fj[0],'c4'=>  $arr_fj[1]),
	array('c1'=>$arr_f11[0], 'c2'=>$arr_f11[1],'c3'=> $arr_fk[0],'c4'=>  $arr_fk[1]),
	array('c1'=>$arr_f12[0], 'c2'=>$arr_f12[1],'c3'=> $arr_fl[0],'c4'=>  $arr_fl[1])

);
$options = array('xPos'=>'55',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>200),
		'c2'=>array('justification'=>'center','width'=>50),
		'c3'=>array('justification'=>'left','width'=>200),
		'c4'=>array('justification'=>'center','width'=>50)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/

$pdf->ezText("<b>2. Mantenimiento Preventivo </b>",10);
$pdf->ezText("\n",2);
/** -------------------------------------------------------------------- **/
$data=array(array('izq'=>'Revisado', 'der'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'375',
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
			'izq'=>array('justification'=>'left','width'=>50),
			'der'=>array('justification'=>'left','width'=>160)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p13 = $data_f['p13'];
$arrays = explode('|', $text_p13);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);

if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f5[1] != '') $arr_f5[1] = 'X';

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2])
);
$options = array('xPos'=>'55',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>320),
		'c2'=>array('justification'=>'center','width'=>50),
		'c3'=>array('justification'=>'left','width'=>160)
	)
);
$pdf->ezTable($data, '','',$options);

/** -------------------------------------------------------------------- **/
$text_p18 = $data_f['p18'];
$arrays = explode('|', $text_p18);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);
$arr_f4 = explode(';', $arrays[3]);
$arr_f5 = explode(';', $arrays[4]);
$arr_f6 = explode(';', $arrays[5]);
$arr_f7 = explode(';', $arrays[6]);


if($arr_f1[1] != '') $arr_f1[1] = 'X';
if($arr_f2[1] != '') $arr_f2[1] = 'X';
if($arr_f3[1] != '') $arr_f3[1] = 'X';
if($arr_f4[1] != '') $arr_f4[1] = 'X';
if($arr_f5[1] != '') $arr_f5[1] = 'X';
if($arr_f6[1] != '') $arr_f6[1] = 'X';
if($arr_f7[1] != '') $arr_f7[1] = 'X';


$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2]),
	array('c1'=>$arr_f4[0], 'c2'=>$arr_f4[1], 'c3'=>$arr_f4[2]),
	array('c1'=>$arr_f5[0], 'c2'=>$arr_f5[1], 'c3'=>$arr_f5[2]),
	array('c1'=>$arr_f6[0], 'c2'=>$arr_f6[1], 'c3'=>$arr_f6[2]),
	array('c1'=>$arr_f7[0], 'c2'=>$arr_f7[1], 'c3'=>$arr_f7[2])
);
$options = array('xPos'=>'55',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>320),
		'c2'=>array('justification'=>'center','width'=>50),
		'c3'=>array('justification'=>'left','width'=>160)
	)
);
$pdf->ezTable($data, '','',$options);

/** -------------------------------------------------------------------- **/
$pdf->ezText("\n",10);
$data=array(array('h01'=>'Verificar alarmas visibles en Radio Base', 'h02'=>'Ubicacion de alarma', 'h03'=>'Solucionado', 'h04'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'55',
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
			'h01'=>array('justification'=>'center','width'=>170),
			'h02'=>array('justification'=>'center','width'=>120),
			'h03'=>array('justification'=>'center','width'=>120),
			'h04'=>array('justification'=>'center','width'=>120)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p14 = $data_f['p14'];
$arrays = explode('|', $text_p14);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);


$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2], 'c4'=>$arr_f1[3]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2], 'c4'=>$arr_f2[3]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2], 'c4'=>$arr_f3[3])
);
$options = array('xPos'=>'55',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>170),
		'c2'=>array('justification'=>'left','width'=>120),
		'c3'=>array('justification'=>'left','width'=>120),
		'c4'=>array('justification'=>'left','width'=>120)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('h01'=>'Verificar reporte de alarmas a sistema de gestion', 'h02'=>'Estado', 'h03'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'55',
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
			'h01'=>array('justification'=>'center','width'=>230),
			'h02'=>array('justification'=>'center','width'=>80),
			'h03'=>array('justification'=>'center','width'=>220)
		)
	));
/** -------------------------------------------------------------------- **/
$text_p15 = $data_f['p15'];
$arrays = explode('|', $text_p15);
$arr_f1 = explode(';', $arrays[0]);
$arr_f2 = explode(';', $arrays[1]);
$arr_f3 = explode(';', $arrays[2]);

$data = array(
	array('c1'=>$arr_f1[0], 'c2'=>$arr_f1[1], 'c3'=>$arr_f1[2]),
	array('c1'=>$arr_f2[0], 'c2'=>$arr_f2[1], 'c3'=>$arr_f2[2]),
	array('c1'=>$arr_f3[0], 'c2'=>$arr_f3[1], 'c3'=>$arr_f3[2])
);
$options = array('xPos'=>'55',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>540,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 9,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'center','width'=>230),
		'c2'=>array('justification'=>'center','width'=>80),
		'c3'=>array('justification'=>'left','width'=>220)
	)
);
$pdf->ezTable($data, '','',$options);

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/
$pdf->ezText("\n",10);
$pdf->ezText(utf8_decode("<b>Otras observaciones:  </b>"),10);
$pdf->ezText("\n",5);

$data = array(
	
	array('c1'=>$data_f['observaciones'])  	
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