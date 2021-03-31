<?

$cod 		= strtolower(base64_decode($_GET["cod"]));
$idformtto 	= base64_decode($_GET["idformtto"]);
$idevento 	= base64_decode($_GET["idevento"]);

require("../funciones/motor.php");
require("../funciones/funciones.php");
include ('lib/class.ezpdf.php');

$fecha=date("d/m/Y");

$res_form = mysql_query("SELECT * from formulario_p013n where idevento = ".$idevento);
$data_f = mysql_fetch_array($res_form);



$datox=mysql_fetch_array(mysql_query("SELECT descripcion FROM parametrica WHERE grupo='pie' AND sub_grupo='pie_pdf'"));
$pie=$datox['descripcion'];
//Landscape 
$pdf =& new Cezpdf('LETTER','Portrait');
$pdf->selectFont('fonts/Helvetica.afm');
$pdf->ezSetCmMargins(1,1,1.5,1);
			
////informacion de la pagina
$datacreator = array ('Title'=>'SISTEMA DE SEGUIMIENTO TECNICO','Author'=>'Ariel Siles Encinas','Subject'=>'ARCHIVO PDF DIMESAT','Creator'=>'ariel.siles@gmail.com','Producer'=>'http://facebook.com/');
$pdf->addInfo($datacreator);

$all = $pdf->openObject();
$pdf->saveState();
//$pdf->ezStartPageNumbers(537,35,10,'right','Pag. {PAGENUM} de {TOTALPAGENUM}');

/*Lineas rojas*/
$pdf->setStrokeColor(1,hexdec('33')/255,hexdec('00')/255);
//$pdf->line(20,32,590,32);
//$pdf->line(20,742,590,742);


//$pdf->line(20,670,590,670);
//$pdf->addTextWrap(12,20,580,9,$pie,'center');
$pdf->restoreState();
$pdf->closeObject();
$pdf->addObject($all,'all');

$data=array(array('title'=>'<b> FORMULARIO DE MANTENIMIENTO DE RADIO BASES</b>'));
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
$pdf->ezText("<b>1. RELEVAMIENTO ESTACION: </b>". $data_f['ESTACION'],10);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/
$data=array(array('c1'=>'TECNOLOGIA', 'c2'=>'GSM', 'c3'=>'UMTS', 'c4'=>'LTE'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>480,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'c1'=>array('justification'=>'left','width'=>150),
		'c2'=>array('justification'=>'center','width'=>127),
		'c3'=>array('justification'=>'center','width'=>127),
		'c4'=>array('justification'=>'center','width'=>126)
		)
	));
/** -------------------------------------------------------------------- **/


$data = array(
	
	array('c1'=>'TIPO DE ENLACE', 'c2'=>$data_f['TEGSM'], 'c3'=>$data_f['TEUMTS'], 'c4'=>$data_f['TELTE']), 
	array('c1'=>'EQUIPO ORIGEN DE TX', 'c2'=>$data_f['EOGSM'], 'c3'=>$data_f['EOUMTS'], 'c4'=>$data_f['EOLTE']), 
	array('c1'=>'TIPO DE PUERTO','c2'=>$data_f['TPGSM'], 'c3'=>$data_f['TPUMTS'], 'c4'=>$data_f['TPLTE']), 
	array('c1'=>'PUERTO ASIGNADO EN TX','c2'=>$data_f['PGSM'], 'c3'=>$data_f['PUMTS'], 'c4'=>$data_f['PLTE']), 
	array('c1'=>'SALTO PREVIO','c2'=>$data_f['SPGSM'], 'c3'=>$data_f['SPUMTS'], 'c4'=>$data_f['SPLTE']), 
	array('c1'=>'MODELO DE GABINITE','c2'=>$data_f['MGGSM'], 'c3'=>$data_f['MGUMTS'], 'c4'=>$data_f['MGLTE']) 
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
		'c1'=>array('justification'=>'left','width'=>150),
		'c2'=>array('justification'=>'center','width'=>127),
		'c3'=>array('justification'=>'center','width'=>127),
		'c4'=>array('justification'=>'center','width'=>126)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b> Antenas de la Radio Base</b>",10);
$pdf->ezText("\n",2);
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
$data=array(array('c1'=>'N', 'c2'=>'Tipo de antena', 'c3'=>'Sector', 'c4'=>'Tecnologias', 'c5'=>'Modelo', 'c6'=>'Tilt Mecanico','c7'=>'RET', 'c8'=>'* Tilt Electrico', 'c9'=>'Altura (m)', 'c10'=>'Modelo de RRU/TMA'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>480,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 7,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'c1'=>array('justification'=>'left','width'=>20),
			'c2'=>array('justification'=>'center','width'=>40),
			'c3'=>array('justification'=>'center','width'=>35),
			'c4'=>array('justification'=>'center','width'=>170),
			'c5'=>array('justification'=>'left','width'=>40),
			'c6'=>array('justification'=>'center','width'=>50),
			'c7'=>array('justification'=>'center','width'=>25)			,
			'c8'=>array('justification'=>'left','width'=>40),
			'c9'=>array('justification'=>'center','width'=>30),
			'c10'=>array('justification'=>'center','width'=>90)			
	)
));

