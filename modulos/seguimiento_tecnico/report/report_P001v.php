<?php
$idcentro    = $_POST["idcentro"];
$formulario  = $_POST["formulario"];
$fechainicio = $_POST["fechainicio"];
$fechafin    = $_POST["fechafin"];

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=st_reporte_mtto.xls");
header("Pragma: no-cache");
header("Expires: 0");

$cabecera = array("Malo", "Bueno", "Observaciones");

$cabecer1 = array("No Existe", "Ejecutado", "Observaciones");

$cabecer2 = array("No Existe", "Existe", "Observaciones");

$cabecer3 = array("No Existe", "Correcta", "Incorrecta", "Observaciones");


$cab10 = "";
foreach ($cabecera as $cab){
    $cab10 .= "<th>$cab</th>";
}

$cab20 = "";
foreach ($cabecer1 as $cab1){
    $cab20 .= "<th>$cab1</th>";
}

$cab30 = "";
foreach ($cabecer2 as $cab2){
    $cab30 .= "<th>$cab2</th>";
}

$cab40 = "";
foreach ($cabecer3 as $cab3){
    $cab40 .= "<th>$cab3</th>";
}

?>
<table border="1">

<tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th colspan="2"><b>Temporada Seca</b></th>
    <th colspan="2"><b>Temporada Lluvia</b></th>
    <th></th>
    <th></th>
    <th colspan="2"><b>Temporada Seca</b></th>
    <th colspan="2"><b>Temporada Lluvia</b></th>
    <th></th>
    <th></th>
    <th colspan="2"><b>Temporada Seca</b></th>
    <th colspan="2"><b>Temporada Lluvia</b></th>
    <th></th>
    <th></th>
    <th colspan="2"><b>Temporada Seca</b></th>
    <th colspan="2"><b>Temporada Lluvia</b></th>
    <th></th>
    <th></th>
    <th colspan="2"><b>Temporada Seca</b></th>
    <th colspan="2"><b>Temporada Lluvia</b></th>
    <th></th>
    <th></th>
</tr>
<tr>
    <th>No</th>
    <th>FECHA</th>
    <th>NOM_ESTACION</th>
    <th>TITULO</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>Tipo de acceso</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Observaciones</th>
    <th>Tipo de acceso</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Observaciones</th>
    <th>Tipo de acceso</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Observaciones</th>
    <th>Tipo de acceso</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Observaciones</th>
    <th>Tipo de acceso</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Distancia Km</th>
    <th>Tiempo en hrs</th>
    <th>Observaciones</th>
    <th></th>
    <?php echo $cab10 ?>
    <th></th>
    <?php echo $cab10 ?>
    <th>LIMPIEZA DE EQUIPOS Y AMBIENTES:</th>
    <?php echo $cab20 ?>
    <th></th>
    <?php echo $cab20 ?>
    <th></th>
    <?php echo $cab20 ?>
    <th></th>
    <?php echo $cab20 ?>
    <th></th>
    <?php echo $cab20 ?>
    <th></th>
    <?php echo $cab20 ?>
    <th></th>
    <?php echo $cab20 ?>
    <th></th>
    <?php echo $cab20 ?>
    <th></th>
    <?php echo $cab20 ?>
    <th></th>
    <?php echo $cab20 ?>
    <th>VERIFICACION DE AMBIENTES:</th>
    <?php echo $cab30 ?>
    <th></th>
    <?php echo $cab30 ?>
    <th></th>
    <?php echo $cab30 ?>
    <th></th>
    <?php echo $cab30 ?>
    <th>VERIFICACION DE SISTEMA DE ILUMINACION:</th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th>ESTRUCTURA METALICA:</th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th></th>
    <?php echo $cab40 ?>
    <th>Otras Observaciones</th>
    
