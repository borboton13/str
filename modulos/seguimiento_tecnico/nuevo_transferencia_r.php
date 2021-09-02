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
$idcuentaDest = $_POST["cuentaDest"];

$glosa = $_POST["glosa"];
$notrans = $_POST["notrans"];




    $fechacre = date("Y-m-d H:i:s");

    $consulta = "INSERT INTO transaccion (fecha, importe, tipo, notrans, glosa, idcuenta, fechacre) 
                 VALUES('$fecha', '$importe', 'E', '$notrans', '$glosa', '$idcuenta', '$fechacre')";

    $consultaDest = "INSERT INTO transaccion (fecha, importe, tipo, notrans, glosa, idcuenta, fechacre) 
                     VALUES('$fecha', '$importe', 'I', '$notrans', '$glosa', '$idcuentaDest', '$fechacre')";

    mysqli_query($conexion, $consulta);
    mysqli_query($conexion, $consultaDest);

	header("location: ".$link_modulo."?path=transacciones.php");
?>