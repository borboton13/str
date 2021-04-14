<?php
require("../../funciones/motor.php");
require("../../funciones/funciones.php");


    $id = $_POST["id"];
    $id_item = $_POST["id_item"];

    $consulta = "delete from transaccion where idtransaccion = $id";

    mysqli_query($conexion, $consulta);
	header("location: ".$link_modulo_r."?path=trabajos_depositos.php&id_item=".$id_item);

?>