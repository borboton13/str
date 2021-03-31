<HTML>
<HEAD>
<TITLE> Título de la página </TITLE>
</HEAD>
<BODY>
<?  
$web=$_SESSION["web"];

if (isset($_GET['idevento']))   $idevento     = $_GET['idevento'];
if (isset($_GET['idform']))     $idformulario = $_GET['idform'];
if (isset($_GET['idformtto'])) $idformtto 	= $_GET['idformtto'];
if (isset($_GET['nombreForm'])) $nombreForm   = $_GET['nombreForm'];
if (isset($_GET['params']))       $params	= base64_decode($_GET['params']);
//echo ($params);
$resultado = mysql_query("SELECT * FROM formulario_p013n WHERE idevento = $idevento ");

$dato = mysql_fetch_array($resultado);

$arr = explode('-', $dato['inicio']);

$anio			= $arr[0];
$codCentro 		= $dato['codCentro'];
$ini			= $dato['inicio'];
$fin			= $dato['fin'];
$idev 			= $idevento;
$codEs			= $dato['codigoest'];
$nomEs 			= $dato['estacion'];

//$params = "&anio=$anio&codCentro=$codCentro&ini=$ini&fin=$fin&idev=$idev&codEs=$codEs&nomEs=$nomEs";


require("../../funciones/funciones.php");
	$Vop1 = array("...", "F.O", "MW", "SATELITAL", "PEX");
	$Vop2 = array("...", "E1", "ELECTRICO", "OPTICO");
	$Vop3TA = array("...", "E1", "ELECTRICO", "OPTICO");
	$VopRB2 = array("...", "SECTORIAL","OMNIDIRECCIONAL");
	$VopRB3 = array("...", "1","2","3","4");
	$VopRB4 = array("...", "GSM 850");
	$VopRB5 = array("...", "UMTS 850");
	$VopRB6 = array("...", "LTE 700");
	$VopRB7 = array("...", "LTE 1900");
	$VopRB10 = array("...", "SI","NO");
	$VopRB14 = array("...", "GSM 1900");
	$VopRB15 = array("...", "UMTS 1900");
	$VopRB16 = array("...", "LTE AWS");
	$VopOKNOK = array("...", "OK","NOK");
	$VopXNA = array("...", "X","NA");
	$VopSINONA = array("...", "SI", "NO","NA");
	$VopFNFNENA = array("...", "FUNCIONA", "NO FUNCIONA","EXISTE","NO EXISTE","NA");			

//echo($link_modulo_r);
?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">

	<input type="hidden" name="path" value="prev_nuevo_form_P013n_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
	<input type="hidden" name="nomEstacion" value="<?=$nomEstacion?>" />
	<input type="hidden" name="idformtto" value="<?=$idformtto?>" />
<br />
<TABLE width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIMIENTO PREVENTIVO RADIO BASES</caption>	
	<TR>
		<TH >
				ESTACION: <input name="nomES" type="text" id="nomEs" size="30" value="<?=$dato['ESTACION'];?>" />
		</TH>
	</TR>
	

</TABLE>
	

