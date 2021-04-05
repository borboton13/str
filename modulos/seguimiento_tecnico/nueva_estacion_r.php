<?php
require("../../funciones/funciones.php");

	$nombre = $_POST["nombre"];
	$codigo = $_POST["codigo"];
	$idcentro = $_POST["centro"];
	$zona = $_POST["zona"];
	$provincia = $_POST["provincia"];


	$resultado=mysqli_query($conexion, "SELECT id FROM clientes WHERE razon_social='$cliente';");
	$filas=mysqli_num_rows($resultado);

	$idestacion = incrementar_nro($conexion, 2, 'idestacion');
		
	$consulta="INSERT INTO estacion SET 
	idestacion	= '".$idestacion."',
	codigo	= '".$codigo."',
	nombre	= '".$nombre."',
	idcentro	= '".$idcentro."',
	provicia	= '".$provincia."',
	tipo_zona	= '".$zona."'";

	$resultado=mysqli_query($conexion, $consulta);

	if($resultado) {
		header("Location: ".$link_modulo."?path=ver_estaciones.php");
	}else
		echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysqli_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
		

?>

