<style>	
	.time_picker_div {padding:5px;
		border:solid #999999 1px;
		background:#ffffff;}
	legend{
	font-weight:bold;
	font-style:italic}	
	div.grippie {
		background:#EEEEEE url(../../paquetes/textarea/grippie.png) no-repeat scroll center 2px;
		border-color:#DDDDDD;
		border-style:solid;
		border-width:0pt 1px 1px;
		cursor:s-resize;
		height:9px;
		overflow:hidden;
	}
.Estilo1 {font-size: 18px}
</style>
<? 
$id_st_cronograma_informes=$_GET["id_st_cronograma_informes"];

$fecha=date("d/m/Y");
$pro_key="f002";

$resultado=mysql_query("SELECT
id_st_proyecto,
id_item,
id_cliente,
id_usuario,
detalles,
periodo,
DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha,
conta,
hora_programada AS h_prog,
DATE_FORMAT(hora_llegada,'%Y-%m-%d %H:%i') AS hora_llegada,
DATE_FORMAT(hora_salida,'%Y-%m-%d %H:%i') AS hora_salida,
obs,
DATE_FORMAT(p1,'%Y-%m-%d %H:%i') AS p1,
DATE_FORMAT(p2,'%Y-%m-%d %H:%i') AS p2,
p3,
p4,
p6,
p7,
p8,
p9
FROM st_cronograma_informes_".$pro_key."
WHERE id_st_cronograma_informes_".$pro_key."='".$id_st_cronograma_informes."'");
$dato=mysql_fetch_array($resultado);

$datox=mysql_fetch_array(mysql_query("SELECT razon_social FROM clientes WHERE id='".$dato['id_cliente']."'"));
$cliente=$datox['razon_social'];
$datox=mysql_fetch_array(mysql_query("SELECT concat(nombre, ' ', ap_pat) as usuario FROM usuarios WHERE id='".$dato['id_usuario']."'"));
$tecnico=$datox['usuario'];
$datox=mysql_fetch_array(mysql_query("SELECT MAX(periodo) AS de FROM st_cronograma_informes_".$pro_key." WHERE id_item='".$dato['id_item']."'"));
$de=$datox['de'];

$dato_t=mysql_fetch_array(mysql_query("SELECT departamento,producto,marca,caracteristicas,ubicacion,sn FROM st_trabajos WHERE id_item='".$dato['id_item']."'"));



?>
<table width="600" align="center">
<tr>
<td><a class="enlaceboton" href="<?=$link_modulo?>?path=trabajos_ver_correlativo.php&nro=<?=$dato['id_st_proyecto']?>" target='_top'><img src='../../img/ico_detalles.gif' alt='Ver Proyecto' border="0" align="absmiddle"> Ver Lista de Equipos del Proyecto </a>
</td></tr>
<tr>
<td>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">
<input type="hidden" name="path" value="trabajos_informar_<?=$pro_key?>_1r.php" />

<input type="hidden" name="id_st_cronograma_informes" value="<?=$id_st_cronograma_informes;?>" />
<input type="hidden" name="id_item" value="<?=$dato['id_item'];?>" />

<table width="100%" class="table2">
<caption>
<span class="Estilo1">TRABAJO EXTRA </span>
<br />
Llenar Formulario Paso 1 de 3:
</caption>
<tr>
<td width="65%">Proyecto Nro:<span class="title">
  <?=$dato['id_st_proyecto'];?>
</span></td>
<td width="35%" align="right"><span class="medium">INF:</span><span class="medium azul"> <?=strtoupper($pro_key)?><?=str_pad($id_st_cronograma_informes, 4, "0", STR_PAD_LEFT);?></span></td>
</tr>
<tr>
<td>Cliente:<span class="medium title7">
  <?=$cliente;?>
</span></td>
<td width="35%" align="right">Intervenci&oacute;n Nro: <strong class="medium"><?=$dato['periodo'];?> de
  <?=$de?>
</strong></td>
</tr>
</table>
<table width="100%" class="table2">
<tr>
<th colspan="2"><strong class="verde">Detalles del Servico:</strong></th>
</tr>
<tr>
<td width="58%"><span class="rojo">*</span>Detalles:
  <input name="detalles" type="text" id="detalles" value="<?=$dato['detalles'];?>" size="35" maxlength="250"/></td>
<td width="42%"><div align="right">COD CONTA- 
    <input name="conta" type="text" id="conta" value="<?=$dato['conta'];?>" size="6" maxlength="6"/>
</div></td>
</tr>
<tr>
<td><span class="rojo">*</span>Estaci&oacute;n:
  <input name="ubicacion" type="text" id="ubicacion" value="<?=$dato_t['ubicacion'];?>" size="41" maxlength="100"/></td>
<td>
  Departamento:<span class="azul">
    <?=$dato_t['departamento'];?>
</span></td>
</tr>
</table>
<table width="100%" class="table2">
<tr>
<th colspan="2"><strong class="verde">Programacion:</strong></th>
</tr>
<tr>
<td width="25%">Fecha Programada:</td>
<td><span class="azul"><?=$dato['fecha'];?></span> </td>
</tr>
<tr>
<td width="25%">Hora Programada:</td>
<td><span class="azul"><?=$dato['h_prog'];?></span> </td>
</tr>
<tr>
<td>Tecnico a Cargo:</td>
<td><span class="azul"><?=$tecnico;?></span>                              </td>
</tr>
</table>

<table width="100%" border="0" cellpadding="0" cellspacing="2" class="table2">
<tr>
<th colspan="2"><strong class="verde">ATENCION:</strong></th>
</tr>
<tr>
<td width="49%"><div align="right"><span class="rojo">*</span>Notificaci&oacute;n:<input name="p1" type="text" id="p1" size="18" value="<?=$dato['p1']?>" onclick="displayCalendar(this,'yyyy-mm-dd hh:ii',this,true)"/><img onclick="displayCalendar(document.amper.p1,'yyyy-mm-dd hh:ii',this,true)" src="../../img/time.png" alt="Seleccionar fecha incial" width="16" height="16"></div></td>
<td width="51%"><div align="right"><span class="rojo">*</span>Ingreso al Sitio:<input name="time1" type="text" id="time1" size="17" value="<?=$dato['hora_llegada']?>" onclick="displayCalendar(this,'yyyy-mm-dd hh:ii',this,true)"/><img onclick="displayCalendar(document.amper.time1,'yyyy-mm-dd hh:ii',this,true)" src="../../img/time.png" alt="Seleccionar fecha incial" width="16" height="16"></div></td>
</tr>
<tr>
<td><div align="right">Inicio de Viaje:
    <input name="p2" type="text" id="p2" size="18" value="<?=$dato['p2']?>" onclick="displayCalendar(this,'yyyy-mm-dd hh:ii',this,true)"/><img onclick="displayCalendar(document.amper.p2,'yyyy-mm-dd hh:ii',this,true)" src="../../img/time.png" alt="Seleccionar fecha incial" width="16" height="16"></div></td>
<td><div align="right"><span class="rojo">*</span>Conclusi&oacute;n del trabajo:<input name="time2" type="text" id="time2" size="17" value="<?=$dato['hora_salida']?>" onclick="displayCalendar(this,'yyyy-mm-dd hh:ii',this,true)"/><img onclick="displayCalendar(document.amper.time2,'yyyy-mm-dd hh:ii',this,true)" src="../../img/time.png" alt="Seleccionar fecha incial" width="16" height="16"></div></td>
</tr>
</table>
<table width="100%" cellspacing="2" class="table2">
<tr>
<th colspan="2"><div align="center"><strong class="verde">RESPONSABLES DE TRABAJO</strong></div></th>
</tr>
<tr>
<th><strong class="verde"><span class="rojo">*</span>Autorizaci�n por Cliente </strong></th>
<th><strong class="verde"><span class="rojo">*</span>Personal de Dimesat srl</strong></th>
</tr>
<tr>
<td valign="top" width="50%"><textarea class="resizable" name="p3" style="width: 295px; height: 60px;" id="p3"><?=$dato['p3']?></textarea></td>
<TD valign="top" width="50%"><textarea class="resizable" name="p4" style="width: 295px; height: 60px;" id="p4"><?=$dato['p4']?></textarea></TD>
</tr>
<tr>
<th colspan="2"><strong class="verde"><span class="rojo">*</span>TIPO DE TRABAJO </strong></th>
</tr>
<tr>
  <td width="50%"><div align="right" style="padding-right:80px">
    <b>ENERGIA <input name="p6" type="radio" value="ENERGIA"  <? if($dato['p6']=="ENERGIA") { echo"checked";}?>/></b><br />
    <b>ALARMAS EXTERNAS <input name="p6" type="radio" value="ALARMAS EXTERNAS"  <? if($dato['p6']=="ALARMAS EXTERNAS") { echo"checked";}?>/></b><br />
    <b>BTS <input name="p6" type="radio" value="BTS" <? if($dato['p6']=="BTS") { echo"checked";}?>/></b><br />
    <b>RECTIFICADORES <input name="p6" type="radio" value="RECTIFICADORES" <? if($dato['p6']=="RECTIFICADORES") { echo"checked";}?>/></b><br />
    <b>GRUPO GENERADOR <input name="p6" type="radio" value="GRUPO GENERADOR" <? if($dato['p6']=="GRUPO GENERADOR") { echo"checked";}?>/></b><br />
    <b>INFRAESTRUCTURA <input name="p6" type="radio" value="INFRAESTRUCTURA" <? if($dato['p6']=="INFRAESTRUCTURA") { echo"checked";}?>/></b></div></td>
  <TD width="50%"><div align="right" style="padding-right:80px">
    <b>VSAT <input name="p6" type="radio" value="VSAT"  <? if($dato['p6']=="VSAT") { echo"checked";}?>/></b><br />
    <b>BATERIAS <input name="p6" type="radio" value="BATERIAS" <? if($dato['p6']=="BATERIAS") { echo"checked";}?>/></b><br />
    <b>MW <input name="p6" type="radio" value="MW" <? if($dato['p6']=="MW") { echo"checked";}?>/></b></div><div align="center">
    <b>OTROS <input name="p6" type="radio" value="OTROS" <? if(substr($dato['p6'],0,5)=="OTROS") { echo"checked";}?>/><input name="p6_otros" type="text" <? if(substr($dato['p6'],0,5)=="OTROS") { echo"value='".substr($dato['p6'],7)."'";}?>/></b></div></TD>
</tr>

<tr>
<th colspan="2"><strong class="verde"><span class="rojo">*</span>DESCRIPCION GENERAL DEL TRABAJO REALIZADO</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="p7" class="resizable" style="width: 596px; height: 100px;" id="p7"><?=$dato['p7']?></textarea></td>
</tr>

<tr>
<th colspan="2"><strong class="verde">REPUESTOS O INSUMOS UTILIZADOS</strong></th>
</tr>
<tr>
<th colspan="2"><div align="center"><strong class="verde"><span class="rojo">*</span>PROVISTOS POR EL CLIENTE</strong></div></th>
</tr>
<tr>
<td colspan="2">
<textarea name="p8" class="resizable" style="width: 596px; height: 100px;" id="p8"><?=$dato['p8']?></textarea></td>
</tr>

<tr>
<th colspan="2"><div align="center"><strong class="verde"><span class="rojo">*</span>PROVISTOS POR DIMESAT</strong></div></th>
</tr>
<tr>
<td colspan="2">
<textarea name="p9" class="resizable" style="width: 596px; height: 100px;" id="p9"><?=$dato['p9']?></textarea></td>
</tr>

<!--
<tr>
<th colspan="2"><div align="center"><strong class="verde">REPUESTOS O INSUMOS UTILIZADOS</strong></div></th>
</tr>
<tr>
<th><strong class="verde">PROVISTOS POR EL CLIENTE</strong></th>
<th><strong class="verde">PROVISTOS POR DIMESAT</strong></th>
</tr>
<tr>
<td valign="top" width="50%"><textarea name="p8" class="resizable" style="width: 295px; height: 100px;" id="p8"><?=$dato['p8']?></textarea></td>
<TD valign="top" width="50%"><textarea name="p9" class="resizable" style="width: 295px; height: 100px;" id="p9"><?=$dato['p9']?></textarea></TD>
</tr>
-->

<tr>
<th colspan="2" height="20" ><strong class="verde">OBSERVACIONES</strong></th>
</tr>
<tr>
<td colspan="2" height="20"><textarea name="obs" class="resizable" style="width: 596px; height: 100px;"  id="obs"><?=$dato['obs']?></textarea></td>
</tr>
</table>
<table width="100%" class="table2">
<tfoot>
<tr>
<td width="50%" ><span class="rojo">(*) Campos Requeridos</span><br /><center>
<input name="validar" type="submit" class="large" value="Siguiente &gt; Paso 2" />
</center></td>
</tr>
</tfoot>
</table>
</form>
<table width="400" border="0" align="right" class="table2">	
<tr><td class="marco"><? echo" <a class=\"enlaceboton\" href='../../html/html_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($dato['id_item'])."' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/c_html.gif' alt='Ver Informe en HTML' border=\"0\">Vista preliminar en HTML</a>"; ?></td><td class="marco"><? echo"<a class=\"enlaceboton\" href='../../pdf/pdf_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($dato['id_item'])."' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/imp.gif' alt='Ver Informe en PDF' border=\"0\">Vista Preliminar en PDF</a> ";
?></td></tr></table>
</td>
</tr>
</table>
<script type="text/javascript" src="../../paquetes/textarea/jquery-latest.js"></script>
<script type="text/javascript" src="../../paquetes/textarea/jquery.textarearesizer.compressed.js"></script>
<script type="text/javascript">
	/* jQuery textarea resizer plugin usage */
	$(document).ready(function() {
		$('textarea.resizable:not(.processed)').TextAreaResizer();
	});
</script>
<link type="text/css" rel="stylesheet" href="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>		
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<script type="text/javascript">
function VerifyOne () {
if( checkField( document.amper.detalles, isName, false) &&
checkField( document.amper.ubicacion, isName, false) &&
isNull( document.amper.time1) &&
isNull( document.amper.time2) &&
isNull( document.amper.p1) &&
isNull( document.amper.p3) &&
validarRB(document.amper.p6,'Seleccione el Tipo de Trabajo!') &&
isNull( document.amper.p7)
)
{ 
if(confirm("Esta Guardando esta informaci�n y Pasando al Paso 2 de 3."))
{return true;}
else {return false;}   

}
else {return false;}   	
}
</script>  
