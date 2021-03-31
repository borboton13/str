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

$res_form = mysql_query("SELECT 
f.responsable,
f.fechamantenimiento,
convert(cast(convert(f.observaciones  using latin1) as binary) using UTF8) AS observaciones,
c.nombre AS nombrecentro,
est.nombre AS nombreestacion,
est.departamento,
est.provicia,
est.codigo

FROM p019_formulario f,evento e,centro c, estacion est
WHERE
f.idevento=e.idevento AND
e.idcentro=c.idcentro AND
e.idestacion=est.idestacion AND
f.idevento = ".$idevento);
$data_f = mysql_fetch_array($res_form);
////////////////////////////////////////////////////

$codEs=$data_f['codigo'];

$resultado=mysql_query("SELECT localidad FROM estacion,estacionentel
WHERE estacion.codigo=estacionentel.idsitio
AND estacion.codigo='$codEs'");

$datolocalidad = mysql_fetch_array($resultado);
$localidad=$datolocalidad["localidad"];

/////////////////////////////////////////////////////
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

$data=array(array('title'=>'<b> FORMULARIO DE MANTENIMIENTO PREVENTIVO SISTEMA DE TRANSMISION (MW, FO, SAT)</b>'));
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
$pdf->ezText(utf8_decode("<b>1. Identificación del Sitio </b>"),10);
$pdf->ezText("\n",4);
/** -------------------------------------------------------------------- **/

/** -------------------------------------------------------------------- **/
$pdf->ezText("CM/SCM",8);

$pdf->ezText("\n",4);
//$pdf->ezText("Centro o Subcentro:",10);
$pdf->ezText("\n",30);

$pdf->addText(157, 690, 8, $data_f['nombrecentro']);
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
$pdf->addText(157, 628, 8, $data_f['nombreestacion']);
$pdf->rectangle(155, 625,160,15);

$pdf->addText(320, 630, 9, "ID Sitio \n");
$pdf->addText(390, 628, 8, $data_f['codigo']);
$pdf->rectangle(388, 625,160,15);

/*Lineas rojas*/
//$pdf->setStrokeColor(1,hexdec('33')/255,hexdec('00')/255);
$pdf->setStrokeColor(0,0,0);
//$pdf->line(20,32,590,32);
$pdf->line(20,615,590,615);

$pdf->ezText(utf8_decode("<b>2. Relevamiento Información de Infraestructura  </b>"),10);
$pdf->ezText("\n",4);

////////////////////////////////////////////
///convert(cast(convert(observaciones  using latin1) as binary) using UTF8) AS observaciones ///
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 	{field:'numero',title:'No.',width:30},
					// {field:'idsitio',title:'ID_Sitio',width:70,editor:'text'},
					// {field:'nombreestacion',title:'Nombre Estacion',width:150,editor:'text'},
					// {field:'tipoestacion',title:'Tipo de Estacion',width:100,editor:'text'},
					// {field:'latitud',title:'Latitud',width:100,editor:'text'},
					// {field:'longitud',title:'Longitud',width:100,editor:'text'},
					// {field:'altura',title:'Altura',width:70,editor:'text'},
					// {field:'torres',title:'No. Torres',width:70,editor:'text'},
					// {field:'tipotorre',title:'Tipo de torre',width:110,editor:'text'},
					// {field:'alturatorre',title:'Altura Torre',width:100,editor:'text'},
					// {field:'gabinetes',title:'No. Gabinetes',width:100,editor:'text'},
					// {field:'tipogabinetes',title:'Tipo de gabinetes',width:200,editor:'text'},
					// {field:'idevento',title:'idevento',width:100,editor:'text', hidden:'true'},	

$res_p019_2 = mysql_query("SELECT * FROM p019_relevamientoinfraestructura where idevento=".$idevento." ORDER BY numero");

while($datatmp = mysql_fetch_assoc($res_p019_2)) { 
 
 $data2[] = array_merge($datatmp);
 				
} 
$titles = array(
'numero'=>'<b>No.</b>',
'idsitio'=>'<b>ID_Sitio</b>',
'nombreestacion'=>'<b>Nombre Estacion</b>',
'tipoestacion'=>'<b>Tipo de Estacion</b>',
'latitud'=>'<b>Latitud</b>',
'longitud'=>'<b>Longitud</b>',
'altura'=>'<b>Altura (m.s.n.m)</b>',
'torres'=>'<b>Torres</b>',
'tipotorre'=>'<b>Tipo de torre</b>',
'alturatorre'=>'<b>Altura Torre</b>',
'gabinetes'=>'<b>No. Gabinetes</b>',
'tipogabinetes'=>'<b>Tipo de gabinetes</b>'
);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);

$pdf->ezTable($data2, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);

///////////////////
$pdf->ezText("\n",4);
$pdf->ezText(utf8_decode("<b>3. Sistema de Transporte Microondas  </b>"),10);
$pdf->ezText("\n",4);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					// 	{field:'numero',title:'No.',width:30},
					// {field:'neorigen',title:'NE_Origen',width:70,editor:'text'},
					// {field:'nedestino',title:'NE_Destino',width:70,editor:'text'},
					// {field:'fabricante',title:'Fabricante',width:100,editor:'text'},
					// {field:'modelo',title:'Modelo',width:100,editor:'text'},
					// {field:'fretorigen',title:'Frecuencia Tx-Origen',width:140,editor:'text'},
					// {field:'fretdestino',title:'Frecuencia Tx-Destino',width:140,editor:'text'},
					// {field:'topologia',title:'Topologia Radio MW 1+1,1+0,2+0,XPIC, HTBY, SD',width:340,editor:'text'},
					// {field:'azimut',title:'Azimut',width:70,editor:'text'},
					// {field:'diametro',title:'Diametro',width:70,editor:'text'},
					// {field:'estado',title:'Estado',width:70,editor:'text'},															
					// {field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},
					// {field:'action',title:'Action',width:80,align:'center', 

$res_p019_3 = mysql_query("SELECT * FROM p019_transportemicroondas where idevento=".$idevento." ORDER BY numero");

while($datatmp = mysql_fetch_assoc($res_p019_3)) { 
 
 $data3[] = array_merge($datatmp);
 				
} 
$titles = array(
'numero'=>'<b>No.</b>',
'neorigen'=>'<b>NE_Origen</b>',
'nedestino'=>'<b>NE_Destino</b>',
'fabricante'=>'<b>fabricante</b>',
'modelo'=>'<b>Modelo</b>',
'fretxorigen'=>'<b>Frecuencia Tx-Origen</b>',
'fretxdestino'=>'<b>Frecuencia Tx-Destino</b>',
'topologia'=>'<b>Topologia Radio MW 1+1,1+0,2+0,XPIC, HTBY, SD</b>',
'azimut'=>'<b>Azimut</b>',
'diametro'=>'<b>Diametro</b>',
'estado'=>'<b>Estado</b>'
);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);

