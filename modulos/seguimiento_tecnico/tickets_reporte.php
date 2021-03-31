<?php
if(isset($_POST["fecha"])) $fecha = $_POST["fecha"]." 00:00:00";
else {
	$dato=mysqli_fetch_array(mysqli_query($conexion, "select now()"));
	$fecha=$dato[0];
}

if(isset($_POST["menos"]))
{
	$dato=mysqli_fetch_array(mysqli_query($conexion, "SELECT DATE_SUB('$fecha',INTERVAL 1 DAY)"));
	$fecha=$dato[0];
}

if(isset($_POST["mas"]))
{
$dato=mysqli_fetch_array(mysqli_query($conexion, "SELECT DATE_ADD('$fecha',INTERVAL 1 DAY)"));
$fecha=$dato[0];
}

$fecha=substr($fecha,0,10);


if(isset($_POST["fechainicial"])) $fechainicial = $_POST["fechainicial"];
if(isset($_POST["fechafinal"])) $fechafinal = $_POST["fechafinal"];

if(isset($_POST["estacionentel"])) $estacionentel = $_POST["estacionentel"];
if(isset($_POST["idestacionentel"])) $idestacionentel = $_POST["idestacionentel"];
//

if(isset($_POST["cboxregional"])) $cboxregional = $_POST["cboxregional"];
//$cboxregional = $_POST['cboxregional'];
if(isset($_POST["cboxmes"])) $cboxmes = $_POST["cboxmes"];
//$cboxmes= $_POST['cboxmes'];
if(isset($_POST["cboxano"])) $cboxano = $_POST["cboxano"];
 //$cboxano= $_POST['cboxano'];
if(isset($_POST["cboxestado"])) $cboxestado = $_POST["cboxestado"];
 //$cboxestado= $_POST['cboxestado'];
 //echo $cboxano;



	$fini= substr($fecha,0,4)."-". substr($fecha,5,2)."-01";
	$ffin= substr($fecha,0,4)."-". substr($fecha,5,2)."-31";
	//echo $fini;
	//echo ($_POST['cboxregional']);



$strSql="";
//$strSql=" and centro.nombre='COCHABAMBA'";
//echo ($strSql);

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
	//$checkboxx[]="";

    $checkbox=$_POST["checkbox"];
    $count = count($checkbox);
    //$check1 = '';
    for ($i = 0; $i < $count; $i++) {
    	//echo $i ."-".$checkbox[$i]. "/";

    	switch ($checkbox[$i]) {
    	        	case '1':
    	        		$check1=1;/// Regional
    	        		$strSql.=" and centro.nombre='" . $cboxregional ."' ";
    	        		break;
    	        	case '2': //estacion
    	        		$check2=1;
    	        		$strSql.=" and nombreestacion='" . $estacionentel ."' ";
    	        		break;
    	        	case '3'://Id estacion
    	        		$check3=1;
    	        		$strSql.=" and idestacionentel='" . $idestacionentel ."' ";
    	        		break;
    	        	case '4'://Estado
    	        		$check4=1;    	        		    	        		    	        		
    	        		break;
    	        	case '5'://ano
    	        		$check5=1;
    	        		$fechainiRif= $cboxano.'-01-01';
    	        		$fechafinRif= $cboxano.'-12-31';

    	        		$strSql.=" and st_ticketn.fecha_inicio_rif BETWEEN '$fechainiRif' AND '$fechafinRif' ";
    	        		//echo $strSql;
    	        		break;
    	        	case '6'://mes
    	        		$check6=1;

    	        		$fechainiRif= $cboxano.'-'.$cboxmes .'-01';
    	        		$fechafinRif= $cboxano.'-'.$cboxmes .'-31';

    	        		$strSql.=" and st_ticketn.fecha_inicio_rif BETWEEN '$fechainiRif' AND '$fechafinRif' ";


    	        		break;
    	        	case '7'://between fechas
    	        		$check7=1;

    	        		$fechainiRif= $fechainicial;
    	        		$fechafinRif= $fechafinal;

    	        		$strSql.=" and st_ticketn.fecha_inicio_rif BETWEEN '$fechainiRif' AND '$fechafinRif' ";
    	        		break;
    	        	
    	        	default:
    	        		# code...
    	        		break;
    	        }        
    }
}



