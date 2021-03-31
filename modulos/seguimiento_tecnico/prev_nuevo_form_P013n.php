<HTML>
<HEAD>
<TITLE> Título de la página </TITLE>
<meta http-equiv="content-type" content="text/html; utf-8">


<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>

    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	<script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>


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

$resultado = mysql_query("SELECT * FROM p013_formulario WHERE idevento = '$idevento' ");
$totalFilas    =    mysql_num_rows($resultado);  


$resultado = mysql_query("
SELECT ev.idevento, ev.estado, ev.inicio, ev.fin, es.codigo as codigoest, es.nombre as nombreest, g.codigo AS codigog, c.idcentro, c.codigo as codCentro,c.nombre as nombrecentro FROM evento ev
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

$params = "&anio=$anio&codCentro=$codCentro&ini=$ini&fin=$fin&idev=$idev&codEs=$codEs&nomEs=$nomEs&idevento=$idevento&idform=$idformulario&nombreForm=$nombreForm";

if ($totalFilas!=0){
	$href = "$link_modulo?path=prev_editar_form_P013n.php&$params";
	?>
		<script type="text/javascript">
	        window.open('<?=$href?>', '_top');
		</script> 
	<?
}
require("../../funciones/funciones.php");
require("../../funciones/Db.class.php");
	$op1 = array("...", "2G","4G", "2G-4G", "2G-4G-LTE","4G-LTE", "LTE");
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
	<form name="amper"   onSubmit=" return VerifyOne();">

	<input type="hidden" name="path" value="__prev_nuevo_form_P013n_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" id="idevento"/>
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
	<input type="hidden" name="nomEs" value="<?=$nomEs?>" />
<br />
<TABLE width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIMIENTO PREVENTIVO RADIO BASES</caption>	
	<TR>
		<TH >
				IDENTIFICACION DEL SITIO
		</TH>
	</TR>
	

</TABLE>

<TABLE width="900" align="center" class="table2">
	
	<TR>
		<TD>
			Departamento
		</TD>
		<TD>
			<input name="nomDpto" type="text" id="nomDpto" size="30" value="COBHABAMBA" />
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			ID Sitio
		</TD>				
			
		<TD>
			<input name="codEs" type="text" id="codEs" size="30" value="<? ECHO($codEs);?>" />
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			Centro o Subcentro
		</TD>
		<TD>
			<input name="nombrecentro" type="text" id="nombrecentro" size="30" value="<? ECHO($nombrecentro);?>" />
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			Nombre Sitio
		</TD>				
			
		<TD>
			<input name="nomES" type="text" id="nomEs" size="30" value="<? ECHO($nomEs);?>" />
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			Responsable contratista
		</TD>
		<TD>
			<input name="responsable" type="text" id="responsable" size="30" value="" />
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			Fecha de mantto
		</TD>				
			
		<TD>			
			

			<input name="fechamantenimiento" type="text" id="fechamantenimiento" size="10" class="Text_left" value="" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)" readonly="yes"/>
            <img onclick="displayCalendar(document.amper.fechamantenimiento,'yyyy-mm-dd',this,false)" src="../../img/cal.gif" alt="Seleccionar fecha" width="16" height="16">		
		</TD>				
		
	</TR>		
		

</TABLE>
	

<br />

