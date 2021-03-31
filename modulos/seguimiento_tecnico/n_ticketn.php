<style>	
	.time_picker_div {padding:5px;
		border:solid #999999 1px;
		background:#ffffff;}
	legend{
	font-weight:bold;
	font-style:italic}	
	div.grippie {
		background:#EEEEEE url(../../paquetes/textarea/grippie.png) no-repeat scroll center 2px;
		border-color:#DDDDDD;
		border-style:solid;
		border-width:0pt 1px 1px;
		cursor:s-resize;
		height:9px;
		overflow:hidden;
	}
</style>

<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
	<link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script>
	<script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>
<?php
$estacion_val = null;
$filas = 0;
$dato = null;
if(isset($_GET["rif"])){
	$id_st_ticket = $_GET["rif"];
	$consulta = "SELECT id_st_ticket,ticket,idnodo,estacion,fecha_inicio_rif,hora_inicio_rif,fecha_fin_rif,hora_fin_rif,tipo,problema,fecha_not,hora_not,plan_accion,trabajo_realizado,personal,observaciones,idtipofalla,idtipointervencion " .
			    "FROM st_ticket WHERE id_st_ticket='$id_st_ticket'";
	$resultado 	= mysqli_query($conexion, $consulta);
	$filas	   	= mysqli_num_rows($resultado);
	$dato		= mysqli_fetch_array($resultado);
    $estacion_val = $dato['estacion'];
}

/*if(isset($_GET["idestacion"])){
    $idestacion = $_GET["idestacion"];
}*/

?>

<table width="1000" align="center">
<tr>
<td><a class="enlaceboton" href="<?=$link_modulo?>?path=tickets.php" target='_top'>
	<img src='../../img/ico_detalles.gif' alt='Ver Proyecto' border="0" align="absmiddle"> Ver Lista de Tickets </a>
</td>
</tr>
<tr>
<td>
<form name="amper" method="post" action="../../modulos/seguimiento_tecnico/___s_ticket.php" onSubmit=" return VerifyOne ();">
<input type="hidden" name="filas" id="filas" value="<?=$filas?>" />
<input type="hidden" name="id_st_ticket" id="id_st_ticket" value="<?=$id_st_ticket?>" />

<table width="100%" class="table2">
<caption><span style="font-size:18px">REGISTRO DE TICKET</span><br /></caption>
</table>

<!-- RIF -->
<table width="100%" class="table2">
	<tr>
		<th colspan="2"><strong class="verde">Detalles RIF:</strong></th>
	</tr>

	<tr>
		<td width="50% ">
			
			<div align="right">
			<span class="rojo">*</span>Nro de Ticket:
		  	<input name="ticket" type="text" id="ticket" value="<?=$dato['ticket'];?>" size="20" maxlength="15"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  	</div>
		  	
		</td>
		
		<td width="50%">
            <div align="center">Escribir y seleccionar SOLO de la lista</div>
		</td>
	</tr>
	
	<tr>
		<td width="50%">
		  	<div align="right"><span class="rojo">*</span>ID Nodo:  
		    <input name="idnodo" 
		    	type="text" 
		    	id="idnodo" 
		    	value="<?=$dato['idnodo'];?>" 
		    	size="20" 
		    	maxlength="10"
		    	size="30" autocomplete="off" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
		</td>
		<td width="50%">
			<!--<div align="right">
			Estación:
		  	<input name="estacion" type="text" id="estacion" value="<?/*=$dato['estacion'];*/?>" size="30" maxlength="255"/>&nbsp;&nbsp;
		  	</div>-->
            <div align="right">
                <span class="cafe">ESTACION:</span>
                <input name="estacion"
                       type="text"
                       id="estacion"
                       readonly="readonly"
                       value="<?php echo $estacion_val; ?>"
                       size="30" autocomplete="off" >&nbsp;&nbsp;
                <input type="hidden" id="idestacionentel" name="idestacionentel">
            </div>
		</td>
	</tr>
	
	<tr>
		<td width="50%">
			<div align="right"><span class="rojo">*</span>Fecha de Inicio:
			<input name="fecha_inicio_rif" type="text" id="fecha_inicio_rif" size="20" value="<?=$dato['fecha_inicio_rif']?>" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)"/>
			<img onclick="displayCalendar(document.amper.fecha_inicio_rif,'yyyy-mm-dd',this,false)" src="../../img/time.png" alt="Seleccionar fecha apertura" width="16" height="16">
			</div>
		</td>
		<td width="50%">
			<div align="right"><span class="rojo">*</span>Hora Inicio:
			<input name="hora_inicio_rif" type="text" id="hora_inicio_rif" size="15" value="<?=$dato['hora_inicio_rif']?>" />
			(hh:mm:ss)
			</div>
		</td>
	</tr>
	<tr>
		<td width="50%">
			<div align="right">Fecha de Fin:
			<input name="fecha_fin_rif" type="text" id="fecha_fin_rif" size="20" value="<?=$dato['fecha_fin_rif']?>" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)"/>
			<img onclick="displayCalendar(document.amper.fecha_fin_rif,'yyyy-mm-dd',this,false)" src="../../img/time.png" alt="Seleccionar fecha apertura" width="16" height="16">
			</div>
		</td>
		<td width="50%">
			<div align="right">Hora Fin:
			<input name="hora_fin_rif" type="text" id="hora_fin_rif" size="15" value="<?=$dato['hora_fin_rif']?>" />
			(hh:mm:ss)
			</div>
		</td>
	</tr>
	
	<tr>
		<td width="50%">
		  	<div align="right"><span class="rojo">*</span>Tecnologia:  
		    <!-- <input name="tipo" type="text" id="tipo" value="<?=$dato['tipo'];?>" size="20" maxlength="100"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		    -->

		    <select name="tecnologia" id="tecnologia" class="selectbuscar">
                    <option value="0" selected class="title7"> Seleccionar... </option>
                    <?php
                    $res2=mysqli_query($conexion, "SELECT idtecnologia, nombretecnologia FROM tecnologia");
                    while($dato2=mysqli_fetch_array($res2)){
                        $idtecnologia = $dato2['idtecnologia'];
                        $nombretecnologia      = $dato2['nombretecnologia'];
                        echo '<option value="'.$idtecnologia.'" ';
                        if($idtecnologia==$dato['idtecnologia']) echo 'selected';
                        echo'>'.$nombretecnologia.'</option>';
                    }
                    ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
		</td>
		<td width="50%">
			<div align="right"><span class="rojo">*</span>Sistema en falla:  
		    <select name="sistemafalla" id="sistemafalla" class="selectbuscar">
                    <option value="0" selected class="title7"> Seleccionar... </option>
                    <?php
                    $res2=mysqli_query($conexion, "SELECT idsistemafalla, nombresistemafalla FROM ticket_sistemafalla");
                    while($dato2=mysqli_fetch_array($res2)){
                        $idsistemafalla = $dato2['idsistemafalla'];
                        $nombrefalla    = $dato2['nombresistemafalla'];
                        echo '<option value="'.$idsistemafalla.'" ';
                        if($idsistemafalla==$dato['idsistemafalla']) echo 'selected';
                        echo'>'.$nombrefalla.'</option>';
                    }
                    ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</div>
		</td>
	</tr>
	<tr>
		<td >
			<div align="right"><span class="rojo">*</span>Afectacion al servicio:
		  	<!--<input name="problema" type="text" id="pr                                                                                 x         oblema" value="<?=$dato['problema'];?>" size="28" maxlength="255"/>
		  	-->

		  	<select name="afectacionservicio" id="afectacionservicio" class="selectbuscar">
                    <option value="0" selected class="title7"> Seleccionar... </option>
                    <?php
                    $res2=mysqli_query($conexion, "SELECT idafectacionservicio, nombreafectacionservicio FROM ticket_afectacionservicio");
                    while($dato2=mysqli_fetch_array($res2)){
                        $idafectacionservicio = $dato2['idafectacionservicio'];
                        $nombreafectacionservicio     = $dato2['nombreafectacionservicio'];
                        echo '<option value="'.$idafectacionservicio.'" ';
                        if($idafectacionservicio==$dato['idafectacionservicio']) echo 'selected';
                        echo'>'.$nombreafectacionservicio.'</option>';
                    }
                    ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  	</div>	

		  	
		</td>
		<td >
			 <div align="right"><span class="rojo">*</span>Equipo en Falla:
		  	<select name="equipofalla" id="equipofalla" class="selectbuscar">
                    <option value="0" selected class="title7"> Seleccionar... </option>
                    <?php
                    /*$res2=mysqli_query($conexion, "SELECT idequipofalla, nombreequipofalla FROM equipofallan
						WHERE idsistemafalla=1");
                    while($dato2=mysqli_fetch_array($res2)){
                        $idsistemafalla = $dato2['idequipofalla'];
                        $nombrefalla    = $dato2['nombreequipofalla'];
                        echo '<option value="'.$idsistemafalla.'" ';
                        if($idsistemafalla==$dato['idequipofalla']) echo 'selected';
                        echo'>'.$nombrefalla.'</option>';
                    }*/
                    ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		  	</div>
		</td>
	</tr>

    <tr>
        <td width="50%" >
             <div align="right"><span class="rojo">* </span>Atencion:
                <select name="atencion" id="atencion" class="selectbuscar">
                    <option value="0" selected class="title7"> Seleccionar... </option>
                    <?php
                    $res2=mysqli_query($conexion, "SELECT idatencion, nombreatencion FROM ticket_atencion");
                    while($dato2=mysqli_fetch_array($res2)){
                        $idatencion = $dato2['idatencion'];
                        $nombreatencion      = $dato2['nombreatencion'];
                        echo '<option value="'.$idatencion.'" ';
                        if($idatencion==$dato['idatencion']) echo 'selected';
                        echo'>'.$nombreatencion.'</option>';
                    }
                    ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </td>    
        <td width="30%">
          	<div align="right"><span class="rojo">* </span>Tipo de falla:
                <select name="tipofalla" id="tipofalla" class="selectbuscar">
                    <option value="0" selected class="title7"> Seleccionar... </option>
                    <?php/*
                    $res2=mysqli_query($conexion, "SELECT tipofallan.idtipofalla, tipofallan.nombretipofalla FROM tipofallan,equipofallantipofallan
					WHERE tipofallan.idtipofalla=equipofallantipofallan.idtipofalla and equipofallantipofallan.idequipofalla='DTE-003'");
                    while($dato2=mysqli_fetch_array($res2)){
                        $idtipofalla = $dato2['idtipofalla'];
                        $nombre      = $dato2['nombretipofalla'];
                        echo '<option value="'.$idtipofalla.'" ';
                        if($idtipofalla==$dato['idtipofalla']) echo 'selected';
                        echo'>'.$nombre.'</option>';
                    }*/
                    ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
        </td>        

    </tr>
    <tr>
        <td width="50%" >

        	

        	

		 </td> 
	 	<td width="30%">
	 		<div align="right"><span class="rojo">* </span>Solucion:
                <select name="solucion" id="solucion" class="selectbuscar">
                    <option value="0" selected class="title7"> Seleccionar... </option>
                    <?php
                    
                    
                    ?>
                </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </div>
	 	 </td>  
	</tr>

