<?php
$web=$_SESSION["web"];

if (isset($_GET['idevento']))   $idevento     = $_GET['idevento'];
if (isset($_GET['idform']))     $idformulario = $_GET['idform'];
if (isset($_GET['nombreForm'])) $nombreForm   = $_GET['nombreForm'];

$resultado = mysql_query("
SELECT ev.idevento, ev.estado, ev.inicio, ev.fin, es.codigo as codigoest, es.nombre as nombreest, g.codigo AS codigog, c.idcentro, c.codigo as codCentro
FROM evento ev
JOIN estacion es ON ev.idestacion = es.idestacion
JOIN grupo g 	 ON ev.idgrupo = g.idgrupo
JOIN centro c    ON ev.idcentro = c.idcentro
WHERE ev.idevento = '$idevento' ");

$dato = mysql_fetch_array($resultado);

$arr = explode('-', $dato['inicio']);

$anio			= $arr[0];
$codCentro 		= $dato['codCentro'];
$ini			= $dato['inicio'];
$fin			= $dato['fin'];
$idev 			= $idevento;
$codEs			= $dato['codigoest'];
$nomEs 			= $dato['nombreest'];

$params = "&anio=$anio&codCentro=$codCentro&ini=$ini&fin=$fin&idev=$idev&codEs=$codEs&nomEs=$nomEs";
$opP01 = array("...", "SI", "NO");
$opP02 = array("...", "ACTIVO", "FUERA DE SERVICIO");

?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P017_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />

<table width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO<br>PEX_CU (MODEMS HDSL)</caption>
	<tr>
		<th width="25%">Estaci�n</th>
		<td width="75%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td>
	</tr>
	<tr>
		<th width="25%">Titulo</th>
		<td width="75%" class="resaltar"><input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" /></td>
	</tr>
	<tr><th colspan="2"><strong class="verde">1.- Relevamiento</strong></th></tr>
	<tr>
	  <th width="25%">Se tiene modems?</th>
	  <td width="75%">
		  <select name="p01" class="selectb">
			  <? foreach($opP01 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>
		  </select>
	  </td>
	</tr>

	<tr>
		<th width="25%">Estado</th>
		<td width="75%">
			<select name="p02" class="selectbuscar">
				<? foreach($opP02 as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</td>
	</tr>

	<tr>
		<th width="25%">Marca</th>
		<td width="75%"><input class="Text_left" name="p03" type="text" size="30" /></td>
	</tr>

	<tr>
		<th width="25%">Modelo</th>
		<td width="75%"><input class="Text_left" name="p04" type="text" size="30" /></td>
	</tr>

	<tr>
		<th width="25%">Salto anterior</th>
		<td width="75%"><input class="Text_left" name="p05" type="text" size="30" /></td>
	</tr>

</table>
<br />
<table  width="900" align="center" class="table2">
	<tr><th colspan="3"><strong class="verde">2.- Mantenimiento Preventivo</strong></th></tr>
	<tr align="center">
		<td width='55%'></td>
		<td>Revisado</td>
		<td>Observaciones</td>
	</tr>
	<?
	$text =	"Verificar la instalaci�n del Equipo;;|".
			"Verificar la limpieza;;|".
			"Verificar conectores;;|".
			"Verificar que los cables de energ�a y aterramiento no esten da�ados o rotos;;";
	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			switch($i){
				case 0: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p06$a' type='hidden' value='$subarray[$i]'>";
						break;
				case 1: $result .= "<td align='center'><input type='checkbox' name='p06$a' value='$a'></td>";
						break;
				default: $result .= "<td align='center'><input class='Text_left' type='text' name='p06$a' value='$subarray[$i]' size='20'/></td>";
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
<table  width="900" align="center" class="table2">

		<tr align="center">
			<td width='30%'>Listar alarmas de Radio Base por LMT</td>
			<td width='20%'>Causa</td>
			<td width='20%'>Solucion</td>
			<td width='20%'>Observaciones</td>
		</tr>
		<?
		$text =	";;;|;;;|;;;|;;;|;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td align='center'><input class='Text_left' type='text' name='p07$a' size='30'/></td>";
				}else{
					$result .= "<td align='center'><input class='Text_left' type='text' name='p07$a' size='20'/></td>";
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
<table width="900" align="center" class="table2" cellspacing="2" class="table2">
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