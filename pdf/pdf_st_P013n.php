<?

//mb_http_output('UTF-8');


//ini_set('default_charset','utf-8');
//header('Content-Type: text/html; charset=ISO-8859-1');
ini_set('default_charset','utf-8');
header('Content-Type: text/html; charset=UTF-8');
//header('Content-Type: text/html; charset=UTF-8'); 

$cod 		= strtolower(base64_decode($_GET["cod"]));
$idformtto 	= base64_decode($_GET["idformtto"]);
$idevento 	= base64_decode($_GET["idevento"]);

require("../funciones/motor.php");
require("../funciones/funciones.php");
include ('lib/class.ezpdf.php');

//mysql_set_charset('utf8',$conexion);
//mysql_query("SET NAMES 'utf8'");

$fecha=date("d/m/Y");

$res_form = mysql_query("SELECT *,estacion.codigo AS codigoestacion,centro.nombre as nombrecentro,estacion.nombre AS nombreestacion FROM p013_formulario,estacion,centro WHERE p013_formulario.idestacion=estacion.codigo AND estacion.idcentro=centro.idcentro and idevento = ".$idevento);
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
//$pdf->setStrokeColor(1,hexdec('33')/255,hexdec('00')/255);



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
$pdf->setStrokeColor(0,0,0);
//$pdf->line(20,32,590,32);
$pdf->line(20,742,590,742);


//$pdf->addText(200, 600, 10, "<i>!Leer Aumenta el Saber! </i>\n");
//$pdf->addText(240, 740, 10, "<b>Listado Empleados </b>\n");

/** -------------------------------------------------------------------- **/
$pdf->ezText("<b>Identificacion del Sitio </b>",10);
$pdf->ezText("\n",5);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/
$pdf->ezText("Departamento",8);

$pdf->ezText("\n",5);
//$pdf->ezText("Centro o Subcentro:",10);
$pdf->ezText("\n",20);

$pdf->addText(157, 690, 8, $data_f['depto']);
$pdf->rectangle(155, 685,160,15);

$pdf->addText(320, 690, 8, "ID Sitio \n");
$pdf->addText(390, 690, 8, $data_f['codigoestacion']);
$pdf->rectangle(388, 685,160,15);

$pdf->addText(45, 670, 9, "Centro o Subcentro \n");
$pdf->addText(157, 670, 8, $data_f['nombrecentro']);
$pdf->rectangle(155, 665,160,15);

$pdf->addText(320, 670, 9, "Nombre Sitio \n");
$pdf->addText(390, 668, 8, $data_f['nombreestacion']);
$pdf->rectangle(388, 665,160,15);

$pdf->addText(45, 650, 9, "Responsable contratista \n");
$pdf->addText(157, 650, 8, utf8_decode($data_f['responsable']));
$pdf->rectangle(155, 645,160,15);

$pdf->addText(320, 650, 9, "Fecha mantto \n");
$pdf->addText(390, 648, 8, $data_f['fechamantenimiento']);
$pdf->rectangle(388, 645,160,15);


/*Lineas rojas*/
//$pdf->setStrokeColor(1,hexdec('33')/255,hexdec('00')/255);
$pdf->setStrokeColor(0,0,0);
//$pdf->line(20,32,590,32);
$pdf->line(20,640,590,640);

$pdf->ezText("<b>1. Relevamiento </b>",10);
$pdf->ezText("\n",5);

$pdf->ezText("Radio Bases",8);
$pdf->ezText("\n",2);
$pdf->ezText("Estado",8);
$pdf->ezText("\n",2);
$pdf->ezText("Vendedor",8);
$pdf->ezText("\n",2);
$pdf->ezText("Tipo de transporte",8);
$pdf->ezText("\n",2);
$pdf->ezText("Salto anterior",8);
$pdf->ezText("\n",2);
$pdf->ezText("Interface",8);
$pdf->ezText("\n",2);
$pdf->ezText("Equipo de transmision",8);
$pdf->ezText("\n",2);
$pdf->ezText("Energia principal",8);
$pdf->ezText("\n",2);
$pdf->ezText("Energia de respaldo",8);
$pdf->ezText("\n",5);

