<?php
require("../../funciones/motor.php");

//if(isset($_POST['idnodo'])){
	$letters = $_POST['idestacionentel'];
	//$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = mysql_query("SELECT nombreestacion,tecnologia FROM estacionentel WHERE idestacionentel= ".$letters) ;

	//SELECT nombreestacion,tecnologia FROM estacionentel WHERE idsitio='CB0361'
	
	
	
	while ($ver=mysql_fetch_array($res)) {
		//$cadena="<script> document.getElementById('estacion').value =" .utf8_encode($ver['nombre']).' </script>;';

		$cadena=" <script> $('#estacion').val('".utf8_encode($ver['nombre'])."'); </script>";

		//echo $inf["id"]."###".htmlentities ($inf["razon_social"])."|";
	}		

	echo  $cadena;
	mysql_free_result($res);
	mysql_close($conexion);
	
?>