</table>

<!-- FIN RIF -->

<table width="100%" border="0" cellpadding="0" cellspacing="2" class="table2">
<tr>
<th colspan="2"><strong class="verde">NOTIFICACION A DIMESAT:</strong></th>
<tr>
		<td width="50%">
			<div align="left"><span class="rojo">*</span>Fecha:
			<input name="fecha_not_dim" type="text" id="fecha_not_dim" size="20" value="<?=$dato['fecha_not_dim']?>" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)"/>
			<img onclick="displayCalendar(document.amper.fecha_not_dim,'yyyy-mm-dd',this,false)" src="../../img/time.png" alt="Seleccionar fecha apertura" width="16" height="16">
			</div>
		</td>
		<td width="50%">
			<div align="left"><span class="rojo">*</span>Hora:
			<input name="hora_not_dim" type="text" id="hora_not_dim" size="15" value="<?=$dato['hora_not_dim']?>" />
			(hh:mm:ss)
			</div>
		</td>
</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="2" class="table2">
<tr>
<th colspan="2"><strong class="verde">INTERVENCION EN SITIO:</strong></th>
<tr>
		<td width="50%">
			<div align="left"><span class="rojo">*</span>Fecha:
			<input name="fecha_not_sitio" type="text" id="fecha_not_sitio" size="20" value="<?=$dato['fecha_not_sitio']?>" onclick="displayCalendar(this,'yyyy-mm-dd',this,false)"/>
			<img onclick="displayCalendar(document.amper.fecha_not_sitio,'yyyy-mm-dd',this,false)" src="../../img/time.png" alt="Seleccionar fecha apertura" width="16" height="16">
			</div>
		</td>
		<td width="50%">
			<div align="left"><span class="rojo">*</span>Hora:
			<input name="hora_not_sitio" type="text" id="hora_not_sitio" size="15" value="<?=$dato['hora_not_sitio']?>" />
			(hh:mm:ss)
			</div>
		</td>
