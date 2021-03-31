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
.table3{
display:inline;
}	
.table3 TD{
    width:20px;
border: 1px solid black ;
text-align:left;
}
.table5{
display:inline;
margin-left:5px;
}	
.table5 TD{
    width:20px;
border: 1px solid black ;
text-align:center;
}
.table3{
    
border: 1px solid black ;
text-align:center;
}

.table4{
display:inline;
margin-left:-25px;
}	
.table4 TD{
 
border: 1px solid black ;
text-align:center;
}

.chir:nth-child(-n+7){
 height:48px;
  background-color:#C0C0C0;



}
.table6{
display:inline;
margin-left:80px;
text-align:center;
}	
.table6 TD{
border: 1px solid black ;
text-align:center;
}

	
.chor:nth-child(-n+8){
 height:48px;
 background-color:#C0C0C0;


}	
.chor:nth-child(8){
 height:72px;

}	
.med{
    width:100px;
}
.tablef{
display:inline;
}	
.tablef TD{

border: 1px solid black ;
text-align:left;
}
.pruebas{
padding-top:20px;
margin-left:230px;
}

.tablon{
margin-left:-5px;
}
.tablan{
margin-left:-0px;

}
.tablan th{
margin-left:-5px;
border:1px solid black;
}
.safe{
width:1225px;
margin-left:60px;
background-color:#C0C0C0;
padding-left:-100px;
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
JOIN formulario_p013v h ON ev.idevento = h.idevento
JOIN p013v_formulario f ON h.id = f.id
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


$resultQuery = mysql_query("SELECT * FROM formulario_p013v p WHERE p.id = ".$idformtto);
$result      = mysql_fetch_array($resultQuery);

$titulo = $result['titulo'];
$p13	= $result['p13'];
$p14	= $result['p14'];
$p15	= $result['p15'];
$p16	= $result['p16'];
$p18	= $result['p18'];
$p19	= $result['p19'];
$p21	= $result['p21'];
$p22	= $result['p22'];
$p23	= $result['p23'];
$p24	= $result['p24'];
$p25	= $result['p25'];
$p26	= $result['p26'];
$observaciones	= $result['observaciones'];


$opP15 = array("...", "Funciona", "No funciona", "No existe");

?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P013v_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
	<input type="hidden" name="idformtto" value="<?=$idformtto?>" />

<table width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIIENTO PREVENTIVO<br>RADIO BASES</caption>
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


<table  width="900" align="center" class="table2">
    
	<tr>
		<th width="25%">Titulo</th>
		<td width="75%" class="resaltar"><input name="titulo" type="text" id="titulo" value="<?=$titulo?>" size="70"/></td>
	</tr>
</table>

<table  width="900" align="center" class="table2">
    
	
<th colspan="4"><strong class="verde">1.- Relevamiento</strong></th>
		<tr align="center">
		    
			<td width='45%'>Tecnologia</td>
			<td width='5%'>GSM</td>
			<td width='25%'>UMTS</td>
			<td width='25%'>LTE</td>
		</tr>
		<?

		$text=$p19;
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
				$result .= "<td>$subarray[$i]</td>";
				$result .= "<input name='p19$a' id='p19$a$b' type='hidden' value='$subarray[$i]'>";
				}else{
					$result .= "<td align='center'><input name='p19$a' type='text' id='p19$a$b' value='$subarray[$i]' size='19'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size19" value="<?=$a?>" />
</table>

<br />
<section class="safe">
    <table  width="1230" align="center" class="table2 tablon">
    <th colspan="4"><strong class="verde">Antenas de la radio base</strong></th>
</table>

<table  width="1225" align="center" class="tablan">
    <th  width="1.5%">N</th>
    <th  width="8.5%">Tipo de Antena</th>
    <th width="1%">Sec<br>tor</th>
    <th  width="415">Tecnologia</th>
    <th  width="99">Modelo</th>
    <th  width="99">Tilt Mecanico</th>
    <th  width="100">RET</th>
    <th  width="98">*Tilt Electrico</th>
    <th  width="99">Altura (m)</th>
    <th  width="100">TMA</th>
</table>


<table  align="left" class="table3">

	<tr align="center">

	</tr>
	<?

	$text=$p23;

	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr align='' class='chir'>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			if($i == 0 ||$i == 2){
				$result .= "<td>$subarray[$i]</td>";
				$result .= "<input name='p23$a' id='p23$a$b' type='hidden' value='$subarray[$i]'>";
			}if($i == 1){
					$result .= "<td align='center'><input name='p23$a' type='text' id='p23$a$b' value='$subarray[$i]' size='23' class='med'/></td>";
				}
	
			$a++;
		}
		$result .= "</tr>";
	}
	echo $result;
	?>
	<input type="hidden" name="size23" value="<?=$a?>" />