<TABLE width="900" align="center" class="table2">
	
	
	<TR>
		<TH >
			TECNOLOGIA
		</TH>
	  	<TH>
			GSM
		</TH>		
	  	<TH >
			UMTS
		</TH>
		<TH > 
			LTE
		</TH>		
	</TR>
	<TR>
		<TH >
			TIPO DE ENLACE
		</TH>
	  	<TD>
			<select name="TEGSM">
			 <?
				  foreach($Vop1 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['TEGSM']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>			
			</select>
		</TD>		
	  	<TD>
			<select name="TEUMTS">
				<?
				  foreach($Vop1 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['TEUMTS']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>			
			</select>
		</TD>				
		<TD>
			<select name="TELTE">
				<?
				  foreach($Vop1 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['TELTE']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>			
			</select>
		</TD>				
	</TR>
	<TR>
		<TH >
			EQUIPO ORIGEN DE TX	
		</TH>
	  	<TD>
			<input name="EOGSM" type="text" id="EOGSM" size="30" value="<?=$dato['EOGSM'];?>" />
		</TD>		
	  	<TD>
			<input name="EOUMTS" type="text" id="EOUMTS" size="30" value="<?=$dato['EOUMTS'];?>"/>
		</TD>				
		<TD>
			<input name="EOLTE" type="text" id="EOLTE" size="30" value="<?=$dato['EOLTE'];?>"/>
		</TD>				
	</TR>
	<TR>
		<TH >
			TIPO DE PUERTO
		</TH>
	  	<TD>
			<select name="TPGSM">
				<?
				  foreach($Vop2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['TPGSM']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>						
			</select>
		</TD>		
	  	<TD>
			<select name="TPUMTS">
				<?
				  foreach($Vop2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['TPUMTS']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>						
			</select>
		</TD>				
		<TD>
			<select name="TPLTE">
				<?
				  foreach($Vop2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['TPLTE']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>					
			</select>
		</TD>				
	</TR>
	<TR>
		<TH >
			PUERTO ASIGNADO EN TX
		</TH>
	  	<TD>
			<input name="PGSM" type="text" id="PGSM" size="30" value="<?=$dato['PGSM'];?>" />
		</TD>		
	  	<TD>
			<input name="PUMTS" type="text" id="PUMTS" size="30" value="<?=$dato['PUMTS'];?>" />
		</TD>				
		<TD>
			<input name="PLTE" type="text" id="PLTE" size="30" value="<?=$dato['PLTE'];?>" />
		</TD>			
	</TR>
	<TR>
		<TH >
			SALTO PREVIO
		</TH>
	  	<TD>
			<input name="SPGSM" type="text" id="SPGSM" size="30" value="<?=$dato['SPGSM'];?>" />
		</TD>		
	  	<TD>
			<input name="SPUMTS" type="text" id="SPUMTS" size="30" value="<?=$dato['SPUMTS'];?>" />
		</TD>				
		<TD>
			<input name="SPLTE" type="text" id="SPLTE" size="30" value="<?=$dato['SPLTE'];?>" />
		</TD>				
	</TR>

	<TR>
		<TH >
			MODELO DE GABINETE	
		</TH>
	  	<TD>
			<input name="MGGSM" type="text" id="MGGSM" size="30" value="<?=$dato['MGGSM'];?>" />
		</TD>		
	  	<TD>
			<input name="MGUMTS" type="text" id="MGUMTS" size="30" value="<?=$dato['MGUMTS'];?>" />
		</TD>				
		<TD>
			<input name="MGLTE" type="text" id="MGLTE" size="30" value="<?=$dato['MGLTE'];?>" />
		</TD>				
	</TR>


</TABLE>

<br />
<TABLE width="900" align="center" class="table2">
	<caption>ANTENAS DE LA RADIO BASE</caption>
	<TR>
		<TH >
			Numero
		</TH>
	  	<TH>
			Tipo de Antena
		</TH>		
	  	<TH >
			Sector
		</TH>
		<TH COLSPAN=4> 
			Tecnologia
		</TH>
		<TH >
			Modelo	
		</TH>
		<TH >
			Tilt Mecanico	
		</TH>
		<TH >
			RET	
		</TH>
		<TH >
			*Tilt Electrico	
		</TH>
		<TH >
			Altura(m)	
		</TH>
		<TH >
			Modelo de RRU/TMA
		</TH>		
	</TR>		
	<TR>
		<TD rowspan=2 >
			1
		</TD>
	  	<TD rowspan=2 >
			<select name="RB12">							
			  <?
				  foreach($VopRB2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB12']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>						
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB13">				

			  <?
				  foreach($VopRB3 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB13']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>											
			</select>
		</TD>			
		<TD>		
			<select name="RB14">				
			  <?
				  foreach($VopRB4 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB14']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>							
			</select>
		</TD>										
		<TD >
			<select name="RB15">				
			  <?
				  foreach($VopRB5 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB15']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>							
			</select>
		</TD>	
		<TD >
			<select name="RB16">
				
			  <?
				  foreach($VopRB6 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB16']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>							
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB17">
				
			  <?
				  foreach($VopRB7 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB17']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>							
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB18" type="text" id="RB18" size="10" value="<?=$dato['RB18'];?>"/>	
		</TD>
		<TD rowspan=2 >
			<input name="RB19" type="text" id="RB19" size="10" value="<?=$dato['RB19'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<select name="RB110">				
			  <?
				  foreach($VopRB10 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB110']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>							
		
			</select>

		</TD>
		<TD rowspan=2 >
			<input name="RB111" type="text" id="RB111" size="10" value="<?=$dato['RB111'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<input name="RB112" type="text" id="RB112" size="10" value="<?=$dato['RB112'];?>"/>	
		</TD>
		<TD >
			<input name="RB113" type="text" id="RB113" size="20" value="<?=$dato['RB113'];?>"/>	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB114">
				
			  <?
				  foreach($VopRB14 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB114']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>		
			</select>
		</TD>
	  	<TD >		
	  	<select name="RB115">	
			  <?
				  foreach($VopRB15 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB115']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>		
			</select>
		</TD>	  
	  	<TD >
			<select name="RB116">				
			  <?
				  foreach($VopRB16 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB116']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>		
			</select>
		</TD>			
		<TD>		
			<input name="RB117" type="text" id="RB117" size="20" value="<?=$dato['RB117'];?>" />					
		</TD>										
	</TR>
	<TR><!-- FILA 2-->
		<TD rowspan=2 >
			2
		</TD>
	  	<TD rowspan=2 >
			<select name="RB22">
				
			  <?
				  foreach($VopRB2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB22']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>					
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >			
	  		<select name="RB23">				
			  <?
				  foreach($VopRB3 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB23']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>	
			</select>
		</TD>			
		<TD>		
			<select name="RB24">				

			    <?
				  foreach($VopRB4 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB24']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>								
			</select>
		</TD>										
		<TD >
			<select name="RB25">				
			  <?
				  foreach($VopRB5 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB25']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>	
		<TD >
			<select name="RB26">
				
			  <?
				  foreach($VopRB6 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB26']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB27">				

			  <?
				  foreach($VopRB7 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB27']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB28" type="text" id="RB28" size="10"  value="<?=$dato['RB28'];?>"/>	
		</TD>
		<TD rowspan=2 >
			<input name="RB29" type="text" id="RB29" size="10"  value="<?=$dato['RB29'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<select name="RB210">				
			  <?
				  foreach($VopRB10 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB210']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB211" type="text" id="RB211" size="10" value="<?=$dato['RB211'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<input name="RB212" type="text" id="RB212" size="10" value="<?=$dato['RB212'];?>"/>	
		</TD>
		<TD >
			<input name="RB213" type="text" id="RB213" size="20" value="<?=$dato['RB213'];?>"/>	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB214">				
			  <?
				  foreach($VopRB14 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB214']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>
	  	<TD >
			<select name="RB215">
				
			  <?
				  foreach($VopRB15 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB215']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>	  
	  	<TD >			<select name="RB216">
				

			  <?
				  foreach($VopRB16 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB216']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>			
		<TD>		
			<input name="RB217" type="text" id="RB217" size="20" value="<?=$dato['RB217'];?>"/>					
		</TD>										
	</TR>
	<TR><!-- FILA 3-->
		<TD rowspan=2 >
			3
		</TD>
	  	<TD rowspan=2 >
			<select name="RB32">				

			  <?
				  foreach($VopRB2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB32']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB33">				

			  <?
				  foreach($VopRB3 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB33']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>			
		<TD>		
			<select name="RB34">				
			  <?
				  foreach($VopRB4 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB34']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>										
		<TD >
			<select name="RB35">
			  <?
				  foreach($VopRB5 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB35']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>	
		<TD >
			<select name="RB36">				

			  <?
				  foreach($VopRB6 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB36']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB37">		
			  <?
				  foreach($VopRB7 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB37']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>															
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB38" type="text" id="RB38" size="10" value="<?=$dato['RB38'];?>" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB39" type="text" id="RB39" size="10" value="<?=$dato['RB39'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<select name="RB310">				
			  <?
				  foreach($VopRB10 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB310']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>	
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB311" type="text" id="RB311" size="10" value="<?=$dato['RB311'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<input name="RB312" type="text" id="RB312" size="10" value="<?=$dato['RB312'];?>"/>	
		</TD>
		<TD >
			<input name="RB313" type="text" id="RB313" size="20" value="<?=$dato['RB313'];?>"/>	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB314">
				
			  <?
				  foreach($VopRB14 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB314']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
	  	<TD >
			<select name="RB315">
			  <?
				  foreach($VopRB15 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB315']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	  
	  	<TD >
			<select name="RB316">
				
			  <?
				  foreach($VopRB16 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB316']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>			
		<TD>		
			<input name="RB317" type="text" id="RB317" size="20" value="<?=$dato['RB317'];?>"/>					
		</TD>										
	</TR>

	<TR><!-- FILA 4-->
		<TD rowspan=2 >
			4
		</TD>
	  	<TD rowspan=2 >
			<select name="RB42">
			  <?
				  foreach($VopRB2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB42']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
	  		<select name="RB43">
			  <?
				  foreach($VopRB3 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB43']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>			
		<TD>		
			<select name="RB44">

			  <?
				  foreach($VopRB4 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB44']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>										
		<TD >
			<select name="RB45">
			  <?
				  foreach($VopRB5 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB45']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	
		<TD >
			<select name="RB46">
			  <?
				  foreach($VopRB6 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB46']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB47">				
			  <?
				  foreach($VopRB7 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB47']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB48" type="text" id="RB48" size="10" value="<?=$dato['RB48'];?>"/>	
		</TD>
		<TD rowspan=2 >
			<input name="RB49" type="text" id="RB49" size="10" value="<?=$dato['RB49'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<select name="RB410">
			  <?
				  foreach($VopRB10 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB410']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB411" type="text" id="RB411" size="10" value="<?=$dato['RB411'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<input name="RB412" type="text" id="RB412" size="10" value="<?=$dato['RB412'];?>"/>	
		</TD>
		<TD >
			<input name="RB413" type="text" id="RB413" size="20" value="<?=$dato['RB413'];?>"/>	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB414">
				
			  <?
				  foreach($VopRB14 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB414']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
	  	<TD >
			<select name="RB415">
			  <?
				  foreach($VopRB15 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB415']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	  
	  	<TD >
			<select name="RB416">
			  <?
				  foreach($VopRB16 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB416']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>			
		<TD>		
			<input name="RB417" type="text" id="RB417" size="20" value="<?=$dato['RB417'];?>" />					
		</TD>										
	</TR>

	<TR><!-- FILA 5-->
		<TD rowspan=2 >
			5
		</TD>
	  	<TD rowspan=2 >
			<select name="RB52">
			  <?
				  foreach($VopRB2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB52']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB53">
			  <?
				  foreach($VopRB3 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB53']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>			
		<TD>		
			<select name="RB54">
			  <?
				  foreach($VopRB4 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB54']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>										
		<TD >
			<select name="RB55">
			  <?
				  foreach($VopRB5 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB55']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	
		<TD >
			<select name="RB56">
			  <?
				  foreach($VopRB6 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB56']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB57">
			  <?
				  foreach($VopRB7 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB57']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB58" type="text" id="RB58" size="10" value="<?=$dato['RB58'];?>" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB59" type="text" id="RB59" size="10" value="<?=$dato['RB59'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<select name="RB510">
			  <?
				  foreach($VopRB10 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB510']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB511" type="text" id="RB511" size="10" value="<?=$dato['RB511'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<input name="RB512" type="text" id="RB512" size="10" value="<?=$dato['RB512'];?>"/>	
		</TD>
		<TD >
			<input name="RB513" type="text" id="RB513" size="20" value="<?=$dato['RB513'];?>"/>	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB514">
			  <?
				  foreach($VopRB14 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB514']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
	  	<TD >
			<select name="RB515">
			  <?
				  foreach($VopRB15 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB515']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	  
	  	<TD >
			<select name="RB516">
			  <?
				  foreach($VopRB16 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB516']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>			
		<TD>		
			<input name="RB517" type="text" id="RB517" size="20" value="<?=$dato['RB517'];?>" />					
		</TD>										
	</TR>

	<TR><!-- FILA 6-->
		<TD rowspan=2 >
			6
		</TD>
	  	<TD rowspan=2 >
			<select name="RB62">
			  <?
				  foreach($VopRB2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB62']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB63">
			  <?
				  foreach($VopRB3 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB63']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>			
		<TD>		
			<select name="RB64">				
			  <?
				  foreach($VopRB4 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB64']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>	
			</select>
		</TD>										
		<TD >
			<select name="RB65">
			  <?
				  foreach($VopRB5 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB65']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	
		<TD >
			<select name="RB66">				
			  <?
				  foreach($VopRB6 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB66']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB67">				
			  <?
				  foreach($VopRB7 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB67']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB68" type="text" id="RB68" size="10" value="<?=$dato['RB68'];?>"/>	
		</TD>
		<TD rowspan=2 >
			<input name="RB69" type="text" id="RB69" size="10" value="<?=$dato['RB69'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<select name="RB610">				
			  <?
				  foreach($VopRB10 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB610']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB611" type="text" id="RB611" size="10" value="<?=$dato['RB611'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<input name="RB612" type="text" id="RB612" size="10" value="<?=$dato['RB612'];?>"/>	
		</TD>
		<TD >
			<input name="RB613" type="text" id="RB613" size="20" value="<?=$dato['RB613'];?>"/>	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB614">				
			  <?
				  foreach($VopRB14 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB614']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
	  	<TD >
			<select name="RB615">
			  <?
				  foreach($VopRB15 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB615']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	  
	  	<TD >
			<select name="RB616">				
			  	<?
				  foreach($VopRB16 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB616']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>			
		<TD>		
			<input name="RB617" type="text" id="RB617" size="20"  value="<?=$dato['RB617'];?>"/>					
		</TD>										
	</TR>
	<TR><!-- FILA 7-->
		<TD rowspan=2 >
			7
		</TD>
	  	<TD rowspan=2 >
			<select name="RB72">				
			  <?
				  foreach($VopRB2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB72']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>		
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB73">				
			  <?
				  foreach($VopRB3 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB73']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>		
			</select>
		</TD>			
		<TD>		
			<select name="RB74">				
			  <?
				  foreach($VopRB4 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB74']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>		
			</select>
		</TD>										
		<TD >
			<select name="RB75">
			  <?
				  foreach($VopRB5 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB75']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>			
			</select>
		</TD>	
		<TD >
			<select name="RB76">
			  <?
				  foreach($VopRB6 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB76']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>				
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB77">
			  <?
				  foreach($VopRB7 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB77']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>			
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB78" type="text" id="RB78" size="10" value="<?=$dato['RB78'];?>" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB79" type="text" id="RB79" size="10" value="<?=$dato['RB79'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<select name="RB710">
			  <?
				  foreach($VopRB10 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB710']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>		
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB711" type="text" id="RB711" size="10" value="<?=$dato['RB711'];?>" />	
		</TD>	
		<TD rowspan=2 >
			<input name="RB712" type="text" id="RB712" size="10" value="<?=$dato['RB712'];?>" />	
		</TD>
		<TD >
			<input name="RB713" type="text" id="RB713" size="20" value="<?=$dato['RB713'];?>"/>	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB714">				
			  <?
				  foreach($VopRB14 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB714']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
	  	<TD >
			<select name="RB715">
			  <?
				  foreach($VopRB15 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB715']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>	
			</select>
		</TD>	  
	  	<TD >
			<select name="RB716">
			  <?
				  foreach($VopRB16 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB716']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>			
		<TD>		
			<input name="RB717" type="text" id="RB717" size="20" value="<?=$dato['RB717'];?>"/>					
		</TD>										
	</TR>
	<TR><!-- FILA 8-->
		<TD rowspan=2 >
			8
		</TD>
	  	<TD rowspan=2 >
			<select name="RB82">				
			  <?
				  foreach($VopRB2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB82']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB83">				
			  <?
				  foreach($VopRB3 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB83']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>			
		<TD>		
			<select name="RB84">				
			  <?
				  foreach($VopRB4 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB84']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>										
		<TD >
			<select name="RB85">				
			  <?
				  foreach($VopRB5 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB85']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	
		<TD >
			<select name="RB86">
			  <?
				  foreach($VopRB6 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB86']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB87">				
			  <?
				  foreach($VopRB7 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB87']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB88" type="text" id="RB58" size="10" value="<?=$dato['RB58'];?>"/>	
		</TD>
		<TD rowspan=2 >
			<input name="RB89" type="text" id="RB59" size="10" value="<?=$dato['RB59'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<select name="RB810">
			  <?
				  foreach($VopRB10 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB810']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB811" type="text" id="RB811" size="10" value="<?=$dato['RB811'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<input name="RB812" type="text" id="RB812" size="10" value="<?=$dato['RB812'];?>"/>	
		</TD>
		<TD >
			<input name="RB813" type="text" id="RB813" size="20" value="<?=$dato['RB813'];?>"/>	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB814">
			  <?
				  foreach($VopRB14 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB814']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>
	  	<TD >
			<select name="RB815">
			  <?
				  foreach($VopRB15 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB815']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>	  
	  	<TD >
			<select name="RB816">	

			  <?
				  foreach($VopRB14 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB814']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>			
		<TD>		
			<input name="RB817" type="text" id="RB817" size="20" value="<?=$dato['RB817'];?>" />					
		</TD>										
	</TR>
	<TR><!-- FILA 9-->
		<TD rowspan=2 >
			9
		</TD>
	  	<TD rowspan=2 >
			<select name="RB92">					
			  <?
				  foreach($VopRB2 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB92']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>		
								
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB93">
			  <?
				  foreach($VopRB3 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB93']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>					
			</select>
		</TD>			
		<TD>		
			<select name="RB94">				
			  <?
				  foreach($VopRB4 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB94']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>									
			</select>
		</TD>										
		<TD >
			<select name="RB95">
			  <?
				  foreach($VopRB5 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB95']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>									
			</select>
		</TD>	
		<TD >
			<select name="RB96">
			  <?
				  foreach($VopRB6 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB96']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>					
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB97">				
			  <?
				  foreach($VopRB7 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB97']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>				
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB98" type="text" id="RB98" size="10" value="<?=$dato['RB98'];?>" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB99" type="text" id="RB99" size="10" value="<?=$dato['RB99'];?>" />	
		</TD>	
		<TD rowspan=2 >
			<select name="RB910">
			  <?
				  foreach($VopRB10 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB910']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>				
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB911" type="text" id="RB911" size="10" value="<?=$dato['RB911'];?>"/>	
		</TD>	
		<TD rowspan=2 >
			<input name="RB912" type="text" id="RB912" size="10" value="<?=$dato['RB912'];?>"/>	
		</TD>
		<TD >
			<input name="RB913" type="text" id="RB913" size="20" value="<?=$dato['RB913'];?>"/>	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB914">
			  <?
				  foreach($VopRB14 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB914']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>								
			</select>
		</TD>
	  	<TD >
			<select name="RB915">
			  <?
				  foreach($VopRB15 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB915']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>					
			</select>
		</TD>	  
	  	<TD >
			<select name="RB916">
			  <?
				  foreach($VopRB16 as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RB916']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>					
			</select>
		</TD>			
		<TD>		
			<input name="RB917" type="text" id="RB917" size="20" value="<?=$dato['RB917'];?>"/>					
		</TD>										
	</TR>
</TABLE>
<p>* Llenar solo en caso de que no se cuente con RET.</p>>


<br />
<br />
<TABLE width="900" align="center" class="table2">
	<caption>Pruebas de Servicio.</caption>	
	<TR>
		<TH >
			Pruebas de Servicio
		</TH>
	  	<TH>
			Numero de A
		</TH>		
	  	<TH >
			Numero de B
		</TH>
		<TH > 
			Hora
		</TH>		
		<TH > 
			GSM
		</TH>		
		<TH colspan=2> 
			UMTS
		</TH>		
		<TH colspan=2> 
			LTE
		</TH>		
	</TR>
	<TR>
		<TH >
			Llamar a movil
		</TH>
	  	<TD>
			<input name="LMA" type="text" id="LMA" size="10" value="<?=$dato['LMA'];?>" />	
		</TD>		
	  	<TD>
			<input name="LMB" type="text" id="LMB" size="10" value="<?=$dato['LMB'];?>"/>	
		</TD>				
		<TD>
			<input name="LMH" type="text" id="LMH" size="10" value="<?=$dato['LMH'];?>"/>	
		</TD>				
		<TD>
			<select name="LMGSM">
			  <?
				  foreach($VopOKNOK as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['LMGSM']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>																	
			</select>
		</TD>				
		<TD colspan=2>
			<select name="LMUMTS">
			  <?
				  foreach($VopOKNOK as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['LMUMTS']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>													
			</select>
		</TD>				
				
		
	</TR>
	<TR>
		<TH >
			SMS	
		</TH>
	  	<TD>
			<input name="SMSA" type="text" id="SMSA" size="10" value="<?=$dato['SMSA'];?>" />	
		</TD>		
	  	<TD>
			<input name="SMSB" type="text" id="SMSB" size="10" value="<?=$dato['SMSB'];?>"/>	
		</TD>				
		<TD>
			<input name="SMSH" type="text" id="SMSH" size="10" value="<?=$dato['SMSH'];?>"/>	
		</TD>				
		<TD>
			<select name="SMSGSM">			
			  <?
				  foreach($VopOKNOK as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['SMSGSM']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>												
			</select>
		</TD>				
		<TD colspan=2>
			<select name="SMSUMTS">				
			  <?
				  foreach($VopOKNOK as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['SMSUMTS']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>												
			</select>
		</TD>				
		
					
		
	</TR>
	<TR>
		<TH >
			VideoLlamada
		</TH>
	  	<TD>
			<input name="VLA" type="text" id="VLA" size="10" value="<?=$dato['VLA'];?>" />	
		</TD>		
	  	<TD>
			<input name="VLB" type="text" id="VLB" size="10" value="<?=$dato['VLB'];?>"/>	
		</TD>				
		<TD>
			<input name="VLH" type="text" id="VLH" size="10" value="<?=$dato['VLH'];?>"/>	
		</TD>				
		<TD>
			<select name="VLGSM">	
			  <?
				  foreach($VopOKNOK as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['VLGSM']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>													
			</select>
		</TD>				
		<TD colspan=2>
			
			<select name="VLUMTS">					
			  <?
				  foreach($VopOKNOK as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['VLUMTS']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>													
			</select>
		</TD>				
		
	</TR>
	<TR>
		<TH >
			Llamar a fijo
		</TH>
	  	<TD>
			<input name="LFA" type="text" id="LFA" size="10" value="<?=$dato['LFA'];?>"/>	
		</TD>		
	  	<TD>
			<input name="LFB" type="text" id="LFB" size="10" value="<?=$dato['LFB'];?>"/>	
		</TD>				
		<TD>
			<input name="LFH" type="text" id="LFH" size="10" value="<?=$dato['LFH'];?>"/>	
		</TD>				
		<TD>
			<select name="LFGSM">
			  <?
				  foreach($VopOKNOK as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['LFGSM']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>																									
			</select>
		</TD>				
		<TD colspan=2>
			<select name="LFUMTS">

			  <?
				  foreach($VopOKNOK as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['LFUMTS']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>																																	
			</select>
		</TD>				
				
		
	</TR>
	<TR>
		<TH >
			Navegacion en Internet
		</TH>
	  	<TD>
			
		</TD>		
	  	<TD>
			
		</TD>				
		<TD>
			<input name="NIH" type="text" id="NIH" size="10" value="<?=$dato['NIH'];?>"/>	
		</TD>				
		
		<TD>
			<select name="NIGSM">				
			  <?
				  foreach($VopOKNOK as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['NIGSM']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>											
			</select>
		</TD>
		<TD>
			Baj.<input name="NIUMTSB" type="text" id="NIUMTSB" size="10" value="<?=$dato['NIUMTSB'];?>"/>	
		</TD>
		<TD>
			Sub. <input name="NIUMTSS" type="text" id="NIUMTSS" size="10" value="<?=$dato['NIUMTSS'];?>"/>	
		</TD>				
		<TD>
			Baj. <input name="NILTEB" type="text" id="NILTEB" size="10" value="<?=$dato['NILTEB'];?>"/>	
		</TD>				
		<TD>
			Sub. <input name="NILTES" type="text" id="NILTES" size="10" value="<?=$dato['NILTES'];?>"/>	
		</TD>			
	</TR>
</TABLE>

<BR />

<TABLE width="900" align="center" class="table2">
	<caption>Reporte Fotografico en Alta definicion.</caption>	
	<TR>
		<TD>
			VISTA 360 DEL SITIO
		</TD>
		<TD>
			<select name="RFVS">
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFVS']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			BAJANTE DE ATERRAMIENTO
		</TD>				
			
		<TD>
			<select name="RFBA">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFBA']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			CAMINO DE ACCESO
		</TD>
		<TD>
			<select name="RFCA">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFCA']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
			  ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			GRUPO GENERADOR
		</TD>				
			
		<TD>
			<select name="RFGG">
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFGG']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			DETALLE PUERTA
		</TD>
		<TD>
			<select name="RFDP">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFDP']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			BARRAS DE TIERRA
		</TD>				
			
		<TD>
			<select name="RFBT">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFBT']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			VISTAS DE LA ESTRUCTURA
		</TD>
		<TD>
			<select name="RFVE">
				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFVE']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			TRANSFORMADOR
		</TD>				
			
		<TD>
			<select name="RFT">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFT']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>


		</TD>				
		
	</TR>		
	<TR>
		<TD>
			VISTA FRONTAL LOZA
		</TD>
		<TD>
			<select name="RFVF">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFVF']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			EQUIPOS DE TX
		</TD>				
			
		<TD>
			<select name="RFET">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFET']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			GABINETES ABIERTOS
		</TD>
		<TD>
			<select name="RFGA">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFGA']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			DETALLE PUERTOS DE TX
		</TD>				
			
		<TD>
			<select name="RFDPTX">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFDPTX']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			ANTENAS DE ENLACES
		</TD>
		<TD>
			<select name="RFAE">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFAE']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			AZIMUTHs DESDE ANTENA SECTORIAL
		</TD>				
			
		<TD>
			<select name="RFAA">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFAA']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			VISTA 360 DESDE PLATAFORMA
		</TD>
		<TD>
			<select name="RFVDP">
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFVDP']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			CONEXIONES DE ANTENA SECTORIAL
		</TD>				
			
		<TD>
			<select name="RFCAS">
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFCAS']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			TILTs MECANICOS
		</TD>
		<TD>
			<select name="RFTM">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFTM']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			BANCO DE BATERIAS
		</TD>				
			
		<TD>
			<select name="RFBB">
				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFBB']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			VISTA POSTERIOR LOZA
		</TD>
		<TD>
			<select name="RFVP">
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFVP']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			DETALLE DE CAPACIDAD DE BATERIAS
		</TD>				
			
		<TD>
			<select name="RFDCB">
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFDCB']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			TOP ABIERTO
		</TD>
		<TD>
			<select name="RFTP">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFTP']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			PROTECTORES DE 1ER/2DO NIVEL
		</TD>				
			
		<TD>
			<select name="RFPN">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFPN']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			MEDIDOR
		</TD>
		<TD>
			<select name="RFM">				
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RFM']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			OBSERVACIONES
		</TD>				
			
		<TD>
			<select name="RPO">
				<?
				  foreach($VopXNA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['RPO']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>				
		
	</TR>		

</TABLE>

<BR />


<TABLE width="900" align="center" class="table2">
	<caption>2. Mantenimiento Preventivo</caption>	
	<TR>
		<TH >
			
		</TH>
	  	<TH >
			Revisado
		</TH>
		<TH >
			Observaciones
		</TH>						
	</TR>
	<TR>
		<TD>
			Verificar la instalacion del gabinete
		</TD>
		<TD>
			<input name="MPVIG" type="text" id="MPVIG" size="10" value="<?=$dato['MPVIG'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOVIG" type="text" id="MPOVIG" size="30" value="<?=$dato['MPOVIG'];?>"/>	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar la instalacion de la BBU y tarjetas
		</TD>
		<TD>
			<input name="MPVIB" type="text" id="MPVIB" size="10" value="<?=$dato['MPVIB'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOVIB" type="text" id="MPOVIB" size="30" value="<?=$dato['MPOVIB'];?>"/>	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar la limpieza fuera y dentro de gabinete
		</TD>
		<TD>
			<input name="MPLG" type="text" id="MPOLG" size="10" value="<?=$dato['MPOLG'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOLG" type="text" id="MPOLG" size="30" value="<?=$dato['MPOLG'];?>"/>	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar el cable de aterramiento de gabinete
		</TD>
		<TD>
			<input name="MPVCAG" type="text" id="MPVCAG" size="10" value="<?=$dato['MPVCAG'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOVCAG" type="text" id="MPOVCAG" size="30" value="<?=$dato['MPOVCAG'];?>"/>	
		</TD>									
	</TR>		
	<TR>
		<TD>
			Verificar que los cables de energia y aterramiento no esten danados o rotos
		</TD>
		<TD>
			<input name="MPVCEAND" type="text" id="MPVCEAND" size="10" value="<?=$dato['MPVCEAND'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOVCEAND" type="text" id="MPOVCEAND" size="30" value="<?=$dato['MPOVCEAND'];?>"/>	
		</TD>									
	</TR>		
	<TR>
		<TD>
			Verificar la instalacion de las RRUs
		</TD>
		<TD>
			<input name="MPVIRRU" type="text" id="MPVIRRU" size="10" value="<?=$dato['MPVIRRU'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOVIRRU" type="text" id="MPOVIRRU" size="30" value="<?=$dato['MPOVIRRU'];?>"/>	
		</TD>							
	</TR>		
	<TR>
		<TD>
			Verificar que cables de energia no esten danados o rotos
		</TD>
		<TD>
			<input name="MPCVENDR" type="text" id="MPCVENDR" size="10" value="<?=$dato['MPCVENDR'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOCVENDR" type="text" id="MPOCVENDR" size="30" value="<?=$dato['MPOCVENDR'];?>"/>	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar que cables de aterramiento no esten danados o rotos
		</TD>
		<TD>
			<input name="MPVCANDR" type="text" id="MPVCANDR" size="10" value="<?=$dato['MPVCANDR'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOVCANDR" type="text" id="MPOVCANDR" size="30" value="<?=$dato['MPOVCANDR'];?>"/>	
		</TD>								
	</TR>		
	<TR>

		<TD>
			Verificar el vulcanizado
		</TD>
		<TD>
			<input name="MPVV" type="text" id="MPVV" size="10" value="<?=$dato['MPVV'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOVV" type="text" id="MPOVV" size="30" value="<?=$dato['MPOVV'];?>"/>	
		</TD>								
	</TR>		
	<TR>

		<TD>
			Verificar etiquetado de Antenas y RRUs
		</TD>
		<TD>
			<input name="MPVEANR" type="text" id="MPVEANR" size="10" value="<?=$dato['MPVEANR'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOVEANR" type="text" id="MPOVEANR" size="30" value="<?=$dato['MPOVEANR'];?>"/>	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar la instalacion de las Antenas
		</TD>
		<TD>
			<input name="MPVIA" type="text" id="MPVIA" size="10" value="<?=$dato['MPVIA'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOVIA" type="text" id="MPOVIA" size="30" value="<?=$dato['MPOVIA'];?>"/>	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar jumpers y clamps minimo cada 1.5 metros
		</TD>
		<TD>
			<input name="MPVJC" type="text" id="MPVJC" size="10" value="<?=$dato['MPVJC'];?>"/>	
		</TD>				
		<TD>
			<input name="MPOVJC" type="text" id="MPOVJC" size="30" value="<?=$dato['MPOVJC'];?>"/>	
		</TD>								
	</TR>			

</TABLE>
<BR>

<TABLE width="900" align="center" class="table2">

<TR>
		<TH >
		Verificar alarmas visibles en Radio Base			
		</TH>
	  	<TH >
			Ubicacion de Alarma
		</TH>
		<TH >
			Solucionado
		</TH>	
		<TH >
			Observaciones
		</TH>					
	</TR>
	<TR>
		<TD >
		<input name="VA1" type="text" id="VA1" size="30" value="<?=$dato['VA1'];?>"/>	
		</TD>
	  	<TD >
			<input name="UA1" type="text" id="UA1" size="30" value="<?=$dato['UA1'];?>"/>	
		</TD>
		<TD >
			<select name="S1">
				<?
				  foreach($VopSINONA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['S1']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>
		<TD >
			<input name="OVA1" type="text" id="OVA1" size="30" value="<?=$dato['OVA1'];?>"/>	
		</TD>						
	</TR>

	<TR>
	<TD >
		<input name="VA2" type="text" id="VA2" size="30" value="<?=$dato['VA2'];?>"/>	
		</TD>
	  	<TD >
			<input name="UA2" type="text" id="UA2" size="30" value="<?=$dato['UA2'];?>"/>	
		</TD>
		<TD >
			<select name="S2">				
				<?
				  foreach($VopSINONA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['S2']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>
		<TD >
			<input name="OVA2" type="text" id="OVA2" size="30" value="<?=$dato['OVA2'];?>"/>	
		</TD>						
	</TR>
	<TR>
		<TD >
		<input name="VA3" type="text" id="VA3" size="30" value="<?=$dato['VA3'];?>"/>	
		</TD>
	  	<TD >
			<input name="UA3" type="text" id="UA3" size="30" value="<?=$dato['UA3'];?>"/>	
		</TD>
		<TD >
			<select name="S3">
				
				<?
				  foreach($VopSINONA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['S3']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>
		<TD >
			<input name="OVA3" type="text" id="OVA3" size="30" value="<?=$dato['OVA3'];?>"/>	
		</TD>						
	</TR>
</TABLE>

<BR>
<TABLE width="950" align="center" class="table2">

<TR>
		<TH >
		Verificar  reporte de alarmas a sistema de gestion								
		</TH>
	  	<TH >
			Estado
		</TH>
		<TH >
			Observaciones
		</TH>	
							
	</TR>
	<TR>
		<TD >
		    Puerta abierta	
		</TD>
	  	<TD >
			<select name="E1">				
				<?
				  foreach($VopFNFNENA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['E1']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>
		<TD >
			<input name="OVR1" type="text" id="OVR1" size="80" value="<?=$dato['OVR1'];?>"/>	
		</TD>
	</TR>
<TR>
		<TD >
		    Bateria en descarga/Falla rectificador	
		</TD>
		<TD >
	  		<select name="E2">
				<?
				  foreach($VopFNFNENA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['E2']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>
		<TD >
			<input name="OVR2" type="text" id="OVR2" size="80" value="<?=$dato['OVR2'];?>"/>	
		</TD>
	</TR>
	<TR>
		<TD >
		    Corte de energia comercial	
		</TD>
		<TD >
	  		<select name="E3">
	  			
				<?
				  foreach($VopFNFNENA as $opcion){
					  echo '<option value="'.$opcion.'" ';
					  if($opcion == $dato['E3']) echo 'selected';
					  echo'>'.$opcion.'</option>';			  
				  }
				 ?>
			</select>
		</TD>
		<TD >
			<input name="OVR3" type="text" id="OVR3" size="80" value="<?=$dato['OVR3'];?>"/>	
		</TD>
	</TR>
</TABLE>
<br />
	

<TABLE width="900" align="center" class="table2">

	<TR>
		<TH >
			OBSERVACIONES.-								
		</TH>	  								
	</TR>
	<TR>
		<TD >
			<input name="OBS" type="text" id="OBS" size="120" value="<?=$dato['OBS'];?>" />
		</TD>
	  	
	</TR>	
</TABLE>
<table width="900" align="center" class="table2" cellspacing="2" class="table2">
	<tr>
		<td>
			<input name="guardar" type="submit"  value="Guardar" />
			<input type="button" name="Submit" value="<< Atras" onclick="javascript:history.back(1)" />
		</td>
	</tr>
</table>
</form>


<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css" />
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet />
<script src="../../paquetes/nicEdit/nicEdit.js" type="text/javascript"></script>             

<script type=text/javascript>
bkLib.onDomLoaded(function() {
	new nicEditor({buttonList : ['removeformat','bold','italic','underline','html']}).panelInstance('obs');
});
</script>
<script type=text/javascript>
var calendar;
var calendarb;
window.onload = function() {
	calendar = new Epoch('dp_cal','popup',document.getElementById('fecha_ini'));
	calendarb = new Epoch('dp_cal','popup',document.getElementById('fecha_fin'));
}
</script>  

<script type="text/javascript">var GB_ROOT_DIR = "./../../paquetes/greybox/";</script>
<script type="text/javascript" src="../../paquetes/greybox/AJS.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/AJS_fx.js"></script>
<script type="text/javascript" src="../../paquetes/greybox/gb_scripts_no_reload.js"></script>
<link href="../../paquetes/greybox/gb_styles.css" rel="stylesheet" type="text/css" media="all" />
<link href="../../paquetes/tooltip/tooltip.css" rel="stylesheet" type="text/css">
<script language=javascript type="text/javascript" src="../../paquetes/tooltip/tooltip.js"></script>

<script src="../../js/validador.js" type=text/javascript></script>
<script type="text/javascript">
function VerifyOne () {
    if( checkField( document.amper.LMA, isName, false ) &&
	    isNull( document.amper.SMSA) &&
		isNull( document.amper.VLA) 
		)
		{
			if(confirm("Verifico bien los datos antes de continuar?"))
			{return true;}
			else {return false;}
    }
else {	
return false;
     }
}
</BODY>
</HTML>