</tr>
</table>
<table width="100%" cellspacing="2" class="table2">
<!--<tr>
<th colspan="2"><strong class="verde">Plan de Accion</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="plan_accion" class="resizable" style="width: 596px; height: 40px;" id="plan_accion"><?/*=$dato['plan_accion']*/?></textarea>
</td>
</tr>-->

<!--<tr>
<th colspan="2"><strong class="verde">Trabajo Realizado</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="trabajo_realizado" class="resizable" style="width: 596px; height: 40px;" id="trabajo_realizado"><?/*=$dato['trabajo_realizado']*/?></textarea>
</td>
</tr>-->

<!--<tr>
<th colspan="2"><strong class="verde">Personal</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="personal" class="resizable" style="width: 596px; height: 40px;" id="personal"><?/*=$dato['personal']*/?></textarea>
</td>
</tr>-->



<table width="100%" cellspacing="2" class="table2">
<!--<tr>
<th colspan="2"><strong class="verde">Plan de Accion</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="plan_accion" class="resizable" style="width: 596px; height: 40px;" id="plan_accion"><?/*=$dato['plan_accion']*/?></textarea>
</td>
</tr>-->

<!--<tr>
<th colspan="2"><strong class="verde">Trabajo Realizado</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="trabajo_realizado" class="resizable" style="width: 596px; height: 40px;" id="trabajo_realizado"><?/*=$dato['trabajo_realizado']*/?></textarea>
</td>
</tr>-->

