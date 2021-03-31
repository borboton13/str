<?php
$id_st_cronograma_informes = base64_decode($_GET["id_st_cronograma_informes"]);
$pro_key="f001";

require("../funciones/motor.php");
require("../funciones/funciones.php");
include ('lib/class.ezpdf.php');
$fecha=date("d/m/Y");
$resultado=mysqli_query($conexion,"SELECT
id_st_proyecto,
id_item,
id_cliente,
id_usuario,
detalles,
periodo,
DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha,
hora_programada AS h_prog,
DATE_FORMAT(hora_llegada,'%d/%m/%Y\n%H:%i') AS hora_llegada,
DATE_FORMAT(hora_salida,'%d/%m/%Y\n%H:%i') AS hora_salida,
hora_salida AS fecha_carta,
obs,
conta,
DATE_FORMAT(p1,'%d/%m/%Y\n%H:%i') AS p1,
DATE_FORMAT(p2,'%d/%m/%Y\n%H:%i') AS p2,
p3,
p4,
p5,
p6,
p7,p71,
p8,
p9,nro_ticket,id_nodo,fecha_apertura,fecha_cierre,
para,
cc,
ref,
antecedentes,
trabajo_r,
conclusiones,
DATE_FORMAT(fecha_registro,'%d/%m/%Y\n%H:%i') AS fecha_registro,
fecha_registro AS fecha_label,
condicion_final,
postm_fecha,
postm_descripcion,
postm_condicion_final
FROM st_cronograma_informes_".$pro_key."  
WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."'");
$dato=mysqli_fetch_array($resultado);
 
$datox=mysqli_fetch_array(mysqli_query($conexion,"SELECT razon_social FROM clientes WHERE id='".$dato['id_cliente']."'"));
$cliente=$datox['razon_social'];
$datox=mysqli_fetch_array(mysqli_query($conexion,"SELECT concat(nombre, ' ', ap_pat) as usuario,cargo FROM usuarios WHERE id='".$dato['id_usuario']."'"));
$tecnico=$datox['usuario'];
$tecnico_cargo=$datox['cargo'];
$datox=mysqli_fetch_array(mysqli_query($conexion,"SELECT MAX(periodo) AS de FROM st_cronograma_informes_".$pro_key." WHERE id_item='".$dato['id_item']."'"));
$de=$datox['de'];
$datox=mysqli_fetch_array(mysqli_query($conexion,"SELECT descripcion FROM parametrica WHERE grupo='pie' AND sub_grupo='pie_pdf'"));
$pie=$datox['descripcion'];

$dato_t=mysqli_fetch_array(mysqli_query($conexion,"SELECT departamento,producto,marca,caracteristicas,ubicacion,sn FROM st_trabajos WHERE id_item='".$dato['id_item']."'"));

//$dato_f=mysqli_fetch_array(mysqli_query($conexion,"SELECT fecha_label('".$dato['fecha_carta']."','".$dato_t['departamento']."') AS fecha"));
//$fecha_label=$dato_f['fecha'];
$fecha_label = fecha_label($dato['fecha_carta'], $dato_t['departamento']);

$carpeta_id=$pro_key."_".$id_st_cronograma_informes;

$carpeta="archivos_st/".$dato['id_st_proyecto'];
$dir = "../".$carpeta."/".$carpeta_id."/";
 
$pdf = new Cezpdf('LETTER','portrait');
$pdf->selectFont('fonts/Helvetica.afm');
$pdf->ezSetCmMargins(1.5,2.5,2.5,2);

$ticket = $dato['nro_ticket'];
$resultado_tkt = mysqli_query($conexion,"SELECT ticket,idnodo,estacion,fecha_inicio_rif,hora_inicio_rif,fecha_fin_rif,hora_fin_rif FROM st_ticket where ticket='$ticket';");
$dato_tkt = mysqli_fetch_array($resultado_tkt);
			
////informacion de la pagina
$datacreator = array (
                    'Title'=>'SISTEMA DE SEGUIMIENTO TECNICO',
                    'Author'=>'Ariel Siles Encinas',
                    'Subject'=>'ARCHIVO PDF DIMESAT',
                    'Creator'=>'ariel.siles@gmail.com',
                    'Producer'=>'http://facebook.com/'
                    );
$pdf->addInfo($datacreator);

