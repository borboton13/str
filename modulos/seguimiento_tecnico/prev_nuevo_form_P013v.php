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
margin-left:0px;

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

$opP01 = array("...", "SI", "NO");
$opP04 = array("...", "ACTIVO", "FUERA DE SERVICIO");
$opP05 = array("...", "ERICSSON", "HUAWEI", "VNL", "ZTE");
$opP07 = array("...", "PEX_Cu", "MICROONDAS", "FIBRA OPTICA", "SATELITAL");
$opP09 = array("...", "ETHERNET", "E1", "FIBRA OPTICA");
$opP11 = array("...", "RED COMERCIAL", "GRUPO GENERADOR", "PANELES SOLARES");
$opP12 = array("...", "BANCO DE BATERIAS", "GRUPO GENERADOR", "PANELES SOLARES");
$opP15 = array("...", "Funciona", "No funciona", "No existe");
$opP16 = array("...", "SI", "NO", "N/A");
$opP17 = array("...", "Sectorial", "Ominidireccional");
$opP17_1 = array("..", "SI", "NO");
?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P013v_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />

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
			<input name="fechamantenimiento" type="text" id="fechamantenimiento" size="10" class="Text_left" value="<? ECHO($ini);?>" value="" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)" readonly="yes"/>
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
		    <th width="25%">Formulario</th>
			<td width="75%"><input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" maxlength="" /></td>
	</tr>
	
	<tr>
		<th width="25%">Titulo</th>
		<td width="75%"><input name="tate" type="text" id="tate"  size="70" maxlength=""/></td>
	</tr>
</table>
<br />

<table  width="900" align="center" class="table2">
<th colspan="4"><strong class="verde">1.- Relevamiento</strong></th>
		<tr align="center">
		    
			<td width='35%'>Tecnologia</td>
			<td width='20%'>GSM</td>
			<td width='20%'>UMTS</td>
			<td width='20%'>LTE</td>
		</tr>
		<?
	$text =	"CONFIGURACION;;;|".
	"TIPO DE ENLACE;;;|".
	"EQUIPO DE ORIGEN DE TX;;;|".
	"TIPO DE PUERTO;;;|".
	"PUERTO ASIGNADO EN TX;;;|".
	"SALTO PREVIO;;;|".
	"MODELO DE GABINETE;;;";
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
					$result .= "<td align='center'><input type='text' name='p19$a' size='19'/></td>";
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
<table  width="1225" align="center" class="table2 tablon">
    <th colspan="4"><strong class="verde">Antenas de la radio base</strong></th>
