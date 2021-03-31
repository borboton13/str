<?php
//$conexion=mysql_connect("localhost","ariel_ampersia","ampersis");
//$conexion=mysql_connect("localhost","dimesatn_admcba","Shu;.VQf6#he");
//$conexion=mysql_connect("localhost","dimesatc_alpha","AgRh22UmLAxC");
//$conexion = mysql_connect("localhost","root","mysql");

$conexion = mysqli_connect("localhost", "root", "mysql", "sst");

if (!$conexion){

echo "<h2 align='center'>ERROR: Imposible establecer coneccion con el servidor</h2>";

exit;

}
//$base=mysql_select_db("dimesatn_stcb");
?>
