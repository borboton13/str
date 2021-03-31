<?php

$idform = base64_decode($_GET['idform']);
$codigo = strtolower($_GET['codigo']);
$params = base64_decode($_GET['params']);
$idevento= ($_GET['idevento']);

//echo ($idevento);
//echo ($codigo);
//echo ($params);

$resultado = mysql_query("SELECT * FROM formulario_p013n WHERE idevento = '$idevento' ");
$totalFilas    =    mysql_num_rows($resultado);  

if ($totalFilas!=0){
	
	mysql_query("DELETE FROM formulario_p013n WHERE idevento = " . $idevento);	
	mysql_query("DELETE FROM formulario_mtto_n WHERE codigo='P013n' and idevento = " . $idevento);	
}else{
	mysql_query("DELETE FROM formulario_".$codigo." WHERE id = " . $idform);	

}


$url_volver = $link_modulo."?path=prev_estacion.php$params";

header("Location: ".$url_volver);

?>

