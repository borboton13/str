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
if (isset($_GET['idgrupo'])) $nombreForm   = $_GET['idgrupo'];

$resultado = mysql_query("SELECT * FROM formulario_p007 WHERE idevento = '$idevento' ");
$totalFilas    =    mysql_num_rows($resultado);  


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



$nombreForm = "Formulario Mtto. Preventivo Panel de Transferencia, UPS, Red Comercial y Puesto de Transformacion";
?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P011_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />

<table width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO <br>PANEL DE TRANSFERENCIA, UPS, RED COMERCIAL Y PUESTO DE TRANSFORMACIÓN</caption>
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

<table width="900" align="center" class="table2">

	<tr>
		<th width="20%">Estación</th>
		<td width="80%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td>
	</tr>
	<tr>
		<th width="20%">Titulo</th>
		<td width="80%" class="resaltar"><input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="90" maxlength=""/></td>
	</tr>
</table>
<br />
<table  width="1000" align="center" class="table2">
		<tr>
			<td class="cafe">ATS – CUBICAL DE CONTROL:</td>
			<td align="center" colspan="6">ANTES MTTO.</td>
			<td align="center" colspan="4">DESPUES MTTO.</td>
			<td></td>
		</tr>
		<tr align="center">
			<td width='40%'></td>
			<td width='6%'>No Existe</td>
			<td width='6%'>Malo</td>
			<td width='6%'>Bajo</td>
			<td width='6%'>Medio</td>
			<td width='6%'>Alto</td>
			<td width='6%'>Bueno</td>
			<td width='6%'>Reparado</td>
			<td width='6%'>Ajustado</td>
			<td width='6%'>Cambiado</td>
			<td width='6%'>Pendiente</td>
			<td width='6%'>Otro</td>
		</tr>
		<?
		$text =	"Verificación de indicadores luminosos (leds, focos) en el tablero de Control;;;;;;;;;;;|".
				"Comprobación de los medidores en el panel de control;;;;;;;;;;;|".
				"Verificar que todos los cables y tornillos terminales estén ajustados;;;;;;;;;;;|".
				"Verificar la operación de todos los circuitos de protección;;;;;;;;;;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p01$a' type='hidden' value='$subarray[$i]'>";
				}else{
					if($i == 11)
						$result .= "<td align='center'><input class='Text_left' type='text' name='p01$a' size='4'></td>";
					else
						$result .= "<td align='center'><input type='checkbox' name='p01$a' value='$a'></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size1" value="<?=$a?>" />
</table>
<br />
<table  width="1000" align="center" class="table2">
		<tr>
			<td width="35%"></td>
			<td width="13%"></td>
			<td width="13%"></td>
			<td width="13%"></td>
			<td width="13%"></td>
			<td width="13%"></td>
		</tr>
		<?
		$text =	"Tiempo de arranque automático y transferencia a carga;[Segundos];T arranque:;;T transferen.:;|".
				"Tiempo de retransferencia automática  y parada;[Segundos];T retransfer.:;;T parada:;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0:
					case 1:
					case 2:
					case 4: $result .= "<td align='center'>$subarray[$i]</td>";
							$result .= "<input name='p02$a' type='hidden' value='$subarray[$i]'>";
							break;
					default: $result .= "<td align='center'><input class='Text_left' name='p02$a' type='text' size='7'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size2" value="<?=$a?>" />
</table>
<br />
<table  width="1000" align="center" class="table2">
		<tr>
			<td class="cafe">Funcionamiento de indicadores (display, medidores de aguja, LEDs y focos):</td>
			<td align="center" colspan="3">ANTES MTTO.</td>
			<td align="center" colspan="4">DESPUES MTTO.</td>
			<td></td>
		</tr>
		<tr align="center">
			<td width='28%'></td>
			<td width='9%'>No Existe</td>
			<td width='9%'>Mal</td>
			<td width='9%'>Bien</td>

			<td width='9%'>Mal</td>
			<td width='9%'>Bien</td>
			<td width='9%'>Ajustado</td>
			<td width='9%'>Pendiente</td>
			<td width='9%'>Otro</td>
		</tr>
		<?
		$text =	"Sobrevelocidad;;;;;;;;|".
				"Bajo nivel de aceite;;;;;;;;|".
				"Alta temperatura del motor;;;;;;;;|".
				"Alto / Bajo voltaje.;;;;;;;;|".
				"Sistema de Arranque;;;;;;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p03$a' type='hidden' value='$subarray[$i]'>";
				}else{
					if($i == 8)
						$result .= "<td align='center'><input class='Text_left' type='text' name='p03$a' size='6'></td>";
					else
						$result .= "<td align='center'><input type='checkbox' name='p03$a' value='$a'></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size3" value="<?=$a?>" />
</table>
<br />

<table  width="700" align="center" class="table2">
		<?
		$text =	"Registrar valor del Voltímetro;[V];|".
				"Registrar valor del Amperímetro;[A];|".
				"Registrar valor de Frecuencimetro;[Hz];";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0:
					case 1: $result .= "<td align='center'>$subarray[$i]</td>";
							$result .= "<input name='p04$a' type='hidden' value='$subarray[$i]'>";
							break;
					default: $result .= "<td align='center'><input class='Text_left' name='p04$a' type='text' size='7'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size4" value="<?=$a?>" />
</table>
<br />
<table  width="700" align="center" class="table2">
		<?
		$text =	"Estado de Operación Transferencia Automatico (S/N);Bien:;;Mal:;|".
				"Indicaciones de Alarmas (S/N);SI;;NO;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0:
					case 1:
					case 3: $result .= "<td align='center'>$subarray[$i]</td>";
							$result .= "<input name='p05$a' type='hidden' value='$subarray[$i]'>";
							break;
					default: $result .= "<td align='center'><input type='checkbox' name='p05$a' value='$a'></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size5" value="<?=$a?>" />
</table>
<br />
<table  width="700" align="center" class="table2">
		<tr>
			<td width='46%' class="cafe">Medidas eléctricas de energía comercial </td>
			<td colspan="3" align="center"><b>ANTES MTTO.</b></td>
			<td colspan="3" align="center"><b>DESPUES MTTO.</b></td>
		</tr>
		<tr align="center">
			<td width='46%'></td>
			<td>Fase 1</td>
			<td>Fase 2</td>
			<td>Fase 3</td>
			<td>Fase 1</td>
			<td>Fase 2</td>
			<td>Fase 3</td>
		</tr>
		<?
		$text =	"Voltaje  AC de Entrada [V];;;;;;|".
				"Corriente consumida por la estación [A];;;;;;|".
				"Corriente consumida por equipos (carga técnica) en la estación [A];;;;;;|".
				"Frecuencia [Hz];;;;;;|".
				"Lectura del medidor de energía [Kwh];;;;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		/*foreach ($arrays as $array){*/
		for ($f = 0; $f < sizeof($arrays); $f++) {
			$array = $arrays[$f];
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($f==3 || $f==4){
					switch($i){
						case 0: $result .= "<td>$subarray[$i]</td>";
								$result .= "<input name='p06$a' id='$a$b' type='hidden' value='$subarray[$i]'>";
								break;
						case 1:
						case 4:	$result .= "<td colspan='3' align='center'><input class='Text_center' name='p06$a' type='text' size='20'/></td>";
								break;
						default: $result .= "<input name='p06$a' type='hidden' value='$subarray[$i]'>";
					}
				}else{
					switch($i){
						case 0: $result .= "<td>$subarray[$i]</td>";
								$result .= "<input name='p06$a' id='$a$b' type='hidden' value='$subarray[$i]'>";
								break;
						default: $result .= "<td align='center'><input class='Text_left' name='p06$a' type='text' size='4'/></td>";
					}
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size6" value="<?=$a?>" />
</table>
<br />
<table  width="700" align="center" class="table2">
		<?
		$text =	"Verificar , limpiar y controlar distribuidores de energía comercial AC (tableros de distribución), para prevenir sobrecargas en térmicos;Equilibrado:;;Desequilibrado:;|".
				"Revisión de calentamiento del cableado en AC por sobrecarga. ;Normal:;;Caliente:;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0:
					case 1:
					case 3: $result .= "<td align='center'>$subarray[$i]</td>";
							$result .= "<input name='p07$a' type='hidden' value='$subarray[$i]'>";
						break;
					default: $result .= "<td width='7%' align='center'><input type='checkbox' name='p07$a' value='$a'></td>";
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
<table  width="700" align="center" class="table2">
		<tr>
			<td width='40%' align="center" class="cafe"><b>U P S</b></td>
			<td colspan="3" align="center"><b>ANTES MTTO.</b></td>
			<td colspan="3" align="center"><b>DESPUES MTTO.</b></td>
		</tr>
		<tr align="center">
			<td width='40%'></td>
			<td>Fase 1</td>
			<td>Fase 2</td>
			<td>Fase 3</td>
			<td>Fase 1</td>
			<td>Fase 2</td>
			<td>Fase 3</td>
		</tr>
		<?
		$text =	"Voltaje  AC de Entrada [V];;;;;;|".
				"Corriente de Entrada [A];;;;;;|".
				"Frecuencia de Entrada [Hz];;;;;;|".
				"Voltaje DC del banco de baterías [V];;;;;;|".
				"Corriente DC de Salida [A];;;;;;|".
				"Voltaje  AC a la salida [V];;;;;;|".
				"Corriente AC a la salida [A];;;;;;|".
				"Frecuencia de Salida [Hz];;;;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		/*foreach ($arrays as $array){*/
		for ($f = 0; $f < sizeof($arrays); $f++) {
			$array = $arrays[$f];
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($f>=2 && $f<=7){
					switch($i){
						case 0: $result .= "<td align='center'>$subarray[$i]</td>";
								$result .= "<input name='p08$a' type='hidden' value='$subarray[$i]'>";
								break;
						case 1:
						case 4:	$result .= "<td colspan='3' align='center'><input class='Text_center' name='p08$a' type='text' size='20'/></td>";
								break;
						default: $result .= "<input name='p08$a' type='hidden' value='$subarray[$i]'>";
						//default: $result .= "<td>$i</td>";
					}
				}else{
					switch($i){
						case 0: $result .= "<td align='center'>$subarray[$i]</td>";
								$result .= "<input name='p08$a' type='hidden' value='$subarray[$i]'>";
								break;
						default: $result .= "<td align='center'><input class='Text_left' name='p08$a' type='text' size='4'/></td>";
					}
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size8" value="<?=$a?>" />
</table>
<br />
<table  width="700" align="center" class="table2">
		<?
		$text =	"Verificar y controlar la distribución de AC  UPS en tableros de la estación.;Equilibrado:;;Desequilibrado:;|".
				"Revisión de sobrecalentamiento del cableado en AC y DC.;Normal:;;Caliente:;|".
				"Indicación de Alarmas activadas;SI;;NO;|".
				"Temperatura de baterías del banco;Normal:;;Caliente:;|".
				"Porcentaje de carga Pu/Pn;[%];;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		//foreach ($arrays as $array){
		for ($f = 0; $f < sizeof($arrays); $f++) {
			$array = $arrays[$f];
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($f!=4){
					switch($i){
						case 0:
						case 1:
						case 3: $result .= "<td align='center'>$subarray[$i]</td>";
								$result .= "<input name='p09$a' type='hidden' value='$subarray[$i]'>";
								break;
						default: $result .= "<td width='7%' align='center'><input type='checkbox' name='p09$a' value='$a'></td>";
					}
				}else{
					switch($i){
						case 0:
						case 1: $result .= "<td align='center'>$subarray[$i]</td>";
								$result .= "<input name='p09$a' type='hidden' value='$subarray[$i]'>";
								break;
						case 2: $result .= "<td width='7%' align='center' colspan='3'><input type='text' class='Text_center' name='p09$a' size='15' ></td>";
								break;
						default: $result .= "<input name='p08$a' type='hidden' value='$subarray[$i]'>";
					}
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size9" value="<?=$a?>" />
</table>
<br />
<table width="700" align="center" class="table2" cellspacing="2" class="table2">
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