$pdf->addText(160, 605, 6, $data_f['radiobase']);
$pdf->rectangle(157, 603,160,10);

$pdf->addText(160, 591, 6, utf8_decode($data_f['estado']));
$pdf->rectangle(157, 589,160,10);

$pdf->addText(160, 577, 6, utf8_decode($data_f['vendor']));
$pdf->rectangle(157, 575,160,10);

$pdf->addText(160, 563, 6, utf8_decode($data_f['tipotransporte']));
$pdf->rectangle(157, 560,160,10);

$pdf->addText(160, 548, 6, utf8_decode($data_f['saltoanterior']));
$pdf->rectangle(157, 546,160,10);

$pdf->addText(160, 535, 6, utf8_decode($data_f['interface']));
$pdf->rectangle(157, 532,160,10);

$pdf->addText(160, 521, 6, utf8_decode($data_f['equipotransmision']));
$pdf->rectangle(157, 518,160,10);

$pdf->addText(160, 506, 6, utf8_decode($data_f['energiaprincipal']));
$pdf->rectangle(157, 503,160,10);

$pdf->addText(160, 493, 6, utf8_decode($data_f['energiarespaldo']));
$pdf->rectangle(157, 490,160,10);


$pdf->setStrokeColor(0,0,0);
//$pdf->line(20,32,590,32);
$pdf->line(20,480,590,480);
$pdf->ezText("\n",2);
$pdf->ezText("<b>2. Mantenimiento preventivo </b>",10);
$pdf->ezText("\n",5);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$res_mantenimiento = mysql_query("SELECT  convert(cast(convert(nombreverificacionfisica using latin1) as binary) using utf8) as nombreverificacionfisica,
convert(cast(convert(revisado using latin1) as binary) using utf8) as revisado,
convert(cast(convert(observaciones using latin1) as binary) using utf8) observaciones 
 FROM p013_verificacionfisica,p013_tverificacionfisica
WHERE p013_verificacionfisica.idverificacionfisica=p013_tverificacionfisica.idverficacionfisica AND idevento=".$idevento." ORDER BY orden");




//$res_mantenimiento=utf8_decode($res_mantenimiento);
//$data_mantenimiento = mysql_fetch_array($res_mantenimiento);

//$ixx = 0;

//explotando los datos 
while($datatmp = mysql_fetch_assoc($res_mantenimiento)) { 
 
 $data[] = array_merge($datatmp);
 //$ixx = $ixx+1;
}


$titles = array(
'nombreverificacionfisica'=>'<b></b>',
'revisado'=>'<b>Revisado</b>',
'observaciones'=>'<b>Observaciones</b>'
);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);
//$txttit = "\n";
//$txttit.= "\n"; 
//$pdf->ezText($txttit, 12);
$pdf->ezTable($data, $titles, '', $options);

//$pdf->ezText("\n\n\n", 5);
$pdf->ezText("\n", 5);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$res_alarmas = mysql_query("SELECT convert(cast(convert(alarma using latin1) as binary) using UTF8) AS alarma,
convert(cast(convert(causa using latin1) as binary) using UTF8) AS causa,
convert(cast(convert(solucion using latin1) as binary) using UTF8) AS solucion,
convert(cast(convert(observaciones using latin1) as binary) using UTF8) AS observaciones FROM p013_alarmas WHERE idevento =".$idevento." ORDER BY orden");
//$data_mantenimiento = mysql_fetch_array($res_mantenimiento);

//$ixx = 0;

//explotando los datos 
while($datatmp = mysql_fetch_assoc($res_alarmas)) { 
 
 $data1[] = array_merge($datatmp);
 //$ixx = $ixx+1;
}


$titles = array(
'alarma'=>'<b>Listar alarmas de Radio Base por LMT, OMT</b>',
'causa'=>'<b>Causa</b>',
'solucion'=>'<b>Solucion</b>',
'observaciones'=>'<b>Observaciones</b>'
);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);