$pdf->ezTable($data3, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);
///////////////////////////////////////////////////////////////////////////////////
$pdf->ezText("\n",4);
$pdf->ezText(utf8_decode("<b>4. Sistema de Transporte Fibra Optica  </b>"),10);
$pdf->ezText("\n",4);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					// {field:'numero',title:'No.',width:30,editor:'text'},
					// {field:'mediotransporte',title:'Medio de Transporte',width:140,editor:'text'},
					// {field:'existe',title:'Existe',width:60,editor:'text'},
					// {field:'estadoequipo',title:'Estado del Equipo Tx',width:140,editor:'text'},
					// {field:'cantidadpuertosrbs',title:'Cantidad de puertos RBS',width:150,editor:'text'},
					// {field:'hilotx',title:'Etiqueta de puerto RBS-Hilo Tx From',width:215,editor:'text'},
					// {field:'hilorx',title:'Etiqueta de puerto RBS-Hilo Rx To',width:200,editor:'text'},
					// {field:'observaciones',title:'Observaciones',width:270,editor:'text'},
					// {field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},	

$res_p019_4 = mysql_query("SELECT * FROM p019_transportefibra where idevento=".$idevento." ORDER BY numero");

while($datatmp = mysql_fetch_assoc($res_p019_4)) { 
 
 $data4[] = array_merge($datatmp);
 				
} 
$titles = array(
'numero'=>'<b>No.</b>',
'mediotransporte'=>'<b>Medio de Transporte</b>',
'existe'=>'<b>Existe</b>',
'estadoequipo'=>'<b>Estado del Equipo Tx</b>',
'cantidadpuertosrbs'=>'<b>Cantidad de puertos RBS</b>',
'hilotx'=>'<b>Etiqueta de puerto RBS-Hilo Tx From</b>',
'hilorx'=>'<b>Etiqueta de puerto RBS-Hilo Rx To</b>',
'observaciones'=>'<b>Observaciones</b>'
);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);