</table>
<table  width="350" align="left" class="table5">

	    <tr>
		</tr>
	<?

	$text=$p24;

	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr align=''>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			if($i >= 0){
					$result .= "<td align='center'><input name='p24$a' type='text' id='p24$a$b' value='$subarray[$i]' size='24' class='med'/></td>";
			}
			$a++;
		}
		$result .= "</tr>";
	}
	echo $result;
	?>
	<input type="hidden" name="size24" value="<?=$a?>" />

</table>
<table  width="30" align="left" class="table4">

	<tr align="center">
	</tr>
	<?

	$text=$p25;
	
	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr align='' class='chor'>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			if($i >= 0){
					$result .= "<td align='center'><input name='p25$a' type='text' id='p25$a$b' value='$subarray[$i]' size='25' class='med'/></td>";
			}
			$a++;
		}
		$result .= "</tr>";
	}
	echo $result;
	?>
	<input type="hidden" name="size25" value="<?=$a?>" />

</table>

<table  width="350" align="left" class="table6">

	<tr align="center">

	</tr>
	<?

	$text=$p26;
	
	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr align='' class='chir'>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			if($i >= 0){
					$result .= "<td align='center'><input name='p26$a' type='text' id='p26$a$b' value='$subarray[$i]' size='26' class='med'/></td>";
			}
			$a++;
		}
		$result .= "</tr>";
	}
	echo $result;
	?>
	<input type="hidden" name="size26" value="<?=$a?>" />

</table>

<table  width="1230" align="center" class="table2 tablon">
    <th colspan="4"><strong class="verde">* Llenar solo en caso de que no se cuente con RET.</strong></th>
</table>
</section>

<table  width="900" align="center" class="table2 pruebas">

    <th colspan="7"><strong class="verde">Pruebas de servicio.</strong></th>

		<tr align="center">
			<td width='20%' class="cafe"><b>Pruebas de servicio</b></td>
			<td width='15%' class="cafe"><b>Numero de A</b></td>
			<td width='15%' class="cafe"><b>Numero de B</b></td>
			<td width='20%' class="cafe"><b>Hora</b></td>
			<td width='10%' class="cafe"><b>GSM</b></td>
			<td width='20%' class="cafe"><b>UMTS</b></td>
			<td width='20%' class="cafe"><b>LTE</b></td>
		</tr>
		<?

		$text=$p16;
		
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p16$a' type='hidden' value='$subarray[$i]'>";
						break;
					default: $result .= "<td align='center'><input name='p16$a' type='text' id='p16$a$b' value='$subarray[$i]' size='16' class='med'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size16" value="<?=$a?>" />
</table>
<br />

<section align="center">
    
    <table  width="1050" align="center" class="table2">
    <th colspan="4"><strong class="verde">Reporte Fotografico en Alta Definicion</strong></th>
</table>
<table  width="300" class="tablef" id="st">

	<tr align="center">
		<td width='40%'></td>
		<td width='6%' class="azul2"></td>
	</tr>
	<?

	$text=$p21;
	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr align=''>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			if($i == 0){
				$result .= "<td>$subarray[$i]</td>";
				$result .= "<input name='p21$a' id='p21$a$b' type='hidden' value='$subarray[$i]'>";
			}if($i == 1){
					$result .= "<td align='center'><input type='checkbox' name='p21$a' value='$a'";
					if($subarray[$i] == $a) $result .= "checked";
					$result .= " ></td>";
				}
	
			$a++;
		}
		$result .= "</tr>";
	}
	echo $result;
	?>
	<input type="hidden" name="size21" value="<?=$a?>" />