$data = array(
	
	array('c1'=>'1', 'c2'=>$data_f['RB12'], 'c3'=>$data_f['RB13'], 'c4'=>$data_f['RB14'].'  '.$data_f['RB114'],'c5'=>$data_f['RB15'].'  '.$data_f['RB115'], 'c6'=>$data_f['RB16'].'  '.$data_f['RB116'], 'c7'=>$data_f['RB17'], 'c8'=>$data_f['RB18'],'c9'=>$data_f['RB19'], 'c10'=>$data_f['RB110'], 'c11'=>$data_f['RB111'], 'c12'=>$data_f['RB112'], 'c13'=>$data_f['RB113'].'  '.$data_f['RB117']), 
	array('c1'=>'2', 'c2'=>$data_f['RB22'], 'c3'=>$data_f['RB23'], 'c4'=>$data_f['RB24'].'  '.$data_f['RB214'],'c5'=>$data_f['RB25'].'  '.$data_f['RB215'], 'c6'=>$data_f['RB26'].'  '.$data_f['RB216'], 'c7'=>$data_f['RB27'], 'c8'=>$data_f['RB28'],'c9'=>$data_f['RB29'], 'c10'=>$data_f['RB210'], 'c11'=>$data_f['RB211'], 'c12'=>$data_f['RB212'], 'c13'=>$data_f['RB213'].'  '.$data_f['RB217']), 
	array('c1'=>'3', 'c2'=>$data_f['RB32'], 'c3'=>$data_f['RB33'], 'c4'=>$data_f['RB34'].'  '.$data_f['RB314'],'c5'=>$data_f['RB35'].'  '.$data_f['RB315'], 'c6'=>$data_f['RB36'].'  '.$data_f['RB316'], 'c7'=>$data_f['RB37'], 'c8'=>$data_f['RB38'],'c9'=>$data_f['RB39'], 'c10'=>$data_f['RB310'], 'c11'=>$data_f['RB311'], 'c12'=>$data_f['RB312'], 'c13'=>$data_f['RB313'].'  '.$data_f['RB317']),
	array('c1'=>'4', 'c2'=>$data_f['RB42'], 'c3'=>$data_f['RB43'], 'c4'=>$data_f['RB44'].'  '.$data_f['RB414'],'c5'=>$data_f['RB45'].'  '.$data_f['RB415'], 'c6'=>$data_f['RB46'].'  '.$data_f['RB416'], 'c7'=>$data_f['RB47'], 'c8'=>$data_f['RB48'],'c9'=>$data_f['RB49'], 'c10'=>$data_f['RB410'], 'c11'=>$data_f['RB411'], 'c12'=>$data_f['RB412'], 'c13'=>$data_f['RB413'].'  '.$data_f['RB417']), 
	array('c1'=>'5', 'c2'=>$data_f['RB52'], 'c3'=>$data_f['RB53'], 'c4'=>$data_f['RB54'].'  '.$data_f['RB514'],'c5'=>$data_f['RB55'].'  '.$data_f['RB515'], 'c6'=>$data_f['RB56'].'  '.$data_f['RB516'], 'c7'=>$data_f['RB57'], 'c8'=>$data_f['RB58'],'c9'=>$data_f['RB59'], 'c10'=>$data_f['RB510'], 'c11'=>$data_f['RB511'], 'c12'=>$data_f['RB512'], 'c13'=>$data_f['RB513'].'  '.$data_f['RB517']),
	array('c1'=>'6', 'c2'=>$data_f['RB62'], 'c3'=>$data_f['RB63'], 'c4'=>$data_f['RB64'].'  '.$data_f['RB614'],'c5'=>$data_f['RB65'].'  '.$data_f['RB615'], 'c6'=>$data_f['RB66'].'  '.$data_f['RB616'], 'c7'=>$data_f['RB67'], 'c8'=>$data_f['RB68'],'c9'=>$data_f['RB69'], 'c10'=>$data_f['RB610'], 'c11'=>$data_f['RB611'], 'c12'=>$data_f['RB612'], 'c13'=>$data_f['RB613'].'  '.$data_f['RB617']),
	array('c1'=>'7', 'c2'=>$data_f['RB72'], 'c3'=>$data_f['RB73'], 'c4'=>$data_f['RB74'].'  '.$data_f['RB714'],'c5'=>$data_f['RB75'].'  '.$data_f['RB715'], 'c6'=>$data_f['RB76'].'  '.$data_f['RB716'], 'c7'=>$data_f['RB77'], 'c8'=>$data_f['RB78'],'c9'=>$data_f['RB79'], 'c10'=>$data_f['RB710'], 'c11'=>$data_f['RB711'], 'c12'=>$data_f['RB712'], 'c13'=>$data_f['RB713'].'  '.$data_f['RB717']), 
	array('c1'=>'8', 'c2'=>$data_f['RB82'], 'c3'=>$data_f['RB83'], 'c4'=>$data_f['RB84'].'  '.$data_f['RB814'],'c5'=>$data_f['RB85'].'  '.$data_f['RB815'], 'c6'=>$data_f['RB86'].'  '.$data_f['RB816'], 'c7'=>$data_f['RB87'], 'c8'=>$data_f['RB88'],'c9'=>$data_f['RB89'], 'c10'=>$data_f['RB810'], 'c11'=>$data_f['RB811'], 'c12'=>$data_f['RB812'], 'c13'=>$data_f['RB813'].'  '.$data_f['RB817']),
	array('c1'=>'9', 'c2'=>$data_f['RB92'], 'c3'=>$data_f['RB93'], 'c4'=>$data_f['RB94'].'  '.$data_f['RB914'],'c5'=>$data_f['RB95'].'  '.$data_f['RB915'], 'c6'=>$data_f['RB96'].'  '.$data_f['RB916'], 'c7'=>$data_f['RB97'], 'c8'=>$data_f['RB98'],'c9'=>$data_f['RB99'], 'c10'=>$data_f['RB910'], 'c11'=>$data_f['RB911'], 'c12'=>$data_f['RB912'], 'c13'=>$data_f['RB913'].'  '.$data_f['RB917'])


);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>550,
	'colGap' => 5,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 6,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>20),
		'c2'=>array('justification'=>'center','width'=>40),
		'c3'=>array('justification'=>'center','width'=>35),
		'c4'=>array('justification'=>'left','width'=>40),
		'c5'=>array('justification'=>'left','width'=>50),
		'c6'=>array('justification'=>'left','width'=>40),
		'c7'=>array('justification'=>'left','width'=>40),
		'c8'=>array('justification'=>'left','width'=>40),
		'c9'=>array('justification'=>'left','width'=>50),
		'c10'=>array('justification'=>'left','width'=>25),
		'c11'=>array('justification'=>'left','width'=>40),
		'c12'=>array('justification'=>'left','width'=>30),
		'c13'=>array('justification'=>'left','width'=>90)
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",1);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b> * Llenar solo en caso de que no se cuente con RET.</b>",10);
$pdf->ezText("\n",8);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b> Prueba de servicio</b>",10);
$pdf->ezText("\n",2);
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
$data=array(array('c1'=>'Pruebas de servicio', 'c2'=>'Numero de A', 'c3'=>'Numero de B', 'c4'=>'Hora', 'c5'=>'GSM', 'c6'=>'UMTS','c7'=>'LTE'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>480,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'c1'=>array('justification'=>'left','width'=>100),
			'c2'=>array('justification'=>'center','width'=>70),
			'c3'=>array('justification'=>'center','width'=>70),
			'c4'=>array('justification'=>'center','width'=>40),
			'c5'=>array('justification'=>'left','width'=>50),
			'c6'=>array('justification'=>'center','width'=>100),
			'c7'=>array('justification'=>'center','width'=>100)						
	)
));