</tr>
<?	
	//$consulta="SELECT * FROM st_ticket;";
	$resultado=mysql_query("
	SELECT ev.inicio, es.nombre, f.titulo, f.p01, f.p02, f.p03, f.p04, f.p05, f.p06, f.p07, f.p08, f.p11, f.p09, f.p10, f.observaciones
	FROM formulario_p001v f
	JOIN evento ev   ON f.idevento = ev.idevento
	JOIN estacion es ON ev.idestacion = es.idestacion
	WHERE ev.idcentro = ".$idcentro."
	AND ev.inicio BETWEEN '".$fechainicio."' AND '".$fechafin."';
	");

	$filas=mysql_num_rows($resultado);
	if($filas!=0){
		$i=0;
		while($dato=mysql_fetch_array($resultado)){

			$fecha = $dato['inicio'];
			$nombre = $dato['nombre'];
			$titulo = $dato['titulo'];

			$p01 = $dato['p01'];
			$p02 = $dato['p02'];
			$p03 = $dato['p03'];
			$p04 = $dato['p04'];
			$p05 = $dato['p05'];

            $html_p06 = "";
            $p06 = $dato['p06']; $arrays = explode('|', $p06);

            $arr = explode(';', $arrays[0]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[1]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[2]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[3]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}
            $arr = explode(';', $arrays[4]); for($i=0 ; $i < sizeof($arr) ; $i++){ $html_p06 .= "<td>".$arr[$i]."</td>";}

            $html_p07 = "";
            $p07 = $dato['p07']; $arrays = explode('|', $p07);

            $arr = explode(';', $arrays[0]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p07 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[1]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p07 .= "<td>".$valor."</td>"; 
            }

            $html_p08 = "";
            
            $p08 = $dato['p08']; $arrays = explode('|', $p08);

            $arr = explode(';', $arrays[0]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p08 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[1]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p08 .= "<td>".$valor."</td>"; 
            }
            $arr = explode(';', $arrays[2]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p08 .= "<td>".$valor."</td>"; 
            }
            
            $arr = explode(';', $arrays[3]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p08 .= "<td>".$valor."</td>"; 
            }
            $arr = explode(';', $arrays[4]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p08 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[5]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p08 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[6]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p08 .= "<td>".$valor."</td>"; 
            }


            $arr = explode(';', $arrays[7]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p08 .= "<td>".$valor."</td>"; 
            }


            $arr = explode(';', $arrays[8]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p08 .= "<td>".$valor."</td>"; 
            }


            $arr = explode(';', $arrays[9]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p08 .= "<td>".$valor."</td>"; 
            }

            $html_p11 = "";
            $p11 = $dato['p11']; $arrays = explode('|', $p11);

            $arr = explode(';', $arrays[0]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p11 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[1]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p11 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[2]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p11 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[3]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p11 .= "<td>".$valor."</td>"; 
            }



            $html_p09 = "";
            $p09 = $dato['p09']; $arrays = explode('|', $p09);

            $arr = explode(';', $arrays[0]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p09 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[1]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p09 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[2]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p09 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[3]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p09 .= "<td>".$valor."</td>"; 
            }
            
            $html_p10 = "";
            
            $p10 = $dato['p10']; $arrays = explode('|', $p10);

            $arr = explode(';', $arrays[0]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p10 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[1]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p10 .= "<td>".$valor."</td>";  
            }
            $arr = explode(';', $arrays[2]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p10 .= "<td>".$valor."</td>"; 
            }
            
            $arr = explode(';', $arrays[3]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p10 .= "<td>".$valor."</td>"; 
            }
            $arr = explode(';', $arrays[4]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p10 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[5]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p10 .= "<td>".$valor."</td>"; 
            }

            $arr = explode(';', $arrays[6]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p10 .= "<td>".$valor."</td>"; 
            }


            $arr = explode(';', $arrays[7]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p10 .= "<td>".$valor."</td>"; 
            }


            $arr = explode(';', $arrays[8]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p10 .= "<td>".$valor."</td>"; 
            }


            $arr = explode(';', $arrays[9]); 
            
            for($i=0 ; $i < sizeof($arr) ; $i++){ 
                if ($i == 1 || $i == 2 || $i == 3)
                $valor = ($arr[$i] != '') ? 'X' : '';
                
                else  $valor = $arr[$i]; 
                
                $html_p10 .= "<td>".$valor."</td>"; 
            }

            $observaciones = $dato['observaciones'];

			$i++;

		echo "
		<tr>
		<td>$i</td>
		<td>$fecha</td>
		<td>$nombre</td>
		<td>$titulo</td>

		<td>$p01</td>
		<td>$p02</td>
		<td>$p03</td>
		<td>$p04</td>
		<td>$p05</td>
        $html_p06
        $html_p07
        $html_p08
        $html_p11
        $html_p09
        $html_p10
        <td>$observaciones</td>
		</tr>";

		}
	 
	}
?>
</table>		  