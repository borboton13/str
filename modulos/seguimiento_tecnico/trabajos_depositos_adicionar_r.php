<?php
require("../../funciones/motor.php");
require("../../funciones/funciones.php");


function convertfecha_($fecha, $separador){
    $var    = explode($separador, $fecha);
    $res  = $var[2]."-".$var[1]."-".$var[0];
    return $res;
}

$fecha = convertfecha_($_POST['fecha'], "/");
$importe = $_POST["importe"];
$tipo = $_POST["tipo"];
$idcuenta = $_POST["cuenta"];
$glosa = $_POST["glosa"];
$notrans = $_POST["notrans"];


$id_item = $_POST["id_item"];
$pro_key = $_POST["pro_key"];

    $fechacre = date("Y-m-d H:i:s");

    $consulta = "INSERT INTO transaccion (fecha, importe, tipo, notrans, glosa, idcuenta, id_item, fechacre)
                 VALUES('$fecha', '$importe', '$tipo', '$notrans', '$glosa', '$idcuenta', '$id_item', '$fechacre')";

    mysqli_query($conexion, $consulta);
	header("location: ".$link_modulo_r."?path=trabajos_depositos.php&id_item=".$id_item);
?>