//echo($strSql);



	$opRegional = array("...", "COCHABAMBA","VILLA TUNARI","CONO SUR");
	$opAno = array("...", "2019","2020","2021","2022");
	$opEstado = array("...", "Abierto","Cerrado");
	//st_ticketn.fecha_inicio_rif='$fechainicial'
	



?>
<div align="center"><span class="title">BUSQUEDA DE TICKET</span></div>

  <form name="form1" method="post" action="#">
  	<input type="hidden" id="strSql" name="strSql" value="<?php echo($strSql);?>">

<table width="140%" align="center" class="table4">
<tr>
	<TD colspan="10">
		<table>
			<tr>
				<td><a class="enlaceboton" href="../../excel/excel_st_listado_ticketreporte.php?strSql=<?php echo(($strSql));?> " onclick="openNewWindowhtml( this, '800', '590' );return false;"><img src="../../img/excel_ico.gif" alt="Ver Listado en Excel" width="16" height="16" border="0" align="absmiddle" 	/> Ver Todo Listado en Excel </a>
				</td>
				<TD>
					<?php												
						$dias=date("w",mktime(0,0,0,substr($fecha,5,2),substr($fecha,8,2),substr($fecha,0,4)));
						switch($dias)
						  {
						  case 1: echo"<b>LUN</b>";break;
						  case 2: echo"<b>MAR</b>";break;
						  case 3: echo"<b>MIE</b>";break;
						  case 4: echo"<b>JUE</b>";break;
						  case 5: echo"<b>VIE</b>";break;
						  case 6: echo"<b>SAB</b>";break;
						  case 0: echo"<b>DOM</b>";break;		  	  
						  }	  
							  $dia=substr($fecha,8,2);
							  $mes=substr($fecha,5,2);
							  echo", $dia de ";
						switch($mes)
						  {
						  case 1: echo"ENE";break;
						  case 2: echo"FEB";break;
						  case 3: echo"MAR";break;
						  case 4: echo"ABR";break;
						  case 5: echo"MAY";break;
						  case 6: echo"JUN";break;
						  case 7: echo"JUL";break;
						  case 8: echo"AGO";break;
						  case 9: echo"SEP";break;
						  case 10: echo"OCT";break;
						  case 11: echo"NOV";break;
						  case 12: echo"DIC";break;		  	  
						  }
						  echo" ".substr($fecha,0,4)."&nbsp;";
						?>
				</TD>
			</tr>	
			<tr>
				<!-- <input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" /> -->
				<td class="marco">
					<input type="checkbox" name="checkbox[]" value="1" id="chkregional"  <?php if ($check1==1){ echo(" checked='checked'");}?>>
					  <span class="title7">&nbsp;Regional&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
					  
					  <select name="cboxregional">
						<?php foreach($opRegional as $opcion){
							$strSelected="";
							if($opcion == $cboxregional) $strSelected= 'selected';
				  			echo "<option ".$strSelected  ." value='$opcion'>$opcion</option>";
			  			}?>	
					</select>
					
							  				      					  											
				</td>
				<TD class="marco">
					<input type="checkbox" name="checkbox[]" value="5" id="chkano" <?php if ($check5==1){ echo(" checked='checked'");}?>>
					<span class="title7">&nbsp;<? echo(utf8_decode('Año')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					  
					  <select name="cboxano">
						<?php foreach($opAno as $opcion){
							$strSelected="";
							if($opcion == $cboxano) $strSelected= 'selected';

				  			echo "<option ".$strSelected  ." value='$opcion'>$opcion</option>";
			  			}?>	
					</select>
					
				</TD>
			</tr>

			<tr>
				<!-- <input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" /> -->				

				<td class="marco">
					<input type="checkbox" name="checkbox[]" value="2" id="chkestacion" <?php if ($check2==1){ echo(" checked='checked'");}?>>
					<span class="title7">&nbsp;Estacion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>					  
					  
			              <input name="estacionentel" 
			                     type="text" 
			                     class="Text_left" 
			                     id="estacionentel" 
			                     value="<?php echo($estacionentel);?>" 
			                     onKeyUp="ajax_showOptions(this,'',event,'../../paquetes/autocompletar/search_estacionentel.php')" size="15" autocomplete="off" >
			              <!-- <input type="hidden" id="estacionentel_hidden" name="idestacionentel"> -->
				</td>
				<td class="marco">
					<input type="checkbox" name="checkbox[]" value="6" id="chkmes" <?php if ($check6==1){ echo(" checked='checked'");}?>>
					<span class="title7">&nbsp;Mes&nbsp;</span>

					  <?php

							$meses = array('...','enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');

							$nombre = 'cboxmes'; 
							$resultado = lista($nombre, $meses,$cboxmes); 


							echo $resultado; 


							function lista($nombre, $meses,$cboxmes){

								$array = $meses; 
								$txt= "<select name='$nombre' id='$nombre'>";

									for ($i=0; $i<sizeof($array); $i++){

										$strtext="";
										//echo $cboxmes;

										if($i == $cboxmes){

											$strtext = "selected";
											//echo $strtext;
										}

										$txt .= "<option  ". $strtext ." value='$i' >". $array[$i] . '</option>';

									} $txt .= '</select>'; return $txt; 

								}

					?>
				</td>
			</tr>

			<tr>
				<!-- <input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" /> -->
				<td class="marco">
					<input type="checkbox" name="checkbox[]" value="3" id="chkidestacion"<?php if ($check3==1){ echo(" checked='checked'");}?>>
					<span class="title7">&nbsp;ID Estacion&nbsp;</span>
					  
					  
					  
			              <input name="idestacionentel" 
			                     type="text" 
			                     class="Text_left" 
			                     id="idestacionentel" 
			                     value="<?php echo($idestacionentel);?>" 
			                     onKeyUp="ajax_showOptions(this,'',event,'../../paquetes/autocompletar/search_idestacionentel.php')" size="15" autocomplete="off" >
			              <!-- <input type="hidden" id="estacionentel_hidden" name="idestacionentel"> -->

				</td>
				<td class="marco">
					<input type="checkbox" name="checkbox[]" value="7" id="chkfechainicial" <?php if ($check7==1){ echo(" checked='checked'");}?>>
					<span class="title7">&nbsp;Fecha Inicial&nbsp;</span>

						<input name="fechainicial" type="text" onclick="displayCalendar(this,'yyyy-mm-dd',this)" id="fechainicial" value="<?=substr($fechainicial,0,10);?>">
						<span class="title7">&nbsp;Fecha Final&nbsp;</span>
						<input name="fechafinal" type="text" onclick="displayCalendar(this,'yyyy-mm-dd',this)" id="fechafinal" value="<?=substr($fechafinal,0,10);?>">
				</td>
			</tr>
			<tr>
				<!-- <input name="titulo" type="text" id="titulo" value="<?=$nombreForm?>" size="70" /> -->
				<td class="marco">
				
					  <input type="checkbox" name="checkbox[]" value="4"  id="chkestado"<?php if ($check4==1){ echo(" checked='checked'");}?>>
					  <span class="title7">&nbsp;Estado &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
					<select name="cboxestado">
						<?php foreach($opEstado as $opcion){
				  			$strSelected="";
							if($opcion == $cboxestado) $strSelected= 'selected';

				  			echo "<option ".$strSelected  ." value='$opcion'>$opcion</option>";
			  			}?>	
					</select>
				      


					
						&nbsp;

						
						
					
				</td>

					<TD class="marco"><input class="btn_dark" name="Submit" type="submit" value="Procesar Busqueda"></TD>
			</tr>
		</table>
	</TD>
</tr>
<tr>
<th width="2%">N&deg;</th>
<th width="7%">CM/SCM</th>
<th width="7%">NRO TICKET GFM</th>
<th width="7%">ID ESTACION</th>
<th width="7%">ESTACION</th>
<th width="7%">NP/NS</th>
<th width="7%">TECNOLOGIA</th>
<th width="5%">AREA </th>
<th width="7%">ATENCION</th>
<th width="5%">AFECTACION AL SERVICIO</th>
<th width="7%">SISTEMA EN FALLA</th>
<th width="7%">EQUIPO EN FALLA</th>
<th width="7%">TIPO DE FALLA</th>
<th width="7%">SOLUCION</th>
<th width="7%">DESCRIPCION FALLA</th>
<th width="7%">Fecha y Hora Inicio de alarma RIF</th>
<th width="7%">Fecha y Hora Notificacion a contratista</th>
<th width="7%">Fecha y Hora inicio intervencion en sitio</th>
<th width="7%">Fecha y Hora restablecimiento del servicio RIF</th>
<th width="7%">Tiempo de interrupcion (hh:mm)</th>
<th width="7%">Tiempo empleado contratista (hh:mm)</th>
<th width="7%">Observaciones</th>




<!--
<th width="12%">PLAN DE ACCION</th>
<th width="11%">PERSONAL</th>
-->
</tr>
<?php
$consulta = "SELECT *,
	CONCAT( 
    	TIMESTAMPDIFF(HOUR, fecha_inicio, fecha_fin), ':', 
    	MOD(TIMESTAMPDIFF(MINUTE, fecha_inicio, fecha_fin), 60), '' 
		 )AS tiempo_interrupcion,
	CONCAT( 
    	TIMESTAMPDIFF(HOUR, fecha_notificacion, fecha_fin), ':', 
    	MOD(TIMESTAMPDIFF(MINUTE, fecha_notificacion, fecha_fin), 60), '' 
		 )AS tiempo_empleado    	
 FROM(
	SELECT 
	centro.nombre as centro_nombre,
	st_ticketn.ticket,
	st_ticketn.idnodo,
	estacionentel.nombreestacion,
	estacionentel.tiponodo,	
	tecnologia.nombretecnologia,
	estacionentel.AREA,
	ticket_atencion.nombreatencion,
	ticket_afectacionservicio.nombreafectacionservicio,
	ticket_sistemafalla.nombresistemafalla,
	ticket_equipofalla.nombreequipofalla,
	ticket_tipofalla.nombretipofalla,
	ticket_solucion.nombresolucion,
	st_ticketn.descripcionfalla,
	timestamp(fecha_inicio_rif,hora_inicio_rif)AS fecha_inicio,
	timestamp(fecha_not_dim,hora_not_dim)AS fecha_notificacion,
	timestamp(fecha_not_sitio,hora_not_sitio)AS fecha_sitio,
	timestamp(fecha_fin_rif,hora_fin_rif)AS fecha_fin,
	st_ticketn.observaciones
	FROM 
	st_ticketn,
	estacionentel,
	tecnologia,
	centro,
	ticket_atencion,
	ticket_afectacionservicio,
	ticket_sistemafalla,
	ticket_equipofalla,
	ticket_tipofalla,
	ticket_solucion
	WHERE 	
	st_ticketn.idnodo=estacionentel.idestacionentel
	and estacionentel.idcentro=centro.idcentro
	and st_ticketn.idatencion=ticket_atencion.idatencion
	AND st_ticketn.idtecnologia=tecnologia.idtecnologia
	AND st_ticketn.idafectacionservicio=ticket_afectacionservicio.idafectacionservicio
	AND st_ticketn.idsistemafalla=ticket_sistemafalla.idsistemafalla
	AND st_ticketn.idequipofalla=ticket_equipofalla.idequipofalla
	AND st_ticketn.idtipofalla=ticket_tipofalla.idtipofalla
	AND st_ticketn.idsolucion=ticket_solucion.idsolucion
	". $strSql ."
)cn1 order by fecha_inicio desc"; 
$resultado = mysqli_query($conexion, $consulta);
$filas	   = mysqli_num_rows($resultado);

if($filas!=0){ 
	$i=0;
	while($dato=mysqli_fetch_array($resultado)){
		$i++;
		// $inicio = $dato['fecha_inicio_rif'].' '.$dato['hora_inicio_rif'];
		// $fin 	= $dato['fecha_fin_rif'].' '.$dato['hora_fin_rif'];
		// $dif 	= date("H:i", strtotime("00:00") + strtotime($fin) - strtotime($inicio));
		
		// /* ------------------------------------------------------ */
		// $s  = strtotime($fin)-strtotime($inicio);
		// $ss = strtotime($fin)-strtotime($inicio);
		// $d = intval($s/86400);
		// $s -= $d*86400;
		// $h = intval($s/3600);
		// $s -= $h*3600;
		// $m = intval($s/60);
		// $s -= $m*60;
		
		// if($dato['fecha_fin_rif']){
		// 	$dif1 = (($d*24)+$h)."hrs"." ".$m."min";
		// }else{
		// 	$dif1 = '';	
		// }
		// //$dif2= $d.$space.dias." ".$h.hrs." ".$m."min";
		// //$dif3= $d.$space.dias." ".$h.hrs." ".$m."min ".$s."seg";
		// /* ------------------------------------------------------ */
  //       $inicio = $dato['fecha_not'].' '.$dato['hora_not'];
  //       $fin 	= $dato['fecha_fin_rif'].' '.$dato['hora_fin_rif'];
  //       $dif 	= date("H:i", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio));

  //       $s  = strtotime($fin)-strtotime($inicio);
  //       $ss = strtotime($fin)-strtotime($inicio);
  //       $d = intval($s/86400);
  //       $s -= $d*86400;
  //       $h = intval($s/3600);
  //       $s -= $h*3600;
  //       $m = intval($s/60);
  //       $s -= $m*60;

  //       if($dato['fecha_fin_rif']){
  //           $dif2 = (($d*24)+$h).hrs." ".$m."min";
  //       }else{
  //           $dif2 = '';
  //       }

		// /* ------------------------------------------------------ */

		// if($i%2==0) $rowt="#f1f1f1"; else $rowt="#f6f7f8";

		// $rif = $dato['id_st_ticket']; 
		// $idestacion = $dato['idestacion'];
		// $estacion_html = $dato['estacion'];

		// if (!isset($dato['idestacion'])){
		//     $estacion_html = "<span class='cafe'>".$dato['estacion']."</span>";
  //       }

		if($nively == 1){
			$ticket_html = "<a href='$link_modulo?path=u_ticketn.php&ticket=".$dato['ticket']."'>".$dato['ticket']."</a>";
		}else{
			$ticket_html = $dato['ticket'];
		}

        $rowt = '';

	echo"
	<tr bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\">
	<td>".$i."</td>
	<td><center>".$dato['centro_nombre']."</center></td>
	<td><center>$ticket_html</center></td>
	<td><center>".$dato['idnodo']."</center></td>
	<td><center>".$dato['nombreestacion']."</center></td>
	<td><center>".$dato['tiponodo']."</center></td>
	<td><center>".$dato['nombretecnologia']."</center></td>
	<td><center>".$dato['AREA']."</center></td>
	<td><center>".$dato['nombreatencion']."</center></td>
	<td><center>".$dato['nombreafectacionservicio']."</center></td>
	<td><center>".$dato['nombresistemafalla']."</center></td>
	<td><center>".$dato['nombreequipofalla']."</center></td>
	<td><center>".$dato['nombretipofalla']."</center></td>
	<td><center>".$dato['nombresolucion']."</center></td>
	<td><center>".$dato['descripcionfalla']."</center></td>
	<td><center>".$dato['fecha_inicio']."</center></td>
	<td><center>".$dato['fecha_notificacion']."</center></td>
	<td><center>".$dato['fecha_sitio']."</center></td>
	<td><center>".$dato['fecha_fin']."</center></td>
	<td><center>".$dato['tiempo_interrupcion']."</center></td>
	<td><center>".$dato['tiempo_empleado']."</center></td>
	<td><center>".$dato['observaciones']."</center></td>

	</tr>
	";

	 }
	}
	?>
</table>
</form>			  
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
        var GB_ROOT_DIR = "./../../paquetes/greybox/";
    </script>    

    <script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
	<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
	<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css">

	<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
<link type="text/css" rel="stylesheet" href="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