<!--<tr>
<th colspan="2"><strong class="verde">Personal</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="personal" class="resizable" style="width: 596px; height: 40px;" id="personal"><?/*=$dato['personal']*/?></textarea>
</td>
</tr>-->

<tr>
<th colspan="2"><strong class="verde">Descripcion de falla del servicio y medida de restitucion (350 Caracteres)</strong></th>
</tr>
<tr>
<td colspan="2" align="center">
<textarea name="descripcionfalla" class="resizable" style="width: 650px; height: 80px;" id="descripcionfalla"><?=$dato['descripcionfalla']?></textarea>
</td>
</tr>

</table>
<table width="100%" cellspacing="2" class="table2">
<!--<tr>
<th colspan="2"><strong class="verde">Plan de Accion</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="plan_accion" class="resizable" style="width: 596px; height: 40px;" id="plan_accion"><?/*=$dato['plan_accion']*/?></textarea>
</td>
</tr>-->

<!--<tr>
<th colspan="2"><strong class="verde">Trabajo Realizado</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="trabajo_realizado" class="resizable" style="width: 596px; height: 40px;" id="trabajo_realizado"><?/*=$dato['trabajo_realizado']*/?></textarea>
</td>
</tr>-->

<!--<tr>
<th colspan="2"><strong class="verde">Personal</strong></th>
</tr>
<tr>
<td colspan="2">
<textarea name="personal" class="resizable" style="width: 596px; height: 40px;" id="personal"><?/*=$dato['personal']*/?></textarea>
</td>
</tr>-->

<tr>
<th colspan="2"><strong class="verde">OBSERVACIONES (350 Caracteres)</strong></th>
</tr>
<tr>
<td colspan="2" align="center">
<textarea name="observaciones" class="resizable" style="width: 650px; height: 80px;" id="observaciones"><?=$dato['observaciones']?></textarea>
</td>
</tr>

