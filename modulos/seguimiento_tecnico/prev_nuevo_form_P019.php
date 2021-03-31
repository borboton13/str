<HTML>
<HEAD>
<TITLE> Título de la página </TITLE>



    

    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	<script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>


	<STYLE type="text/css">
		#container {
  margin: 20px;
  width: 400px;
  height: 8px;
  position: relative;
}

 .datagrid-cell{
        font-size: 11px;
    }

  
.datagrid-header .datagrid-cell span{
    font-weight: bold;
    /*color: blue;*/
    font-size:10px;
}	

</STYLE>
</HEAD>
<BODY>
<?  

$web=$_SESSION["web"];

if (isset($_GET['idevento']))   $idevento     = $_GET['idevento'];
if (isset($_GET['idform']))     $idformulario = $_GET['idform'];
if (isset($_GET['nombreForm'])) $nombreForm   = $_GET['nombreForm'];

$resultado = mysql_query("SELECT * FROM p019_formulario WHERE idevento = '$idevento' ");
$totalFilas    =    mysql_num_rows($resultado);  


$resultado = mysql_query("
SELECT ev.idevento, ev.estado, ev.inicio, ev.fin, es.codigo as codigoest, es.nombre as nombreest,es.departamento as departamento,es.provicia as provincia, g.codigo AS codigog, c.idcentro, c.codigo as codCentro,c.nombre as nombrecentro FROM evento ev
JOIN estacion es ON ev.idestacion = es.idestacion
JOIN grupo g 	 ON ev.idgrupo = g.idgrupo
JOIN centro c    ON ev.idcentro = c.idcentro
WHERE ev.idevento = '$idevento' ");
$dato = mysql_fetch_array($resultado);

$arr = explode('-', $dato['inicio']);

$anio			= $arr[0];
$codCentro 		= $dato['codCentro'];
$nombrecentro 	= $dato['nombrecentro'];
$codCentro 		= $dato['codCentro'];
$ini			= $dato['inicio'];
$fin			= $dato['fin'];
$idev 			= $idevento;
$codEs			= $dato['codigoest'];
$nomEs 			= $dato['nombreest'];
$departamento 	= $dato['departamento'];
$provincia 		= $dato['provincia'];

$params = "&anio=$anio&codCentro=$codCentro&ini=$ini&fin=$fin&idev=$idev&codEs=$codEs&nomEs=$nomEs&idevento=$idevento&idform=$idformulario&nombreForm=$nombreForm";

$resultado=mysql_query("SELECT localidad FROM estacion,estacionentel
WHERE estacion.codigo=estacionentel.idsitio
AND estacion.codigo='$codEs'");

$datolocalidad = mysql_fetch_array($resultado);
$localidad=$datolocalidad["localidad"];


if ($totalFilas!=0){
	$href = "$link_modulo?path=prev_editar_form_P019.php&$params";
	?>
		<script type="text/javascript">
	        window.open('<?=$href?>', '_top');
		</script> 
	<?
}
require("../../funciones/funciones.php");
require("../../funciones/Db.class.php");
	$op1 = array("...", "2G", "2G-4G", "2G-4G-LTE","4G-LTE", "LTE");
	$op2 = array("...", "E1", "ELECTRICO", "OPTICO");
	$op3TA = array("...", "E1", "ELECTRICO", "OPTICO");
	$opRB2 = array("...", "SECTORIAL","OMNIDIRECCIONAL");
	$opRB3 = array("...", "1","2","3","4");
	$opRB4 = array("...", "GSM 850");
	$opRB5 = array("...", "UMTS 850");
	$opRB6 = array("...", "LTE 700");
	$opRB7 = array("...", "LTE 1900");
	$opRB10 = array("...", "SI","NO");
	$opRB14 = array("...", "GSM 1900");
	$opRB15 = array("...", "UMTS 1900");
	$opRB16 = array("...", "LTE AWS");
	$opOKNOK = array("...", "OK","NOK");
	$opXNA = array("...", "X","NA");
	$opSINONA = array("...", "SI", "NO","NA");	
	$opFNFNENA = array("...", "FUNCIONA", "NO FUNCIONA","EXISTE","NO EXISTE","NA");			

//echo($link_modulo_r);
?>
<!--<form name="amper" method="post" action="<?=$link_modulo_r____?>" onSubmit=" return VerifyOne ();">-->
	<form name="amper"   onSubmit=" return VerifyOne ();">

	<input type="hidden" name="path" value="__prev_nuevo_form_P013n_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" id="idevento"/>
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
	<input type="hidden" name="nomEs" value="<?=$nomEs?>" />
<br />
<TABLE width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIMIENTO PREVENTIVO - SISTEMA DE TRANSMISION (MW,FO, SAT)</caption>	
	<TR>
		<TH >
				IDENTIFICACION DEL SITIO
		</TH>
	</TR>
	

</TABLE>

<TABLE width="900" align="center" class="table2">
	
	<TR>
		<TD>
			CM/SCM:
		</TD>
		<TD>
			<input name="nombrecentro" type="text" id="nombrecentro" size="30" value="<?ECHO($nombrecentro);?>" />
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			Departamento:
		</TD>				
			
		<TD>
			<input name="departamento" type="text" id="departamento" size="30" value="<? ECHO($departamento);?>" />
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			Nomb. Responsable:
		</TD>
		<TD>
			<input name="responsable" type="text" id="responsable" size="30" value="" />
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			Provincia:
		</TD>				
			
		<TD>
			<input name="provincia" type="text" id="provincia" size="30" value="<? ECHO($provincia);?>" />
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			Fecha de mantenimiento:
		</TD>
		<TD>
			<input name="fechamantenimiento" type="text" id="fechamantenimiento" size="10" class="Text_left" value="" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)" readonly="yes"/>
            <img onclick="displayCalendar(document.amper.fechamantenimiento,'yyyy-mm-dd',this,false)" src="../../img/cal.gif" alt="Seleccionar fecha" width="16" height="16">		
			
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			Localidad:
		</TD>				
			
		<TD>					
			
			<input name="localidad" type="text" id="localidad" size="30" value="<? ECHO($localidad);?>" />
		</TD>				
		
	</TR>
	<TR>
		<TD>
			Property_id:
		</TD>
		<TD>
			<input name="nomES" type="text" id="nomEs" size="30" value="<? ECHO($nomEs);?>" />
			
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			ID Sitio:
		</TD>				
			
		<TD>
			<input name="localidad" type="text" id="localidad" size="30" value="<? echo($codEs); ?>" />
		</TD>				
		
	</TR>				
		

</TABLE>
	

<br />



<br />
<TABLE width="1290" align="left" class="table2">
	<caption>2. Relevamiento informacion de infraestructura</caption>
	
	
</TABLE>
<table id="p019_2" ></table>
	<br>
<TABLE width="1290" align="left" class="table2">
	<caption>3. Sistema de Transporte Microondas </caption>
	
	
</TABLE>
<table id="p019_3"></table>
	<br>

<TABLE width="1290" align="left" class="table2">
	<caption>4. Sistema de Transporte Fibra Optica</caption>		
</TABLE>
<table id="p019_4"></table>	

<br />

<TABLE width="1290" align="left" class="table2">
	<caption>5. Sistema de Transporte Satelital</caption>		
</TABLE>
<table id="p019_5"></table>
	<br>
	
<TABLE width="1290" align="left" class="table2">
	<caption>6. Mantenimiento Preventivo de Infraestructura</caption>		
</TABLE>
<table id="p019_6"></table>
<br>

<TABLE width="1000" align="left" class="table2">
	<caption>7. Disponibilidad de tarjetas  y equipos  TDM/ETH  (E1, FE, GE, ATN, SME, ME, ASR)</caption>		
</TABLE>
<table id="p019_7"></table>

<table id="p019_6"></table>
<br>

<TABLE width="1290" align="left" class="table2">
	<caption>8. Relevamiento Servicio Movil (RBS)</caption>		
</TABLE>
<table id="p019_8"></table>

<br>
<TABLE width="1290" align="left" class="table2">
	<caption>Acciones Pendientes, Preventivas, Recomendaciones, Anexo (reporte fotografico):</caption>		

	<td colspan="2" align="center">
	<textarea name="observaciones" class="resizable" style="width: 1290px; height: 80px;" id="observaciones"></textarea>
</td>
</TABLE>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<table width="150" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
		<td>
			
			<input type="button" id="boton" value="Guardar"/>

			<input type="button" name="Submit" value="<< Atras" onclick="javascript:history.back(1)" />

		</td>
	</tr>
</table>

</form>

<div id="container"></div>
<div id="select2lista"></div>
<span id="res"></span>


	
	<script>	

			
		
		$(function(){

		



			////////////////////////////////////		
				$('#p019_2').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:230,
				singleSelect:true,
				idField:'idverificacionfisica',				
				nowrap:false,
				url:'data/datagrid_p019_2.json',				
				//{"numero":"1","idsitio":"","nombreestacion":"","tipoestacion":"","latitud":"","longitud":"","altura":"","torres":"","tipotorre":"","gabinetes":"","tipogabinetes":"","idevento":""},	
				columns:[[			
					{field:'numero',title:'No.',width:30},
					{field:'idsitio',title:'ID_Sitio',width:70,editor:'text'},
					{field:'nombreestacion',title:'Nombre Estacion',width:150,editor:'text'},
					{field:'tipoestacion',title:'Tipo de Estacion',width:100,editor:'text'},
					{field:'latitud',title:'Latitud',width:100,editor:'text'},
					{field:'longitud',title:'Longitud',width:100,editor:'text'},
					{field:'altura',title:'Altura',width:70,editor:'text'},
					{field:'torres',title:'No. Torres',width:70,editor:'text'},
					{field:'tipotorre',title:'Tipo de torre',width:110,editor:'text'},
					{field:'alturatorre',title:'Altura Torre',width:100,editor:'text'},
					{field:'gabinetes',title:'No. Gabinetes',width:100,editor:'text'},
					{field:'tipogabinetes',title:'Tipo de gabinetes',width:200,editor:'text'},
					{field:'idevento',title:'idevento',width:100,editor:'text', hidden:'true'},															
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverow2(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrow2(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrow2(this)">Edit</a> ';
								
								return e;
							}
						}
					}
				]],
				onEndEdit:function(index,row){
					
					$(this).datagrid('getEditor', index);
				},
				onBeforeEdit:function(index,row){
					row.editing = true;
					$(this).datagrid('refreshRow', index);
				},
				onAfterEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				},
				onCancelEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				}
			});
				////////////////////////////////
						
				$('#p019_3').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:230,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'data/datagrid_p019_3.json',
				//{"numero":"1","neorigen":"","nedestino":"","fabricante":"","modelo":"","fretorigen":"","fretdestino":"","topologia":"","azimut":"","diametro":"","estado":"","idevento":""},				
				columns:[[					
					{field:'numero',title:'No.',width:30},
					{field:'neorigen',title:'NE_Origen',width:70,editor:'text'},
					{field:'nedestino',title:'NE_Destino',width:70,editor:'text'},
					{field:'fabricante',title:'Fabricante',width:100,editor:'text'},
					{field:'modelo',title:'Modelo',width:100,editor:'text'},
					{field:'fretxorigen',title:'Frecuencia Tx-Origen',width:140,editor:'text'},
					{field:'fretxdestino',title:'Frecuencia Tx-Destino',width:140,editor:'text'},
					{field:'topologia',title:'Topologia Radio MW 1+1,1+0,2+0,XPIC, HTBY, SD',width:340,editor:'text'},
					{field:'azimut',title:'Azimut',width:70,editor:'text'},
					{field:'diametro',title:'Diametro',width:70,editor:'text'},
					{field:'estado',title:'Estado',width:70,editor:'text'},															
					{field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverow3(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrow3(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrow3(this)">Edit</a> ';
								
								return e;
							}
						}
					}
				]],
				onEndEdit:function(index,row){
					
					$(this).datagrid('getEditor', index);
				},
				onBeforeEdit:function(index,row){
					row.editing = true;
					$(this).datagrid('refreshRow', index);
				},
				onAfterEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				},
				onCancelEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				}
			});
				//////////////////////////
				$('#p019_4').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:230,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'data/datagrid_p019_4.json',
				//{"numero":"1","mediotransporte":"","existe":"","estadoequipo":"","cantidadpuertosrbs":"","hilotx":"","hilorx":"","observaciones":"","idevento":""},	
				columns:[[					
					{field:'numero',title:'No.',width:30},
					{field:'mediotransporte',title:'Medio de Transporte',width:140,editor:'text'},
					{field:'existe',title:'Existe',width:60,editor:'text'},
					{field:'estadoequipo',title:'Estado del Equipo Tx',width:140,editor:'text'},
					{field:'cantidadpuertosrbs',title:'Cantidad de puertos RBS',width:150,editor:'text'},
					{field:'hilotx',title:'Etiqueta de puerto RBS-Hilo Tx From',width:215,editor:'text'},
					{field:'hilorx',title:'Etiqueta de puerto RBS-Hilo Rx To',width:200,editor:'text'},
					{field:'observaciones',title:'Observaciones',width:270,editor:'text'},
					{field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},									
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverow4(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrow4(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrow4(this)">Edit</a> ';
								
								return e;
							}
						}
					}
				]],
				onEndEdit:function(index,row){
					
					$(this).datagrid('getEditor', index);
				},
				onBeforeEdit:function(index,row){
					row.editing = true;
					$(this).datagrid('refreshRow', index);
				},
				onAfterEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				},
				onCancelEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				}
			});