$all = $pdf->openObject();
$pdf->saveState();
$pdf->ezStartPageNumbers(537,35,10,'right','Pag. {PAGENUM} de {TOTALPAGENUM}');
$pdf->setStrokeColor(1,hexdec ('33')/255,hexdec('00')/255);
$pdf->line(20,32,590,32);
$pdf->addTextWrap(12,20,580,9,$pie,'center');
$pdf->restoreState();
$pdf->closeObject();
$pdf->addObject($all,'all');
$pdf->ezText("\n",14);
   /** $pdf->ezImage('../img/logo_pdf.jpg',-28,'','','left',array('width'=>1)); **/
$pdf->rectangle(192,742,390,18);
$pdf->addText(260,746,12,'<b><i>GERENCIA DEPARTAMENTO TECNICO</i></b>');
$pdf->rectangle(192,696,250,46);
$pdf->addText(220,716,14,'<b>MANTENIMIENTO CORRECTIVO</b>');
$pdf->rectangle(442,696,140,46);

/** $pdf->addPngFromFile($dir."barcode.png",443,699,138); **/
$pdf->addText(468,698,10,'INF: <b>'.strtoupper($pro_key).str_pad($id_st_cronograma_informes, 4, "0", STR_PAD_LEFT).'</b>');

$pdf->ezText($fecha_label,12,array('justification' =>'right'));
//$pdf->ezText('CLIENTE: '.$cliente,14);
$pdf->ezText("\n",12);
$data = array(
array('izq'=>'Para: ','der'=>'<b>'.$dato['para'].'</b>'),
array('izq'=>'CC: ','der'=>'<b>'.$dato['cc'].'</b>'),
array('izq'=>'De: ','der'=>'<b>'.$tecnico.'
'.$tecnico_cargo.'</b>')
);

$options = array('xPos'=>'right',
                'xOrientation'=>'left',
				'showHeadings'=>0,
				'width'=>480,
				'colGap' => 5,				
				'shaded'=> 0,
				'showLines'=> 0,
				'fontSize' => 12,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>40),
				'der'=>array('justification'=>'left','width'=>440)
				)
            );
$pdf->ezTable($data, '','',$options);

$pdf->ezText("\n",12);
$pdf->ezText('REF. : <b>'.$dato['ref'].'</b>',12,array('justification' =>'right'));
$pdf->ezText("\n",12);

$pdf->ezText("<b>1. ANTECEDENTES</b>",12);
$pdf->ezText($dato['antecedentes'],11,array('justification' =>'full'));
$pdf->ezText("\n",12);
$pdf->ezText("<b>2. TRABAJO REALIZADO</b>",12);
$pdf->ezText($dato['trabajo_r'],11,array('justification' =>'full'));
$pdf->ezText("\n",12);
$pdf->ezText("<b>3. MATERIAL Y HERRAMIENTAS UTILIZADOS</b>",12);
$pdf->ezText($dato['p9'],11,array('justification' =>'full'));
$pdf->ezText("\n",12);
$pdf->ezText("<b>4. CONCLUSIONES</b>",12);
$pdf->ezText($dato['conclusiones'],11,array('justification' =>'full'));
$pdf->ezText("\n",12);
$pdf->ezText("<b>5. PERSONAL TECNICO</b>",12);
$pdf->ezText($dato['p4'],11,array('justification' =>'full'));

$pdf->ezNewPage();
$pdf->ezSetCmMargins(1.5,2.5,1.5,1);
//////encabezado
/** $pdf->ezImage('../img/logo_pdf.jpg',0,'','','left',array('width'=>1)); **/
$pdf->rectangle(192,744,390,18);
$pdf->addText(260,748,12,'<b><i>GERENCIA DEPARTAMENTO TECNICO</i></b>');
$pdf->rectangle(192,698,250,46);
$pdf->addText(220,718,14,'<b>MANTENIMIENTO CORRECTIVO</b>');
$pdf->rectangle(442,698,140,46);
/** $pdf->addPngFromFile($dir."barcode.png",443,701,138); **/
$pdf->addText(468,700,10,'INF: <b>'.strtoupper($pro_key).str_pad($id_st_cronograma_informes, 6, "0", STR_PAD_LEFT).'</b>');

///detales del proyecto
$data = array(
array('izq'=>'Proyecto Nro: <b>'.$dato['id_st_proyecto'].'</b>','der'=>'CONTA-'.$dato['conta'].' <b>FORM001</b>')
,array('izq'=>'Cliente: <b>'.$cliente.'</b>','der'=>'Intervencion Nro <b>'.$dato['periodo'].' de '.$de.' </b> ')
);