<!-- <table width="100%" class="table2">
<tfoot>
<tr>
<td width="50%" ><span class="rojo">(*) Campos Requeridos</span><br /><center>
<input name="validar" type="submit" class="large" value="&nbsp;&nbsp;Guardar&nbsp;&nbsp;" />
</center></td>
</tr>
</tfoot>
</table> -->

<br>
<table width="900" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
		<td>
			
			<input type="button" id="boton" value="Guardar"/>

			<input type="button" name="Submit" value="<< Atras" onclick="location.href='<?=$link_modulo?>?path=ticketsn.php'" />
		</td>
	</tr>
</table>
</form>

</td>
</tr>
</table>
<div id="select2lista"></div>
<span id="res"></span>

<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="../../paquetes/textarea/jquery-latest.js"></script>
<script type="text/javascript" src="../../paquetes/textarea/jquery.textarearesizer.compressed.js"></script>


<script type="text/javascript">
	/* jQuery textarea resizer plugin usage */
	$(document).ready(function() {
		$('textarea.resizable:not(.processed)').TextAreaResizer();
		//rellenarEstacion();		
	});
</script>

<script type="text/javascript">
	
	$(document).ready(function() {
		//alert('funciona');

		$('#boton').click(function(){
			var mensaje;
	    	var opcion = confirm("Guardar los cambios?");
	    	if (opcion == true) {	

	    	    		


	    			var ticket=$('#ticket').val();//ticket,
					var idnodo=$('#idnodo').val();//idnodo,
					var fecha_inicio_rif=$('#fecha_inicio_rif').val();//fecha_inicio_rif,
					var hora_inicio_rif=$('#hora_inicio_rif').val();//hora_inicio_rif,
					var fecha_fin_rif=$('#fecha_fin_rif').val();//fecha_fin_rif,
					var hora_fin_rif=$('#hora_fin_rif').val();//hora_fin_rif,
					var fecha_not_dim=$('#fecha_not_dim').val();//fecha_not,
					var hora_not_dim=$('#hora_not_dim').val();//hora_not,
					var fecha_not_sitio=$('#fecha_not_sitio').val();//fecha_not_sitio,
					var hora_not_sitio=$('#hora_not_sitio').val();//hora_not_sitio,
					var observaciones=$('#observaciones').val();//observaciones,
					var descripcionfalla=$('#descripcionfalla').val();//descripcionfalla,
					var idtecnologia=$('#tecnologia').val();//idtecnologia,
					var idafectacionservicio=$('#afectacionservicio').val();//idafectacionservicio,
					var idsistemafalla=$('#sistemafalla').val();//idsistemafalla,
					var idtipofalla=$('#tipofalla').val();//idtipofalla,
					var idequipofalla=$('#equipofalla').val();//idequipofalla,
					var idatencion=$('#atencion').val();//idtipointervencion,
					var idestacion=$('#idnodo').val();//idestacionentel,
					var idsolucion=$('#solucion').val();//idsolucion
					

	    		jQuery.post("../../paquetes/ajax/insertar_ticketn.php", {
	    			ticket:ticket,
					idnodo:idnodo,
					fecha_inicio_rif:fecha_inicio_rif,
					hora_inicio_rif:hora_inicio_rif,
					fecha_fin_rif:fecha_fin_rif,
					hora_fin_rif:hora_fin_rif,
					fecha_not_dim:fecha_not_dim,
					hora_not_dim:hora_not_dim,
					fecha_not_sitio:fecha_not_sitio,
					hora_not_sitio:hora_not_sitio,
					observaciones:observaciones,
					descripcionfalla:descripcionfalla,
					idtecnologia:idtecnologia,
					idafectacionservicio:idafectacionservicio,
					idsistemafalla:idsistemafalla,
					idtipofalla:idtipofalla,
					idequipofalla:idequipofalla,
					idatencion:idatencion,
					idestacion:idestacion,
					idsolucion:idsolucion
				}, function(data, textStatus){
					if(data == 1){
						$('#res').html('Datos insertados correctamente');
						$('#res').css('color','green');
								}
					else{
						$('#res').html(data);
						$('#res').css('color','red');
						}
				});	

				//document.amper.boton.disabled=true;

	    	}

			
		});



		


		$('#idnodo').change(function(){
			$('#estacion').val('');
			rellenarEstacion();
			//$('#estacion').val('ARQUE');
			//alert('funciona');			
		});
		//-------------------------------------------------------------------------------
		var equipofalla = $('#equipofalla');
        //var equipofalla_sel = $('#equipofalla_sel');
		$('#sistemafalla').change(function(){
			//alert('funciona');
			var idsistemafalla=$(this).val();
			if (idsistemafalla!==''){
				//alert('funciona');
				$.ajax({
					data:{idsistemafalla:idsistemafalla},
					dataType:'html',
					type:'POST',
					url:'../../paquetes/ajax/get_equipofalla.php'
				}).done(function(data){
					equipofalla.html(data);
					equipofalla.prop('disabled',false);
				});
			}else{
				equipofalla.val('');
				equipofalla.prop('disabled',false)
			}
			//$('#equipofalla')
		});
			//---------------------------------------------------------------------------
		var tipofalla = $('#tipofalla');
        //var equipofalla_sel = $('#equipofalla_sel');
		$('#equipofalla').change(function(){
			//alert('funciona');
			var idequipofalla=$(this).val();
			if (idequipofalla!==''){
				//alert('funciona');
				$.ajax({
					data:{idequipofalla:idequipofalla},
					dataType:'html',
					type:'POST',
					url:'../../paquetes/ajax/get_tipofalla.php'
				}).done(function(data){
					tipofalla.html(data);
					tipofalla.prop('disabled',false);
				});
			}else{
				tipofalla.val('');
				tipofalla.prop('disabled',false)
			}
			//$('#equipofalla')
		});

			//---------------------------------------------------------------------------
		var solucion = $('#solucion');
        //var equipofalla_sel = $('#equipofalla_sel');
		$('#tipofalla').change(function(){
			//alert('funciona');


			var idtipofalla=$(this).val();
			var idequipofalla=$('#equipofalla').val();
			//alert(idequipofalla);

			if (idtipofalla!==''){
				//alert('funciona');
				$.ajax({
					data:{idtipofalla:idtipofalla, idequipofalla:idequipofalla},
					dataType:'html',
					type:'POST',
					url:'../../paquetes/ajax/get_solucion.php'
				}).done(function(data){
					solucion.html(data);
					solucion.prop('disabled',false);
				});
			}else{
				solucion.val('');
				solucion.prop('disabled',false)
			}
			//$('#equipofalla')
		});

	});

