<?

$cod 		= strtolower(base64_decode($_GET["cod"]));
$idformtto 	= base64_decode($_GET["idformtto"]);

require("../funciones/motor.php");
require("../funciones/funciones.php");
include ('lib/class.ezpdf.php');

$fecha=date("d/m/Y");

$res_form = mysql_query("
SELECT c.nombre AS nom_centro, c.depto, e.idgrupo, e.inicio, es.codigo, es.nombre AS nom_estacion, p.*
FROM formulario_".$cod." p
JOIN evento e 	 ON p.idevento = e.idevento
JOIN estacion es ON e.idestacion = es.idestacion
JOIN centro c ON e.idcentro = c.idcentro
WHERE p.id = ".$idformtto);
$data_f = mysql_fetch_array($res_form);

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
$pdf->line(20,670,590,670);
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
$data = array(
array('c1'=>'<b>CM/SCM:</b>',					'c2'=>$data_f['nom_centro'], 					'c3'=>'',				'c4'=>''),
array('c1'=>'<b>Nomb. Responsables:</b>',		'c2'=>$data_g['user1'].' , '.$data_g['user2'],	'c3'=>'<b>Fecha Mtto:</b>', 	'c4'=>date_format(date_create($data_f['inicio']), 'd/m/Y')),
array('c1'=>'<b>Departamento:</b>',			'c2'=>$data_f['depto'],							'c3'=>'', 				'c4'=>''),
array('c1'=>'<b>Nombre estaci�n:</b>',		'c2'=>$data_f['nom_estacion'], 					'c3'=>'<b>ID estaci�n:</b> ', 	'c4'=> $data_f['codigo'])
);
$options = array('xPos'=>'left',
                'xOrientation'=>'right',
				'showHeadings'=>0,
				'width'=>480,
				'colGap' => 5,
				'shaded'=> 0,
				'showLines'=> 0,
				'fontSize' => 10,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'c1'=>array('justification'=>'right','width'=>120),
				'c2'=>array('justification'=>'left','width'=>250),
				'c3'=>array('justification'=>'right','width'=>70),
				'c4'=>array('justification'=>'left','width'=>100)
				)
            );
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>1. RELEVAMIENTO</b>",10);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$pdf->ezText("\n",5);
$data = array(
	array('c1'=>'Tiene Grupo electr�geno:',			'c2'=>utf8_decode($data_f['p01'])),
	array('c1'=>'Estado:',							'c2'=>utf8_decode($data_f['p02'])),
	array('c1'=>'Marca:',							'c2'=>utf8_decode($data_f['p03'])),
	array('c1'=>'Modelo:',							'c2'=>utf8_decode($data_f['p04'])),
	array('c1'=>'Serie:',							'c2'=>utf8_decode($data_f['p05'])),
	array('c1'=>'Voltaje (V):',						'c2'=>utf8_decode($data_f['p06'])),
	array('c1'=>'Capacidad (KVA):',					'c2'=>utf8_decode($data_f['p07'])),
	array('c1'=>'Marca ATS:',						'c2'=>utf8_decode($data_f['p08'])),
	array('c1'=>'Capacidad del tanque externo:',	'c2'=>utf8_decode($data_f['p09']))
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>0,
	'colGap' => 5,
	'shaded'=> 0,
	'showLines'=> 0,
	'fontSize' => 11,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'right','width'=>200),
		'c2'=>array('justification'=>'left','width'=>350)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>