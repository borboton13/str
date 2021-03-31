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
JOIN formulario_p002v h ON ev.idevento = h.idevento
JOIN p002v_formulario f ON h.id = f.id
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

$resultQuery = mysql_query("SELECT * FROM formulario_p002v p WHERE p.id = ".$idformtto);
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
$p09	= $result['p09'];
$p010	= $result['p010'];
$p011	= $result['p011'];
$p012	= $result['p012'];
$p013	= $result['p013'];

$opEstado 		= array("...", "En uso", "En desuso");
$opTipoEstruct1 = array("...", 	"Gabinete outdoor de calle",
	 						   	"Monoposte",
								"Torre Arriostrada GreenField",
								"Torre Arriostrada Rooftop",
								"Torre Autosoportada GreenField",
								"Torre Autosoportada Rooftop",
								"Reticular",
								"Wall Mounting",
								"InDoor",
								"Poste",
								"Tanque");

$opTipoEstruct2 = array("...",	"Cow",
								"Monoposte",
								"Mastil",
								"Torre Arriostrada GreenField",
								"Torre Arriostrada Rooftop",
								"Torre Autosoportada GreenField",
								"Torre Autosoportada Rooftop",
								"Reticular",
								"Wall Mounting",
								"InDoor",
								"Poste",
								"Tanque");
$optipodecerra 		= array("...", "Enmallado", "Muro de ladrillo");
?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P002v_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
	<input type="hidden" name="idformtto" value="<?=$idformtto?>" />

<table width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO <br /> ESTRUCTURA</caption>
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
		<th width="25%">Estación</th>
		<td width="75%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td>
	</tr>
	<tr>
		<th width="25%">Titulo</th>
		
		<td width="75%" class="resaltar">
			<input name="titulo" type="text" id="titulo" value="<?=$titulo?>" size="70" />
		</td>
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
				<?
				foreach($opEstado as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p01) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>
<tr>
		<th width="25%">Tipo de esctructura</th>
		<td width="75%">
			<select name="p02">
				<?
				foreach($opTipoEstruct1 as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p02) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
	  <th width="25%">Altura de la estructura (m)</th>
	  <td width="75%"><input name="p03" type="text" id="p03" size="10" value="<?=$p03?>" /></td>
	</tr>
	<tr>
		<th><strong>ESTRUCTURA 2</strong></th>
		<td></td>
	</tr>
	<tr>
		<th width="25%">Estado</th>
		<td width="75%">
			<select name="p04">
				<?
				foreach($opEstado as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p04) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
		<th width="25%">Tipo de esctructura</th>
		<td width="75%">
			<select name="p05">
				<?
				foreach($opTipoEstruct2 as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p05) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>
	<tr>
	  	<th width="25%">Altura de la estructura (m)</th>
	  	<td width="75%"><input name="p06" type="text" id="p06" size="10" value="<?=$p06?>" /></td>
	</tr>
	
		<tr>
		<th><strong>ESTACION</strong></th>
		<td></td>
	</tr>
<tr>
		<th width="25%">Tipo de cerramiento perimetral</th>
		<td width="75%">
			<select name="p08">
				<?
				foreach($optipodecerra as $opcion){
					echo '<option value="'.$opcion.'" ';
					if($opcion == $p08) echo 'selected';
					echo'>'.$opcion.'</option>';
				}
				?>
			</select>
		</td>
	</tr>
	
	<tr>
	  <th width="25%">Dimesnsión de estación (ancho x largo (metros))</th>
	  <td width="75%"><input name="p09" type="text" id="p09" size="10" value="<?=$p09?>" /></td>
	  </td>
	</tr>
	
	<tr>
	  <th width="25%">Losa equipos (ancho x largo (metros))</th>
	  <td width="75%"><input name="ps10" type="text" id="ps10" size="10" value="<?=$p010?>" /></td>
	  </td>
	</tr>
	
	<tr>
	  <th width="25%">Losa o caseta grupo generador (ancho x largo (metros))</th>
	  <td width="75%"><input name="ps11" type="text" id="ps11" size="10" value="<?=$p011?>" /></td></td>
	</tr>
	
	
	<tr>
	  <th width="25%">Caseta de Sereno (ancho x largo (metros))</th>
	  <td width="75%"><input name="sereno" type="text" id="sereno" size="10" value="<?=$p012?>" /></td></td>
	</tr>

    

</table>
<br />
<table  width="1000" align="center" class="table2">
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
		
	  
		    $text=$p07;
		
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

<TABLE width="900" align="center" class="table2">


    	<tr>
		<th colspan="2"><strong class="verde">Otras observaciones</strong></th>
	</tr>
	<td colspan="2" align="center">
	 
	<textarea name="observaciones" class="resizable" style="width: 900px; height: 80px;" id="observaciones" ><? ECHO(utf8_decode($p013));?></textarea>
</td>
</TABLE>
</table>
<table width="1000" align="center" class="table2" cellspacing="2" class="table2">
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