///////////////////////
				//////////////////////////
				$('#p019_5').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:230,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'data/datagrid_p019_5.json',	
				//{"numero":"1","fabricante":"","existe":"","estado":"","modeloequipo":"","diametro":"","potencia":"","nivelrx":"","observaciones":"","idevento":""},				
				columns:[[					
					{field:'numero',title:'No.',width:30},
					{field:'fabricante',title:'Fabricante',width:150,editor:'text'},					
					{field:'existe',title:'Existe',width:70,editor:'text'},
					{field:'estado',title:'Estado',width:90,editor:'text'},
					{field:'modeloequipo',title:'Modelo Equipo',width:120,editor:'text'},
					{field:'diametro',title:'Diametro Antena',width:120,editor:'text'},
					{field:'potencia',title:'Potencia BUC',width:100,editor:'text'},
					{field:'nivelrx',title:'Nivel de Rx',width:110,editor:'text'},
					{field:'observaciones',title:'Observaciones',width:410,editor:'text'},
					{field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},									
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverow5(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrow5(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrow5(this)">Edit</a> ';
								
								return e;
							}
						}
					}
				]],
				onEndEdit:function(index,row){
					
					$(this).datagrid('getEditor', index);
				},
				onBeforeEdit:function(index,row){
					row.editing = true;
					$(this).datagrid('refreshRow', index);
				},
				onAfterEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				},
				onCancelEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				}
			});
				//ruta='../../paquetes/ajax/rellenar_p013_alarmasexternas.php?idevento='+ idevento;
				$('#p019_6').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:330,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'../../paquetes/ajax/rellenar_p019_6_tdatagrid.php',				
				columns:[[					
					{field:'idmantenimientopreventivo',title:'',width:10,hidden:true},					
					{field:'nombremantenimiento',title:'',width:750},								
					{field:'estadoinicial',title:'Estado Inicial',width:300,editor:'text'},								
					{field:'revisado',title:'Revisado',width:150,editor:'text'},								
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverow6(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrow6(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrow6(this)">Edit</a> ';
								
								return e;
							}
						}
					}
				]],
				onEndEdit:function(index,row){
					
					$(this).datagrid('getEditor', index);
				},
				onBeforeEdit:function(index,row){
					row.editing = true;
					$(this).datagrid('refreshRow', index);
				},
				onAfterEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				},
				onCancelEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				}
			});
			/////////////////////////////////////////////////
			$('#p019_7').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1000,
				height:330,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'../../paquetes/ajax/rellenar_p019_7_tdatagrid.php',				
				columns:[[					
					{field:'orden',title:'orden',width:10,hidden:true},
					{field:'nombredistarjetasequipos',title:'Tarjeta',width:150},					
					{field:'cantidad',title:'Cantidad',width:150,editor:'text'},													
					{field:'puertosservicio',title:'Puertos en Servicio',width:300,editor:'text'},								
					{field:'puertoslibres',title:'Puertos Libres',width:310,editor:'text'},								
					{field:'iddisptarjetasequipos',title:'iddisptarjetasequipos',width:150,hidden:true},								
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverow7(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrow7(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrow7(this)">Edit</a> ';
								
								return e;
							}
						}
					}
				]],
				onEndEdit:function(index,row){
					
					$(this).datagrid('getEditor', index);
				},
				onBeforeEdit:function(index,row){
					row.editing = true;
					$(this).datagrid('refreshRow', index);
				},
				onAfterEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				},
				onCancelEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				}
			});

			/////////////////////////////////////////////////
			//{"numero":"1","tecnologia":"","fabricante":"","modelo":"","tipoacceso":"","idevento":""},	to":""},	
			$('#p019_8').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:230,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'data/datagrid_p019_8.json',				
				columns:[[										
					{field:'numero',title:'No.',width:30},					
					{field:'tecnologia',title:'Tecnologia',width:370,editor:'text'},													
					{field:'fabricante',title:'Fabricante',width:300,editor:'text'},								
					{field:'modelo',title:'Modelo',width:300,editor:'text'},								
					{field:'tipoacceso',title:'Tipo de Acceso',width:200,editor:'text'},								
					{field:'idevento',title:'idevento',width:150,hidden:true},								
					{field:'action',title:'Action',width:80,align:'center',
					
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverow8(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrow8(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrow8(this)">Edit</a> ';
								
								return e;
							}
						}
					}
				]],
				onEndEdit:function(index,row){
					
					$(this).datagrid('getEditor', index);
				},
				onBeforeEdit:function(index,row){
					row.editing = true;
					$(this).datagrid('refreshRow', index);
				},
				onAfterEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				},
				onCancelEdit:function(index,row){
					row.editing = false;
					$(this).datagrid('refreshRow', index);
				}
			});
			////////////////////////////////////

			
			
		});



		function getRowIndex(target){
			var tr = $(target).closest('tr.datagrid-row');
			return parseInt(tr.attr('datagrid-row-index'));
		}

		////////////////////////////////
		function editrow2(target){
			$('#p019_2').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverow2(target){
			$('#p019_2').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrow2(target){
			$('#p019_2').datagrid('cancelEdit', getRowIndex(target));
		}

		////////////////////////////////
		function editrow3(target){
			$('#p019_3').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverow3(target){
			$('#p019_3').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrow3(target){
			$('#p019_3').datagrid('cancelEdit', getRowIndex(target));
		}
		
		////////////////////////////////
		function editrow4(target){
			$('#p019_4').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverow4(target){
			$('#p019_4').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrow4(target){
			$('#p019_4').datagrid('cancelEdit', getRowIndex(target));
		}
		////////////////////////////////
		function editrow5(target){
			$('#p019_5').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverow5(target){
			$('#p019_5').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrow5(target){
			$('#p019_5').datagrid('cancelEdit', getRowIndex(target));
		}

		////////////////////////////////
		function editrow6(target){
			$('#p019_6').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverow6(target){
			$('#p019_6').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrow6(target){
			$('#p019_6').datagrid('cancelEdit', getRowIndex(target));
		}

		////////////////////////////////
		function editrow7(target){
			$('#p019_7').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverow7(target){
			$('#p019_7').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrow7(target){
			$('#p019_7').datagrid('cancelEdit', getRowIndex(target));
		}

		////////////////////////////////
		function editrow8(target){
			$('#p019_8').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverow8(target){
			$('#p019_8').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrow8(target){
			$('#p019_8').datagrid('cancelEdit', getRowIndex(target));
		}
		
		

							
		
	</script>


<script type="text/javascript">
	
	$(document).ready(function() {

		$('#idestacionentelgsm').change(
			function(){
				//alert('funciona');
				$('#nombreestacionentelgsm').val('');
				rellenarEstacionGSM();			
				//alert('funciona');			
		});	

		$('#idestacionentel4g').change(
			function(){
				
				$('#nombreestacionentel4g').val('');
				rellenarEstacion4g();			
				//alert('funciona');			
		});		

		$('#idestacionentellte').change(
			function(){
				
				$('#nombreestacionentellte').val('');
				rellenarEstacionlte();			
				//alert('funciona');			
		});		

		$('#boton').click(function(){
			//alert('Boton presionado');	
			////////////////////////////encabezado y punto 1 + Observaciones	
		
		var mensaje;
    	var opcion = confirm("Guardar los cambios?");
    	if (opcion == true) {
				/*Creamos la instancia del objeto. Ya estamos conectados*/
		//alert('as');
			var idevento= $('#idevento').val();

			jQuery.post("../../paquetes/ajax/insertar_formulario_mtto_n_p019.php", {
				idevento:idevento
				
			}, function(data, textStatus){
				if(data == 1){
					$('#res').html('Datos insertados correctamente');
					$('#res').css('color','green');
							}
				else{
					$('#res').html(data);
					$('#res').css('color','red');
					}
			});	
			sleep(200);

			//var idevento= $('#idevento').val();
			var responsable=$('#responsable').val();
			var fechamantenimiento=$('#fechamantenimiento').val();
			var observaciones=$('#observaciones').val();									

			jQuery.post("../../paquetes/ajax/insertar_p019_formulario.php", {
				idevento:idevento,
				responsable:responsable,
				fechamantenimiento:fechamantenimiento,				
				observaciones:observaciones
			}, function(data, textStatus){
				if(data == 1){
					$('#res').html('Datos insertados correctamente');
					$('#res').css('color','green');
							}
				else{
					$('#res').html(data);
					$('#res').css('color','red');
					}
			});	
			sleep(200);
			///////////////////// Punto 2 Mantenimiento preventivo
			var rowsp019_2 = $('#p019_2').datagrid('getRows');			
			//alert(rowspruebasservicio.length);	

			for(var i=0; i<rowsp019_2.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p019_2.php", {
						idevento : idevento,
						numero : rowsp019_2[i].numero,
						idsitio : rowsp019_2[i].idsitio,
						nombreestacion : rowsp019_2[i].nombreestacion,
						tipoestacion : rowsp019_2[i].tipoestacion,
						latitud : rowsp019_2[i].latitud,
						longitud : rowsp019_2[i].longitud,
						altura : rowsp019_2[i].altura,
						torres : rowsp019_2[i].torres,
						tipotorre : rowsp019_2[i].tipotorre,
						alturatorre : rowsp019_2[i].alturatorre,
						gabinetes : rowsp019_2[i].gabinetes,
						tipogabinetes : rowsp019_2[i].tipogabinetes								
						}, function(data, textStatus){
						if(data == 1){
							$('#res').html('Datos insertados correctamente');
							$('#res').css('color','green');
						}
						else{
							$('#res').html(data);
							$('#res').css('color','red');
						}
					});
				sleep(200);
				//i=20;
			}//en del for
			/////////////////////////////////////////////////////////////
			var rowsp019_3 = $('#p019_3').datagrid('getRows');			
			//alert(rowspruebasservicio.length);	

			for(var i=0; i<rowsp019_3.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p019_3.php", {
						idevento : idevento,
						numero : rowsp019_3[i].numero,
						idsitio : rowsp019_3[i].idsitio,
						neorigen : rowsp019_3[i].neorigen,
						nedestino : rowsp019_3[i].nedestino,
						fabricante : rowsp019_3[i].fabricante,
						modelo : rowsp019_3[i].modelo,
						fretxorigen : rowsp019_3[i].fretxorigen,
						fretxdestino : rowsp019_3[i].fretxdestino,
						topologia : rowsp019_3[i].topologia,
						azimut : rowsp019_3[i].azimut,
						diametro : rowsp019_3[i].diametro,
						estado : rowsp019_3[i].estado																				
						}, function(data, textStatus){
						if(data == 1){
							$('#res').html('Datos insertados correctamente');
							$('#res').css('color','green');
						}
						else{
							$('#res').html(data);
							$('#res').css('color','red');
						}
					});
				sleep(200);
				//i=20;
			}//en del for
			/////////////////////////////////////////////////////////////
			var rowsp019_4 = $('#p019_4').datagrid('getRows');			
			//alert(rowspruebasservicio.length);	

			for(var i=0; i<rowsp019_4.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p019_4.php", {
						idevento : idevento,
						numero : rowsp019_4[i].numero,
						mediotransporte : rowsp019_4[i].mediotransporte,
						existe : rowsp019_4[i].existe,
						estadoequipo : rowsp019_4[i].estadoequipo,
						cantidadpuertosrbs : rowsp019_4[i].cantidadpuertosrbs,
						hilotx : rowsp019_4[i].hilotx,
						hilorx : rowsp019_4[i].hilorx,
						observaciones : rowsp019_4[i].observaciones																				
						}, function(data, textStatus){
						if(data == 1){
							$('#res').html('Datos insertados correctamente');
							$('#res').css('color','green');
						}
						else{
							$('#res').html(data);
							$('#res').css('color','red');
						}
					});
				sleep(200);
				//i=20;
			}//en del for
			/////////////////////////////////////////////////////////////
			var rowsp019_5 = $('#p019_5').datagrid('getRows');			
			//alert(rowspruebasservicio.length);	

			for(var i=0; i<rowsp019_5.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p019_5.php", {
						idevento : idevento,
						numero : rowsp019_5[i].numero,
						fabricante : rowsp019_5[i].fabricante,
						existe : rowsp019_5[i].existe,
						estado : rowsp019_5[i].estado,
						modeloequipo : rowsp019_5[i].modeloequipo,
						diametro : rowsp019_5[i].diametro,
						potencia : rowsp019_5[i].potencia,
						nivelrx : rowsp019_5[i].nivelrx,						
						observaciones : rowsp019_5[i].observaciones																				
						}, function(data, textStatus){
						if(data == 1){
							$('#res').html('Datos insertados correctamente');
							$('#res').css('color','green');
						}
						else{
							$('#res').html(data);
							$('#res').css('color','red');
						}
					});
				sleep(200);
				//i=20;
			}//en del for
			/////////////////////////////////////////////////////////////

			var rowsp019_6 = $('#p019_6').datagrid('getRows');			
			//alert(rowspruebasservicio.length);	

			for(var i=0; i<rowsp019_6.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p019_6.php", {
						idevento : idevento,
						idmantenimientopreventivo : rowsp019_6[i].idmantenimientopreventivo,
						estadoinicial : rowsp019_6[i].estadoinicial,
						revisado : rowsp019_6[i].revisado																						
						}, function(data, textStatus){
						if(data == 1){
							$('#res').html('Datos insertados correctamente');
							$('#res').css('color','green');
						}
						else{
							$('#res').html(data);
							$('#res').css('color','red');
						}
					});
				sleep(200);
				//i=20;
			}//en del for
			/////////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////

			var rowsp019_7 = $('#p019_7').datagrid('getRows');			
			//alert(rowspruebasservicio.length);	

			for(var i=0; i<rowsp019_7.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p019_7.php", {
						idevento : idevento,
						iddisptarjetasequipos : rowsp019_7[i].iddisptarjetasequipos,
						cantidad : rowsp019_7[i].cantidad,
						puertosservicio : rowsp019_7[i].puertosservicio,
						puertoslibres : rowsp019_7[i].puertoslibres																						
						}, function(data, textStatus){
						if(data == 1){
							$('#res').html('Datos insertados correctamente');
							$('#res').css('color','green');
						}
						else{
							$('#res').html(data);
							$('#res').css('color','red');
						}
					});
				sleep(200);
				//i=20;
			}//en del for
			/////////////////////////////////////////////////////////////

			var rowsp019_8 = $('#p019_8').datagrid('getRows');			
			//alert(rowspruebasservicio.length);	

			for(var i=0; i<rowsp019_8.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p019_8.php", {
						idevento : idevento,
						numero : rowsp019_8[i].numero,
						tecnologia : rowsp019_8[i].tecnologia,
						fabricante : rowsp019_8[i].fabricante,
						modelo : rowsp019_8[i].modelo,
						tipoacceso : rowsp019_8[i].tipoacceso																					
						}, function(data, textStatus){
						if(data == 1){
							$('#res').html('Datos insertados correctamente');
							$('#res').css('color','green');
						}
						else{
							$('#res').html(data);
							$('#res').css('color','red');
						}
					});
				sleep(200);
				//i=20;
			}//en del for
			/////////////////////////////////////////////////////////////
			
			//document.getElementById('boton').disabled=false;
			document.amper.boton.disabled=true;
			alert('Proceso terminado');
			javascript:history.back(1);
			//barra();
			
			
		}	//end if
		});
	});

	function barra(){
		//alert('entro');
		var bar = new ProgressBar.Line(container, {
	  strokeWidth: 4,
	  easing: 'easeInOut',
	  duration: 8000,
	  color: '#FFEA82',
	  trailColor: '#eee',
	  trailWidth: 1,
	  svgStyle: {width: '100%', height: '100%'},
	  text: {
	    style: {
	      // Text color.
	      // Default: same as stroke color (options.color)
	      color: '#999',
	      position: 'absolute',
	      right: '0',
	      top: '30px',
	      padding: 0,
	      margin: 0,
	      transform: null
	    },
	    autoStyleContainer: false
	  },
	  from: {color: '#FFEA82'},
	  to: {color: '#ED6A5A'},
	  step: (state, bar) => {
	    bar.setText(Math.round(bar.value() * 100) + ' %');
	  }
	});

	bar.animate(1.0);  // Number from 0.0 to 1.0
	}