<TABLE width="900" align="center" class="table2">
	<caption >1. Relevamiento</caption>	
	
	
	<TR>
		<TH >
			Radio Bases
		</TH>
	  	<TD>
			<select name="radiobase" id="radiobase">				
				<? foreach($op1 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>							
			</select>
		  
		</TD>		
	  					
	</TR>
	<TR>
		<TH >
			Estado	
		</TH>
	  	<TD>
			<input name="estado" type="text" id="estado" size="30" value="" />
		</TD>		
	  			
	</TR>
	<TR>
		<TH >
			Vendedor
		</TH>
	  	<TD>
			<input name="vendor" type="text" id="vendor" size="30" value="" />
		</TD>		
	  				
	</TR>
	<TR>
		<TH >
			Tipo de Transporte
		</TH>
	  	<TD>
			<input name="tipotransporte" type="text" id="tipotransporte" size="30" value="" />
		</TD>		
	  				
	</TR>
	<TR>
		<TH >
			Salto Anterior
		</TH>
	  	<TD>
			<input name="saltoanterior" type="text" id="saltoanterior" size="30" value="" />
		</TD>		
	  					
	</TR>

	<TR>
		<TH >
			Interface	
		</TH>
	  	<TD>
			<input name="interface" type="text" id="interface" size="30" value="" />
		</TD>		
	  					
	</TR>
	<TR>
		<TH >
			Equipo de transmision	
		</TH>
	  	<TD>
			<input name="equipotransmision" type="text" id="equipotransmision" size="30" value="" />
		</TD>		
	  					
	</TR>
	
	<TR>
		<TH >
			Energia principal	
		</TH>
	  	<TD>
			<input name="energiaprincipal" type="text" id="energiaprincipal" size="30" value="" />
		</TD>		
	  					
	</TR>
	<TR>
		<TH >
			Energia de Respaldo	
		</TH>
	  	<TD> 	
			<input name="energiarespaldo" type="text" id="energiarespaldo" size="30" value="" />
		</TD>		
	  					
	</TR>


</TABLE>

<br />
<TABLE width="1290" align="center" class="table2">
	<caption>2. Mantenimiento preventivo</caption>
	
	
</TABLE>
<table id="verificacion" ></table>
	<br>

<table id="alarmas" ></table>
	<br>

	<table id="alarmasexternas"></table>
	<br>


<br />
<table id="pruebasservicio"></table>
	<br>
	
<table id="observaciones"></table>

<br>
<TABLE width="900" align="center" class="table2">
	<caption>4. Relevamiento CELDAS</caption>			
</TABLE>

<TABLE width="900" align="center" class="table2">
	
	<TR>
		<TD>
			Tecnologia
		</TD>
		<TD>
			<input name="tecnologiagsm" type="text" id="tecnologiagsm" size="30" value="" readonly="readonly" />
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			ID Estacion
		</TD>				
			
		<TD>
			<input name="idestacionentelgsm" type="text" id="idestacionentelgsm" size="30" value="" />
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			Nombre de la BTS
		</TD>
		<TD>
			<input name="nombreestacionentelgsm" type="text" id="nombreestacionentelgsm" size="30" value="" readonly="readonly"/>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			Configuracion
		</TD>				
			
		<TD>
			<input name="configuraciongsm" type="text" id="configuraciongsm" size="30" value="" />
		</TD>				
		
	</TR>		
		
		

</TABLE>

<br />

<table id="gsm" class="table2"></table>
	<br>



<TABLE width="900" align="center" class="table2">
	
	<TR>
		<TD>
			Tecnologia
		</TD>
		<TD>
			<input name="tecnologia4g" type="text" id="tecnologia4g" size="30" value="" readonly="readonly" />
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			ID Estacion
		</TD>				
			
		<TD>
			<input name="idestacionentel4g" type="text" id="idestacionentel4g" size="30" value="" />
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			Nombre de la BTS
		</TD>
		<TD>
			<input name="nombreestacionentel4g" type="text" id="nombreestacionentel4g" size="30" readonly="readonly" value="" />
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			Configuracion
		</TD>				
			
		<TD>
			<input name="configuracion4g" type="text" id="configuracion4g" size="30" value="" />
		</TD>				
		
	</TR>		
		
		

</TABLE>

<br />
<table id="hspa"></table>
	<br>

</BR>
<TABLE width="900" align="center" class="table2">
	
	<TR>
		<TD>
			Tecnologia
		</TD>
		<TD>
			<input name="tecnologialte" type="text" id="tecnologialte" size="30" readonly="readonly" value="" />
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			ID Estacion
		</TD>				
			
		<TD>
			<input name="idestacionentellte" type="text" id="idestacionentellte" size="30" value="" />
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			Nombre de la BTS
		</TD>
		<TD>
			<input name="nombreestacionentellte" type="text" id="nombreestacionentellte" size="30" readonly="readonly" value="" />
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			Configuracion
		</TD>				
			
		<TD>
			<input name="configuracionlte" type="text" id="configuracionlte" size="30" value="" />
		</TD>				
		
	</TR>		
		
		

</TABLE>

<br />
<table id="lte"></table>

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
<span id="resformulario"></span>
<br>
<span id="res2"></span>
<br>
<span id="res3"></span>
<br>
<span id="res4"></span>
<br>
<span id="res5"></span>
<br>
<span id="res6"></span>
<br>
<span id="res7"></span>
<br>
<span id="res8"></span>
<br>
<span id="res9"></span>
<br>
<span id="res10"></span>
<br>
<span id="res10"></span>
<br>
<span id="res10"></span>
<br>
<span id="res10"></span>
<br>
<span id="res10"></span>




	
	<script>	

			
		
		$(function(){

		



			////////////////////////////////////		
				$('#verificacion').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:455,
				singleSelect:true,
				idField:'idverificacionfisica',								
				nowrap:false,
				//font-size:'6px',
				url:'data/datagrid_p013_tverificacionfisica.json',				
				columns:[[			
					{id:'id1',field:'idverificacionfisica',title:'idverificacionfisica',width:200,editor:'text',hidden:'true'},
					{id:'id2',field:'nombreverificacionfisica',title:'',width:500},
					{id:'id3',field:'revisado',title:'Revisado',width:100,editor:'text'},
					{id:'id4',field:'observaciones',title:'Observaciones',width:600,editor:'text'},
					{id:'id5',field:'orden',title:'orden',width:100,editor:'text', hidden:'true'},								
					{id:'id6',field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverowVR(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrowVR(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrowVR(this)">Edit</a> ';
								
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
						
				$('#alarmas').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:200,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'data/datagrid_p013_alarmas.json',				
				columns:[[					
					{field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},
					{field:'alarma',title:'Listar Alarmas de RBS por LMT, OMT',width:250,editor:'text'},
					{field:'causa',title:'Causa',width:250,editor:'text'},
					{field:'solucion',title:'Solucion',width:350,editor:'text'},
					{field:'observaciones',title:'Observaciones',width:350,editor:'text'},
					{field:'orden',title:'orden',width:100,editor:'text',hidden:true},															
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverowAL(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrowAL(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrowAL(this)">Edit</a> ';
								
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
				$('#alarmasexternas').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:420,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'data/datagrid_p013_tverificacionalarmasexternas.json',				
				columns:[[					
					{field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},
					{field:'idverificaralarmaexterna',title:'idverificaralarmaexterna',width:100,editor:'text',hidden:true},
					{field:'nombreverificaralarmaexterna',title:'Verificar alarmas externas',width:300},
					{field:'estado',title:'estado',width:150,editor:'text'},
					{field:'observaciones',title:'observaciones',width:750,editor:'text'},
					{field:'orden',title:'orden',width:100,editor:'text',hidden:true},									
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverowALE(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrowALE(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrowALE(this)">Edit</a> ';
								
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
				$('#pruebasservicio').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:200,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'data/datagrid_p013_tpruebasservicios.json',				
				columns:[[					
					{field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},
					{field:'idpruebaservicio',title:'idpruebaservicio',width:100,editor:'text',hidden:true},					
					{field:'nombrepruebaservicio',title:'Pruebas de servicio',width:180},
					{field:'numeroa',title:'Numero A',width:100,editor:'text'},
					{field:'numerob',title:'Numero B',width:100,editor:'text'},
					{field:'pruebaexitosa',title:'Prueba exitosa?',width:100,editor:'text'},
					{field:'fecha',title:'Fecha (YYYY-mm-dd)',width:170,editor:'text'},
					{field:'hora',title:'Hora (24 Hrs)',width:110,editor:'text'},
					{field:'observaciones',title:'Observaciones',width:440,editor:'text'},
					{field:'orden',title:'orden',width:100,editor:'text',hidden:true},									
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverowPS(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrowPS(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrowPS(this)">Edit</a> ';
								
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

				$('#observaciones').datagrid({
				title:'3. OBSERVACIONES',
				iconCls:'icon-edit',
				width:1290,
				height:370,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'data/datagrid_p013_observaciones.json',				
				columns:[[					
					{field:'idevento',title:'idevento',width:100,editor:'text',hidden:true},															
					{field:'observacion',title:'',width:1200,editor:'text'},
					{field:'orden',title:'orden',width:100,editor:'text',hidden:true},									
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverowObs(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrowObs(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrowObs(this)">Edit</a> ';
								
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
				$('#gsm').datagrid({
				title:'',				
				iconCls:'icon-edit',
				width:1290,
				height:360,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'data/datagrid_data.json',				
				columns:[[					
					{field:'orden',title:'Orden',width:80,editor:'text',hidden:true},
					{field:'sector',title:'Sector',width:45},
					{field:'localcellid',title:'Local Cell ID',width:80,editor:'text'},
					{field:'bandamhz',title:'Banda Mhz',width:70,editor:'text'},
					{field:'modelorbs',title:'Modelo RBS',width:80,editor:'text'},
					{field:'tipoantena',title:'Tipo de antena',width:90,editor:'text'},
					{field:'marcaantena',title:'Marca antena',width:90,editor:'text'},
					{field:'modeloantena',title:'Modelo de antena',width:110,editor:'text'},
					{field:'azimuth',title:'Azimuth',width:60,editor:'text'},
					{field:'tiltmecanico',title:'Tilt Mecanico',width:85,editor:'text'},
					{field:'tiltelectrico',title:'Tilt Electrico',width:80,editor:'text'},
					{field:'anguloapertura',title:'Angulo de apertura',width:115,editor:'text'},
					{field:'alturaantena',title:'Altura de antena(m)',width:120,editor:'text'},
					{field:'tieneret',title:'Tiene RET',width:80,editor:'text'},
					{field:'modelorru',title:'Modelo RRU',width:100,editor:'text'},													
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverowgsm(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrowgsm(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrowgsm(this)">Edit</a> ';
								
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
			$('#hspa').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:360,
				singleSelect:true,
				idField:'sector',											
				nowrap:false,
				url:'data/datagrid_data.json',				
				columns:[[					
					{field:'orden',title:'Orden',width:80,editor:'text',hidden:true},
					{field:'sector',title:'Sector',width:45},
					{field:'localcellid',title:'Local Cell ID',width:80,editor:'text'},
					{field:'bandamhz',title:'Banda Mhz',width:70,editor:'text'},
					{field:'modelorbs',title:'Modelo RBS',width:80,editor:'text'},
					{field:'tipoantena',title:'Tipo de antena',width:90,editor:'text'},
					{field:'marcaantena',title:'Marca antena',width:90,editor:'text'},
					{field:'modeloantena',title:'Modelo de antena',width:110,editor:'text'},
					{field:'azimuth',title:'Azimuth',width:60,editor:'text'},
					{field:'tiltmecanico',title:'Tilt Mecanico',width:85,editor:'text'},
					{field:'tiltelectrico',title:'Tilt Electrico',width:80,editor:'text'},
					{field:'anguloapertura',title:'Angulo de apertura',width:115,editor:'text'},
					{field:'alturaantena',title:'Altura de antena(m)',width:120,editor:'text'},
					{field:'tieneret',title:'Tiene RET',width:80,editor:'text'},
					{field:'modelorru',title:'Modelo RRU',width:100,editor:'text'},													
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverowhspa(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrowhspa(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrowhspa(this)">Edit</a> ';
								
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
			$('#lte').datagrid({
				title:'',
				iconCls:'icon-edit',
				width:1290,
				height:360,
				singleSelect:true,
				idField:'sector',				
				nowrap:false,
				url:'data/datagrid_data.json',				
				columns:[[					
					{field:'orden',title:'Orden',width:80,editor:'text',hidden:true},
					{field:'sector',title:'Sector',width:45},
					{field:'localcellid',title:'Local Cell ID',width:80,editor:'text'},
					{field:'bandamhz',title:'Banda Mhz',width:70,editor:'text'},
					{field:'modelorbs',title:'Modelo RBS',width:80,editor:'text'},
					{field:'tipoantena',title:'Tipo de antena',width:90,editor:'text'},
					{field:'marcaantena',title:'Marca antena',width:90,editor:'text'},
					{field:'modeloantena',title:'Modelo de antena',width:110,editor:'text'},
					{field:'azimuth',title:'Azimuth',width:60,editor:'text'},
					{field:'tiltmecanico',title:'Tilt Mecanico',width:85,editor:'text'},
					{field:'tiltelectrico',title:'Tilt Electrico',width:80,editor:'text'},
					{field:'anguloapertura',title:'Angulo de apertura',width:115,editor:'text'},
					{field:'alturaantena',title:'Altura de antena(m)',width:120,editor:'text'},
					{field:'tieneret',title:'Tiene RET',width:80,editor:'text'},
					{field:'modelorru',title:'Modelo RRU',width:100,editor:'text'},													
					{field:'action',title:'Action',width:80,align:'center',
						formatter:function(value,row,index){
							if (row.editing){
								var s = '<a href="javascript:void(0)" onclick="saverowlte(this)">Save</a> ';
								var c = '<a href="javascript:void(0)" onclick="cancelrowlte(this)">Cancel</a>';
								return s+c;
							} else {
								var e = '<a href="javascript:void(0)" onclick="editrowlte(this)">Edit</a> ';
								
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
		});



		function getRowIndex(target){
			var tr = $(target).closest('tr.datagrid-row');
			return parseInt(tr.attr('datagrid-row-index'));
		}

		////////////////////////////////
		function editrowVR(target){
			$('#verificacion').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverowVR(target){
			$('#verificacion').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrowVR(target){
			$('#verificacion').datagrid('cancelEdit', getRowIndex(target));
		}

		////////////////////////////////
		function editrowAL(target){
			$('#alarmas').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverowAL(target){
			$('#alarmas').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrowAL(target){
			$('#alarmas').datagrid('cancelEdit', getRowIndex(target));
		}
		
		////////////////////////////////
		function editrowALE(target){
			$('#alarmasexternas').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverowALE(target){
			$('#alarmasexternas').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrowALE(target){
			$('#alarmasexternas').datagrid('cancelEdit', getRowIndex(target));
		}
		////////////////////////////////
		function editrowPS(target){
			$('#pruebasservicio').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverowPS(target){
			$('#pruebasservicio').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrowPs(target){
			$('#pruebasservicio').datagrid('cancelEdit', getRowIndex(target));
		}

		////////////////////////////////
		function editrowObs(target){
			$('#observaciones').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverowObs(target){
			$('#observaciones').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrowObs(target){
			$('#observaciones').datagrid('cancelEdit', getRowIndex(target));
		}
		

		

		////////////////////////////
		function editrowgsm(target){
			$('#gsm').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverowgsm(target){
			$('#gsm').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrowgsm(target){
			$('#gsm').datagrid('cancelEdit', getRowIndex(target));
		}

		//////////////////////////////////////
		function editrowhspa(target){
			$('#hspa').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverowhspa(target){
			$('#hspa').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrowhspa(target){
			$('#hspa').datagrid('cancelEdit', getRowIndex(target));
		}

		//////////////////////////////////////
		function editrowlte(target){
			$('#lte').datagrid('beginEdit', getRowIndex(target));
		}		
		function saverowlte(target){
			$('#lte').datagrid('endEdit', getRowIndex(target));
		}
		function cancelrowlte(target){
			$('#lte').datagrid('cancelEdit', getRowIndex(target));
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
		<?		
			
			 
			
			// $resultado = mysql_query("SELECT * FROM formulario_mtto_n WHERE idevento = '$idevento' ");			 
			// $filasformulario=mysql_num_rows($resultado);
			 //if ($filasformulario <=0){
			 	//$id = incrementar_id("p013_formulario", "id");
			 	
			 	//$bd=Db::getInstance();
    			//$stmt = $bd->ejecutar("CALL SP_FORMULARIO_MTTO_I(19,$id,'P013n','Formulario Mtto. Preventivo Radio Bases Nuevo','Formulario Mtto. Preventivo Radio Bases 
    			//	Nuevo',$idevento    );");													
    		//	}
    	?>



    		//alert('as');
			var idevento= $('#idevento').val();

			jQuery.post("../../paquetes/ajax/insertar_formulario_mtto_n.php", {
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








			var responsable=$('#responsable').val();
			var fechamantenimiento=$('#fechamantenimiento').val();
			var radiobase=$('#radiobase').val();
			var estado=$('#estado').val();
			var vendor=$('#vendor').val();
			var tipotransporte=$('#tipotransporte').val();
			var saltoanterior=$('#saltoanterior').val();
			var interface=$('#interface').val();
			var equipotransmision=$('#equipotransmision').val();
			var energiaprincipal= $('#energiaprincipal').val();
			var energiarespaldo=$('#energiarespaldo').val();
			//var observaciones=$('#observaciones').val();
			var codes=$('#codEs').val();
				//alert(codes);
			jQuery.post("../../paquetes/ajax/insertar_p013_formulario.php", {
				idevento:idevento,
				responsable:responsable,
				fechamantenimiento:fechamantenimiento,
				radiobase:radiobase,
				estado:estado,
				vendor:vendor,
				tipotransporte:tipotransporte,
				saltoanterior:saltoanterior,
				interface:interface,
				equipotransmision:equipotransmision,
				energiaprincipal:energiaprincipal,
				energiarespaldo:energiarespaldo,				
				idestacion:codes
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
				//$idevento 
				//$idverificacionfisica 
				//$revisado 
				//$observacionesverificacion 

			var rowsverificacion = $('#verificacion').datagrid('getRows');			
			//alert(rowsverificacion.length);					
			for(var i=0; i<rowsverificacion.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p013_verificacionfisica.php", {
						idevento : idevento,
						idverificacionfisica : rowsverificacion[i].idverificacionfisica,							                                           
						revisado : rowsverificacion[i].revisado,		
						observacionesverificacion : rowsverificacion[i].observaciones								
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

			////////////////////////Listar Alarmas//////////////////////////////////////////

			//$idevento = $_POST['idevento'];
			//$alarma = $_POST['alarma'];		
			//$causa = $_POST['causa'];		
			//$solucion = $_POST['solucion'];					
			//$observaciones = $_POST['observaciones'];		
			//$orden = $_POST['orden'];		
			var rowsalarmas = $('#alarmas').datagrid('getRows');			
			//alert(rowsverificacion.length);					
			for(var i=0; i<rowsalarmas.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p013_alarmas.php", {
						idevento : idevento,
						orden : rowsalarmas[i].orden,
						alarma : rowsalarmas[i].alarma,							                                           
						causa : rowsalarmas[i].causa,		
						solucion : rowsalarmas[i].solucion,							
						observaciones : rowsalarmas[i].observaciones							
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
			////////////////////////Listar OBSERVACIONES//////////////////////////////////////////

			//$idevento = $_POST['idevento'];
			//$alarma = $_POST['alarma'];		
			//$causa = $_POST['causa'];		
			//$solucion = $_POST['solucion'];					
			//$observaciones = $_POST['observaciones'];		
			//$orden = $_POST['orden'];		
			var rowsobservaciones = $('#observaciones').datagrid('getRows');			
			//alert(rowsverificacion.length);					
			for(var i=0; i<rowsobservaciones.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p013_observaciones.php", {
						idevento : idevento,
						observacion : rowsobservaciones[i].observacion,							
						orden : rowsobservaciones[i].orden																		
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
			//////////////////////alarmas externas////////////////////////////////////////////

			//$idevento 
			//$idverificaralarmaexterna
			//$estado 
			//$observaciones			
			var rowsalarmasexternas = $('#alarmasexternas').datagrid('getRows');			
			//alert(rowsverificacion.length);					
			for(var i=0; i<rowsalarmasexternas.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p013_alarmasexternas.php", {
						idevento : idevento,
						idverificaralarmaexterna : rowsalarmasexternas[i].idverificaralarmaexterna,
						estado : rowsalarmasexternas[i].estado,
						observaciones : rowsalarmasexternas[i].observaciones,																	
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

			//////////////////////Pruebas de servicio////////////////////////////////////////////

			//idevento
			//idpruebaservicio
			//numeroa
			//numerob
			//pruebaexitosa
			//fechahora
			//fecha
			//hora
			//observaciones
			var rowspruebasservicio = $('#pruebasservicio').datagrid('getRows');			
			//alert(rowspruebasservicio.length);	

			for(var i=0; i<rowspruebasservicio.length; i++){				
				//alert(rowsverificacion[i].idverificacionfisica);
				jQuery.post("../../paquetes/ajax/insertar_p013_pruebasservicios.php", {
						idevento : idevento,
						idpruebaservicio : rowspruebasservicio[i].idpruebaservicio,
						numeroa : rowspruebasservicio[i].numeroa,
						numerob : rowspruebasservicio[i].numerob,
						pruebaexitosa : rowspruebasservicio[i].pruebaexitosa,						
						fecha : rowspruebasservicio[i].fecha,
						hora : rowspruebasservicio[i].hora,																							
						observaciones : rowspruebasservicio[i].observaciones																					
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


			///////////////////////////////////// Insertar las cabeceras del relevamiento punto 4




						var tecnologiagsm=$('#tecnologiagsm').val();
						var idestacionentelgsm=$('#idestacionentelgsm').val();
						var nombreestacionentelgsm=$('#nombreestacionentelgsm').val();
						var configuraciongsm=$('#configuraciongsm').val();
					
				if (!!nombreestacionentelgsm){
					jQuery.post("../../paquetes/ajax/insertar_p013_formularioestaciones.php", {
						idevento:idevento,
						idestacionentel:idestacionentelgsm,
						nombreestacionentel:nombreestacionentelgsm,
						tecnologia:tecnologiagsm,
						configuracion:configuraciongsm
						
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
				}
					/////////////////

						var tecnologia4g =$('#tecnologia4g').val();
						var idestacionentel4g=$('#idestacionentel4g').val();
						var nombreestacionentel4g=$('#nombreestacionentel4g').val();
						var configuracion4g=$('#configuracion4g').val();
				
				if (!!nombreestacionentel4g){	
					jQuery.post("../../paquetes/ajax/insertar_p013_formularioestaciones.php", {
						idevento:idevento,
						idestacionentel:idestacionentel4g,
						nombreestacionentel:nombreestacionentel4g,
						tecnologia:tecnologia4g,
						configuracion:configuracion4g
						
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
				}
					/////////////////

						var tecnologialte =$('#tecnologialte').val();
						var idestacionentellte=$('#idestacionentellte').val();
						var nombreestacionentellte=$('#nombreestacionentellte').val();
						var configuracionlte=$('#configuracionlte').val();
				
				if (!!nombreestacionentellte){	
					jQuery.post("../../paquetes/ajax/insertar_p013_formularioestaciones.php", {
						idevento:idevento,
						idestacionentel:idestacionentellte,
						nombreestacionentel:nombreestacionentellte,
						tecnologia:tecnologialte,
						configuracion:configuracionlte
						
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
				}


			/////////////////////////////////// Punto 4 Relevamiento de celdas

			//var ids = [];
			var rowsgsm = $('#gsm').datagrid('getRows');
			var idestacionentel=$('#idestacionentelgsm').val();
			//var idevento= $('#idevento').val();
			//for(var i=0; i<rows.length; i++){

			if (!!nombreestacionentelgsm){
				for(var i=0; i<rowsgsm.length; i++){
					//ids.push(rows[i].orden, rows[i].sector,rows[i].localcellid);

					//var idevento= $('rows[i].orden');

					jQuery.post("../../paquetes/ajax/insertar_p013_relevamientoceldas.php", {
							idevento : idevento,
							idestacionentel : idestacionentel,		
							orden : rowsgsm[i].orden,		
							sector : rowsgsm[i].sector,		
							localcellid : rowsgsm[i].localcellid,		
							bandamhz : rowsgsm[i].bandamhz,		
							modelorbs : rowsgsm[i].modelorbs,		
							tipoantena : rowsgsm[i].tipoantena,		
							marcaantena : rowsgsm[i].marcaantena,		
							modeloantena : rowsgsm[i].modeloantena,		
							azimuth : rowsgsm[i].azimuth,		
							tiltmecanico : rowsgsm[i].tiltmecanico,		
							tiltelectrico : rowsgsm[i].tiltelectrico,
							anguloapertura : rowsgsm[i].anguloapertura,
							alturaantena : rowsgsm[i].alturaantena,
							tieneret : rowsgsm[i].tieneret,
							modelorru : rowsgsm[i].modelorru
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
				}//en del for
			}
			/////////////////////////////////////

			//var ids = [];
			var rowshspa = $('#hspa').datagrid('getRows');
			var idestacionentel4g=$('#idestacionentel4g').val();
			//var idevento= $('#idevento').val();
			//for(var i=0; i<rows.length; i++){
			if (!!nombreestacionentel4g){	
				for(var i=0; i<rowshspa.length; i++){
					//ids.push(rows[i].orden, rows[i].sector,rows[i].localcellid);

					//var idevento= $('rows[i].orden');

					jQuery.post("../../paquetes/ajax/insertar_p013_relevamientoceldas.php", {
							idevento : idevento,
							idestacionentel : idestacionentel4g,		
							orden : rowshspa[i].orden,		
							sector : rowshspa[i].sector,		
							localcellid : rowshspa[i].localcellid,		
							bandamhz : rowshspa[i].bandamhz,		
							modelorbs : rowshspa[i].modelorbs,		
							tipoantena : rowshspa[i].tipoantena,		
							marcaantena : rowshspa[i].marcaantena,		
							modeloantena : rowshspa[i].modeloantena,		
							azimuth : rowshspa[i].azimuth,		
							tiltmecanico : rowshspa[i].tiltmecanico,		
							tiltelectrico : rowshspa[i].tiltelectrico,
							anguloapertura : rowshspa[i].anguloapertura,
							alturaantena : rowshspa[i].alturaantena,
							tieneret : rowshspa[i].tieneret,
							modelorru : rowshspa[i].modelorru
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
				}//en del for
			}

			/////////////////////////////////////
				
			//var ids = [];
			var rowslte = $('#lte').datagrid('getRows');
			var idestacionentellte=$('#idestacionentellte').val();
			//var idevento= $('#idevento').val();
			//for(var i=0; i<rows.length; i++){
			if (!!nombreestacionentellte){	
				for(var i=0; i<rowslte.length; i++){
					//ids.push(rows[i].orden, rows[i].sector,rows[i].localcellid);

					//var idevento= $('rows[i].orden');

					jQuery.post("../../paquetes/ajax/insertar_p013_relevamientoceldas.php", {
							idevento : idevento,
							idestacionentel : idestacionentellte,		
							orden : rowslte[i].orden,		
							sector : rowslte[i].sector,		
							localcellid : rowslte[i].localcellid,		
							bandamhz : rowslte[i].bandamhz,		
							modelorbs : rowslte[i].modelorbs,		
							tipoantena : rowslte[i].tipoantena,		
							marcaantena : rowslte[i].marcaantena,		
							modeloantena : rowslte[i].modeloantena,		
							azimuth : rowslte[i].azimuth,		
							tiltmecanico : rowslte[i].tiltmecanico,		
							tiltelectrico : rowslte[i].tiltelectrico,
							anguloapertura : rowslte[i].anguloapertura,
							alturaantena : rowslte[i].alturaantena,
							tieneret : rowslte[i].tieneret,
							modelorru : rowslte[i].modelorru
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

				}//en del for
			}
			//document.getElementById('boton').disabled=false;
			document.amper.boton.disabled=true;
			alert('Proceso terminado');
			javascript:history.back(1)
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
function formatField(value){
	return '<span style="font-size:10px">'+value+'</span>';
}


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

