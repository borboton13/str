<?php
require("../../funciones/motor.php");

if(isset($_GET['letters'])){
	$letters = $_GET['letters'];
	$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = mysqli_query($conexion, "select id,razon_social from clientes where razon_social like '%".$letters."%'") or die(mysqli_error());
	while($inf = mysqli_fetch_array($res)){
		echo $inf["id"]."###".htmlentities ($inf["razon_social"])."|";
	}	
}
?>