</table>
<table  width="300" class="tablef" id="ss">

	<tr align="center">
		<td width='40%'></td>
		<td width='6%' class="azul2"></td>
	</tr>
	<?
    
    $text=$p22;
	
	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr align=''>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			if($i == 0){
				$result .= "<td>$subarray[$i]</td>";
				$result .= "<input name='p22$a' id='p22$a$b' type='hidden' value='$subarray[$i]'>";
			}if($i == 1){
					$result .= "<td align='center'><input type='checkbox' name='p22$a' value='$a'";
					if($subarray[$i] == $a) $result .= "checked";
					$result .= " ></td>";
				}
	
			$a++;
		}
		$result .= "</tr>";
	}
	echo $result;
	?>
	<input type="hidden" name="size22" value="<?=$a?>" />

</table>
<br />
<br />
</section>


<table width="900" align="center" class="table2">

	<tr><th colspan="3"><strong class="verde">2.- Mantenimiento Preventivo</strong></th></tr>
	<tr align="center">
		<td width='55%'></td>
		<td>Revisado</td>
		<td>Observaciones</td>
	</tr>
	<?
	$text = $p13;

	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			switch($i){
				case 0: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p13$a' id='$a$b' type='hidden' value='$subarray[$i]'>";
						break;
				case 1: $result .= "<td align='center'><input type='checkbox' name='p13$a' value='$a'";
						if($subarray[$i] == $a) $result .= "checked";
						$result .= " ></td>";
						break;
				default: $result .= "<td align='center'><input type='text' name='p13$a' value='$subarray[$i]' size='13'/></td>";
			}
			$a++;
		}
		$result .= "</tr>";
	}
	echo $result;
	?>
	<input type="hidden" name="size13" value="<?=$a?>" />
</table>

<table  width="900" align="center" class="table2">
		<tr align="center">
			<td width='62%'></td>
			<td width='11%'></td>
			<td></td>
		</tr>
		<?

		 $text = $p18;

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p18$a' type='hidden' value='$subarray[$i]'>";
						break;
				case 1: $result .= "<td align='center'><input type='checkbox' name='p18$a' value='$a'";
						if($subarray[$i] == $a) $result .= "checked";
						$result .= " ></td>";
						break;
				default: $result .= "<td align='center'><input type='text' name='p18$a' value='$subarray[$i]' size='18'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size18" value="<?=$a?>" />
</table>


<br />

<br />
<table  width="900" align="center" class="table2">

		<tr align="center">
			<td width='35%'>Verificar alarmas visibles en Radio Base.</td>
			<td width='20%'>Ubicacion de alarma</td>
			<td width='20%'>Solucionado</td>
			<td width='20%'>Observaciones</td>
		</tr>
		<?

		$text=$p14;
		
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i >= 0){
					$result .= "<td><input name='p14$a' type='text' id='p14$a$b' value='$subarray[$i]' size='14'/></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size14" value="<?=$a?>" />
</table>
	<br />
<table  width="900" align="center" class="table2">
		<tr align="center">
			<td width='40%' class="cafe"><b>Verificar reporte de alarmas a sistema de gestion</b></td>
			<td width='20%' class="cafe"><b>Estado</b></td>
			<td width='40%' class="cafe"><b>Observaciones</b></td>
		</tr>
		<?

		$text = $p15;
		
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0: $result .= "<td>$subarray[$i]</td>";
							$result .= "<input name='p15$a' type='hidden' value='$subarray[$i]'>";
							break;
					case 1: $result .= "<td align='center'><select name='p15$a'>";
							foreach($opP15 as $opcion){
								$result .= '<option value="'.$opcion.'" ';
								if($opcion == $subarray[$i]) $result .= 'selected';
								$result .='>'.$opcion.'</option>';
							}
							$result .= 	"</select></td>";
							break;
					case 2: $result .= "<td align='center'><input type='text' name='p15$a' value='$subarray[$i]' size='20'/></td>";
				}

				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size15" value="<?=$a?>" />
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

<table width="900" align="center" class="table2" cellspacing="2" class="table2">
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