<?php

require("../../funciones/motor.php");
require("../../funciones/funciones.php");

	$id = incrementar_id("p019_formulario", "id");

	

	$idevento = $_POST['idevento'];

	//(19,$id,'P013n','Formulario Mtto. Preventivo Radio Bases Nuevo','Formulario Mtto. Preventivo Radio Bases Nuevo',$idevento    )

	//$Hoy = date("Y-m-d H:i:s");
	$res = mysql_query("INSERT INTO formulario_mtto_n002 VALUES(20,$id,'P019','Formulario Mtto. Preventivo Sist. de transmision','Formulario Mtto. Preventivo Sist. de transmision',$idevento)");
	if(mysql_affected_rows()>0){
		echo "1";
	}
	else{
		echo ("2");
	}
	//mysql_free_result();
	mysql_close($conexion);
?>