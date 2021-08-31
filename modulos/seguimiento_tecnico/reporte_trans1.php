<?php

$idcuenta = null;

$ingresos = 0.0;
$egresos = 0.0;
$cuentaDetalle = "";

if(isset($_POST["idcuenta"])){
    $idcuenta = $_POST["idcuenta"];

    $res = mysqli_query($conexion, "SELECT SUM(IF(t.`tipo`= 'I', t.`importe`, 0)) AS ingresos, SUM(IF(t.`tipo`= 'E', t.`importe`, 0)) AS egresos
                                    FROM transaccion t 
                                    WHERE t.idcuenta = " . $idcuenta);
    $data = mysqli_fetch_row($res);

    $ingresos = $data[0];
    $egresos = $data[1];

    $res1 = mysqli_query($conexion, "SELECT c.`idcuenta`, c.`descripcion` FROM cuenta c  WHERE c.`idcuenta` = " . $idcuenta );
    $data1 = mysqli_fetch_row($res1);
    $cuentaDetalle = ' (' . $data1[1] . ')';

}


?>
<div align="center"><span class="title">Reporte A</span></div>
<table width="70%" align="center" class="table4">
<tr>
    <TD colspan="9">
        <table>
        <tr>
            <td class="marco">

                <form name="form1" method="post" >
                    <span class="title7">&nbsp;Seleccionar:&nbsp;</span>

                    <select name="idcuenta" class="selectbuscar" id="idcuenta">
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
                        <!--<input class="btn_dark" onClick="location.href='#'" type="button" value="Nuevo">-->
                        <input class="btn_dark" onClick="location.href='<?=$mst?>nuevo_transaccion.php'" type="button" value="Nuevo">
                    <?php }  ?>

                    <span class="title7">&nbsp;Ingresos:&nbsp;</span> <?php echo number_format($ingresos, 2, '.', ','); ?>
                    <span class="title7">&nbsp;Egresos:&nbsp;</span> <?php echo number_format($egresos, 2, '.', ','); ?>
                    <span class="title7">&nbsp;Saldo:&nbsp;</span> <?php echo number_format($ingresos-$egresos, 2, '.', ','); ?>
                    <span class="title7"><?php echo $cuentaDetalle; ?></span>

                </form>
            </td>
        </tr>
        </table>
    </TD>
</tr>
<tr>
    <th width="30%"><div align="center">Proyecto</div></th>
    <th width="30"><div align="center">Detalle</div></th>
    <th width="20%"><div align="center">Cuadrilla</div></th>
    <th width="10%"><div align="center">Ingresos</div></th>
    <th width="10%"><div align="center">Egresos</div></th>
</tr>
<?php
/*
$consulta = "select t.idtransaccion, t.tipo, date_format(t.fecha,'%d/%m/%Y') as fecha, t.importe, t.notrans, t.glosa, tr.producto, p.declaracion_proyecto 
             from transaccion t 
             left join st_trabajos tr on t.id_item = tr.id_item 
             left join st_proyecto p  ON tr.id_st_proyecto = p.id_st_proyecto
             where t.idcuenta = '".$idcuenta."'  
             order by t.fecha";
*/

$consulta = "   SELECT p.declaracion_proyecto, tr.caracteristicas, i.id_usuario, SUM(IF(t.tipo= 'I', t.importe, 0)) AS ingresos, SUM(IF(t.tipo= 'E', t.importe, 0)) AS egresos
                FROM transaccion t 
                LEFT JOIN st_trabajos tr ON t.id_item = tr.id_item 
                LEFT JOIN st_proyecto p  ON tr.id_st_proyecto = p.id_st_proyecto
                LEFT JOIN st_cronograma_informes_f002 i ON tr.id_item = i.id_item
                WHERE t.idcuenta = '".$idcuenta."'  
                GROUP BY p.declaracion_proyecto, tr.caracteristicas, i.id_usuario";




$resultado = mysqli_query($conexion, $consulta);
$filas	   = mysqli_num_rows($resultado);

if($filas!=0){ 
	$i=0;
    $saldo = 0.0;
    $ingresos = 0.0;
    $egresos = 0.0;
    while($dato=mysqli_fetch_array($resultado)){
        $declaracion_proyecto   = $dato['declaracion_proyecto'];
        $caracteristicas = $dato['caracteristicas'];
        $id_usuario = $dato['id_usuario'];
        $ingresos   = $dato['ingresos'];
        $egresos    = $dato['egresos'];

        $ingresos = number_format($ingresos, 2, '.', ',');
        $egresos = number_format($egresos, 2, '.', ',');


        ?>
        <tr>
            <td class="marco" align="center"><?=$declaracion_proyecto;?></td>
            <td class="marco" align="center"><?=$caracteristicas;?></td>
            <td class="marco"><?=$id_usuario;?></td>
            <td class="marco" align="right"><?=$ingresos?></td>
            <td class="marco" align="center"><?=$egresos?></td>

        </tr>
    <?php } ?>

        <!--
        <tr>
            <td class="marco" align="right" colspan="3">Saldo:</td>
            <td class="marco" align="right"><?=number_format($saldo, 2, '.', ',')?></td>
            <td class="marco" align="center"</td>
            <td class="marco" align="center"</td>
            <td class="marco" align="center"</td>
        </tr>
        -->

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
