<?php

if(isset($_POST["fecha"]))
    $fecha = $_POST["fecha"]." 00:00:00";
else {
	$dato=mysqli_fetch_array(mysqli_query($conexion, "select now()"));
	$fecha=$dato[0];
}

if(isset($_POST["menos"])){
	$dato=mysqli_fetch_array(mysqli_query($conexion, "SELECT DATE_SUB('$fecha',INTERVAL 1 DAY)"));
	$fecha=$dato[0];
}

if(isset($_POST["mas"])){
    $dato=mysqli_fetch_array(mysqli_query($conexion, "SELECT DATE_ADD('$fecha',INTERVAL 1 DAY)"));
    $fecha=$dato[0];
}

$fecha=substr($fecha,0,10);

$idcuenta = null;
if(isset($_POST["cuenta"])){
    $idcuenta = $_POST["cuenta"];
}


?>
<div align="center"><span class="title">Transacciones</span></div>
<table width="98%" align="center" class="table4">
<tr><TD colspan="9">
<table>
<!--<tr><td><a class="enlaceboton" href="../../excel/excel_st_listado_ticket.php" onclick="openNewWindowhtml( this, '800', '590' );return false;"><img src="../../img/excel_ico.gif" alt="Ver Listado en Excel" width="16" height="16" border="0" align="absmiddle" /> Ver Todo Listado en Excel </a></td></tr>-->
<tr><td><a class="enlaceboton" href="#"><img src="../../img/excel_ico.gif" alt="Ver Listado en Excel" width="16" height="16" border="0" align="absmiddle" /> Exportar </a></td></tr>
<tr>
	<td class="marco">

        <form name="form1" method="post" action="#">
            <span class="title7">&nbsp;Seleccionar:&nbsp;</span>
            <!--<input class="btn_dark" name="menos" type="submit" value="&lt;" title="dia anterior">
            <input class="btn_dark" name="mas" type="submit"value="&gt;" title="dia siguiente">-->
            <!--<input name="fecha" type="text" onclick="displayCalendar(this,'yyyy-mm-dd',this)" id="fecha" value="<?/*=substr($fecha,0,10);*/?>">-->

            <select name="cuenta" class="selectbuscar" id="cuenta">
                <option value="0" selected class="title7">Elija una cuenta...</option>
                <?php
                $resultadox = mysqli_query($conexion, "select c.idcuenta, c.numero, c.moneda, b.codigo  
                                                           from cuenta c
                                                           join banco b on c.idbanco = b.idbanco");
                while($datox = mysqli_fetch_array($resultadox)){
                    echo'<option value="'.$datox['idcuenta'].'">'.$datox['numero']. '-'.$datox['moneda'].' ('.$datox['codigo'].')'.'</option>';
                }
                ?>
            </select>

            <input class="btn_dark" name="Submit" type="submit" value="Ver">
            <?php if($nively == 1){  ?>
                <input class="btn_dark" onClick="location.href='#'" type="button" value="Nuevo">
            <?php }  ?>
        </form>
    </td>
</tr>
</table>
</TD></tr>
<tr>
    <th width="5%">N&deg;</th>
    <th width="10%"><div align="center">Fecha</div></th>
    <th width="40"><div align="center">Glosa</div></th>
    <th width="15%"><div align="center">Importe</div></th>
    <th width="5%"><div align="center">Mov</div></th>
    <th width="10%"><div align="center">Trans</div></th>
    <th width="15%"><div align="center">Producto</div></th>
</tr>
<?php

// echo "----> " . $idcuenta;

/*$consulta = "SELECT id_st_ticket,ticket,idnodo,estacion,fecha_inicio_rif,hora_inicio_rif,fecha_fin_rif,hora_fin_rif, fecha_not,hora_not, tipo,problema,fecha_not,hora_not,plan_accion,trabajo_realizado,personal,observaciones,idestacion " .
		    "FROM st_ticket WHERE fecha_inicio_rif='$fecha'";*/

$consulta = "select t.idtransaccion, t.tipo, date_format(t.fecha,'%d/%m/%Y') as fecha, t.importe, t.notrans, t.glosa, tr.producto 
             from transaccion t 
             left join st_trabajos tr on t.id_item = tr.id_item 
             where t.idcuenta = '".$idcuenta."'";


$resultado = mysqli_query($conexion, $consulta);
$filas	   = mysqli_num_rows($resultado);

if($filas!=0){ 
	$i=0;
    $saldo = 0.0;
    while($dato=mysqli_fetch_array($resultado)){
        $id      = $dato['idtransaccion'];
        $fecha   = $dato['fecha'];
        $importe = $dato['importe'];
        $notrans = $dato['notrans'];
        $glosa   = $dato['glosa'];
        $tipo    = $dato['tipo'];
        $producto = $dato['producto'];

        if ($tipo == 'I'){
            $saldo = $saldo + $importe;
        }else {
            $saldo = $saldo - $importe;
        }

        $importe = number_format($importe, 2, '.', ',');
        $i++;
        ?>
        <tr>
            <td class="marco" align="center"><?=$i;?></td>
            <td class="marco" align="center"><?=$fecha;?></td>
            <td class="marco"><?=$glosa;?></td>
            <td class="marco" align="right"><?=$importe?></td>
            <td class="marco" align="center"><?=$tipo?></td>
            <td class="marco" align="center"><?=$notrans;?></td>
            <td class="marco" align="center"><?=$producto;?></td>
        </tr>
    <?php } ?>

        <tr>
            <td class="marco" align="right" colspan="3">Saldo:</td>
            <td class="marco" align="right"><?=number_format($saldo, 2, '.', ',')?></td>
            <td class="marco" align="center"</td>
            <td class="marco" align="center"</td>
            <td class="marco" align="center"</td>
        </tr>

<?php } ?>

</table>			  
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript">
        var GB_ROOT_DIR = "./../../paquetes/greybox/";
    </script>    
	<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
    <script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
<link type="text/css" rel="stylesheet" href="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