$data = array(
	
	array('c1'=>'Llamar a movil', 'c2'=>$data_f['LMA'], 'c3'=>$data_f['LMB'], 'c4'=>$data_f['LMH'],'c5'=>$data_f['LMGSM'],'c6'=>$data_f['LMUMTS'],'c7'=>'','c8'=>'','c9'=>''), 
	array('c1'=>'SMS', 'c2'=>$data_f['SMSA'], 'c3'=>$data_f['SMSB'], 'c4'=>$data_f['SMSH'],'c5'=>$data_f['SMSGSM'], 'c6'=>$data_f['SMSUMTS'], 'c7'=>'','c8'=>'','c9'=>''), 
	array('c1'=>'Videollamada', 'c2'=>$data_f['VLA'], 'c3'=>$data_f['VLB'], 'c4'=>$data_f['VLH'],'c5'=>$data_f['VLGSM'], 'c6'=>$data_f['VLUMTS'], 'c7'=>'','c8'=>'','c9'=>''), 
	array('c1'=>'Llamar a fijo', 'c2'=>$data_f['LFA'], 'c3'=>$data_f['LFB'], 'c4'=>$data_f['LFH'],'c5'=>$data_f['LFGSM'], 'c6'=>$data_f['LFUMTS'], 'c7'=>'','c8'=>'','c9'=>''), 
	array('c1'=>'Navegacion en internet', 'c2'=>'', 'c3'=>'', 'c4'=>$data_f['NIH'],'c5'=>$data_f['NIGSM'], 'c6'=>'Baj. '.$data_f['NIUMTSB'], 'c7'=>'Sub. '.$data_f['NIUMTSS'],'c8'=>'Baj. '.$data_f['NILTEB'],'c9'=>'Sub. '.$data_f['NILTES'])
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
		'c1'=>array('justification'=>'left','width'=>100),
			'c2'=>array('justification'=>'center','width'=>70),
			'c3'=>array('justification'=>'center','width'=>70),
			'c4'=>array('justification'=>'center','width'=>40),
			'c5'=>array('justification'=>'left','width'=>50),
			'c6'=>array('justification'=>'center','width'=>50),
			'c7'=>array('justification'=>'center','width'=>50),						
			'c8'=>array('justification'=>'center','width'=>50),
			'c9'=>array('justification'=>'center','width'=>50)						
		
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",8);
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b> Reporte Fotografico en Alta definicion</b>",10);
$pdf->ezText("\n",1);
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/


$data = array(
	
	array('c1'=>'VISTA 360 DEL SITIO', 'c2'=>$data_f['RFVS'],'c3'=>'','c4'=>'BAJANTE DE ATERRAMIENTO', 'c5'=>$data_f['RFBA']),
	array('c1'=>'CAMINO DE ACCESO', 'c2'=>$data_f['RFCA'],'c3'=>'','c4'=>'GRUPO GENERADOR', 'c5'=>$data_f['RFGG']),
	array('c1'=>'DETALLE PUERTA', 'c2'=>$data_f['RFDP'],'c3'=>'','c4'=>'BARRAS DE TIERRA', 'c5'=>$data_f['RFBT']),
	array('c1'=>'VISTAS DE LA ESTRUCTURA', 'c2'=>$data_f['RFVE'],'c3'=>'','c4'=>'TRANSFORMADOR', 'c5'=>$data_f['RFT']),
	array('c1'=>'VISTA FRONTAL LOZA', 'c2'=>$data_f['RFVF'],'c3'=>'','c4'=>'EQUIPOS DE TX', 'c5'=>$data_f['RFET']),
	array('c1'=>'GABINETES ABIERTOS', 'c2'=>$data_f['RFGA'],'c3'=>'','c4'=>'DETALLE PUERTOS DE TX', 'c5'=>$data_f['RFDPTX']),
	array('c1'=>'ANTENAS DE ENLACES', 'c2'=>$data_f['RFAE'],'c3'=>'','c4'=>'AZUMUTHs DESDE ANTENA SECTORIAL', 'c5'=>$data_f['RFAA']),
	array('c1'=>'VISTA 360 DESDE PLATAFORMA', 'c2'=>$data_f['RFVDP'],'c3'=>'','c4'=>'CONEXIONES DE ANTENA SECTORIAL', 'c5'=>$data_f['RFCAS']),
	array('c1'=>'TILTs MECANICOS', 'c2'=>$data_f['RFTM'],'c3'=>'','c4'=>'BANCO DE BATERIAS', 'c5'=>$data_f['RFBB']),
	array('c1'=>'VISTA PORSTERIOR LOZA', 'c2'=>$data_f['RFVP'],'c3'=>'','c4'=>'DETALLE CAPACIDAD DE BATERIAS', 'c5'=>$data_f['RFDCB']),
	array('c1'=>'TDP ABIERTO', 'c2'=>$data_f['RFTDP'],'c3'=>'','c4'=>'PROTECTORES DE 1ER/2DO NIVEL', 'c5'=>$data_f['RFPN']),
	array('c1'=>'MEDIDOR', 'c2'=>$data_f['RFM'],'c3'=>'','c4'=>'OBSERVACIONES', 'c5'=>$data_f['RFO'])
	
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
		'c1'=>array('justification'=>'left','width'=>160),
		'c2'=>array('justification'=>'center','width'=>70),
		'c3'=>array('justification'=>'center','width'=>90),
		'c4'=>array('justification'=>'left','width'=>160),
		'c5'=>array('justification'=>'center','width'=>50)
		
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",40);
/** -------------------------------------------------------------------- **/
$pdf->ezText("<b> 2. Mantenimiento Preventivo</b>",10);
$pdf->ezText("\n",1);
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
$data=array(array('c1'=>'', 'c2'=>'Revisado', 'c3'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>480,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'c1'=>array('justification'=>'left','width'=>200),
			'c2'=>array('justification'=>'center','width'=>60),
			'c3'=>array('justification'=>'center','width'=>250)			
	)
));

$data = array(
	
	array('c1'=>'Verificar la instalacion del gabinete', 'c2'=>$data_f['MPVIG'], 'c3'=>$data_f['MPOVIG']), 
	array('c1'=>'Verificar la instalacion de la BBU y tarjetas', 'c2'=>$data_f['MPVIB'], 'c3'=>$data_f['MPOVIB']),
	array('c1'=>'Verificar la limpieza fuera y dentro del gabinete', 'c2'=>$data_f['MPLG'], 'c3'=>$data_f['MPOLG']), 
	array('c1'=>'Verificar el cable de aterramiento de gabinete', 'c2'=>$data_f['MPVCAG'], 'c3'=>$data_f['MPOVCAG']), 
	array('c1'=>'Verificar que los cables de energia y aterramiento no esten danados o rotos', 'c2'=>$data_f['MPVCEAND'], 'c3'=>$data_f['MPOVCEAND']), 
	array('c1'=>'Verificar la instalacion de las RRUs', 'c2'=>$data_f['MPVIRRU'], 'c3'=>$data_f['MPOVIRRU']) ,
	array('c1'=>'Verificar que cables de energia no esten danados o rotos', 'c2'=>$data_f['MPCVENDR'], 'c3'=>$data_f['MPOCVENDR']) ,
	array('c1'=>'Verificar que cables de aterramiento no esten danados o rotos', 'c2'=>$data_f['MPVCANDR'], 'c3'=>$data_f['MPOVCANDR']) ,
	array('c1'=>'Verificar el vulcanizado', 'c2'=>$data_f['MPVV'], 'c3'=>$data_f['MPOVV']) ,
	array('c1'=>'Verificar etiquetado en Antenas y RRUs', 'c2'=>$data_f['MPVEANR'], 'c3'=>$data_f['MPOVEANR']) ,
	array('c1'=>'Verificar la instalacion de las antenas', 'c2'=>$data_f['MPVIA'], 'c3'=>$data_f['MPOVIA']) ,
	array('c1'=>'Verificar jumpers y clamps minimo cada 1,5 metros', 'c2'=>$data_f['MPVJC'], 'c3'=>$data_f['MPOVJC']) 

	
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
		'c1'=>array('justification'=>'left','width'=>200),
		'c2'=>array('justification'=>'center','width'=>60),
		'c3'=>array('justification'=>'center','width'=>250)
			
		
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/
$data=array(array('c1'=>'Verificar alarmas visibles en Radio Base', 'c2'=>'Ubicacion de alarma', 'c3'=>'Solucionado', 'c4'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>480,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'c1'=>array('justification'=>'left','width'=>180),
			'c2'=>array('justification'=>'center','width'=>60),
			'c3'=>array('justification'=>'center','width'=>60),			
			'c4'=>array('justification'=>'center','width'=>210)			
	)
));

$data = array(
	
	array('c1'=>$data_f['VA1'], 'c2'=>$data_f['UA1'], 'c3'=>$data_f['S1'], 'c4'=>$data_f['OVA1']), 
	array('c1'=>$data_f['VA2'], 'c2'=>$data_f['UA2'], 'c3'=>$data_f['S2'], 'c4'=>$data_f['OVA2']), 
	array('c1'=>$data_f['VA3'], 'c2'=>$data_f['UA3'], 'c3'=>$data_f['S3'], 'c4'=>$data_f['OVA3'])
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
		'c1'=>array('justification'=>'left','width'=>180),
			'c2'=>array('justification'=>'center','width'=>60),
			'c3'=>array('justification'=>'center','width'=>60),			
			'c4'=>array('justification'=>'center','width'=>210)			
			
		
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/
$data=array(array('c1'=>'Verificar reporte de alarmas a sistema de gestion', 'c2'=>'Estado', 'c3'=>'Observaciones'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>480,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'c1'=>array('justification'=>'left','width'=>200),
			'c2'=>array('justification'=>'center','width'=>60),
			'c3'=>array('justification'=>'center','width'=>250)						
	)
));

$data = array(
	
	array('c1'=>'Puerta Abierta', 'c2'=>$data_f['E1'], 'c3'=>$data_f['OVR1']),  
	array('c1'=>'Baterias en descarga / Falla de rectificador', 'c2'=>$data_f['E2'], 'c3'=>$data_f['OVR2']),  	
	array('c1'=>'Corte de energia comercial', 'c2'=>$data_f['E3'], 'c3'=>$data_f['OVR3'])  
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
		'c1'=>array('justification'=>'left','width'=>200),
			'c2'=>array('justification'=>'center','width'=>60),
			'c3'=>array('justification'=>'center','width'=>250)				
			
		
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);
/** -------------------------------------------------------------------- **/
/** -------------------------------------------------------------------- **/
$data=array(array('c1'=>'OBSERVACIONES.-'));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>480,
		'colGap' => 5,
		'shaded'=> 2,
		'showLines'=> 2,
		'fontSize' => 8,
		'lineCol' => array(0.48,0.48,0.48),
		'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'c1'=>array('justification'=>'left','width'=>510)			
	)
));

$data = array(
	
	array('c1'=>$data_f['OBS'])  	
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
		'c1'=>array('justification'=>'left','width'=>510)								
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",4);
/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>