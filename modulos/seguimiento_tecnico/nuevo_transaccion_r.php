<?php
require("../../funciones/motor.php");
require("../../funciones/funciones.php");


function convertfecha_($fecha, $separador){
    $var    = explode($separador, $fecha);
    $res  = $var[2]."-".$var[1]."-".$var[0];
    return $res;
}
/*
<input type="hidden" name="id_item" value="<?=$id_item?>"/>
<input type="hidden" name="pro_key" value="<?=$pro_key?>"/>
<input type="hidden" name="id_st_proyecto" value="<?=$nro?>"/>
*/
$fecha = convertfecha_($_POST['fecha'], "/");
$importe = $_POST["importe"];
$tipo = $_POST["tipo"];
$idcuenta = $_POST["cuenta"];
$glosa = $_POST["glosa"];
$notrans = $_POST["notrans"];


// $id_item = 'NULL';
//$pro_key = $_POST["pro_key"];

    $fechacre = date("Y-m-d H:i:s");

    //$consulta = "INSERT INTO transaccion (fecha, importe, tipo, notrans, glosa, idcuenta, id_item, fechacre) VALUES('$fecha', '$importe', '$tipo', '$notrans', '$glosa', '$idcuenta', '$id_item', '$fechacre')";
    $consulta = "INSERT INTO transaccion (fecha, importe, tipo, notrans, glosa, idcuenta, fechacre) 
                 VALUES('$fecha', '$importe', '$tipo', '$notrans', '$glosa', '$idcuenta', '$fechacre')";

    mysqli_query($conexion, $consulta);
	header("location: ".$link_modulo."?path=transacciones.php");
?>