$options = array('xPos'=>'right',
                'xOrientation'=>'left',
				'showHeadings'=>0,
				'width'=>540,
				'colGap' => 5,				
				'shaded'=> 2,
				'showLines'=> 2,
				'fontSize' => 9,
				'lineCol' => array(0.48,0.48,0.48),
				'shadeCol' => array(0.95,0.95,0.95),
				'shadeCol2' => array(0.95,0.95,0.95),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>270),
				'der'=>array('justification'=>'right','width'=>270)
				)
            );
$pdf->ezTable($data, '','',$options);

//////////////// DATOS DEL SERVICIO
$pdf->ezText("\n",5);
$data=array(array('izq'=>'<b>DATOS DEL SERVICIO</b>'));
$pdf->ezTable($data,'','',
array('xPos'=>'right',
'xOrientation'=>'left',
                'showHeadings'=>0,                
                'width'=>540,
				'colGap' => 5,
				'shaded'=> 2,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'shadeCol2' => array(0.80,0.80,0.80),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>540))
				));
$data = array(
array('izq'=>'Razon de la visita: <b>'.$dato['detalles'].'</b>','der'=>'Fecha Actual: <b>'.$fecha.'</b>')
,array('izq'=>'Estacion: <b>'.$dato_t['ubicacion'].'</b>','der'=>'Centro de Mantenimiento: <b>'.$dato_t['departamento'].'</b>')
);

$options = array('xPos'=>'right',
                'xOrientation'=>'left',
				'showHeadings'=>0,
				'width'=>540,
				'colGap' => 5,				
				'shaded'=> 0,
				'showLines'=> 2,
				'fontSize' => 9,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>270),
				'der'=>array('justification'=>'left','width'=>270)
				)
            );
$pdf->ezTable($data, '','',$options);

////RIF

$pdf->ezText("\n",3);

$data=array(array('izq'=>'<b>RIF</b>'));
$pdf->ezTable($data,'','',
array('xPos'=>'right',
'xOrientation'=>'left',
                'showHeadings'=>0,                
                'width'=>540,
				'colGap' => 5,
				'shaded'=> 2,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'shadeCol2' => array(0.80,0.80,0.80),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>540))
				));
$data = array(
array('izq'=>'<b>Ticket:</b>','der'=> $dato_tkt['ticket'].'  |  NOD:'.$dato_tkt['idnodo'])
,array('izq'=>'<b>Apertura:</b>','der'=> $dato_tkt['fecha_inicio_rif'].' - '.$dato_tkt['hora_inicio_rif'])
,array('izq'=>'<b>Cierre:</b>','der'=> $dato_tkt['fecha_fin_rif'].' - '.$dato_tkt['hora_fin_rif'])
);

$options = array('xPos'=>'right',
                'xOrientation'=>'left',
				'showHeadings'=>0,
				'width'=>540,
				'colGap' => 5,				
				'shaded'=> 0,
				'showLines'=> 2,
				'fontSize' => 9,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>140),
				'der'=>array('justification'=>'left','width'=>400)
				)
            );
$pdf->ezTable($data, '','',$options);

////programacion
$pdf->ezText("\n",3);
$data=array(array('0'=>'<b>NOTIFICACION</b>','1'=>'<b>INICIO VIAJE</b>','2'=>'<b>INGRESO AL SITIO</b>','3'=>'<b>CONCLUSION TRABAJO</b>'));
$pdf->ezTable($data,'','',
array('xPos'=>'right',
				'xOrientation'=>'left',
                'showHeadings'=>0,                
                'width'=>540,
				'colGap' => 5,
				'shaded'=> 2,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'shadeCol2' => array(0.80,0.80,0.80),
				'cols'=>array(
				'0'=>array('justification'=>'center','width'=>135),
				'1'=>array('justification'=>'center','width'=>135),
				'2'=>array('justification'=>'center','width'=>135),
				'3'=>array('justification'=>'center','width'=>135))
				));
			
