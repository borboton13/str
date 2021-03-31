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
if (isset($_GET['idformtto'])) $idformtto 	= $_GET['idformtto'];
if (isset($_GET['nombreForm'])) $nombreForm   = $_GET['nombreForm'];
if (isset($_GET['params']))       $params	= base64_decode($_GET['params']);

$resultado = mysql_query("
SELECT ev.idevento, ev.estado, ev.inicio, ev.fin, es.codigo as codigoest, es.nombre as nombreest,es.departamento as departamento,es.provicia as provincia, g.codigo AS codigog, c.idcentro, c.codigo as codCentro,c.nombre as nombrecentro, h.id, f.responsable, f.fechamantenimiento FROM evento ev
JOIN estacion es ON ev.idestacion = es.idestacion
JOIN grupo g 	 ON ev.idgrupo = g.idgrupo
JOIN centro c    ON ev.idcentro = c.idcentro
JOIN formulario_p001v h ON ev.idevento = h.idevento
JOIN p001v_formulario f ON h.id = f.id
WHERE h.id = '$idformtto' ");
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
$responsable 	= $dato['responsable'];
$fechamantenimiento 		= $dato['fechamantenimiento'];


$resultados=mysql_query("SELECT localidad FROM estacion,estacionentel
WHERE estacion.codigo=estacionentel.idsitio
AND estacion.codigo='$codEs'");

$datolocalidad = mysql_fetch_array($resultados);
$localidad=$datolocalidad["localidad"];


//$params = "&anio=$anio&codCentro=$codCentro&ini=$ini&fin=$fin&idev=$idev&codEs=$codEs&nomEs=$nomEs";

$resultQuery = mysql_query("SELECT * FROM formulario_p001v p WHERE p.id = ".$idformtto);
$result      = mysql_fetch_array($resultQuery);

$titulo = $result['titulo'];
$p01	= $result['p01'];
$p02	= $result['p02'];
$p03	= $result['p03'];
$p04	= $result['p04'];
$p05	= $result['p05'];
$p06	= $result['p06'];
$p07	= $result['p07'];
$p08	= $result['p08'];
$p11	= $result['p11'];
$p09	= $result['p09'];
$p10	= $result['p10'];
$observaciones	= $result['observaciones'];


$opTipoEstacion = array("...", "Edificio tecnico", "Greenfield", "Rooftop", "Gabinete outdoor de calle");
$opPropiedad = array("...", "Alquilada", "Comodato", "Propiedad Tigo", "Propiedad BTV", "Propiedad ENTEL");
$opcionSN = array("...", "SI", "NO");

?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P001v_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
	<input type="hidden" name="idformtto" value="<?=$idformtto?>" />

<table width="900" align="center" class="table2">
	<caption>MODIFICAR FORMULARIO DE MANTENIIENTO PREVENTIVO <br>SITIO</caption>
</table>


	<br />
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
			<input name="responsable" type="text" id="responsable" size="30" value="<? ECHO(utf8_decode($responsable));?>" />
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
			<input name="fechamantenimiento" value="<? ECHO($fechamantenimiento);?>" type="text" id="fechamantenimiento" size="10" class="Text_left" value="" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)" readonly="yes"/>
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
		<th width="25%">Titulo</th>
		<td width="75%"><input name="titulo" type="text" id="titulo" value="<?=$titulo?>" size="70" maxlength=""/></td>
	</tr>
	<tr>
		<th width="25%">CM/SCM</th>
		<td width="75%"><?=$nomCentro?></td>
	</tr>
	<tr>
		<th width="25%">Nombre de Responsables:</th>
		<td width="75%">
			<?=$nomGrupo?>&nbsp;&nbsp;
			<? echo "<span class='cafe'><b>Fecha de Mantenimiento: </b></span>" . $ini; ?>
		</td>
	</tr>
	<tr>
		<th width="25%">Departamento:</th>
		<td width="75%"><?=$depto?></td>
	</tr>
	<tr>
		<th width="25%">Estación</th>
		<td width="75%"><? echo $nomEs . "&nbsp;&nbsp;&nbsp;&nbsp;<span class='cafe'><b>ID Estación:</b></span> " . $codEs ?></td>
	</tr>

	<tr><th colspan="2"><strong class="verde">1.- Relevamiento</strong></th></tr>
	<tr>
		<th width="25%">Dirección:</th>
		<td width="75%"><input name="p01" type="text" id="p01" size="60" value="<?=$p01?>" /></td>
	</tr>
	<tr>
	  <th width="25%">Tipo de estación</th>
	  <td width="75%">
		  <select name="p02">
			  <?
			  foreach($opTipoEstacion as $opcion){
				  echo '<option value="'.$opcion.'" ';
				  if($opcion == $p02) echo 'selected';
				  echo'>'.$opcion.'</option>';
			  }
			  ?>
		  </select>
	  </td>
	</tr>
	<tr>
		<th width="25%">Propiedad</th>
		<td width="75%">
			<select name="p03">
				<?
				foreach($opPropiedad as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p03) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<th width="25%">Requiere desmalezado?</th>
		<td width="75%">
			<select name="p04">
				<?
				foreach($opcionSN as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p04) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>

	<tr>
	  <th width="25%">Horarios de accesibilidad al sitio</th>
	  <td width="75%"><input name="p05" type="text" id="p05" size="5" value="<?=$p05?>" /> Horas</td>
	</tr>
</table>

<br />
<table  width="900" align="center" class="table2">
		<tr align="center">
			<td width='20%'></td>
			<td colspan="2"><b>Temporada Seca</b></td>
			<td colspan="2"><b>Temporada Lluvia</b></td>
			<td></td>
		</tr>

		<tr align="center">
			<td class='cafe' width='20%'><b>Tipo de acceso</b></td>
			<td class='cafe'>Distancia Km</td>
			<td class='cafe'>Tiempo en hrs</td>
			<td class='cafe'>Distancia Km</td>
			<td class='cafe'>Tiempo en hrs</td>
			<td class='cafe'>Observaciones</td>
		</tr>
		<?
		$text = $p06;	//"ASFALTO;;;;;|TIERRA;;;;;|A PIE;;;;;|FLUVIAL;;;;;|AEREA;;;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align='center'>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p06$a' id='p06$a$b' type='hidden' value='$subarray[$i]'>";
				}else{
					$result .= "<td><input name='p06$a' type='text' id='p06$a$b' value='$subarray[$i]' size='6'/></td>";
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
<table  width="1050" align="center" class="table2">

	<tr align="center">
		<td width='40%'></td>
		<td width='6%' class="azul2">Malo</td>
		<td width='6%'>Bueno</td>
		<td width='6%'>Observaciones</td>
	</tr>
	<?


	$text = $p07;
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
					
				}if($i == 3){
					$result .= "<td><input name='p07$a' type='text' id='p07$a$b' value='$subarray[$i]' size='7'/></td>";
					
				}if($i == 1 || $i == 2){
					$result .= "<td align='center'><input type='checkbox' name='p07$a' value='$a'";
					if($subarray[$i] == $a) $result .= "checked";
					$result .= " ></td>";
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
<table  width="1050" align="center" class="table2">
		<tr><td colspan="11"><strong class="verde">2.- Mantenimiento Preventivo</strong></td></tr>
		<tr align="center">
			<td width='40%'></td>
			<td width='6%'>No Existe</td>
			<td width='6%'>Ejecutado</td>
			<td width='6%'>Observaciones</td>
		</tr>
		<?

		$text = $p08;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
			if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p08$a' id='p08$a$b' type='hidden' value='$subarray[$i]'>";
					
				}if($i == 3){
					$result .= "<td><input name='p08$a' type='text' id='p08$a$b' value='$subarray[$i]' size='8'/></td>";
					
				}if($i == 1 || $i == 2){
					$result .= "<td align='center'><input type='checkbox' name='p08$a' value='$a'";
					if($subarray[$i] == $a) $result .= "checked";
					$result .= " ></td>";
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
<table  width="1050" align="center" class="table2">

		<tr align="center">
			<td width='40%'></td>
			<td width='6%'>No Existe</td>
			<td width='6%'>Existe</td>
			<td width='6%'>Observaciones</td>
		</tr>
		<?

		$text = $p11;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
			if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p11$a' id='p11$a$b' type='hidden' value='$subarray[$i]'>";
					
			}if($i == 3){
					$result .= "<td><input name='p11$a' type='text' id='p11$a$b' value='$subarray[$i]' size='11'/></td>";
					
				}if($i == 1 || $i == 2){
					$result .= "<td align='center'><input type='checkbox' name='p11$a' value='$a'";
					if($subarray[$i] == $a) $result .= "checked";
					$result .= " ></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size11" value="<?=$a?>" />
</table>
<br />
<table  width="1050" align="center" class="table2">
		<tr align="center">
			<td width='40%'>VERIFICACIÓN DE SISTEMA DE ILUMINACIÓN:</td>
			<td width='6%'>No Existe</td>
			<td width='6%'>Correcta</td>
			<td width='6%'>Incorrecta</td>
			<td width='6%'>Observaciones</td>
		</tr>
		<?
		/*$text =	"<b>ILUMINACION:</b>;;;;;;;;;;|
				 Focos de Balizamiento en AC y DC;;;;;;;;;;|
	             Iluminación de salas de energía y equipos;;;;;;;;;;|
	             Iluminación de exteriores, dentro el cerco perimetral de repetidoras;;;;;;;;;;";*/
		$text = $p09;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p09$a' id='p09$a$b' type='hidden' value='$subarray[$i]'>";
					
				}if($i == 4){
					$result .= "<td><input name='p09$a' type='text' id='p09$a$b' value='$subarray[$i]' size='9'/></td>";
					
				}if($i == 1 || $i == 2 || $i == 3){
					$result .= "<td align='center'><input type='checkbox' name='p09$a' value='$a'";
					if($subarray[$i] == $a) $result .= "checked";
					$result .= " ></td>";
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
<table  width="1050" align="center" class="table2">
		<tr align="center">
			<td width='40%'>ESTRUCTURA METÁLICA:</td>
			<td width='6%'>No Existe</td>
			<td width='6%'>Correcta</td>
			<td width='6%'>Incorrecta</td>
			<td width='6%'>Observaciones</td>
		</tr>
		<?
		/*$text =	"<b>ESTRUCTURA METALICA:</b>;0;0;0;0;0;0;0;0;0;0|
				 Control Tensores, Riendas y Anclajes.;0;0;0;0;0;0;0;0;0;0|
	             Verificación del estado de coaxiales, f.o., cableado de bajada.;0;0;0;0;0;0;0;0;0;0|
	             Verificación Puesta a Tierra.;0;0;0;0;0;0;0;0;0;0|
	             Control y ajuste de buloneria;0;0;0;0;0;0;0;0;0;0|
	             Control de corrosión de torre, portones y partes metálicas.;0;0;0;0;0;0;0;0;0;0|
	             Control de Cerraduras y Candados.;0;0;0;0;0;0;0;0;0;0|
	             Control de Verticalidad;0;0;0;0;0;0;0;0;0;0|
	             Verificar puertas y chapas;0;0;0;0;0;0;0;0;0;0";*/
		$text = $p10;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p10$a' id='p10$a$b' type='hidden' value='$subarray[$i]'>";
					
				}if($i == 4){
					$result .= "<td><input name='p10$a' type='text' id='p10$a$b' value='$subarray[$i]' size='10'/></td>";
					
				}if($i == 1 || $i == 2 || $i == 3){
					$result .= "<td align='center'><input type='checkbox' name='p10$a' value='$a'";
					if($subarray[$i] == $a) $result .= "checked";
					$result .= " ></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size10" value="<?=$a?>" />
</table>



<br />
<TABLE width="900" align="center" class="table2">


    	<tr>
		<th colspan="2"><strong class="verde">Observaciones</strong></th>
	</tr>
	<td colspan="2" align="center">
	 
	<textarea name="observaciones" class="resizable" style="width: 900px; height: 80px;" id="observaciones" ><? ECHO(utf8_decode($observaciones));?></textarea>
</td>
</TABLE>

<table width="1050" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
		<td>
			<!--<input name="guardar" type="submit"  value="Guardar" />
			<input type="button" name="Submit" value="<< Atras" onclick="javascript:history.back(1)" />-->
			<?php include("prev_form_buttons.php"); ?>
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
<script type="text/javascript" src="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>



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