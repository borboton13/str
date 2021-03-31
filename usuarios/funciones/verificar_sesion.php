<?php
$santoy=$_SESSION["santox"];
$senay=$_SESSION["senax"];
$sesiony=$_SESSION["sesionx"];
$nively = $_SESSION["nivelx"];

$consulta="SELECT nombre,ap_pat,ap_mat,cargo,nro_ing,id FROM usuarios WHERE cuenta='$santoy' and contrasena='$senay' and sesion_temp='$sesiony'";
$resultado  = mysqli_query($conexion, $consulta);
$filas      = mysqli_num_rows($resultado);
if($filas!=0)
{
$dato = mysqli_fetch_array($resultado);
$nombrec    = $dato[0]." ".$dato[1]." ".$dato[2];
$cargo      = $dato[3];
$nro_ing    = $dato[4];
$id_user    = $dato[5];

$cuenta = $santoy;

}  
else
{
header("Location: ../index.php?sw=2");
/*echo "<h2 align='center'>ERROR: No se puede verificar su autentificaci�n!<br>
pongase en contacto con el administrador del Sistema de AMPER<br>
<b>marcelo.chavez@amperonline.com</b><br>
<a href='../index.php'>Ir a pagina principal</a>
</h2>";
*/

exit;
}
?>