$data = array(array('0'=>$dato['p1'],'1'=>$dato['p2'],'2'=>$dato['hora_llegada'],'3'=>$dato['hora_salida']));
$pdf->ezTable($data,'','',
array('xPos'=>'right',
                'xOrientation'=>'left',                
                'width'=>540,
				'showHeadings'=>0,
				'colGap' => 5,
				'shaded'=> 0,
				'showLines'=> 1,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'0'=>array('justification'=>'center','width'=>135),
				'1'=>array('justification'=>'center','width'=>135),
				'2'=>array('justification'=>'center','width'=>135),
				'3'=>array('justification'=>'center','width'=>135))
				));
////programacion
$pdf->ezText("\n",3);

$data=array(array('izq'=>'<b>PROGRAMACION</b>'));
$pdf->ezTable($data,'','',
array('xPos'=>'right',
'xOrientation'=>'left',
                'showHeadings'=>0,                
                'width'=>540,
				'colGap' => 5,
				'shaded'=> 2,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'shadeCol2' => array(0.80,0.80,0.80),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>540))
				));
$data = array(
array('izq'=>'Tecnico a Cargo:','der'=>'<b>'.$tecnico.'</b>')
,array('izq'=>'Fecha Programada:','der'=>'<b>'.$dato['fecha'].' '.$dato['h_prog'].'</b>')
);

$options = array('xPos'=>'right',
                'xOrientation'=>'left',
				'showHeadings'=>0,
				'width'=>540,
				'colGap' => 5,				
				'shaded'=> 0,
				'showLines'=> 2,
				'fontSize' => 9,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>140),
				'der'=>array('justification'=>'left','width'=>400)
				)
            );
$pdf->ezTable($data, '','',$options);				

//////////////// DATOS DEL INFORME
/////////// 2:primera fila
$pdf->ezText("\n",3);
$data=array(array('izq'=>'<b>Personal de turno del Cliente</b>','der'=>'<b>Personal Contratista de turno</b>'));
$pdf->ezTable($data,'','',
array('xPos'=>'right',
'xOrientation'=>'left',
                'showHeadings'=>0,                
                'width'=>540,
				'colGap' => 5,
				'shaded'=> 2,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'shadeCol2' => array(0.80,0.80,0.80),
				'cols'=>array(
				'izq'=>array('justification'=>'center','width'=>270),
				'der'=>array('justification'=>'center','width'=>270))
				));
$data = array(
array('izq'=>$dato['p3'],'der'=>$dato['p4'])
);
$pdf->ezTable($data,'','',
array('xPos'=>'right',
                'xOrientation'=>'left',                
                'width'=>540,
				'showHeadings'=>0,
				'colGap' => 5,
				'shaded'=> 0,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'der'=>array('justification'=>'left','width'=>270),
				'izq'=>array('justification'=>'left','width'=>270))
				));
///////////// 3:primera fila
$pdf->ezText("\n",3);

$p5_1_="";
$p5_2_="";
$p5_3_="";
$p5_4_="";
$p5_5_="";
$p5_1="TRANSMISION"; 
$p5_2="ENERGIA";
$p5_3="RBS";
$p5_4="BTS";
$p5_5="INFRAESTRUCTURA";
switch($dato['p5']){
case 'TRANSMISION': $p5_1="<b>".$p5_1."</b>"; $p5_1_="<b>X</b>"; break;
case 'ENERGIA': $p5_2="<b>".$p5_2."</b>"; $p5_2_="<b>X</b>"; break;
case 'RBS': $p5_3="<b>".$p5_3."</b>"; $p5_3_="<b>X</b>"; break;
case 'BTS': $p5_4="<b>".$p5_4."</b>"; $p5_4_="<b>X</b>"; break;
case 'INFRAESTRUCTURA': $p5_5="<b>".$p5_5."</b>"; $p5_5_="<b>X</b>"; break;
}

$p6_1_="";
$p6_2_="";
$p6_3_="";
$p6_4_="";
$p6_1="CORTE DE TRAFICO";
$p6_2="CORTE INTERMITENTE";
$p6_3="PELIGRO DE CORTE";
$p6_4="OTROS";
switch($dato['p6']){
case 'CORTE DE TRAFICO': $p6_1="<b>".$p6_1."</b>"; $p6_1_="<b>X</b>"; break;
case 'CORTE INTERMITENTE': $p6_2="<b>".$p6_2."</b>"; $p6_2_="<b>X</b>"; break;
case 'PELIGRO DE CORTE': $p6_3="<b>".$p6_3."</b>"; $p6_3_="<b>X</b>"; break;
}
if(substr($dato['p6'],0,5)=="OTROS") { $p6_4="<b>".$dato['p6']."</b>"; $p6_4_="<b>X</b>"; }

