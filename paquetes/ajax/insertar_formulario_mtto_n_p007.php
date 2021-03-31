<?php

require("../../funciones/motor.php");
require("../../funciones/funciones.php");

	$id = incrementar_id("formulario_mtto_n_p007", "id");

$idevento     = $_POST['idevento'];
$idformulario = $_POST['idformulario'];
$titulo       = $_POST['titulo'];
$params       = $_POST['params'];
$p01    = $_POST['p01'];
$p02    = $_POST['p02'];
$p03    = $_POST['p03'];
$p04    = $_POST['p04'];
$p05    = $_POST['p05'];
$p06    = $_POST['p06'];
$p07    = $_POST['p07'];
$p08    = $_POST['p08'];
$p09    = $_POST['p09'];

$p11    = $_POST['p11'];
$p12    = $_POST['p12'];
$p13    = $_POST['p13'];
$p14    = $_POST['p14'];

	//(19,$id,'P013n','Formulario Mtto. Preventivo Radio Bases Nuevo','Formulario Mtto. Preventivo Radio Bases Nuevo',$idevento    )

	//$Hoy = date("Y-m-d H:i:s");
	$res = mysql_query("INSERT INTO formulario_mtto_n_p007 VALUES('$id', '$idevento', '$idformulario', '$titulo', '$p01', '$p02', '$p03', '$p04', '$p05', '$p06', '$p07', '$p08', '$p09', '$p10', '$p11', '$p12', '$p13', '$p14')");
	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	//mysql_free_result();
	mysql_close($conexion);
?>