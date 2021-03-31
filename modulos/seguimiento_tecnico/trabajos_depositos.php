<?php
if($nively=='1'){ $adm=1;}

$id_item=$_GET["id_item"];
$resultado=mysqli_query($conexion, "SELECT departamento,producto,marca,caracteristicas,sn,ubicacion,id_st_proyecto FROM st_trabajos WHERE id_item='".$id_item."'");
$dato=mysqli_fetch_array($resultado);
$nro=$dato['id_st_proyecto'];
 
 $dato_p=mysqli_fetch_array(mysqli_query($conexion, "SELECT descripcion FROM parametrica WHERE grupo='st_archivo' AND sub_grupo='".$dato['producto']."'"));
 $pro_key=$dato_p['descripcion'];
	 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<title>Actividades</title>
</head>
<body style="padding-top:5px;">
<table width="100%" class="table2" align="center">
    <caption>TRANSACCIONES</caption>
	<!--<tr><th width="25%">Departamento:</th>
	<td width="75%" ><span class="blue"><?/*=$dato['departamento'];*/?></span></td>
	</tr>-->
	<tr><th>Producto/serv:</th><td ><span class="blue"><?=$dato['producto'];?></span></td></tr>
	<!--<tr><th>Marca:</th><td ><span class="azul"><?/*=$dato['marca'];*/?></span> <?php /*if($dato['sn']!='') echo"<br><span class='small'>S/N: ".$dato['sn']."</span>";  */?></td></tr>-->
	<tr><th>Caracteristicas:</th><td ><span class="blue"><?=$dato['caracteristicas']?></span></td></tr>
	<tr><th width="25%">Estaci&oacute;n:</th>
	<td width="75%" ><span class="blue"><?=$dato['ubicacion']?></span></td>
	</tr>	  
</table>
<?php
    /*$consulta="SELECT st.id_st_cronograma_informes_".$pro_key.",date_format(st.fecha,'%d/%m/%Y'),st.condicion_final,st.id_usuario,CONCAT(u.nombre,' ',u.ap_pat),date_format(st.hora_programada,'%H:%i'),st.postm_condicion_final,st.postm_fecha,st.periodo,st.pasos,st.revision
    FROM st_cronograma_informes_".$pro_key." st, usuarios u
    WHERE st.id_item='".$id_item."' AND st.id_usuario=u.id
    ORDER BY st.periodo ASC";*/

    $consulta = "select t.idtransaccion, t.tipo, date_format(t.fecha,'%d/%m/%Y') as fecha, t.importe, t.notrans, t.glosa 
    from transaccion t 
    where t.id_item = '".$id_item."'";

    $resultado = mysqli_query($conexion, $consulta);
	$filas     = mysqli_num_rows($resultado);
?>
    <br />
	<table width="100%" class="table2" align="center">
      <tbody>
      <tr>
          <td colspan="5" align="right">
              <a href="<?=$link_modulo_r?>?path=trabajos_depositos_adicionar.php&id_item=<?=$id_item?>" class="enlaceboton">
                  <img src="../../img/adicionar.gif" alt="Adicionar" border="0" align="absmiddle" > Adicionar transaccion</a>
          </td>
      </tr>
        <tr>
            <th width="15%"><div align="center">Fecha</div></th>
		    <th width="45"><div align="center">Glosa</div></th>
            <th width="15%"><div align="center">Importe</div></th>
            <th width="5%"><div align="center">Mov</div></th>
            <th width="15%"><div align="center">Trans</div></th>
        </tr>
        <?php
        if($filas!=0){

        $saldo = 0.0;
        while($dato=mysqli_fetch_array($resultado)){
            $id      = $dato['idtransaccion'];
            $fecha   = $dato['fecha'];
            $importe = $dato['importe'];
            $notrans = $dato['notrans'];
            $glosa   = $dato['glosa'];
            $tipo    = $dato['tipo'];

            if ($tipo == 'I'){
                $saldo = $saldo + $importe;
            }else {
                $saldo = $saldo - $importe;
            }

            $importe = number_format($importe, 2, '.', ',')
        ?>
        <tr>
            <td class="marco" align="center"><?=$fecha;?></td>
            <td class="marco"><?=$glosa;?></td>
            <td class="marco" align="right"><?=$importe?></td>
            <td class="marco" align="center"><?=$tipo?></td>
            <td class="marco" align="center"><?=$notrans;?></td>
        </tr>
        <?php } ?>

        <tr>
            <td class="marco" align="right" colspan="2">Saldo:</td>
            <td class="marco" align="right"><?=number_format($saldo, 2, '.', ',')?></td>
            <td class="marco" align="center"</td>
            <td class="marco" align="center"</td>
        </tr>

        <?php } ?>

        </tbody>
<?php if($adm){ ?>
        <tfoot>
        <tr>
            <td colspan="5" align="right">
                <a href="<?=$link_modulo_r?>?path=trabajos_depositos_adicionar.php&id_item=<?=$id_item?>" class="enlaceboton">
                    <img src="../../img/adicionar.gif" alt="Adicionar" border="0" align="absmiddle" > Adicionar transaccion</a>
            </td>
        </tr>

        </tfoot>
<?php } ?>

</body>
<script type="text/javascript">
function openNewWindowhtml( object, width, height ) {
    ventana = window.open( object.href, '','toolbar=1, location=0, directories=0, status=0, menubar=1, scrollbars=1, resizable=1, width=' + width + ', height=' + height );
}
function verificar() {
    if (document.getElementById('ocultar').checked == false){
        if(document.amper.observacion.value!="") { return true;}
        else { alert("Inserte su observacion"); document.amper.observacion.focus();	return false;}
    }
}

</script>
</html>