$data=array(array('izq'=>'<b>TIPO DE EMERGENCIA</b>','der'=>'<b>SERVICIO AFECTADO</b>'));
$pdf->ezTable($data,'','',
array('xPos'=>'right',
'xOrientation'=>'left',
                'showHeadings'=>0,                
                'width'=>540,
				'colGap' => 5,
				'shaded'=> 2,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'shadeCol2' => array(0.80,0.80,0.80),
				'cols'=>array(
				'izq'=>array('justification'=>'center','width'=>270),
				'der'=>array('justification'=>'center','width'=>270))
				));

$data = array(
array('izq'=>$p5_1,'izq_'=>$p5_1_,'der'=>$p6_1,'der_'=>$p6_1_),
array('izq'=>$p5_2,'izq_'=>$p5_2_,'der'=>$p6_2,'der_'=>$p6_2_),
array('izq'=>$p5_3,'izq_'=>$p5_3_,'der'=>$p6_3,'der_'=>$p6_3_),
array('izq'=>$p5_4,'izq_'=>$p5_4_,'der'=>$p6_4,'der_'=>$p6_4_),
array('izq'=>$p5_5,'izq_'=>$p5_5_,'der'=>"",'der_'=>"")
);
$pdf->ezTable($data,'','',
array('xPos'=>'right',
                'xOrientation'=>'left',                
                'width'=>540,
				'showHeadings'=>0,
				'colGap' => 5,
				'shaded'=> 0,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'der'=>array('justification'=>'right','width'=>250),
				'izq_'=>array('justification'=>'center','width'=>20),
				'izq'=>array('justification'=>'right','width'=>250),
				'der_'=>array('justification'=>'center','width'=>20))
				));
/////////// 4:primera fila
$pdf->ezText("\n",5);
$data=array(array('izq'=>'<b>DESCRIPCION DE LA FALLA</b>'));
$pdf->ezTable($data,'','',
array('xPos'=>'right',
'xOrientation'=>'left',
                'showHeadings'=>0,                
                'width'=>540,
				'colGap' => 5,
				'shaded'=> 2,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'shadeCol2' => array(0.80,0.80,0.80),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>540))
				));
$data = array(
array('izq'=>$dato['p7'])
);
$pdf->ezTable($data,'','',
array('xPos'=>'right',
                'xOrientation'=>'left',                
                'width'=>540,
				'showHeadings'=>0,
				'colGap' => 5,
				'shaded'=> 0,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>540))
				));	
				
				
/////////// 71:primera fila
/*
$pdf->ezText("\n",5);
$data=array(array('izq'=>'<b>DA�OS Y PARTES AFECTADAS EN LA ESTACI�N</b>'));
$pdf->ezTable($data,'','',
array('xPos'=>'right',
'xOrientation'=>'left',
                'showHeadings'=>0,                
                'width'=>540,
				'colGap' => 5,
				'shaded'=> 2,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'shadeCol2' => array(0.80,0.80,0.80),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>540))
				));
$data = array(
array('izq'=>$dato['p71'])
);
$pdf->ezTable($data,'','',
array('xPos'=>'right',
                'xOrientation'=>'left',                
                'width'=>540,
				'showHeadings'=>0,
				'colGap' => 5,
				'shaded'=> 0,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>540))
				));	

*/
/////////// P8
$pdf->ezText("\n",5);
$data=array(array('izq'=>'<b>DESCRIPCION DE LA INTERVENCION</b>'));
$pdf->ezTable($data,'','',
array('xPos'=>'right',
'xOrientation'=>'left',
                'showHeadings'=>0,                
                'width'=>540,
				'colGap' => 5,
				'shaded'=> 2,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'shadeCol2' => array(0.80,0.80,0.80),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>540))
				));
$data = array(
array('izq'=>$dato['p8'])
);
$pdf->ezTable($data,'','',
array('xPos'=>'right',
                'xOrientation'=>'left',                
                'width'=>540,
				'showHeadings'=>0,
				'colGap' => 5,
				'shaded'=> 0,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>540))
				));	

/////////// P9
$pdf->ezText("\n",5);
$data=array(array('izq'=>'<b>REPUESTOS E INSUMOS UTILIZADOS</b>'));
$pdf->ezTable($data,'','',
array('xPos'=>'right',
'xOrientation'=>'left',
                'showHeadings'=>0,                
                'width'=>540,
				'colGap' => 5,
				'shaded'=> 2,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'shadeCol2' => array(0.80,0.80,0.80),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>540))
				));
