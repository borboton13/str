<HTML>
<HEAD>
<TITLE> Título de la página </TITLE>



    

   <!-- Esto es un comentario  <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">-->
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
	<script src="https://cdn.rawgit.com/kimmobrunfeldt/progressbar.js/0.5.6/dist/progressbar.js"></script>

	<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
	<script type="text/javascript" src="https://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>




</HEAD>
<BODY>
<?  

$web=$_SESSION["web"];

if (isset($_GET['idevento']))   $idevento     = $_GET['idevento'];
if (isset($_GET['idform']))     $idformulario = $_GET['idform'];
if (isset($_GET['nombreForm'])) $nombreForm   = $_GET['nombreForm'];

$resultado = mysql_query("SELECT * FROM p002_formulario WHERE idevento = '$idevento' ");
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


	<tr id="estru">
		<th id="estructura"><strong>ESTRUCTURA 1</strong></th>
		<td></td>
	</tr>
	
	<tr>
		<th width="25%">Estado</th>
		<td width="75%">
			<select name="p01">
				<option value="...">...</option>
				<option value="En uso">En uso</option>
				<option value="En desuso">En desuso</option>
			</select>
		</td>
	</tr>
	<tr>
		<th width="25%">Tipo de esctructura</th>
		<td width="75%">
			<select name="p02">
				<option value="...">...</option>
				<option value="Gabinete outdoor de calle">Gabinete outdoor de calle</option>
				<option value="Monoposte">Monoposte</option>
				<option value="Torre Arriostrada GreenField">Torre Arriostrada GreenField</option>
				<option value="Torre Arriostrada Rooftop">Torre Arriostrada Rooftop</option>
				<option value="Torre Autosoportada GreenField">Torre Autosoportada GreenField</option>
				<option value="Torre Autosoportada Rooftop">Torre Autosoportada Rooftop</option>
				<option value="Reticular">Reticular</option>
				<option value="Wall Mounting">Wall Mounting</option>
				<option value="InDoor">InDoor</option>
				<option value="Poste">Poste</option>
				<option value="Tanque">Tanque</option>
				
			</select>
		</td>
	</tr>
	<tr>
	  <th width="25%">Altura de la estructura (m)</th>
	  <td width="75%"><input name="p03" type="text" id="p03" size="10" /></td>
	</tr>




	<tr id="estru">
		<th id="estructura"><strong>ESTRUCTURA 2</strong></th>
		<td></td>
	</tr>
	<tr>
		<th width="25%">Estado</th>
		<td width="75%">
			<select name="p04">
				<option value="...">...</option>
				<option value="En uso">En uso</option>
				<option value="En desuso">En desuso</option>
			</select>
		</td>
	</tr>
	<th width="25%">Tipo de esctructura</th>
		<td width="75%">
			<select name="p05">
				<option value="...">...</option>
				<option value="Cow">Cow</option>
				<option value="Monoposte">Monoposte</option>
				<option value="Mastil">Mastil</option>
				<option value="Torre Arriostrada GreenField">Torre Arriostrada GreenField</option>
				<option value="Torre Arriostrada Rooftop">Torre Arriostrada Rooftop</option>
				<option value="Torre Autosoportada GreenField">Torre Autosoportada GreenField</option>
				<option value="Torre Autosoportada Rooftop">Torre Autosoportada Rooftop</option>
				<option value="Reticular">Reticular</option>
				<option value="Wall Mounting">Wall Mounting</option>
				<option value="InDoor">InDoor</option>
				<option value="Poste">Poste</option>
				<option value="Tanque">Tanque</option>
				<tr>
	  <th width="25%">Altura de la estructura (m)</th>
	  <td width="75%"><input name="p06" type="text" id="p06" size="10" /></td>
	</tr>
	
	
		<tr>
		<th><strong>ESTACION</strong></th>
		<td></td>
	</tr>
	
	<tr>
		<th width="25%">Tipo de Cerramiento perimetral</th>
		<td width="75%">
			<select name="p01">
				<option value="...">...</option>
				<option value="En uso">Enmallado</option>
				<option value="En desuso">Muro de ladrillo</option>
			</select>
		</td>
	</tr>

	<tr>
	  <th width="25%">Dimensión de la estación (m)</th>
	  <td width="75%"><input name="p03" type="text" id="p03" size="10" /></td>
	</tr>

		<tr>
	  <th width="25%">Losa de equipos (m)</th>
	  <td width="75%"><input name="p03" type="text" id="p03" size="10" /></td>
	</tr>

	<tr>
	  <th width="25%">Losa o caseta grupo generador (m)</th>
	  <td width="75%"><input name="p03" type="text" id="p03" size="10" /></td>
	</tr>

	<tr>
	  <th width="25%">Caseta de sereno (m)</th>
	  <td width="75%"><input name="p03" type="text" id="p03" size="10" /></td>
	</tr>

	
	<tr>
		<th colspan="2"><strong class="verde">2.- Mantenimiento Preventivo</strong></th>
	</tr>
				
</table>
<br />
<table  width="1000" align="center" class="table2">

		<tr align="center">
			<td width='40%'></td>
			<td width='6%' class="azul2">No Existe</td>
			<td width='6%'>Malo</td>
			<td width='6%'>Bajo</td>
			<td width='6%'>Medio</td>
			<td width='6%'>Alto</td>
			<td width='6%'>Bueno</td>
			<td width='6%'>Reparado</td>
			<td width='6%'>Ajustado</td>
			<td width='6%'>Cambiado</td>
			<td width='6%'>Pendiente</td>
		</tr>
		<?
		$text =	"Verificar la verticalidad de la estructura;;;;;;;;;;|".
		"Verificar si no existe puntos de oxidación en la estructura y tomar fotografías en caso de encontrar anormalidades.;;;;;;;;;;|".
		"Verificar la tensión de los cables de arriostramiento;;;;;;;;;;|".
		"Verificar el estado del pintado de la estructura y adjuntar fotografías en caso de encontrar anormalidades.;;;;;;;;;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p07$a' id='p07$a$b' type='hidden' value='$subarray[$i]'>";
				}else{
					$result .= "<td align='center'><input type='checkbox' name='p07$a' value='$a'></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size7" value="<?=$a?>" />
</table>
<br />
<table width="1000" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
		<td>
			<input name="guardar" type="submit"  value="Guardar" />
			<input type="button" name="Submit" value="<< Atras" onclick="javascript:history.back(1)" />
		</td>
	</tr>
</table>
</form>

<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<!--<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css" />

<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet />-->
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>
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
<!--
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />-->
<!--
<link href="../../paquetes/tooltip/tooltip.css" rel="stylesheet" type="text/css">-->
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

		$('#boton').click(function(){
			//alert('Boton presionado');	
			////////////////////////////encabezado y punto 1 + Observaciones	
		
		var mensaje;
    	var opcion = confirm("Guardar los cambios?");
    	if (opcion == true) {
				/*Creamos la instancia del objeto. Ya estamos conectados*/
		//alert('as');
			var idevento= $('#idevento').val();

			jQuery.post("../../paquetes/ajax/insertar_formulario_mtto_n_p002.php", {
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

			jQuery.post("../../paquetes/ajax/insertar_p002_formulario.php", {
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
			
			/////////////////////////////////////////////////////////////

			var rowsp019_8 = $('#p019_8').datagrid('getRows');			
			//alert(rowspruebasservicio.length);	

			
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
<!--
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css" />-->
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>



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
<!--<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet /><link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="../../paquetes/tooltip/tooltip.css" rel="stylesheet" type="text/css">-->
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