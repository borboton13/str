<?php

if (isset($_POST['adicionar_cliente'])) {

//datos cliente
$rs = $_POST["rs"];

echo "-------> " . $rs;

//$rs = ereg_replace( "([     ]+)", " ", trim($rs) );
//$rs = trim($rs);
//$nivelc = $_POST["nivelc"];
$nivelc = 5;
$tipoc = $_POST["tipoc"];
$area = $_POST["area"];
$caracteristicas = $_POST["caracteristicas"];
$nit = $_POST["nit"];
$dir = $_POST["dir"];
$pais = $_POST['pais'];
$ciudad = $_POST['ciudad'];
//datos contacto
$cnombre = $_POST["cnombre"];
$ccargo = $_POST["ccargo"];
$cdpto = $_POST["cdpto"];
$ctelf = $_POST["ctelf"];
$ccel = $_POST["ccel"];
$cmail = $_POST["cmail"];
$cfax = $_POST["cfax"];
$cobs = $_POST['cobs'];

//$dato=mysql_fetch_array(mysql_query("SELECT incrementar_nro(1,'clientes')"));
//$nro_=$dato[0];

$nro_ = incrementar_nro($conexion, 1, 'clientes');

$filas=mysqli_num_rows(mysqli_query($conexion, "SELECT id FROM clientes WHERE razon_social='$rs';"));
echo "-------> filas: " . $filas;

if($filas==0) {
    echo "-------> filas: " . $filas;
    //inserta cliente
    $consulta="INSERT INTO clientes (id, razon_social, caracteristicas, nit, tcliente, area, direccion, pais, ciudad, nivel_cliente, creador, fecha_crea, resp_mod, ult_fecha_mod) VALUES ('$nro_', '$rs', '$caracteristicas', '$nit', '$tipoc', '$area', '$dir', '$pais', '$ciudad', '$nivelc', '$id_user', NOW(), '$id_user', NOW())";
    echo "-------> consulta Cliente: " . $consulta;
    $resultado=mysqli_query($conexion, $consulta);

    //inserta contacto
    $consulta = "INSERT INTO contactos (id_cliente, nombre, cargo, dpto, telf, celular, email, fax, obs, id_user, fecha_registro) VALUES ('$nro_', '$cnombre', '$ccargo', '$cdpto', '$ctelf', '$ccel', '$cmail', '$cfax', '$cobs', '$id_user', NOW())";
    echo "<br />";
    echo "-------> consulta Contacto: " . $consulta;

    $resultado=mysqli_query($conexion, $consulta);

header("Location: clientes.php?path=cliente_detalles.php&nro=".base64_encode($nro_));
}
else echo"<b>MENSAJE: El CLIENTE <b>$rs</b> ya exite! <br />";

}
else 
{
header("Location: ../index.php");
}
?>

