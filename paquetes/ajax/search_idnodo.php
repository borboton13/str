<?php
require("../../funciones/motor.php");

//if(isset($_POST['idnodo'])){
	$letters = $_POST['idestacion'];
	//$letters = preg_replace("/[^a-z0-9 ]/si","",$letters);
	$res = mysqli_query($conexion, "select nombreestacion from estacionentel where idestacionentel = '".$letters."'") ;
	
	/*$cadena="<label>SELECT javier (paises)</label> ";
	//	while($inf = mysql_fetch_array($res)){
		//$cadena= $inf['nombre'];
	//}	
	
	echo  $cadena;*/



	//$cadena="<label>SELECT 2 (paises)</label> 
	//		<select id=lista2 name='lista2'>";

	//while ($ver=mysql_fetch_array($res)) {
		//$cadena=$cadena.'<option value=1>'.utf8_encode($ver['nombre']).'</option>';
	//}
    $cadena = '';
	while ($ver=mysqli_fetch_array($res)) {
		//$cadena="<script> document.getElementById('estacion').value =" .utf8_encode($ver['nombre']).' </script>;';

		$cadena=" <script> $('#estacion').val('".utf8_encode($ver['nombreestacion'])."'); </script>";

		//echo $inf["id"]."###".htmlentities ($inf["razon_social"])."|";
	}

	//$('#estacion').val(ARQUE');

	//$('#estacion').val('ARQUE');

	//$('#estacion').val('ARQUE');

	

	echo  $cadena;
    mysqli_free_result($res);
	mysqli_close($conexion);
	/*$pila = array();
	while ($fila = mysql_fetch_array($res)) {
      array_push($pila, $fila['nombre']);
	}

echo json_encode($pila);*/

		
	//echo $cadena;
//}
?>