</script>

<script type="text/javascript">
	function rellenarEstacion(){
		try{
			$.ajax({
				type:"POST",
				url:"../../paquetes/ajax/search_idnodo.php",
				data:"idestacion=" + $('#idnodo').val(),
				success:function(r){
					$('#select2lista').html(r);

				}
			});
			  //alert('bien');
		}
			catch(error) {
			  console.error(error);
			  alert(error);
			  // expected output: ReferenceError: nonExistentFunction is not defined
			  // Note - error messages will vary depending on browser
			}
	}
</script>




<link type="text/css" rel="stylesheet" href="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../../paquetes/calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>		
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>




<script type="text/javascript">


//validarRB(document.amper.p5,'Seleccione el Tipo de Emergencia!') &&
//validarRB(document.amper.p6,'Seleccione el Servicio Afectado!') &&






function VerifyOne () {
	
if( checkField( document.amper.ticket, isName, false) &&
	checkField( document.amper.idnodo, isName, false) &&
	isNull( document.amper.fecha_inicio_rif) && 
	isNull( document.amper.hora_inicio_rif)&&
	checkField( document.amper.tipo, isName, false) &&
	checkField( document.amper.problema, isName, false) &&
	isNull( document.amper.fecha_not)&&
	isNull( document.amper.hora_not)
  )
{ 
	if(confirm("Esta Guardando esta información del TICKET"))
	{	return true;	}
	else {return false;}   

}
else {return false;}   	
}
</script>  


