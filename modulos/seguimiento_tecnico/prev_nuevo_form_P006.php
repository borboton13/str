<HTML>
<HEAD>
<TITLE> T�tulo de la p�gina </TITLE>


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
?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
	<input type="hidden" name="path" value="prev_nuevo_form_P006_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />

<table width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIENTO PREVENTIVO <br>GRUPO GENERADOR</caption>
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

<table width="900" align="center" class="table2">
	<tr>
		<th width="25%">Estaci�n</th>
		<td width="75%" class="resaltar"><? echo $codEs . " - " . $nomEs; ?></td>
	</tr>
	<tr>
		<th width="25%">Titulo</th>
		<td width="75%" class="resaltar"><input class='Text_left' name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" maxlength=""/></td>
	</tr>

	<tr>
	  <th width="25%">Marca</th>
	  <td width="75%"><input class='Text_left' name="p01" type="text" size="20" /></td>
	</tr>

	<tr>
		<th width="25%">No. Serie</th>
		<td width="75%"><input class='Text_left' name="p02" type="text" size="20" /></td>
	</tr>
</table>
<br />
<table  width="800" align="center" class="table2">
		<tr>
			<td width='20%'></td>
			<td width='20%' align="center"><b>RED - GRUPO</b></td>
			<td width='20%' align="center"><b>PANEL - GRUPO</b></td>
			<td width='20%' align="center"><b>GRUPO - GRUPO</b></td>
		</tr>
		<?
		$text =	"TIPO ESTACION;;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td class='cafe'>$subarray[$i]</td>";
					$result .= "<input name='p03$a' type='hidden' value='$subarray[$i]'>";
				}else{
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
<table  width="800" align="center" class="table2">
	<tr>
		<td width='50%' class="cafe" colspan="2">MEDIDAS CON EL MOTOR EN FUNCIONAMIENTO</td>
		<td width='25%' align="center">ANTES MTTO.</td>
		<td width='25%' align="center">DESPUES MTTO.</td>
	</tr>
	<?
	$text =	"Presi�n del aceite en el motor;BAR;;|".
			"Temperatura del motor en operaci�n;�C;;|".
			"Revoluciones (RPM) del motor en operaci�n;RPM;;|".
			"Horas de funcionamiento del motor;Hrs;;|".
			"Color del Humo a la salida del escape;COLOR;;";

	$arrays = explode('|',$text);
	$result = "";
	$a = 1;
	foreach ($arrays as $array){
		$subarray = explode(';', $array);
		$result .= "<tr>";
		for ($i = 0; $i < sizeof($subarray); $i++) {
			switch($i){
				case 0:
				case 1: $result .= "<td>$subarray[$i]</td>";
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
<table  width="800" align="center" class="table2">
		<tr>
			<td colspan="2" width='35%' class="cafe">Medidas de  AC  del grupo generador sin carga</td>
			<td colspan="3" align="center"><b>ANTES MTTO.</b></td>
			<td colspan="3" align="center"><b>DESPUES MTTO.</b></td>
		</tr>

		<tr align="center">
			<td colspan="2" width='35%'></td>
			<td>Fase 1</td>
			<td>Fase 2</td>
			<td>Fase 3</td>

			<td>Fase 1</td>
			<td>Fase 2</td>
			<td>Fase 3</td>
		</tr>
		<?
		$text =	"Voltaje de salida del grupo sin carga;[V];;;;;;|".
				"Frecuencia sin carga;[Hz];;;;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		for ($f = 0; $f < sizeof($arrays); $f++) {
			$array = $arrays[$f];
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($f == 0) {
					switch ($i) {
						case 0:
						case 1:
							$result .= "<td>$subarray[$i]</td>";
							$result .= "<input name='p05$a' type='hidden' value='$subarray[$i]'>";
							break;
						default: $result .= "<td align='center'><input class='Text_left' name='p05$a' type='text' size='4'/></td>";
					}
				}else{
					switch ($i) {
						case 0:
						case 1:
							$result .= "<td>$subarray[$i]</td>";
							$result .= "<input name='p05$a' type='hidden' value='$subarray[$i]'>";
							break;
						case 2:
						case 5:	$result .= "<td colspan='3' align='center'><input class='Text_center' name='p05$a' type='text' size='15'/></td>";
								break;
						default: $result .= "<input name='p05$a' type='hidden' value='$subarray[$i]'>";
					}
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
<table  width="800" align="center" class="table2">
		<tr>
			<td width='55%' class="cafe">Medidas de AC del grupo generador con carga</td>
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
		$text =	"Voltaje de salida del grupo con carga [V];;;;;;|".
				"Corriente de Salida del Grupo en Servicio [A];;;;;;|".
				"Frecuencia con carga [Hz];;;;;;|".
				"Verificaci�n de la estabilidad de tensi�n y sin carga y con carga [V];;;;;;|".
				"Verificaci�n de la estabilidad de tensi�n y sin carga y con carga [Hz];;;;;;";
		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		//foreach ($arrays as $array){
		for ($f = 0; $f < sizeof($arrays); $f++) {
			$array = $arrays[$f];
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($f==2 || $f==4 || $f==5){
					switch($i){
						case 0: $result .= "<td align='right'>$subarray[$i]</td>";
								$result .= "<input name='p06$a' id='$a$b' type='hidden' value='$subarray[$i]'>";
								break;
						case 1:
						case 4:	$result .= "<td colspan='3' align='center'><input class='Text_center' name='p06$a' type='text' size='21'/></td>";
								break;
						default: $result .= "<input name='p06$a' type='hidden' value='$subarray[$i]'>";
					}
				}else{
					switch($i){
						case 0: $result .= "<td align='right'>$subarray[$i]</td>";
								$result .= "<input name='p06$a' type='hidden' value='$subarray[$i]'>";
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
<table  width="800" align="center" class="table2">
		<tr>
			<td width='70%' align="center">Verificaci�n del funcionamiento en tensi�n del alternador de Baja [V]</td>
			<td align="center"> <input class='Text_center' name='p06_1' type='text' size='15'/> </td>
		</tr>
</table>
<br />
<table  width="900" align="center" class="table2">
		<tr>
			<td width='60%' class="cafe">ACTIVIDADES SEGUN HORAS DE FUNCIONAMIENTO</td>
			<td align="center"><b>250 Hr</b></td>
			<td align="center"><b>500 Hr</b></td>
			<td align="center"><b>750 Hr</b></td>
			<td align="center"><b>1000 Hr</b></td>
		</tr>
		<?
		$text =	"Revisar el nivel  de aceite del motor , viscosidad y contenido de carb�n;;;;|".
				"Efectuar el cambio  de aceite, �ste debe ser el especificado por f�brica.;;;;|".
				"Renovar el elemento de filtro de aceite.;;;;|".
				"Limpieza del elemento filtro de aire con aire comprimido.;;;;|".
				"Verificar limpiar y ajustar conexiones de las bater�as de arranque.;;;;|".
				"Verificar si la coloraci�n del humo es normal a la salida del escape.;;;;|".
				"Revisi�n del estado del filtro de combustible, efectuar  la limpieza  con aire comprimido y cambio si fuera necesario;;;;|".
				"Realizar ajuste de luz de v�lvulas de admisi�n y escape.;;;;|".
				"Controlar la tensi�n de Correas, de acuerdo a especificaci�n del modelo de grupo;;;;|".
				"Realizar el mantenimiento/limpieza del alternador de baja.;;;;|".
				"Verificar el juego correcto de la polea.;;;;|".
				"Verificar / limpiar si existe un excesivo dep�sito de carb�n en la tuber�a de Escape.;;;;|".
				"Con el motor en carga verificar si existe p�rdida de Potencia.;;;;|".
				"Verificar si existe ruido en  rodamientos (alternador).;;;;|".
				"Quitar el filtro de aire: 1) Si el filtro de aire es seco, limpiar con aire comprimido;;;;|".
				"Quitar el filtro de aire: 2) Si el filtro de aire es h�medo, lavarlo con diesel y llenar con aceite nuevo;;;;|".
				"Revisar y registrar  la presi�n del aceite, temperatura del motor.;;;;|".
				"Revisar el nivel  de aceite del motor , viscosidad y contenido de carb�n.;;;;|".
				"Renovar el elemento filtro de aire.;;;;|".
				"Verificar la presi�n y pulverizaci�n de los inyectores.;;;;|".
				"Limpiar las aletas/cubiertas de refrigeraci�n/ventilaci�n;;;;|".
				"Quitar el motor de arranque, desmontarlo, limpieza.;;;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p07$a' type='hidden' value='$subarray[$i]'>";
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
<table  width="1000" align="center" class="table2">
		<tr>
			<td class="cafe">MTTO CON EL MOTOR APAGADO Y FRIO:</td>
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
		$text =	"Nivel de aceite en motor y tanque suplementario;;;;;;;;;;;|".
			"Nivel de aceite en el filtro de aire;;;;;;;;;;;|".
			"Nivel de polvo en el filtro de aire;;;;;;;;;;;|".
			"Existencia de Fugas de Combustible;;;;;;;;;;;|".
			"Existencia de Fugas de aceite lubricante;;;;;;;;;;;|".
			"Verificaci�n de la tensi�n en las correas impulsoras de las turbinas de aire;;;;;;;;;;;|".
			"Nivel de refrigerante en el radiador;;;;;;;;;;;|".
			"Verificar si la rejilla de salida de aire, est� libre de obstrucciones;;;;;;;;;;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p08$a' type='hidden' value='$subarray[$i]'>";
				}else{
					if($i == 11)
						$result .= "<td align='center'><input class='Text_left' type='text' name='p08$a' size='4'></td>";
					else
						$result .= "<td align='center'><input type='checkbox' name='p08$a' value='$a'></td>";
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
<table  width="1000" align="center" class="table2">
		<tr>
			<td class="cafe">Mtto del alternador de baja , motor apagado:</td>
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
		$text =	"Verificar que todas las conexiones est�n ajustadas;;;;;;;;;;;|".
				"Verificar si existe juego en el acoplamiento Alternador/Motor;;;;;;;;;;;|".
				"Verificar que el ventilador del alternador este ajustado;;;;;;;;;;;|".
				"Verificar estado de los carbones;;;;;;;;;;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p09$a' type='hidden' value='$subarray[$i]'>";
				}else{
					if($i == 11)
						$result .= "<td align='center'><input class='Text_left' type='text' name='p09$a' size='4'></td>";
					else
						$result .= "<td align='center'><input type='checkbox' name='p09$a' value='$a'></td>";
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
<table  width="1000" align="center" class="table2">
		<tr>
			<td class="cafe">Medidas relacionadas al Grupo Generador:</td>
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
		$text =	"Verificar el libre desplazamiento del flotador en el tanque de combustible;;;;;;;;;;;|".
				"Verificar la operaci�n de las bombas de combustible;;;;;;;;;;;|".
				"Drenar el sedimento del tanque de servicio diario;;;;;;;;;;;|".
				"Existencia de fugas en la bomba y tuber�as;;;;;;;;;;;|".
				"Verificaci�n funcionamiento precalentador de arranque;;;;;;;;;;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p10$a' type='hidden' value='$subarray[$i]'>";
				}else{
					if($i == 11)
						$result .= "<td align='center'><input class='Text_left' type='text' name='p10$a' size='4'></td>";
					else
						$result .= "<td align='center'><input type='checkbox' name='p10$a' value='$a'></td>";
				}
				$a++;
			}
			$result .= "</tr>";
		}
		echo $result;
		?>
		<input type="hidden" name="size10" value="<?=$a?>" />
</table>

<table  width="1000" align="center" class="table2">
		<tr>
			<td width="38%"></td>
			<td></td>
			<td width="38%"></td>
			<td></td>
		</tr>
		<?
		$text =	"Cantidad de Diesel del tanque de alimentaci�n diaria [Litros];;Cantidad de Diesel en el tanque de almacenamiento [Litros];|".
				"Cantidad de aceite lubricante existente en la estaci�n [Litros];;Cantidad de agua destilada existente en la estaci�n [Litros];";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				switch($i){
					case 0:
					case 2: $result .= "<td>$subarray[$i]</td>";
						$result .= "<input name='p11$a' type='hidden' value='$subarray[$i]'>";
						break;
					default: $result .= "<td><input class='Text_left' name='p11$a' type='text' size='7'/></td>";
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
<table  width="1000" align="center" class="table2">
		<tr>
			<td width='23%' class="cafe">MTTO BATERIAS DE ARRANQUE</td>
			<td align="center" colspan="6" class="cafe" style="background-color: #D6EAF8;">Marca Bateria 1: <input class='Text_left' name='p12' type='text' size='20'/></td>
			<td align="center" colspan="6" class="cafe" style="background-color: #D6DBDF;">Marca Bateria 2: <input class='Text_left' name='p13' type='text' size='20'/></td>
		</tr>
		<tr>
			<td></td>
			<td align="center">Celda 1</td>
			<td align="center">Celda 2</td>
			<td align="center">Celda 3</td>
			<td align="center">Celda 4</td>
			<td align="center">Celda 5</td>
			<td align="center">Celda 6</td>
			<td align="center">Celda 1</td>
			<td align="center">Celda 2</td>
			<td align="center">Celda 3</td>
			<td align="center">Celda 4</td>
			<td align="center">Celda 5</td>
			<td align="center">Celda 6</td>
		</tr>
		<?
		$text =	"Voltaje DC en  flotaci�n [V];;;;;;;;;;;;|".
				"Temperatura de operaci�n [�C];;;;;;;;;;;;|".
				"Densidad de cada celda [Baumes];;;;;;;;;;;;";

		$arrays = explode('|',$text);
		$result = "";
		$a = 1;
		foreach ($arrays as $array){
			$subarray = explode(';', $array);
			$result .= "<tr align=''>";
			for ($i = 0; $i < sizeof($subarray); $i++) {
				if($i == 0){
					$result .= "<td>$subarray[$i]</td>";
					$result .= "<input name='p14$a' type='hidden' value='$subarray[$i]'>";
				}else{
					$result .= "<td align='center'><input class='Text_left' name='p14$a' type='text' size='5'/></td>";
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
		<tr>
			<td width='40%'></td>
			<td width='25%' class="cafe" align="center">OK</td>
		</tr>
		<?
		$text =	"Prueba de arranque  con el grupo generador;|".
				"Medici�n de corriente de carga con el grupo encendido;|".
				"Verificar, limpiar, asegurar  terminales de las bater�as de arranque;";

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
					default: $result .= "<td align='center'><input type='checkbox' name='p15$a' value='$a'></td>";
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
    campo.readOnly = true; // Se a�ade el atributo
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