</script>



	<script type="text/javascript">
	function rellenarEstacionGSM(){
		try{
			var idestacionentel=$('#idestacionentelgsm').val();
			var codes=$('#codEs').val();
			//alert('funciona')
			$.ajax({
				type:"POST",
				url:"../../paquetes/ajax/search_idestacionentelgsm.php",
				//
				data:{idestacionentel:idestacionentel,codes:codes},				
				//data:"idestacionentel=" + $('#codEs').val(),				
				success:function(r){
					$('#select2lista').html(r);

				}
			});
			  //alert('bien');
		}
			catch(error) {
			  console.error(error);
			  alert(error);
			  // expected output: ReferenceError: nonExistentFunction is not defined
			  // Note - error messages will vary depending on browser
		}
	}

	function rellenarEstacion4g(){
		try{
			var idestacionentel=$('#idestacionentel4g').val();
			var codes=$('#codEs').val();

			$.ajax({
				type:"POST",
				url:"../../paquetes/ajax/search_idestacionentel4g.php",
				//
				data:{idestacionentel:idestacionentel,codes:codes},				
				//data:"idestacionentel=" + $('#codEs').val(),				
				success:function(r){
					$('#select2lista').html(r);

				}
			});
			  //alert('bien');
		}
			catch(error) {
			  console.error(error);
			  alert(error);
			  // expected output: ReferenceError: nonExistentFunction is not defined
			  // Note - error messages will vary depending on browser
		}
	}

	function rellenarEstacionlte(){
		try{
			var idestacionentel=$('#idestacionentellte').val();
			var codes=$('#codEs').val();

			$.ajax({
				type:"POST",
				url:"../../paquetes/ajax/search_idestacionentellte.php",
				//
				data:{idestacionentel:idestacionentel,codes:codes},				
				//data:"idestacionentel=" + $('#codEs').val(),				
				success:function(r){
					$('#select2lista').html(r);

				}
			});
			  //alert('bien');
		}
			catch(error) {
			  console.error(error);
			  alert(error);
			  // expected output: ReferenceError: nonExistentFunction is not defined
			  // Note - error messages will vary depending on browser
		}
	}
