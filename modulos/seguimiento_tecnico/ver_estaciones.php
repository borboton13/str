<?php
include("../../funciones/class.paginado.php");

$adm = '';
if($nively=='1'){ $adm=1;}

$pagina = 0;
if (isset($_GET['pagina'])){
    $pagina = $_GET['pagina'];
}

$nro_por_pagina=15;

$consulta = "select e.idestacion, e.codigo, e.nombre, c.nombre as centro, e.provicia, e.tipo_zona 
             from estacion e
             join centro c on e.idcentro = c.idcentro";

?>

<div align="center"><span class="title">Lista de Estaciones y Locaciones</span></div>

<table width="100%" class="table4">
    <tr>
        <td colspan="3" class="paginado">
            <div align="left">
                <?php
                $rs = new paginado($conexion);
                $rs->pagina($pagina);
                $rs->porPagina($nro_por_pagina);
                $rs->propagar("path");
                $rs->propagar("nro_por_pagina");

                if(!$rs->query($consulta)){
                    die( $rs->error() ); }
                echo "Mostrando ".$rs->desde()." - ".$rs->hasta()." de un total de ".$rs->total()."<br>"; ?>
            </div>
        </td>
        <td colspan="5" class="paginado">
            <?php if($admin){ ?>
                <div align="right">
                    <input class="btn_dark" onClick="location.href='<?=$mst?>nueva_estacion.php'" type="button" value="Nuevo">
                </div>
            <?php } ?>
        </td>
    </tr>
    <tr>
        <th width="5%"><div align="center">Id</div></th>
        <th  width="10%"><div align="center">Codigo</div></th>
        <th  width="30%"><div align="center">Nombre</div></th>
        <th  width="20%"><div align="center">Centro</div></th>
        <th  width="20%"><div align="center">Provincia</div></th>
        <th  width="10%"><div align="center">Zona</div></th>
        <th  width="10%"><div align="center"></div></th>
    </tr>
    <?php

    $i=0;
    while($dato = $rs->obtenerArray()){

        $idestacion = $dato['idestacion'];
        $codigo = $dato['codigo'];
        $nombre = $dato['nombre'];
        $centro = $dato['centro'];
        $provincia = $dato['provicia'];
        $zona = $dato['tipo_zona'];

        ///////////
        $i++;
        if($i%2==0){
            $rowt="#f6f7f8";
        }else{
            $rowt="#f1f1f1";
        }
        echo "<tr height='25' bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\">
 
            <td align='center' class='smallmed'>$idestacion</td>
            <td align='center'>$codigo</td>			          
			<td align='center'>$nombre</td>
			<td class='small'>$centro</td>
			<td align='center'>$provincia</td>
			<td align='center'>$zona</td>
			<td align='center'></td>
			
			</tr>";

    }
    ?>
    <tfoot>
    <tr>
        <td colspan="7" class="paginado">
            <?php echo $rs->anterior()." - ".$rs->nroPaginas()." - ".$rs->siguiente(); ?>
        </td>
    </tr>
    </tfoot>
</table>
