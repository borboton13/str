<?php
$id = $_GET["id"];
$id_item=$_GET["id_item"];

$resultado=mysqli_query($conexion, "SELECT t.fecha, t.importe, t.tipo, t.notrans, t.glosa, concat(c.numero, '-', c.moneda, ' ') as cuenta
                                    FROM transaccion t
                                    LEFT JOIN cuenta c ON t.idcuenta = c.idcuenta 
                                    WHERE t.idtransaccion = '".$id."'");
$dato=mysqli_fetch_array($resultado);

$fecha   = $dato['fecha'];
$importe = $dato['importe'];
$tipo    = $dato['tipo'];
$notrans = $dato['notrans'];
$glosa   = $dato['glosa'];
$cuenta  = $dato['cuenta'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<title>Transacciones</title>
</head>
<body style="padding-top:5px;">

<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne();">		
<input type="hidden" name="path" value="trabajos_depositos_eliminar_r.php" />
<table width="100%" align="center" class="table2">
<caption>¿Eliminar Transaccion?</caption>
<tr>
<th colspan="2"><strong class="verde">Transaccion:</strong></th>
</tr>
    <tr>
        <th width="30%">Fecha:</th>
        <td width="70%"><?=$fecha?></td>
    </tr>

    <tr>
        <th width="30%">Importe:</th>
        <td width="70%"><?=$importe?></td>
    </tr>

    <tr>
        <th width="30%">Tipo Movimiento:</th>
        <td width="70%"><?=$tipo?></td>
    </tr>

    <tr>
        <th width="30%">Glosa:</th>
        <td width="70%"><?=$glosa?></td>
    </tr>

    <tr>
        <th width="30%">Cuenta:</th>
        <td width="70%"><?=$cuenta?></td>
    </tr>

    <tr>
        <th width="30%">No trans:</th>
        <td width="70%"><?=$notrans?></td>
    </tr>

    <tr>
        <td colspan="2" align="center"></span></td>
    </tr>


    <tfoot>
    <tr>
    <td colspan="2" align="center">
        <input type="hidden" name="id_item" value="<?=$id_item?>"/>
        <input type="hidden" name="id" value="<?=$id?>"/>
        <input name="Atras" type="button" id="Atras" value="Atras" onclick="javascript:history.back(1);" />
    <input type="submit" name="Submit" value="Eliminar" />
    </td>
    </tr>
    </tfoot>
</table>
</form>
</body>

</html>