$pdf->ezTable($data1, $titles, '', $options);
$pdf->ezText("\n", 5);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$res_alarmasexternas = mysql_query("SELECT convert(cast(convert(nombreverificaralarmaexterna using latin1) as binary) using UTF8) AS nombreverificaralarmaexterna,
convert(cast(convert(estado using latin1) as binary) using UTF8) AS estado,
convert(cast(convert(observaciones using latin1) as binary) using UTF8) AS observaciones FROM p013_verificacionalarmasexternas,p013_tverificacionalarmasexternas WHERE p013_verificacionalarmasexternas.idverificaralarmaexterna=p013_tverificacionalarmasexternas.idverificaralarmaexterna AND idevento=".$idevento." ORDER BY orden");
//$data_mantenimiento = mysql_fetch_array($res_mantenimiento);

//$ixx = 0;

//explotando los datos 
while($datatmp = mysql_fetch_assoc($res_alarmasexternas)) { 
 
 $data2[] = array_merge($datatmp);
 //$ixx = $ixx+1;
}
 

$titles = array(
'nombreverificaralarmaexterna'=>'<b>Verificar alarmas externas</b>',
'estado'=>'<b>Estado</b>',
'observaciones'=>'<b>Observaciones</b>'
);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);

$pdf->ezTable($data2, $titles, '', $options);
$pdf->ezText("\n", 5);



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$res_pruebasservicio = mysql_query("SELECT nombrepruebaservicio,
 numeroa,
 numerob,
 pruebaexitosa,
 fechahora,
 convert(cast(convert(observaciones  using latin1) as binary) using UTF8) AS observaciones 
FROM p013_pruebasservicios,p013_tpruebasservicios WHERE p013_pruebasservicios.idpruebaservicio=p013_tpruebasservicios.idpruebaservicio and idevento=".$idevento." ORDER BY orden");

while($datatmp = mysql_fetch_assoc($res_pruebasservicio)) { 
 
 $data3[] = array_merge($datatmp);
 //$ixx = $ixx+1;
}
 

$titles = array(
'nombrepruebaservicio'=>'<b>Pruebas de servicio</b>',
'numeroa'=>'<b>Numero de A</b>',
'numerob'=>'<b>Numero de B</b>',
'pruebaexitosa'=>'<b>Prueba Exitosa? </b>',
'fechahora'=>'<b>Fecha y hora</b>',
'observaciones'=>'<b>Observaciones</b>'
);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);

$pdf->ezTable($data3, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);





//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$pdf->addText(160, 521, 6

//$pdf->addTextWrap(160, 650,25 , 10, utf8_decode(html_entity_decode($data_f['observaciones'])), 'center');






$pdf->setStrokeColor(0,0,0);
$pdf->ezText("\n",6);
$pdf->ezText("<b>3. Observaciones </b>",10);
$pdf->ezText("\n",3);

$res_pruebasservicio = mysql_query("SELECT convert(cast(convert(observacion   using latin1) as binary) using UTF8) AS observacion  FROM p013_observaciones WHERE idevento=".$idevento." ORDER BY orden");


$filas=mysql_num_rows($res_pruebasservicio);
if ($filas>0){
	while($datatmp = mysql_fetch_assoc($res_pruebasservicio)) {  
	 	$data7[] = array_merge($datatmp); 
	}
	 
}else{				

	$data7 = array(
	array('observacion'=>''),
	array('observacion'=>''),
	array('observacion'=>''),
	array('observacion'=>''),
	array('observacion'=>''),
	array('observacion'=>''),
	array('observacion'=>''),
	array('observacion'=>''),
	array('observacion'=>'')
	
);
}
$titles = array(
	'observacion'=>'<b></b>',
);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);

$pdf->ezTable($data7, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);