$pdf->ezTable($data4, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);
///////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////
$pdf->ezText("\n",4);
$pdf->ezText(utf8_decode("<b>5. Sistema de Transporte Satelital  </b>"),10);
$pdf->ezText("\n",4);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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


$res_p019_5 = mysql_query("SELECT * FROM p019_transportesatelital where idevento=".$idevento." order by numero ");





while($datatmp = mysql_fetch_assoc($res_p019_5)) { 
 
 $data5[] = array_merge($datatmp);
 				
} 
$titles = array(
'numero'=>'<b>No.</b>',
'fabricante'=>'<b>Fabricante</b>',
'existe'=>'<b>Existe</b>',
'estado'=>'<b>Estado Tx</b>',
'modeloequipo'=>'<b>Modelo Equipo</b>',
'diametro'=>'<b>Diametro Antena</b>',
'potencia'=>'<b>Potencia BUC</b>',
'nivelrx'=>'<b>Nivel de Rx</b>',
'observaciones'=>'<b>Observaciones</b>'
);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);

$pdf->ezTable($data5, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);
///////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////
$pdf->ezText("\n",4);
$pdf->ezText(utf8_decode("<b>6.  Mantenimiento Preventivo  de Infraestructura  </b>"),10);
$pdf->ezText("\n",4);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					 //{field:'idmantenimientopreventivo',title:'',width:10,hidden:true},					
					// {field:'nombremantenimiento',title:'',width:750},								
					// {field:'estadoinicial',title:'Estado Inicial',width:300,editor:'text'},								
					// {field:'revisado',title:'Revisado',width:150,editor:'text'},	


$res_p019_6 = mysql_query("SELECT  
p019_mantenimientopreventivo.idmantenimientopreventivo,
p019_tmantenimientopreventivo.nombremantenimiento,
p019_mantenimientopreventivo.estadoinicial,
p019_mantenimientopreventivo.revisado
FROM p019_mantenimientopreventivo,p019_tmantenimientopreventivo  where idevento=".$idevento." and  
p019_mantenimientopreventivo.idmantenimientopreventivo=p019_tmantenimientopreventivo.idmantenimientopreventivo
ORDER BY p019_mantenimientopreventivo.idmantenimientopreventivo");


while($datatmp = mysql_fetch_assoc($res_p019_6)) { 
 
 $data6[] = array_merge($datatmp);
 				
} 
$titles = array(
'nombremantenimiento'=>'<b></b>',
'estadoinicial'=>'<b>Estado Inicial</b>',
'revisado'=>'<b>Revisado</b>'
);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);

