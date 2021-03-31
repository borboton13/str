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
.caf{
    text-align:right;
}
.cafi{
    text-align:left;
}
</STYLE>



</HEAD>
<BODY>
<?  

$web=$_SESSION["web"];

if (isset($_GET['idevento']))   $idevento     = $_GET['idevento'];
if (isset($_GET['idform']))     $idformulario = $_GET['idform'];
if (isset($_GET['nombreForm'])) $nombreForm   = $_GET['nombreForm'];
if (isset($_GET['idgrupo'])) $nombreForm   = $_GET['idgrupo'];


$resultado = mysql_query("
SELECT ev.idevento, ev.estado, ev.inicio,g.idgrupo , ev.fin, es.codigo as codigoest, es.nombre as nombreest,es.departamento as departamento,es.provicia as provincia, g.codigo AS codigog, c.idcentro, c.codigo as codCentro,c.nombre as nombrecentro FROM evento ev
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

$res_papa = mysql_query("
SELECT CONCAT(u1.nombre,' ', u1.ap_pat, ', ',u2.nombre,' ', u2.ap_pat) AS userx
FROM grupo g
JOIN usuarios u1 ON g.user1 = u1.id
JOIN usuarios u2 ON g.user2 = u2.id
JOIN evento e ON e.idgrupo = g.idgrupo
WHERE e.idevento = '$idevento' ");

$data = mysql_fetch_array($res_papa);

$arrs = explode('-', $data['inicio']);



$resp			= $data['userx'];

?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P002v_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />

<table width="1000" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO <br /> ESTRUCTURA</caption>
</table>

	
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
			<input name="responsable" type="text" id="responsable" size="30" value="<? ECHO($resp);?>" />
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
			<input name="fechamantenimiento" type="text" id="fechamantenimiento" size="10" class="Text_left"  value="<? ECHO($ini);?>" value="" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)" readonly="yes"/>
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

<table width="1000" align="center" class="table2">

	<tr>
		<th width="25%">Estación</th>
		<td width="75%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td>
	</tr>
	<tr>
		    <th width="25%">Formulario</th>
			<td width="75%"><input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" maxlength="" /></td>
	</tr>
	
		<tr>
		<th width="25%">Titulo</th>
		<td width="75%"><input name="tate" type="text" id="tate"  size="70" maxlength=""/></td>
	</tr>
	
	<tr>
		<th colspan="2"><strong class="verde">1.- Relevamiento</strong></th>
	</tr>
	
	<tr>
		<th><strong>ESTRUCTURA 1</strong></th>
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
	<tr>
		<th><strong>ESTRUCTURA 2</strong></th>
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
		<th width="25%">Tipo de cerramiento perimetral</th>
		<td width="75%">
			<select name="p08">
				<option value="...">...</option>
				<option value="Enmallado">Enmallado</option>
				<option value="Muro de ladrillo">Muro de ladrillo</option>
			</select>
		</td>
	</tr>
	
	<tr>
	  <th width="25%">Dimensión de estación (ancho x largo (metros))</th>
	  <td width="75%"><input name="p09" type="text" id="p09" size="10" /></td>
	</tr>
	
	<tr>
	  <th width="25%">Losa equipos (ancho x largo (metros))</th>
	  <td width="75%"><input name="ps10" type="text" id="ps10" size="10" /></td>
	</tr>
	
	<tr>
	  <th width="25%">Losa o caseta grupo generador (ancho x largo (metros))</th>
	  <td width="75%"><input name="ps11" type="text" id="ps11" size="10" /></td>
	</tr>
	
	
	<tr>
	  <th width="25%">Caseta de Sereno (ancho x largo (metros))</th>
	  <td width="75%"><input name="sereno" type="text" id="sereno" size="10" /></td>
	</tr>

    

				
</table>
<br />
</table>

<table  width="1300" align="center" class="table2">
	<tr>
	    
		<th colspan="2"><strong class="verde">2.- Mantenimiento Preventivo</strong></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
		<th></th>
	</tr>

	    <tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>

			
			<td align="center" colspan="6">ACCIONES</td>
		</tr>
		<tr align="center">

			<td width='12%'></td>
			<td class="cafe"></td>
			<td class="caf">DESCRIPCION ESTADO</td>
			<td class="cafi">(marque con x)</td>
		<td class="cafe"></td>
			<td width='8%'>Observacion</td>
			<td width='8%'>Reparado</td>
			<td width='8%'>Ajustado</td>
			<td width='8%'>Cambiado</td>
			<td width='8%'>Pendiente</td>

		</tr>
		<?
		$text =	"Verificar la verticalidad de la estructura.;Vertical;;;inclinado;;;;;;|Verificar si no existe puntos de oxidación en la estructura y tomar fotografías en caso de encontrar anormalidades.;Oxidado;;;Sin oxidacion;;;;;;|Verificar la tensión de los cables  de arriostramiento (Solo en torres arriostradas;Tenso;;;Suelto;;;;;;|Verificar el estado del pintado de la estructura y adjuntar fotografias en caso de encontrar anormalidades.;Pintado;;;Despintado;;;;;;|Verificar si existe hundimiento del terreno o esta estable.;Hundimiento;;;Estable;;;;;;|Verificar si los Pernos Principales estan ajustados;Ajustados;;;Desajustado;;;;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align='center'>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0 || $i == 1 || $i == 4){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p07$a' id='p07$a$b' type='hidden' value='$subarray[$i]'>";
				}if($i == 3 || $i == 5 || $i == 6){
					$result .= "<td><input name='p07$a' type='text' id='p07$a$b' value='$subarray[$i]' size='7'/></td>";
				}if($i == 7 || $i == 8 || $i == 9 || $i == 10){
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
<TABLE width="900" align="center" class="table2">
    	<tr>
		<th colspan="2"><strong class="verde">Otras observaciones</strong></th>
	</tr>
	<td colspan="2" align="center">
	<textarea name="observaciones" class="resizable" style="width: 900px; height: 80px;" id="observaciones"></textarea>
</td>
</TABLE>

<table width="1000" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
		<td>
			<input name="guardar" type="submit"  value="Guardar" />
			<input type="button" name="Submit" value="<< Atras" onclick="javascript:history.back(1)" />
		</td>
	</tr>
</table>
</form>
<script>
     var xa = $("#nombrecentro").val();
    var campo = document.getElementById('responsable');
    if(xa=='VILLA TUNARI'){
    campo.readOnly = true; // Se añade el atributo
    }
</script>
<script>
    var cm = document.getElementById('titulo');
    cm.readOnly = true; // Se añade el atributo
    
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