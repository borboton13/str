
 <!DOCTYPE HTML>
<html>
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

<!--<div id="container" style="min-width: 310px; max-width: 700px; height: 500px; margin: 0 auto"></div>-->
<div id="container" style="min-width: 310px; max-width: 800px; height: 700px; margin: 0 auto"></div>



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
/*$sql="SELECT problema, COUNT(*) as total FROM st_ticket
    WHERE  (fecha_inicio_rif BETWEEN '" . $fini ."'  AND '". $ffin ."')
GROUP BY problema";*/

$sql="SELECT (categorias), SUM(tiempo)as horas FROM(

	SELECT categorias, 0 AS tiempo, orden FROM indicadortemp
	union
	SELECT categorias,count(categorias) as tiempo,0 AS orden FROM(
	
		SELECT id_st_ticket, case 
			when horas < 1 then
				'<=1'	
			when horas >1 AND  horas<=2 then
				'> 1 ; <= 2'
			when horas >2 AND  horas<=3 then	
				'> 2 ; <= 3'
			when horas >3 AND  horas<=4 then	
				'> 3 ; <= 4'
			when horas >4 AND  horas<=5 then	
				'> 4 ; <= 5'
			when horas >5 AND  horas<=10 then	
				'> 5 ; <=10'
			when horas >10 AND  horas<=20 then	
				'>10 ; <=20'
			when horas >20 AND  horas<=30 then	
				'>20 ; <=30'
			when horas >30 AND  horas<=40 then	
				'>30 ; <=40'
			when horas >40 AND  horas<=50 then	
				'>40 ; <=50'
			when horas >50 AND  horas<=60 then	
				'>50 ; <=60'
			when horas >60 AND  horas<=70 then	
				'>60 ; <=70'
			when horas >70 AND  horas<=80 then	
				'>70 ; <=80'
			when horas >80 AND  horas<=90 then	
				'>80 ; <=90'		
			When horas >90 AND  horas<=100 then	
				'>90 ; <=100'
			ELSE 
				'>100'
		
			END AS Categorias
		FROM
		(
			SELECT id_st_ticket, TIMESTAMPDIFF(HOUR, inicio,fin) as horas FROM (
				SELECT id_st_ticket, timestamp(fecha_inicio_rif,hora_inicio_rif)AS inicio,
				timestamp(fecha_fin_rif,hora_fin_rif) AS fin
				 FROM st_ticket
				where fecha_inicio_rif BETWEEN '" . $fini ."'  AND '". $ffin ."'
                AND problema ='FUERA DE SERVICIO'
			) AS cx1
		)cx2
	)cx3
	GROUP BY categorias
	
)cx4	GROUP BY categorias ORDER BY orden desc";


            //echo $sql;

/*Ejecutamos la query*/
$stmt=$bd->ejecutar($sql);
 $numero_filas = mysql_num_rows($stmt);
 //echo $numero_filas;

/*Realizamos un bucle para ir obteniendo los resultados*/


?>


<script type="text/javascript">
    // Data gathered from http://populationpyramid.net/germany/2015/

    // Age categories
    var categories = [ 
        <?php            
               

            $i=0;
            while ($x=$bd->obtener_fila($stmt,0)){
              
                echo('"' . $x['categorias'] . '"'); 

                $i++;
                if ($i< $numero_filas){
                    echo ",";
                }
            }                   
        
        ?> 
    ];

    Highcharts.chart('container', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'INDICADOR TIEMPO DE CIERRE DE TICKETS: FUERA DE SERVICIO'
        },
        subtitle: {
            text: null
        },
        xAxis: [{

            title: {
                text: 'Horas'
            },

            categories: categories,
            reversed: false,
            labels: {
                step: 1
            }
        }, { // mirror axis on right side
            opposite: true,
            reversed: false,
            categories: categories,
            linkedTo: 0,
            labels: {
                step: 1
            }
        }],
        yAxis: {
            title: {
                text: null
            },
            labels: {
                formatter: function () {
                    return Math.abs(this.value) + '';
                }
            }
        },

        plotOptions: {
            bar: {
            dataLabels: {
                enabled: true
            }
        },
            series: {
                stacking: 'normal'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + ', hrs: ' + this.point.category + '</b><br/>' +
                    'Cantidad: ' + Highcharts.numberFormat(Math.abs(this.point.y), 0);
            }
        },

        series: [{
            name: 'Tickets',
            data: [<?php            
               $stmt=$bd->ejecutar($sql);
                $numero_filas = mysql_num_rows($stmt);

                $i=0;
                while ($x=$bd->obtener_fila($stmt,0)){
                echo($x['horas']);
            
                   
                     $i++;
                    if ($i< $numero_filas){
                        echo ",";
                    }                            
                
            }
            ?>
                
            ]
        }]
    });

</script>

	</body>
</html>
