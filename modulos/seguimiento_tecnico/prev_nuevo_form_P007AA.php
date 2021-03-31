<HTML>
<HEAD>
<TITLE> Título de la página </TITLE>


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

$resultado = mysql_query("SELECT * FROM formulario_p007 WHERE idevento = '$idevento' ");
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


/*
if ($totalFilas!=0){
	$href = "$link_modulo?path=prev_editar_form_P007.php&$params";
	?>
		<script type="text/javascript">
	        window.open('<?=$href?>', '_top');
		</script> 
	<?
}
*/
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

<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P007_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
<br />
<TABLE width="900" align="center" class="table2">
	<caption>FORMULARIO DE BANCO DE BATERIAS GG</caption>	
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

<TABLE>

	<tr><th colspan="2"><strong class="verde">1.- Relevamiento JJajja</strong></th></tr>
	<tr> <!-- Filas -->
		<th width="25%">Estación</th>	<!-- Columna -->
		<td width="75%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td> <!-- Columna -->
	</tr>
	<tr>
		<th width="25%">Titulo</th>
		
		<td width="75%" class="resaltar">
			<input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" />
		</td>
	</tr>
	
	<tr><th colspan="2"><strong class="verde">1.- Relevamiento</strong></th></tr>
	
	<tr>
		<th width="25%">Tiene Banco de Baterias</th>
		<td width="75%">
			<select name="p01">
				<option value="...">...</option>
				<option value="SI">SI</option>
				<option value="NO">NO</option>
			</select>
		</td>
	</tr>
	<tr>
		<th width="25%">Estado</th>
		<td width="75%">
			<select name="p02">
				<option value="...">...</option>
				<option value="En funcionamiento">En funcionamiento</option>
				<option value="Degradado">Degradado</option>
				<option value="No existe">No existe</option>
			</select>
		</td>
	</tr>
	<tr>
	  <th width="25%">Marca</th>
	  <td width="75%"><input name="p03" type="text" id="p03" size="15" /></td>
	</tr>
	<tr>
	  	<th width="25%">Modelo</th>
		<td width="75%"><input name="p04" type="text" id="p04" size="15" /></td>
	</tr>
	<tr>
	  	<th width="25%">Voltaje (V)</th>
		<td width="75%"><input name="p05" type="text" id="p05" size="15" /></td>
	</tr>
	<tr>
	  	<th width="25%">Capacidad (Ah)</th>
		<td width="75%"><input name="p06" type="text" id="p06" size="15" /></td>
	</tr>
	<tr>
	  	<th width="25%">Cantidad</th>
		<td width="75%"><input name="p07" type="text" id="p07" size="15" /></td>
	</tr>
	<tr>
	<tr>
	  	<th width="25%">Autonomia Real</th>
		<td width="75%"><input name="p08" type="text" id="p08" size="15" /></td>
	</tr>
	<tr>
		<th width="25%">Tiene gabinete propio</th>
		<td width="75%">
			<select name="p09">
				<option value="...">...</option>
				<option value="SI">SI</option>
				<option value="NO">NO</option>
			</select>
		</td>
	</tr>
</table>
<br />
<table  width="900" align="center" class="table2">

		<tr><th colspan="5"><strong class="verde">2. Mantenimiento Preventivo</strong></th></tr>

		<tr align="center">
			<td class='cafe' width='10%'><b>No. Celda</b></td>
			<td class='cafe'>Voltaje Descarga  [V]</td>
			<td class='cafe'>Temperatura [°C]</td>
			<td class='cafe'>Densidad [Baumes]</td>
			<td class='cafe'>Tiempo de descarga y/o observaciones</td>
		</tr>
		<?
		$text =	"1;;;;|2;;;;|3;;;;|4;;;;|5;;;;|6;;;;|7;;;;|8;;;;|9;;;;|10;;;;|".
				"11;;;;|12;;;;|13;;;;|14;;;;|15;;;;|16;;;;|17;;;;|18;;;;|19;;;;|20;;;;|".
				"21;;;;|22;;;;|23;;;;|24;;;;|25;;;;|26;;;;|27;;;;|28;;;;|29;;;;|30;;;;|TOTAL;;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		/*foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align='center'>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p10$a' id='p10$a$b' type='hidden' value='$subarray[$i]'>";
				}else{
					if($a%5 == 0)
						if($a == 125)
							$result .= "<td><input type='hidden' name='p10$a' value='' /></td>";
						else
							$result .= "<td><input name='p10$a' type='text' id='p10$a$b' value='$subarray[$i]' size='30'/></td>";
					else{
						if($a == 123 || $a == 124)
							$result .= "<td><input type='hidden' name='p10$a' value='' />$a</td>";
						else
							$result .= "<td><input name='p10$a' type='text' id='p10$a$b' value='$subarray[$i]' size='7'/></td>";
					}
				}
				$a++;
			}
			$result .= "</tr>";
		}*/
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align='center'>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p10$a' id='p10$a$b' type='hidden' value='$subarray[$i]'>";
				}else{
					if($a%5 == 0)
						$result .= "<td><input name='p10$a' type='text' id='p10$a$b' value='$subarray[$i]' size='30'/></td>";
					else
						$result .= "<td><input name='p10$a' type='text' id='p10$a$b' value='$subarray[$i]' size='7'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size10" value="<?=$a?>" />
</table>
<br/>
<table  width="900" align="center" class="table2">
	<tr>
		<td width="40%">Verificar conexiones en bornes (ajustados)</td>
		<td width="60%"><input name="p11" type="text" id="p11" size="20" /></td>
	</tr>
	<tr>
		<td width="40%">Verificar limpieza de los Bornes</td>
		<td width="60%"><input name="p12" type="text" id="p12" size="20" /></td>
	</tr>
	<tr>
		<td width="40%">Verificar nivel de Agua Destilada</td>
		<td width="60%"><input name="p13" type="text" id="p13" size="20" /></td>
	</tr>
	<tr>
		<td width="40%">Porcentaje de carga  Banco de Baterias en Servicio (%)</td>
		<td width="60%"><input name="p14" type="text" id="p14" size="20" /></td>
	</tr>
</table>

<table width="900" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
		<td>
			<input name="guardar" id="guardar" type="submit"  value="Guardar" />
			<input type="button" name="Submit" value="<< Atras" onclick="javascript:history.back(1)" />
		</td>
	</tr>
</table>
</form>

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
	calendar = new Epoch('dp_cal','popup',document.getElementById('fecha_ini'));
	calendarb = new Epoch('dp_cal','popup',document.getElementById('fecha_fin'));
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
    if( checkField( document.amper.cliente, isName, false ) &&
	    isNull( document.amper.fecha_ini) &&
		isNull( document.amper.obs) 
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