</table>
<table  align="left" class="table3">

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
	    <tr>
		</tr>
	<?
	$text = "1;;1|".
	"2;;2|".
	"3;;3|".
	"4;;1|".
	"5;;2|".
	"6;;3|".
	"1;;1|".
	"2;;2|".
	"3;;3";
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
	$text =	";;|".
	";;|".
	";;|".
	";;|".
	";;|".
	";;|".
	";;|".
	";;|".
	";;|".
	";;|".
	";;|".
	";;|".
	";;|".
	";;|".
	";;";
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
	$text =	"|".
	"|".
	"|".
	"|".
	"|".
	"|".
	"";
	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr align='' class='chor'>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			if($i >= 0){
					$result .= "<td align='center'><input name='p25$a' type='text' id='p25$a$b' value='$subarray[$i]' size='25'class='med'/></td>";
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
	$text =	";;;;;|".
	";;;;;|".
	";;;;;|".
	";;;;;|".
	";;;;;|".
	";;;;;|".
	";;;;;|".
	";;;;;|".
	";;;;;";
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
<table  width="1225" align="center" class="table2 tablon">
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
		$text = "Llamar a movil;;;;;;|".
				"SMS;;;;;;|".
				"Videollamada;;;;;;|".
				"Llamar a fijo;;;;;;|".
				"Navegacion en internet;;;;;;";
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
					default: $result .= "<td align='center'><input type='text' name='p16$a' value='$subarray[$i]' size='16' class='med'/></td>";
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
	$text =	"Vista 360° DEL SITIO;|".
	"CAMINO DE ACCESO;|".
	"DETALLE PUERTA;|".
	"VISTAS DE LA ESTRUCTURA;|".
	"VISTA FRONTAL LOZA;|".
	"GABINETES ABIERTOS:;|".
	"ATENAZAS DE ENLACES;|".
	"VISTA 360° DESDE PLATAFORMA;|".
	"TILTs MECANICOS;|".
	"VISTA POSTERIOR LOZA;|".
	"TDP ABIERTO:;|".
	"MEDIDOR;";
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
					$result .= "<td align='center'><input type='checkbox' name='p21$a' value='$a'></td>";
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
	$text =	"BAJANTE DE ATERRAMIENTO;|".
	"GRUPO GENERADOR;|".
	"BARRAS DE TIERRA;|".
	"TRANSFORMADOR;|".
	"EQUIPOS DE TX;|".
	"DETALLE PUERTOS DE TX;|".
	"AZIMUTHs DESDE ANTENA SECTORIAL;|".
	"CONEXIONES DE ANTENA SECTORIAL;|".
	"BANCO DE BATERIAS;|".
	"DETALLE CAPACIDAD DE BATERIAS;|".
	"PROTECTORES DE 1ER/2DO NIVEL:;|".
	"OBSERVACIONES;";
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
					$result .= "<td align='center'><input type='checkbox' name='p22$a' value='$a'></td>";
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

<table  width="900" align="center" class="table2">
	<tr><th colspan="3"><strong class="verde">2.- Mantenimiento Preventivo</strong></th></tr>
	<tr align="center">
		<td width='35%'></td>
			<td width='6%'>Revisado</td>
			<td width='15%'>Observaciones</td>
	</tr>
	<?
	$text =	"Verificar la instalacion del gabinete;;|".
			"Verificar la instalacion de la BBU y tarjetas;;|".
			"Verificar la limpieza fuera y dentro del gabinete;;|".
			"Verificar el cable de aterramiento de gabinete;;|".
			"Verificar que los cables de energia y aterramiento no esten dañados o rotos;;";
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
				case 1: $result .= "<td align='center'><input type='checkbox' name='p13$a' value='$a'></td>";
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
		$text =	"Verificar la instalacion de las RRUs;;|".
				"Verificar que cables de energia no esten dañados o rotos;;|".
				"Verificar que cables de aterramiento no esten dañados o rotos;;|".
				"Verificar el vulcanizado;;|".
				"Verificar etiquetado en Antenas y RRUs;;|".
				"Verificar la instalacion de las Antenas;;|".
				"Verificar jumpers;;";
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
					case 1: $result .= "<td align='center'><input type='checkbox' name='p18$a' value='$a'></td>";
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
<table  width="900" align="center" class="table2">

		<tr align="center">
			<td width='35%'>Verificar alarmas visibles en Radio Base.</td>
			<td width='20%'>Ubicacion de alarma</td>
			<td width='20%'>Solucionado</td>
			<td width='20%'>Observaciones</td>
		</tr>
		<?
		$text =	";;;|".
		";;;|".
		";;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i >= 0){
					$result .= "<td align='center'><input type='text' name='p14$a' size='14'/></td>";
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
		$text = "Puerta Abierta;;|".
				"Baterias en descarga/Falla de rectificador;;|".
				"Corte de energia comercial;;";
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
				 							foreach($opP15 as $opcion)
												$result .= "<option value='$opcion'>$opcion</option>";
							$result .= 	"</select></td>";
						break;
					default: $result .= "<td align='center'><input type='text' name='p15$a' value='$subarray[$i]' size='15'/></td>";
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
    	<tr><th colspan="3"><strong class="verde">Observaciones</strong></th></tr>
	<td colspan="2" align="center">
	<textarea name="observaciones" class="resizable" style="width: 900px; height: 80px;" id="observaciones"></textarea>
</td>
</TABLE>

<table width="900" align="center" class="table2" cellspacing="2" class="table2">
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




</BODY>
</HTML>