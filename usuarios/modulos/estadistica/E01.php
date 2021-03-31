

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Mantenimiento DIMESAT S.R.L.</title>

		<style type="text/css">

		</style>
	</head>
	<body>
<script src="../../../charts/code/highcharts.js"></script>
<script src="../../../charts/code/modules/data.js"></script>
<script src="../../../charts/code/modules/drilldown.js"></script>
<?php
if($nively=='1'){ $adm=1;}
include("../../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
    $pagina = $_GET['pagina'];
}
?>

<?php
if (isset($_GET['fini'])) $fini = $_GET['fini'];
if (isset($_GET['ffin'])) $ffin = $_GET['ffin'];
        
        
?>

<?php

/*Incluimos el fichero de la clase*/
include("../../../funciones/Db.class.php");


/*Creamos la instancia del objeto. Ya estamos conectados*/
$bd=Db::getInstance();

/*Creamos una query sencilla*/
$sql="SELECT centro.nombre ,COUNT(evento.idcentro)AS total FROM centro
            INNER JOIN evento
            ON centro.idcentro= evento.idcentro
            WHERE  (inicio BETWEEN '" . $fini ."'  AND '". $ffin ."')
            GROUP BY nombre
            HAVING COUNT(evento.idcentro)
            ORDER BY nombre";

           // echo $sql;

/*Ejecutamos la query*/
$stmt=$bd->ejecutar($sql);
 $numero_filas = mysql_num_rows($stmt);
 //echo $numero_filas;

/*Realizamos un bucle para ir obteniendo los resultados*/


?>

<div id="container" style="min-width: 310px; max-width: 700px; height: 500px; margin: 0 auto"></div>


		<script type="text/javascript">

// Create the chart
Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Mantenimiento Preventivo'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Incidencias'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.0f}</b> of total<br/>'
    },

    "series": [
        {
            "name": "Incidencias",
            "colorByPoint": true,
            "data": [
            <?php            
               

                $i=0;
                while ($x=$bd->obtener_fila($stmt,0))
                  
             {?>
                {
                    "name": "<?php echo($x['nombre']);  ?>",
                    "y": <?php echo($x['total']);?>  ,
                    "drilldown": null
                }
                

            <? $i++;
                if ($i< $numero_filas){
                echo ",";
                    }

                } 
                ?> 
                

                

               
            ]
        }
    ]
});
		</script>
	</body>