/*
$variabletext=nl2br(utf8_decode($data_f['observaciones']));
$porciones = explode("<br />", $variabletext);
$longitud = count($porciones);

for($i=0; $i<$longitud; $i++)
      {
      //saco el valor de cada elemento
	  //$pdf->ezText("\n",1);
	  $pdf->ezText($porciones[$i],6);
	  //$pdf->addText(45, 540, 9, $porciones[$i]);
	  //$pdf->addTextWrap(40, 655,300 , 6, $porciones[$i] , 'left');
	  
      }

//$pdf->addTextWrap(40, 655,300 , 6, $porciones[0] , 'left');
 while ($longitud <= 10){
	$pdf->ezText("\n",5);
	$longitud+=1;
 }
 */
 $pdf->ezText("\n",3);
$pdf->ezText("<b>4. Relevamiento de celdas </b>",10);
$pdf->ezText("\n",5);
//$pdf->rectangle(40, 535,520,130);
//$pdf->ezText("\n",5);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$pdf->setStrokeColor(0,0,0);
//$pdf->line(20,685,590,685);

//$pdf->ezText("\n",20);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$res_pruebasservicio = mysql_query("SELECT * from p013_relevamientosceldas,p013_formularioestaciones
WHERE p013_relevamientosceldas.idestacionentel=p013_formularioestaciones.idestacionentel
AND tecnologia='RED 2G GSM' AND p013_relevamientosceldas.idevento=".$idevento." ORDER BY ORDEN");
//$data_mantenimiento = mysql_fetch_array($res_mantenimiento);

$data_f = mysql_fetch_array($res_pruebasservicio);

/*$pdf->addText(45, 490, 9, "Tecnologia \n");
$pdf->addText(157, 490, 8, $data_f['tecnologia']);
$pdf->rectangle(155, 485,160,15);

$pdf->addText(320, 490, 8, "ID Estacion \n");
$pdf->addText(390, 490, 8, $data_f['idestacionentel']);
$pdf->rectangle(388, 485,160,15);

$pdf->addText(45, 460, 9, "Nombre de la BTS \n");
$pdf->addText(157, 460, 8, $data_f['nombrebts']);
$pdf->rectangle(155, 455,160,15);

$pdf->addText(320, 460, 9, "Configuracion \n");
$pdf->addText(390, 460, 8, $data_f['configuracion']);
$pdf->rectangle(388, 455,160,15);
*/
//////////////////////////////////////////////////////////////////////////////////////
$data=array(array('c1'=>'', 'c2'=>'','c3'=>'','c4'=>'','c5'=>''));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>480,
		//'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 0,
		'fontSize' => 8,
		//'lineCol' => array(0.48,0.48,0.48),
		//'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'c1'=>array('justification'=>'left','width'=>80),			
			'c2'=>array('justification'=>'left','width'=>100),			
			'c3'=>array('justification'=>'left','width'=>60),			
			'c4'=>array('justification'=>'left','width'=>80),			
			'c5'=>array('justification'=>'left','width'=>100)			
	)
));

$data = array(
	
	array('c1'=>'Tecnologia:', 'c2'=>$data_f['tecnologia'],'c3'=>'','c4'=>'ID Estacion:','c5'=>$data_f['idestacionentel']), 
	//array('c1'=>'', 'c2'=>'', 'c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>''), 
	array('c1'=>'Nombre de la BTS:', 'c2'=>$data_f['nombrebts'],'c3'=>'','c4'=>'Configuracion:','c5'=>$data_f['configuracion']), 
	
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>550,
	'colGap' => 3,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>80),			
			'c2'=>array('justification'=>'left','width'=>100),			
			'c3'=>array('justification'=>'left','width'=>60),			
			'c4'=>array('justification'=>'left','width'=>80),			
			'c5'=>array('justification'=>'left','width'=>100)							
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",5);




///////////////////////////////////////////////////




