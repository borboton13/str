<style>
	div.grippie {
		background:#EEEEEE url(../../paquetes/textarea/grippie.png) no-repeat scroll center 2px;
		border-color:#DDDDDD;
		border-style:solid;
		border-width:0pt 1px 1px;
		cursor:s-resize;
		height:9px;
		overflow:hidden;
	}
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
periodo,
DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha,
hora_programada AS h_prog,
para,
cc,
ref,
antecedentes,
trabajo_r,
conclusiones
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
<input type="hidden" name="path" value="trabajos_informar_<?=$pro_key?>_2r.php" />
<input type="hidden" name="id_st_cronograma_informes" value="<?=$id_st_cronograma_informes;?>" />
<input type="hidden" name="id_item" value="<?=$dato['id_item'];?>" />

<table width="100%" class="table2">
<caption>
<span style="font-size:18px">TRABAJO EXTRA </span><br />
Llenar Formulario Paso 2 de 3:
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
<td width="35%" align="right">Mantenimiento Nro: <strong class="medium"><?=$dato['periodo'];?> de
  <?=$de?>
</strong></td>
</tr>
</table>
<table width="100%" class="table2">
<tr>
<th colspan="2"><strong class="verde">Detalles del Servico:</strong></th>
</tr>
<tr>
<td width="58%">Caracteristicas: <span class="azul"><?=$dato_t['caracteristicas'];?></span></td>
<td width="42%">Fecha Actual:<span class="azul"> <?=$fecha;?></span></td>
</tr>
<tr>
<td>Estaci&oacute;n: <span class="azul"><?=$dato_t['ubicacion'];?></span></td>
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
<td><span class="azul"><?=$dato['fecha'];?></span></td>
</tr>
<tr>
<td width="25%">Hora Programada:</td>
<td><span class="azul"><?=$dato['h_prog'];?></span></td>
</tr>
<tr>
<td>Tecnico a Cargo:</td>
<td><span class="azul"><?=$tecnico;?></span></td>
</tr>
</table>
<table width="100%" cellspacing="2" class="table2">
<tr>
<th colspan="2"><strong class="verde"><div align="center">- DATOS PARA EL INFORME -</div></strong></th>
</tr>
<tr>
<th height="20"><span class="rojo">*</span>Para:</th>
</tr>
<tr>
<td height="20"><textarea name="para" class="resizable" style="width: 596px; height: 50px;" id="para"><?=$dato['para']?></textarea></td>
</tr>
<tr>
<th height="20"><span class="rojo">*</span>CC: (Copia)</th>
</tr>
<tr>
<td height="20"><textarea name="cc" class="resizable" style="width: 596px; height: 50px;" id="cc"><?=$dato['cc']?></textarea></td>
</tr>
<tr>
<th height="20"><span class="rojo">*</span>Referencia:</th>
</tr>
<tr>
<td height="20"><input name="ref" type="text" id="ref" value="<?=$dato['ref']?>" size="90" /></td>
</tr>
<tr>
<th height="20"><span class="rojo">*</span>Antecedentes:</th>
</tr>
<tr>
<td height="20"><textarea name="antecedentes" class="resizable" style="width: 596px; height: 100px;" id="antecedentes"><?=$dato['antecedentes']?></textarea></td>
</tr>
<tr>
<tr>
<th height="20"><span class="rojo">*</span>Trabajo Realizado:</th>
</tr>
<tr>
<td height="20"><textarea name="trabajo_r" class="resizable" style="width: 596px; height: 300px;" id="trabajo_r"><?=$dato['trabajo_r']?></textarea></td>
</tr>
<tr>
<th height="20"><span class="rojo">*</span>Conclusiones:</th>
</tr>
<tr>
<td height="20"><textarea name="conclusiones" class="resizable" style="width: 596px; height: 100px;" id="conclusiones"><?=$dato['conclusiones']?></textarea></td>
</tr>
</table>
<table width="100%" class="table2">
<tfoot>
<tr>
<td width="50%" ><span class="rojo">(*) Campos Requeridos</span><br /><center>
<input name="validar" type="submit" class="large" value="Siguiente &gt; Paso 3" />
</center></td>
</tr>
</tfoot>
</table>
<table width="600" border="0" align="right" class="table2">	
<tr><td class="marco"><? echo" <a class=\"enlaceboton\" href='../../html/html_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($dato['id_item'])."' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/c_html.gif' alt='Ver Informe en HTML' border=\"0\">Vista preliminar en HTML</a>"; ?></td><td class="marco"><? echo"<a class=\"enlaceboton\" href='../../pdf/pdf_st_".$pro_key.".php?id_st_cronograma_informes=".base64_encode($id_st_cronograma_informes)."&id_item=".base64_encode($dato['id_item'])."' onClick=\"openNewWindowhtml( this, '800', '590' );return false;\"><img src='../../img/imp.gif' alt='Ver Informe en PDF' border=\"0\">Vista Preliminar en PDF</a> ";
?></td><td class="marco"><a class="enlaceboton" href="<?=$link_modulo?>?path=trabajos_informar_<?=$pro_key?>_1.php&id_st_cronograma_informes=<?=$id_st_cronograma_informes?>" target='_top'><img src='../../img/change.gif' alt='Volver al Paso Anterior' border="0" align="absmiddle"> Volver Al Paso Anterior </a></td></tr></table>
</form>
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
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<script type="text/javascript">
function VerifyOne () {
if( isNull( document.amper.para) &&
isNull( document.amper.cc) &&
isNull( document.amper.ref) &&
isNull( document.amper.antecedentes) &&
isNull( document.amper.trabajo_r) &&
isNull( document.amper.conclusiones)
)
{ 
if(confirm("Esta Guardando esta informaci�n y Pasando al Paso 3 de 3."))
{return true;}
else {return false;}   

}
else {return false;}   	
}
</script>  