<?php
if (isset($_POST['modificar_cliente'])) {

$dato=mysqli_fetch_array(mysqli_query($conexion, "select now()"));
$fecha=$dato[0];
//datos cliente
$id = $_POST["id"];
$nivelc = $_POST["nivelc"];
$tipoc = $_POST["tipoc"];
$area = $_POST["area"];
$caracteristicas = $_POST["caracteristicas"];
$nit = $_POST["nit"];
$dir = $_POST["dir"];
$pais = $_POST['pais'];
$ciudad = $_POST['ciudad'];


$consulta="UPDATE clientes SET
caracteristicas='$caracteristicas',
nit='$nit',
tcliente='$tipoc',
area='$area',
direccion='$dir',
pais='$pais',
ciudad='$ciudad',
nivel_cliente='$nivelc',
resp_mod='$id_user',
ult_fecha_mod='$fecha'
WHERE id='$id'";

	if(mysqli_query($conexion, $consulta))
	{
		echo "<b>CIERRE LA VENTANA PARA<BR>VISUALIZAR LOS CAMBIOS</b>";
	}
	else echo"OCURRIO UN ERROR - intente nuevamente";

}
else 
{
header("Location: ../index.php");

}
?>