$res_pruebasservicio = mysql_query("SELECT convert(cast(convert(sector using latin1) as binary) using UTF8) AS sector,
convert(cast(convert(localcellid using latin1) as binary) using UTF8) AS localcellid,
convert(cast(convert(bandamhz using latin1) as binary) using UTF8) AS bandamhz,
convert(cast(convert(modelorbs using latin1) as binary) using UTF8) AS modelorbs,
convert(cast(convert(tipoantena using latin1) as binary) using UTF8) AS tipoantena,
convert(cast(convert(marcaantena using latin1) as binary) using UTF8) AS marcaantena,
convert(cast(convert(modeloantena using latin1) as binary) using UTF8) AS modeloantena,
convert(cast(convert(azimuth using latin1) as binary) using UTF8) AS azimuth,
convert(cast(convert(tiltmecanico using latin1) as binary) using UTF8) AS tiltmecanico,
convert(cast(convert(tiltelectrico using latin1) as binary) using UTF8) AS tiltelectrico,
convert(cast(convert(anguloapertura using latin1) as binary) using UTF8) AS anguloapertura,
convert(cast(convert(alturaantena using latin1) as binary) using UTF8) AS alturaantena,
convert(cast(convert(tieneret using latin1) as binary) using UTF8) AS tieneret,
convert(cast(convert(modelorru using latin1) as binary) using UTF8) AS modelorru from p013_relevamientosceldas,p013_formularioestaciones
WHERE p013_relevamientosceldas.idestacionentel=p013_formularioestaciones.idestacionentel
AND tecnologia='RED 2G GSM' AND p013_relevamientosceldas.idevento=".$idevento." ORDER BY ORDEN");



$filas=mysql_num_rows($res_pruebasservicio);
if ($filas>0){
	//explotando los datos 
	while($datatmp = mysql_fetch_assoc($res_pruebasservicio)) {  
		$data4[] = array_merge($datatmp); 
 
	}

}else{

$data4 = array(
	array('sector'=>'1','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'2','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'3','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'4','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'5','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'6','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'7','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'8','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'9','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>'')	
);
}



$titles = array(
'sector'=>'<b>Sector</b>',
'localcellid'=>'<b>Local Cell ID</b>',
'bandamhz'=>'<b>Banda MHz</b>',
'modelorbs'=>'<b>Modelo RBS </b>',
'tipoantena'=>'<b>Tipo de antena</b>',
'marcaantena'=>'<b>Marca antena</b>',
'modeloantena'=>'<b>Modelo antena</b>',
'azimuth'=>'<b>Azimuth</b>',
'tiltmecanico'=>'<b>Tilt Mecanico</b>',
'tiltelectrico'=>'<b>Tilt Electrico</b>',
'anguloapertura'=>'<b>Angulo de apertura</b>',
'alturaantena'=>'<b>Altura antena</b>',
'tieneret'=>'<b>Tiene Ret</b>',
'modelorru'=>'<b>Modelo RRU</b>'

);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>550,
'fontSize' => 6
);

$pdf->ezTable($data4, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$res_pruebasservicio = mysql_query("SELECT  * from p013_relevamientosceldas,p013_formularioestaciones
WHERE p013_relevamientosceldas.idestacionentel=p013_formularioestaciones.idestacionentel
AND tecnologia='RED 4G HSPA' AND p013_relevamientosceldas.idevento=".$idevento." ORDER BY ORDEN");
//$data_mantenimiento = mysql_fetch_array($res_mantenimiento);

//$ixx = 0;

//explotando los datos 
$pdf->setStrokeColor(0,0,0);


$data_f = mysql_fetch_array($res_pruebasservicio);

/*$pdf->addText(45, 280, 9, "Tecnologia \n");
$pdf->addText(157, 280, 8, $data_f['tecnologia']);
$pdf->rectangle(155, 275,160,15);

$pdf->addText(320, 280, 8, "ID Estacion \n");
$pdf->addText(390, 280, 8, $data_f['idestacionentel']);
$pdf->rectangle(388, 275,160,15);

$pdf->addText(45, 250, 9, "Nombre de la BTS \n");
$pdf->addText(157, 250, 8, $data_f['nombrebts']);
$pdf->rectangle(155, 245,160,15);

$pdf->addText(320, 250, 9, "Configuracion \n");
$pdf->addText(390, 250, 8, $data_f['configuracion']);
$pdf->rectangle(388, 245,160,15);
*/

//////////////////////////////////////////////////////////////////////////////////////
$data=array(array('c1'=>'', 'c2'=>'','c3'=>'','c4'=>'','c5'=>''));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>480,
		//'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 0,
		'fontSize' => 8,
		//'lineCol' => array(0.48,0.48,0.48),
		//'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'c1'=>array('justification'=>'left','width'=>80),			
			'c2'=>array('justification'=>'left','width'=>100),			
			'c3'=>array('justification'=>'left','width'=>60),			
			'c4'=>array('justification'=>'left','width'=>80),			
			'c5'=>array('justification'=>'left','width'=>100)			
	)
));