$pdf->ezTable($data6, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);
///////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////
$pdf->ezText("\n",8);
$pdf->ezText(utf8_decode("<b>7. Disponibilidad de tarjetas  y equipos  TDM/ETH  (E1, FE, GE, ATN, SME, ME, ASR)  </b>"),10);
$pdf->ezText("\n",4);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					 // {field:'orden',title:'orden',width:10,hidden:true},
					// {field:'nombredistarjetasequipos',title:'Tarjeta',width:150},					
					// {field:'cantidad',title:'Cantidad',width:150,editor:'text'},													
					// {field:'puertosservicio',title:'Puertos en Servicio',width:300,editor:'text'},								
					// {field:'puertoslibres',title:'Puertos Libres',width:310,editor:'text'},								
					// {field:'iddisptarjetasequipos',title:'iddisptarjetasequipos',width:150,hidden:true},	


$res_p019_7 = mysql_query("SELECT  p019_tdisptarjetasequipos.orden,
p019_tdisptarjetasequipos.nombredistarjetasequipos,
p019_disptarjetasequipos.cantidad,
p019_disptarjetasequipos.puertosservicio,
p019_disptarjetasequipos.puertoslibres,
p019_disptarjetasequipos.iddisptarjetasequipos

from p019_disptarjetasequipos,p019_tdisptarjetasequipos
WHERE p019_disptarjetasequipos.iddisptarjetasequipos=p019_tdisptarjetasequipos.iddisptarjetasequipos
AND idevento=".$idevento."
ORDER BY p019_tdisptarjetasequipos.orden");


while($datatmp = mysql_fetch_assoc($res_p019_7)) { 
 
 $data7[] = array_merge($datatmp);
 				
} 
$titles = array(
'nombredistarjetasequipos'=>'<b>Tarjeta</b>',
'cantidad'=>'<b>Cantidad</b>',
'puertosservicio'=>'<b>Puertos en Servicio</b>',
'puertoslibres'=>'<b>Puertos Libres</b>'

);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);

$pdf->ezTable($data7, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);
///////////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////////
$pdf->ezText("\n",4);
$pdf->ezText(utf8_decode("<b>8. Relevamiento Servicio Móvil (RBS)  </b>"),10);
$pdf->ezText("\n",4);

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
					 // {field:'numero',title:'No.',width:30},					
					// {field:'tecnologia',title:'Tecnologia',width:370,editor:'text'},													
					// {field:'fabricante',title:'Fabricante',width:300,editor:'text'},								
					// {field:'modelo',title:'Modelo',width:300,editor:'text'},								
					// {field:'tipoacceso',title:'Tipo de Acceso',width:200,editor:'text'},								
					// {field:'idevento',title:'idevento',width:150,hidden:true},	


$res_p019_8 = mysql_query("SELECT * from p019_relevamientoserviciomovil where idevento=".$idevento." 
ORDER BY numero");


while($datatmp = mysql_fetch_assoc($res_p019_8)) { 
 
 $data8[] = array_merge($datatmp);
 				
} 
$titles = array(
'numero'=>'<b>No.</b>',
'tecnologia'=>'<b>Tecnologia</b>',
'fabricante'=>'<b>Fabricante</b>',
'modelo'=>'<b>Modelo</b>',
'tipoacceso'=>'<b>Tipo de Acceso</b>'

);
$options = array(
'shadeCol'=>array(0.9,0.9,0.9),
'xOrientation'=>'center',
'width'=>500,
'fontSize' => 6
);

$pdf->ezTable($data8, $titles, '', $options);
$pdf->ezText("\n\n\n", 1);
///////////////////////////////////////////////////////////////////////////////////
$pdf->ezText("\n",4);
$pdf->ezText(utf8_decode("<b>Acciones Pendientes, Preventivas, Recomendaciones, Anexo (reporte fotográfico):  </b>"),10);
$pdf->ezText("\n",1);

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
		'c1'=>array('justification'=>'left','width'=>510)								
	)
);
$pdf->ezTable($data, '','',$options);
$pdf->ezText("\n",4);


/** -------------------------------------------------------------------- **/

$pdf->ezStream();
?>

