<?php
require("../../funciones/funciones.php");
//
$cliente = $_POST["cliente"];
$fecha_ini = convertfecha($_POST["fecha_ini"],"/");
$fecha_fin = convertfecha($_POST["fecha_fin"],"/");
$obs = $_POST["obs"];


	$resultado=mysqli_query($conexion, "SELECT id FROM clientes WHERE razon_social='$cliente';");
	$filas=mysqli_num_rows($resultado);
	if($filas!=0)
	{
	$dato=mysqli_fetch_array($resultado);
	$id_cliente=$dato['id'];

		/*
		$dato=mysql_fetch_array(mysql_query("SELECT incrementar_nro(2,'seguimiento_tecnico')"));
		$nro=$dato[0];
		*/
		$nro = incrementar_nro($conexion, 2, 'seguimiento_tecnico');
		
$consulta="INSERT INTO st_proyecto SET 
id_st_proyecto='".$nro."',
id_cliente='".$id_cliente."',
declaracion_proyecto='".$obs."',
fecha_inicio='".$fecha_ini."',
fecha_final='".$fecha_fin."',
id_usuario='".$id_user."',
fecha_registro=NOW()
";		
$resultado=mysqli_query($conexion, $consulta);

if($resultado) {
	//mkdir ("../../archivos_st/".$dato[0], 0777);
	mkdir ("../../archivos_st/".$nro, 0777);
	//header("Location: ".$link_modulo."?path=trabajos_ver.php&nro=".base64_encode($nro));
	header("Location: ".$link_modulo."?path=trabajos_ver_correlativo.php&nro=".$nro);
	}
	else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysqli_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
		
	}
	else
	{ echo "MENSAJE: El CLIENTE: <b>".$cliente."</b> no exite <a href='javascript:history.back(1);'>Haga Click Aqui para RETORNAR</a>";
	}
?>