$data = array(
array('izq'=>$dato['p9'])
);
$pdf->ezTable($data,'','',
array('xPos'=>'right',
                'xOrientation'=>'left',                
                'width'=>540,
				'showHeadings'=>0,
				'colGap' => 5,
				'shaded'=> 0,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>540))
				));	
								
/////////// 5:primera fila
/*
$pdf->ezText("\n",5);
$data = array(array('izq'=>$dato['p8'],'der'=>$dato['p9'])
);
$pdf->ezTable($data,array('izq'=>'<b>DESCRIPCION DE LA SOLUCION</b>','der'=>'<b>REPUESTOS E INSUMOS UTILIZADOS</b>'),'',
array('xPos'=>'right',
                'xOrientation'=>'left',                
                'width'=>540,
				'showHeadings'=>1,
				'colGap' => 5,
				'shaded'=> 0,
				'shadeCol2' => array(0.48,0.48,0.48),
				'shadeCol' => array(0.80,0.80,0.80),
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'der'=>array('justification'=>'left','width'=>270),
				'izq'=>array('justification'=>'left','width'=>270))
				));
*/				
/////////// 6:primera fila
$pdf->ezText("\n",5);
$data = array(
array('izq'=>$dato['obs'])
);
$pdf->ezTable($data,array('izq'=>'<b>OBSERVACIONES</b>'),'',
array('xPos'=>'right',
                'xOrientation'=>'left',
                'maxWidth'=>540,
				'showHeadings'=>1,
				'colGap' => 5,
				'shaded'=> 0,
				'showLines'=> 2,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array('izq'=>array('justification'=>'left','width'=>540))));	

////////								
$pdf->ezText("\n CONDICION FINAL: ".$dato['condicion_final'],18);

if($dato['postm_condicion_final']!="")
{
//////////////// 
$pdf->ezText("\n",10);
$data = array(
array('izq'=>'<b>Fecha de POST-MANTENIMIENTO:</b>','der'=>$dato['postm_fecha'])
,array('izq'=>'<b>Resument Textual del Trabajo Realizado:</b>','der'=>$dato['postm_descripcion'])
);

$options = array('xPos'=>'right',
                'xOrientation'=>'left',
				'showHeadings'=>0,
				'titleFontSize' => 16, 
				'width'=>540,
				'colGap' => 5,				
				'shaded'=> 0,
				'showLines'=> 2,
				'fontSize' => 10,
				'lineCol' => array(0.48,0.48,0.48),
				'cols'=>array(
				'izq'=>array('justification'=>'left','width'=>200),
				'der'=>array('justification'=>'left','width'=>340)
				)
            );
$pdf->ezTable($data, '','TRABAJO POST-MANTENIMIENTO',$options);

$pdf->ezText("\n CONDICION FINAL POST-MANTENIMIENTO: ".$dato['postm_condicion_final'],18);
}

//////////////// 
$pdf->line(67,55,200,55);
$pdf->addText(97,45,9,'POR CLIENTE');

$pdf->line(370,55,500,55);
$pdf->addText(400,45,9,'POR DIMESAT');
///////////
	$resultado=mysqli_query($conexion,"SELECT titulo,imagen FROM st_cronograma_informes_".$pro_key."_archivos WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."' ORDER BY item ASC");
	$filas=mysqli_num_rows($resultado);
	if($filas!=0)
	{ $j=0;
	
$pdf->ezNewPage();
$pdf->ezSetCmMargins(1,1,1,1);
$pdf->ezText('<b>REPORTE FOTOGRAFICO</b>',14,array('justification' =>'center'));
$pdf->ezText("\n",10);

	while($dato_arch=mysqli_fetch_array($resultado))
	{
	$nombre=$dato_arch['imagen'];
	$titulo=$dato_arch['titulo'];
	$ext=substr(strrchr($nombre, '.'), 1);
		if($ext=="jpg" || $ext=="jpeg"){
		$pdf->ezImage($dir.$nombre,5,250,'','center',array('width'=>1));
		$pdf->ezText($titulo,10,array('justification' =>'center'));
		$pdf->ezText("\n",10);
		}
	 }
	}
//////////////// 

$pdf->ezStream();
?>