</script>

	



<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css" />
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet />
<script src="../../paquetes/nicEdit/nicEdit.js" type="text/javascript"></script>             

<script type=text/javascript>
bkLib.onDomLoaded(function() {
	new nicEditor({buttonList : ['removeformat','bold','italic','underline','html']}).panelInstance('obs');
});
</script>
<script type=text/javascript>
var calendar;
var calendarb;
window.onload = function() {
	//calendar = new Epoch('dp_cal','popup',document.getElementById('fechamantenimiento'));
	//calendarb = new Epoch('dp_cal','popup',document.getElementById('fecha_fin'));
}
</script>  

<script type="text/javascript">var GB_ROOT_DIR = "./../../paquetes/greybox/";</script>
<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="../../paquetes/tooltip/tooltip.css" rel="stylesheet" type="text/css">
<script language=javascript type="text/javascript" src="../../paquetes/tooltip/tooltip.js"></script>

<script src="../../js/validador.js" type=text/javascript></script>
<script type="text/javascript">
function VerifyOne () {
    if( checkField( document.amper.LMA, isName, false ) &&
	    isNull( document.amper.SMSA) &&
		isNull( document.amper.VLA) 
		)
		{
			if(confirm("Verifico bien los datos antes de continuar?"))
			{return true;}
			else {return false;}
    }
else {	
return false;
     }
}

function sleep(milliseconds) {
  var start = new Date().getTime();
  for (var i = 0; i < 1e7; i++) {
    if ((new Date().getTime() - start) > milliseconds){
      break;
    }
  }
}

</script>

<link type="text/css" rel="stylesheet" href="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>



<script>
var maximo_lineas=9;  //Pon lo que quieras
function checar(contenido){
lineas=contenido.split("\n");
if(lineas.length<=maximo_lineas){
return true
}else{
return false
}
}
</script>

</BODY>
</HTML>