$data = array(
	
	array('c1'=>'Tecnologia:', 'c2'=>$data_f['tecnologia'],'c3'=>'','c4'=>'ID Estacion:','c5'=>$data_f['idestacionentel']), 
	//array('c1'=>'', 'c2'=>'', 'c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>''), 
	array('c1'=>'Nombre de la BTS:', 'c2'=>$data_f['nombrebts'],'c3'=>'','c4'=>'Configuracion:','c5'=>$data_f['configuracion']), 
	
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>550,
	'colGap' => 3,
	//'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>80),			
			'c2'=>array('justification'=>'left','width'=>100),			
			'c3'=>array('justification'=>'left','width'=>60),			
			'c4'=>array('justification'=>'left','width'=>80),			
			'c5'=>array('justification'=>'left','width'=>100)							
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",10);




///////////////////////////////////////////////////

$res_pruebasservicio = mysql_query("SELECT convert(cast(convert(sector using latin1) as binary) using UTF8) AS sector,
convert(cast(convert(localcellid using latin1) as binary) using UTF8) AS localcellid,
convert(cast(convert(bandamhz using latin1) as binary) using UTF8) AS bandamhz,
convert(cast(convert(modelorbs using latin1) as binary) using UTF8) AS modelorbs,
convert(cast(convert(tipoantena using latin1) as binary) using UTF8) AS tipoantena,
convert(cast(convert(marcaantena using latin1) as binary) using UTF8) AS marcaantena,
convert(cast(convert(modeloantena using latin1) as binary) using UTF8) AS modeloantena,
convert(cast(convert(azimuth using latin1) as binary) using UTF8) AS azimuth,
convert(cast(convert(tiltmecanico using latin1) as binary) using UTF8) AS tiltmecanico,
convert(cast(convert(tiltelectrico using latin1) as binary) using UTF8) AS tiltelectrico,
convert(cast(convert(anguloapertura using latin1) as binary) using UTF8) AS anguloapertura,
convert(cast(convert(alturaantena using latin1) as binary) using UTF8) AS alturaantena,
convert(cast(convert(tieneret using latin1) as binary) using UTF8) AS tieneret,
convert(cast(convert(modelorru using latin1) as binary) using UTF8) AS modelorru from p013_relevamientosceldas,p013_formularioestaciones
WHERE p013_relevamientosceldas.idestacionentel=p013_formularioestaciones.idestacionentel
AND tecnologia='RED 4G HSPA' AND p013_relevamientosceldas.idevento=".$idevento." ORDER BY ORDEN");
$filas=mysql_num_rows($res_pruebasservicio);
if ($filas>0){
	//explotando los datos 
	while($datatmp = mysql_fetch_assoc($res_pruebasservicio)) {  
		$data5[] = array_merge($datatmp); 
 
	}

}else{

$data5 = array(
	array('sector'=>'1','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'2','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'3','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'4','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'5','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'6','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'7','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'8','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'9','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>'')	
);
}

$titles = array(
'sector'=>'<b>Sector</b>',
'localcellid'=>'<b>Local Cell ID</b>',
'bandamhz'=>'<b>Banda MHz</b>',
'modelorbs'=>'<b>Modelo RBS </b>',
'tipoantena'=>'<b>Tipo de antena</b>',
'marcaantena'=>'<b>Marca antena</b>',
'modeloantena'=>'<b>Modelo antena</b>',
'azimuth'=>'<b>Azimuth</b>',
'tiltmecanico'=>'<b>Tilt Mecanico</b>',
'tiltelectrico'=>'<b>Tilt Electrico</b>',
'anguloapertura'=>'<b>Angulo de apertura</b>',
'alturaantena'=>'<b>Altura antena</b>',
'tieneret'=>'<b>Tiene Ret</b>',
'modelorru'=>'<b>Modelo RRU</b>'

);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>550,
'fontSize' => 6
);

$pdf->ezTable($data5, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$res_pruebasservicio = mysql_query("SELECT * from p013_relevamientosceldas,p013_formularioestaciones
WHERE p013_relevamientosceldas.idestacionentel=p013_formularioestaciones.idestacionentel
AND tecnologia='RED LTE' AND p013_relevamientosceldas.idevento=".$idevento." ORDER BY ORDEN");
//$data_mantenimiento = mysql_fetch_array($res_mantenimiento);

//$ixx = 0;

$pdf->setStrokeColor(0,0,0);


$data_f = mysql_fetch_array($res_pruebasservicio);

/*$pdf->addText(45, 730, 9, "Tecnologia \n");
$pdf->addText(157, 730, 8, $data_f['tecnologia']);
$pdf->rectangle(155, 725,160,15);

$pdf->addText(320, 730, 8, "ID Estacion \n");
$pdf->addText(390, 730, 8, $data_f['idestacionentel']);
$pdf->rectangle(388, 725,160,15);

$pdf->addText(45, 700, 9, "Nombre de la BTS \n");
$pdf->addText(157, 700, 8, $data_f['nombrebts']);
$pdf->rectangle(155, 695,160,15);

$pdf->addText(320, 700, 9, "Configuracion \n");
$pdf->addText(390, 700, 8, $data_f['configuracion']);
$pdf->rectangle(388, 695,160,15);*/


//////////////////////////////////////////////////////////////////////////////////////
$data=array(array('c1'=>'', 'c2'=>'','c3'=>'','c4'=>'','c5'=>''));
$pdf->ezTable($data,'','',
	array('xPos'=>'left',
		'xOrientation'=>'right',
		'showHeadings'=>0,
		'width'=>480,
		//'colGap' => 5,
		'shaded'=> 1,
		'showLines'=> 0,
		'fontSize' => 8,
		//'lineCol' => array(0.48,0.48,0.48),
		//'shadeCol2' => array(0.80,0.80,0.80),
		'cols'=>array(
			'c1'=>array('justification'=>'left','width'=>80),			
			'c2'=>array('justification'=>'left','width'=>100),			
			'c3'=>array('justification'=>'left','width'=>60),			
			'c4'=>array('justification'=>'left','width'=>80),			
			'c5'=>array('justification'=>'left','width'=>100)			
	)
));

$data = array(
	
	array('c1'=>'Tecnologia:', 'c2'=>$data_f['tecnologia'],'c3'=>'','c4'=>'ID Estacion:','c5'=>$data_f['idestacionentel']), 
	//array('c1'=>'', 'c2'=>'', 'c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>''), 
	array('c1'=>'Nombre de la BTS:', 'c2'=>$data_f['nombrebts'],'c3'=>'','c4'=>'Configuracion:','c5'=>$data_f['configuracion']), 
	
);
$options = array('xPos'=>'left',
	'xOrientation'=>'right',
	'showHeadings'=>0,
	'width'=>550,
	'colGap' => 3,
	'shaded'=> 1,
	'showLines'=> 1,
	'fontSize' => 8,
	'lineCol' => array(0.48,0.48,0.48),
	'cols'=>array(
		'c1'=>array('justification'=>'left','width'=>80),			
			'c2'=>array('justification'=>'left','width'=>100),			
			'c3'=>array('justification'=>'left','width'=>60),			
			'c4'=>array('justification'=>'left','width'=>80),			
			'c5'=>array('justification'=>'left','width'=>100)							
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",1);




///////////////////////////////////////////////////

$res_pruebasservicio = mysql_query("SELECT convert(cast(convert(sector using latin1) as binary) using UTF8) AS sector,
convert(cast(convert(localcellid using latin1) as binary) using UTF8) AS localcellid,
convert(cast(convert(bandamhz using latin1) as binary) using UTF8) AS bandamhz,
convert(cast(convert(modelorbs using latin1) as binary) using UTF8) AS modelorbs,
convert(cast(convert(tipoantena using latin1) as binary) using UTF8) AS tipoantena,
convert(cast(convert(marcaantena using latin1) as binary) using UTF8) AS marcaantena,
convert(cast(convert(modeloantena using latin1) as binary) using UTF8) AS modeloantena,
convert(cast(convert(azimuth using latin1) as binary) using UTF8) AS azimuth,
convert(cast(convert(tiltmecanico using latin1) as binary) using UTF8) AS tiltmecanico,
convert(cast(convert(tiltelectrico using latin1) as binary) using UTF8) AS tiltelectrico,
convert(cast(convert(anguloapertura using latin1) as binary) using UTF8) AS anguloapertura,
convert(cast(convert(alturaantena using latin1) as binary) using UTF8) AS alturaantena,
convert(cast(convert(tieneret using latin1) as binary) using UTF8) AS tieneret,
convert(cast(convert(modelorru using latin1) as binary) using UTF8) AS modelorru from p013_relevamientosceldas,p013_formularioestaciones
WHERE p013_relevamientosceldas.idestacionentel=p013_formularioestaciones.idestacionentel
AND tecnologia='RED LTE' AND p013_relevamientosceldas.idevento=".$idevento." ORDER BY ORDEN");

//explotando los datos 
//while($datatmp = mysql_fetch_assoc($res_pruebasservicio)) { 
 
 //$data6[] = array_merge($datatmp); 
//}
$filas=mysql_num_rows($res_pruebasservicio);
if ($filas>0){
	//explotando los datos 
	while($datatmp = mysql_fetch_assoc($res_pruebasservicio)) {  
		$data6[] = array_merge($datatmp); 
 
	}

}else{

$data6 = array(
	array('sector'=>'1','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'2','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'3','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'4','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'5','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'6','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'7','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'8','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>''),
	array('sector'=>'9','c2'=>'','c3'=>'','c4'=>'','c5'=>'','c6'=>'','c7'=>'','c8'=>'','c9'=>'','c10'=>'','c11'=>'','c12'=>'','c13'=>'','c14'=>'')	
);
}
 

$titles = array(
'sector'=>'<b>Sector</b>',
'localcellid'=>'<b>Local Cell ID</b>',
'bandamhz'=>'<b>Banda MHz</b>',
'modelorbs'=>'<b>Modelo RBS </b>',
'tipoantena'=>'<b>Tipo de antena</b>',
'marcaantena'=>'<b>Marca antena</b>',
'modeloantena'=>'<b>Modelo antena</b>',
'azimuth'=>'<b>Azimuth</b>',
'tiltmecanico'=>'<b>Tilt Mecanico</b>',
'tiltelectrico'=>'<b>Tilt Electrico</b>',
'anguloapertura'=>'<b>Angulo de apertura</b>',
'alturaantena'=>'<b>Altura antena</b>',
'tieneret'=>'<b>Tiene Ret</b>',
'modelorru'=>'<b>Modelo RRU</b>'

);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>550,
'fontSize' => 6
);

$pdf->ezTable($data6, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////

/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>

