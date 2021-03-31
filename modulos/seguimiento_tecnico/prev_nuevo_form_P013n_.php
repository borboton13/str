<HTML>
<HEAD>
<TITLE> Título de la página </TITLE>
</HEAD>
<BODY>
<?  
$web=$_SESSION["web"];

if (isset($_GET['idevento']))   $idevento     = $_GET['idevento'];
if (isset($_GET['idform']))     $idformulario = $_GET['idform'];
if (isset($_GET['nombreForm'])) $nombreForm   = $_GET['nombreForm'];

$resultado = mysql_query("SELECT * FROM formulario_p013n WHERE idevento = '$idevento' ");
$totalFilas    =    mysql_num_rows($resultado);  


$resultado = mysql_query("
SELECT ev.idevento, ev.estado, ev.inicio, ev.fin, es.codigo as codigoest, es.nombre as nombreest, g.codigo AS codigog, c.idcentro, c.codigo as codCentro
FROM evento ev
JOIN estacion es ON ev.idestacion = es.idestacion
JOIN grupo g 	 ON ev.idgrupo = g.idgrupo
JOIN centro c    ON ev.idcentro = c.idcentro
WHERE ev.idevento = '$idevento' ");

$dato = mysql_fetch_array($resultado);

$arr = explode('-', $dato['inicio']);

$anio			= $arr[0];
$codCentro 		= $dato['codCentro'];
$ini			= $dato['inicio'];
$fin			= $dato['fin'];
$idev 			= $idevento;
$codEs			= $dato['codigoest'];
$nomEs 			= $dato['nombreest'];

$params = "&anio=$anio&codCentro=$codCentro&ini=$ini&fin=$fin&idev=$idev&codEs=$codEs&nomEs=$nomEs&idevento=$idevento&idform=$idformulario&nombreForm=$nombreForm";

if ($totalFilas!=0){
	$href = "$link_modulo?path=prev_editar_form_P013n.php&$params";
	?>
		<script type="text/javascript">
	        window.open('<?=$href?>', '_top');
		</script> 
	<?
}
require("../../funciones/funciones.php");
	$op1 = array("...", "F.O", "MW", "SATELITAL", "PEX");
	$op2 = array("...", "E1", "ELECTRICO", "OPTICO");
	$op3TA = array("...", "E1", "ELECTRICO", "OPTICO");
	$opRB2 = array("...", "SECTORIAL","OMNIDIRECCIONAL");
	$opRB3 = array("...", "1","2","3","4");
	$opRB4 = array("...", "GSM 850");
	$opRB5 = array("...", "UMTS 850");
	$opRB6 = array("...", "LTE 700");
	$opRB7 = array("...", "LTE 1900");
	$opRB10 = array("...", "SI","NO");
	$opRB14 = array("...", "GSM 1900");
	$opRB15 = array("...", "UMTS 1900");
	$opRB16 = array("...", "LTE AWS");
	$opOKNOK = array("...", "OK","NOK");
	$opXNA = array("...", "X","NA");
	$opSINONA = array("...", "SI", "NO","NA");	
	$opFNFNENA = array("...", "FUNCIONA", "NO FUNCIONA","EXISTE","NO EXISTE","NA");			

//echo($link_modulo_r);
?>
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">

	<input type="hidden" name="path" value="prev_nuevo_form_P013n_r.php" />
	<input type="hidden" name="idevento" value="<?=$idevento?>" />
	<input type="hidden" name="idformulario" value="<?=$idformulario?>" />
	<input type="hidden" name="params" value="<?=$params?>" />
	<input type="hidden" name="nomEs" value="<?=$nomEs?>" />
<br />
<TABLE width="900" align="center" class="table2">
	<caption>FORMULARIO DE MANTENIMIENTO PREVENTIVO RADIO BASES</caption>	
	<TR>
		<TH >
				ESTACION: <input name="nomES" type="text" id="nomEs" size="30" value="<? ECHO($nomEs);?>" />
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
				<? foreach($op1 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>			
			</select>
		</TD>		
	  	<TD>
			<select name="TEUMTS">
				<? foreach($op1 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>						
			</select>
		</TD>				
		<TD>
			<select name="TELTE">
				<? foreach($op1 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>						
			</select>
		</TD>				
	</TR>
	<TR>
		<TH >
			EQUIPO ORIGEN DE TX	
		</TH>
	  	<TD>
			<input name="EOGSM" type="text" id="EOGSM" size="30" />
		</TD>		
	  	<TD>
			<input name="EOUMTS" type="text" id="EOUMTS" size="30" />
		</TD>				
		<TD>
			<input name="EOLTE" type="text" id="EOLTE" size="30" />
		</TD>				
	</TR>
	<TR>
		<TH >
			TIPO DE PUERTO
		</TH>
	  	<TD>
			<select name="TPGSM">
				<? foreach($op2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>						
			</select>
		</TD>		
	  	<TD>
			<select name="TPUMTS">
				<? foreach($op2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>						
			</select>
		</TD>				
		<TD>
			<select name="TPLTE">
				<? foreach($op2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>						
			</select>
		</TD>				
	</TR>
	<TR>
		<TH >
			PUERTO ASIGNADO EN TX
		</TH>
	  	<TD>
			<input name="PGSM" type="text" id="PGSM" size="30" />
		</TD>		
	  	<TD>
			<input name="PUMTS" type="text" id="PUMTS" size="30" />
		</TD>				
		<TD>
			<input name="PLTE" type="text" id="PLTE" size="30" />
		</TD>			
	</TR>
	<TR>
		<TH >
			SALTO PREVIO
		</TH>
	  	<TD>
			<input name="SPGSM" type="text" id="SPGSM" size="30" />
		</TD>		
	  	<TD>
			<input name="SPUMTS" type="text" id="SPUMTS" size="30" />
		</TD>				
		<TD>
			<input name="SPLTE" type="text" id="SPLTE" size="30" />
		</TD>				
	</TR>

	<TR>
		<TH >
			MODELO DE GABINETE	
		</TH>
	  	<TD>
			<input name="MGGSM" type="text" id="MGGSM" size="30" />
		</TD>		
	  	<TD>
			<input name="MGUMTS" type="text" id="MGUMTS" size="30" />
		</TD>				
		<TD>
			<input name="MGLTE" type="text" id="MGLTE" size="30" />
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
			Tilt Mecánico	
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
				<? foreach($opRB2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>							
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB13">
				<? foreach($opRB3 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>							
			</select>
		</TD>			
		<TD>		
			<select name="RB14">
				<? foreach($opRB4 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>								
			</select>
		</TD>										
		<TD >
			<select name="RB15">
				<? foreach($opRB5 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>	
		<TD >
			<select name="RB16">
				<? foreach($opRB6 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB17">
				<? foreach($opRB7 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB18" type="text" id="RB18" size="10" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB19" type="text" id="RB19" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<select name="RB110">
				<? foreach($opRB10 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
		
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB111" type="text" id="RB111" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<input name="RB112" type="text" id="RB112" size="10" />	
		</TD>
		<TD >
			<input name="RB113" type="text" id="RB113" size="20" />	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB114">
				<? foreach($opRB14 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
	  	<TD >
			<select name="RB115">
				<? foreach($opRB15 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>	  
	  	<TD >
			<select name="RB116">
				<? foreach($opRB16 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>			
		<TD>		
			<input name="RB117" type="text" id="RB117" size="20" />					
		</TD>										
	</TR>
	<TR><!-- FILA 2-->
		<TD rowspan=2 >
			2
		</TD>
	  	<TD rowspan=2 >
			<select name="RB22">
				<? foreach($opRB2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>					
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB23">
			<? foreach($opRB3 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>			
		<TD>		
			<select name="RB24">
				<? foreach($opRB4 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>								
			</select>
		</TD>										
		<TD >
			<select name="RB25">
				<? foreach($opRB5 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>								
			</select>
		</TD>	
		<TD >
			<select name="RB26">
				<? foreach($opRB6 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB27">
				<? foreach($opRB7 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB28" type="text" id="RB28" size="10" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB29" type="text" id="RB29" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<select name="RB210">
				<? foreach($opRB10 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB211" type="text" id="RB211" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<input name="RB212" type="text" id="RB212" size="10" />	
		</TD>
		<TD >
			<input name="RB213" type="text" id="RB213" size="20" />	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB214">
				<? foreach($opRB14 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
	  	<TD >
			<select name="RB215">
				<? foreach($opRB15 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>	  
	  	<TD >
			<select name="RB216">
				<? foreach($opRB16 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>			
		<TD>		
			<input name="RB217" type="text" id="RB217" size="20" />					
		</TD>										
	</TR>
	<TR><!-- FILA 3-->
		<TD rowspan=2 >
			3
		</TD>
	  	<TD rowspan=2 >
			<select name="RB32">
				<? foreach($opRB2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB33">
				<? foreach($opRB3 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>			
		<TD>		
			<select name="RB34">
				<? foreach($opRB4 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>										
		<TD >
			<select name="RB35">
				<? foreach($opRB5 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>	
		<TD >
			<select name="RB36">
				<? foreach($opRB6 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB37">
				<? foreach($opRB7 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB38" type="text" id="RB38" size="10" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB39" type="text" id="RB39" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<select name="RB310">
				<? foreach($opRB10 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB311" type="text" id="RB311" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<input name="RB312" type="text" id="RB312" size="10" />	
		</TD>
		<TD >
			<input name="RB313" type="text" id="RB313" size="20" />	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB314">
				<? foreach($opRB14 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
	  	<TD >
			<select name="RB315">
				<? foreach($opRB15 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>	  
	  	<TD >
			<select name="RB316">
				<? foreach($opRB16 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>			
		<TD>		
			<input name="RB317" type="text" id="RB317" size="20" />					
		</TD>										
	</TR>

	<TR><!-- FILA 4-->
		<TD rowspan=2 >
			4
		</TD>
	  	<TD rowspan=2 >
			<select name="RB42">
				<? foreach($opRB2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB43">
				<? foreach($opRB3 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>			
		<TD>		
			<select name="RB44">
				<? foreach($opRB4 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>										
		<TD >
			<select name="RB45">
				<? foreach($opRB5 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>	
		<TD >
			<select name="RB46">
				<? foreach($opRB6 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB47">
				<? foreach($opRB7 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB48" type="text" id="RB48" size="10" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB49" type="text" id="RB49" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<select name="RB410">
				<? foreach($opRB10 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB411" type="text" id="RB411" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<input name="RB412" type="text" id="RB412" size="10" />	
		</TD>
		<TD >
			<input name="RB413" type="text" id="RB413" size="20" />	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB414">
				<? foreach($opRB14 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
	  	<TD >
			<select name="RB415">
				<? foreach($opRB15 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>	  
	  	<TD >
			<select name="RB416">
				<? foreach($opRB16 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>			
		<TD>		
			<input name="RB417" type="text" id="RB417" size="20" />					
		</TD>										
	</TR>

	<TR><!-- FILA 5-->
		<TD rowspan=2 >
			5
		</TD>
	  	<TD rowspan=2 >
			<select name="RB52">
				<? foreach($opRB2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB53">
				<? foreach($opRB3 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>			
		<TD>		
			<select name="RB54">
				<? foreach($opRB4 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>										
		<TD >
			<select name="RB55">
				<? foreach($opRB5 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	
		<TD >
			<select name="RB56">
				<? foreach($opRB6 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB57">
				<? foreach($opRB7 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB58" type="text" id="RB58" size="10" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB59" type="text" id="RB59" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<select name="RB510">
				<? foreach($opRB10 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>	
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB511" type="text" id="RB511" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<input name="RB512" type="text" id="RB512" size="10" />	
		</TD>
		<TD >
			<input name="RB513" type="text" id="RB513" size="20" />	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB514">
				<? foreach($opRB14 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>
	  	<TD >
			<select name="RB515">
				<? foreach($opRB15 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	  
	  	<TD >
			<select name="RB516">
				<? foreach($opRB16 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>			
		<TD>		
			<input name="RB517" type="text" id="RB517" size="20" />					
		</TD>										
	</TR>

	<TR><!-- FILA 6-->
		<TD rowspan=2 >
			6
		</TD>
	  	<TD rowspan=2 >
			<select name="RB62">
				<? foreach($opRB2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>			
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB63">
				<? foreach($opRB3 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>			
		<TD>		
			<select name="RB64">
				<? foreach($opRB4 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>										
		<TD >
			<select name="RB65">
				<? foreach($opRB5 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	
		<TD >
			<select name="RB66">
				<? foreach($opRB6 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB67">
				<? foreach($opRB7 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB68" type="text" id="RB68" size="10" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB69" type="text" id="RB69" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<select name="RB610">
				<? foreach($opRB10 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB611" type="text" id="RB611" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<input name="RB612" type="text" id="RB612" size="10" />	
		</TD>
		<TD >
			<input name="RB613" type="text" id="RB613" size="20" />	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB614">
				<? foreach($opRB14 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>
	  	<TD >
			<select name="RB615">
				<? foreach($opRB15 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	  
	  	<TD >
			<select name="RB616">
				<? foreach($opRB16 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>			
		<TD>		
			<input name="RB617" type="text" id="RB617" size="20" />					
		</TD>										
	</TR>
	<TR><!-- FILA 7-->
		<TD rowspan=2 >
			7
		</TD>
	  	<TD rowspan=2 >
			<select name="RB72">
				<? foreach($opRB2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>			
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB73">
				<? foreach($opRB3 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>			
		<TD>		
			<select name="RB74">
				<? foreach($opRB4 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>										
		<TD >
			<select name="RB75">
				<? foreach($opRB5 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	
		<TD >
			<select name="RB76">
				<? foreach($opRB6 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB77">
				<? foreach($opRB7 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB78" type="text" id="RB78" size="10" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB79" type="text" id="RB79" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<select name="RB710">
				<? foreach($opRB10 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB711" type="text" id="RB711" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<input name="RB712" type="text" id="RB712" size="10" />	
		</TD>
		<TD >
			<input name="RB713" type="text" id="RB713" size="20" />	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB714">
				<? foreach($opRB14 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>
	  	<TD >
			<select name="RB715">
				<? foreach($opRB15 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	  
	  	<TD >
			<select name="RB716">
				<? foreach($opRB16 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>			
		<TD>		
			<input name="RB717" type="text" id="RB717" size="20" />					
		</TD>										
	</TR>
	<TR><!-- FILA 8-->
		<TD rowspan=2 >
			8
		</TD>
	  	<TD rowspan=2 >
			<select name="RB82">
				<? foreach($opRB2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>			
				
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB83">
				<? foreach($opRB3 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>			
		<TD>		
			<select name="RB84">
				<? foreach($opRB4 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>										
		<TD >
			<select name="RB85">
				<? foreach($opRB5 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	
		<TD >
			<select name="RB86">
				<? foreach($opRB6 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB87">
				<? foreach($opRB7 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB88" type="text" id="RB58" size="10" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB89" type="text" id="RB59" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<select name="RB810">
				<? foreach($opRB10 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB811" type="text" id="RB811" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<input name="RB812" type="text" id="RB812" size="10" />	
		</TD>
		<TD >
			<input name="RB813" type="text" id="RB813" size="20" />	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB814">
				<? foreach($opRB14 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>
	  	<TD >
			<select name="RB815">
				<? foreach($opRB15 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>	  
	  	<TD >
			<select name="RB816">
				<? foreach($opRB16 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>		
			</select>
		</TD>			
		<TD>		
			<input name="RB817" type="text" id="RB817" size="20" />					
		</TD>										
	</TR>
	<TR><!-- FILA 9-->
		<TD rowspan=2 >
			9
		</TD>
	  	<TD rowspan=2 >
			<select name="RB92">
					<? foreach($opRB2 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>					
								
			</select>
		</TD>	  
	  	<TD rowspan=2 >
			<select name="RB93">
				<? foreach($opRB3 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>					
			</select>
		</TD>			
		<TD>		
			<select name="RB94">
				<? foreach($opRB4 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>					
			</select>
		</TD>										
		<TD >
			<select name="RB95">
				<? foreach($opRB5 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>					
			</select>
		</TD>	
		<TD >
			<select name="RB96">
				<? foreach($opRB6 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>					
			</select>
		</TD>
		<TD rowspan=2  >
			<select name="RB97">
				<? foreach($opRB7 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>					
			</select>
		</TD>	
		<TD rowspan=2 >
			<input name="RB98" type="text" id="RB98" size="10" />	
		</TD>
		<TD rowspan=2 >
			<input name="RB99" type="text" id="RB99" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<select name="RB910">
				<? foreach($opRB10 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>					
			</select>
		</TD>
		<TD rowspan=2 >
			<input name="RB911" type="text" id="RB911" size="10" />	
		</TD>	
		<TD rowspan=2 >
			<input name="RB912" type="text" id="RB912" size="10" />	
		</TD>
		<TD >
			<input name="RB913" type="text" id="RB913" size="20" />	
		</TD>
		
	</TR>
	<TR>
		<TD >
			<select name="RB914">
				<? foreach($opRB14 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>					
			</select>
		</TD>
	  	<TD >
			<select name="RB915">
				<? foreach($opRB15 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>					
			</select>
		</TD>	  
	  	<TD >
			<select name="RB916">
				<? foreach($opRB16 as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>					
			</select>
		</TD>			
		<TD>		
			<input name="RB917" type="text" id="RB917" size="20" />					
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
			<input name="LMA" type="text" id="LMA" size="10" />	
		</TD>		
	  	<TD>
			<input name="LMB" type="text" id="LMB" size="10" />	
		</TD>				
		<TD>
			<input name="LMH" type="text" id="LMH" size="10" />	
		</TD>				
		<TD>
			<select name="LMGSM">
				<? foreach($opOKNOK as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>													
			</select>
		</TD>				
		<TD colspan=2>
			<select name="LMUMTS">
				<? foreach($opOKNOK as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>													
			</select>
		</TD>				
				
		
	</TR>
	<TR>
		<TH >
			SMS	
		</TH>
	  	<TD>
			<input name="SMSA" type="text" id="SMSA" size="10" />	
		</TD>		
	  	<TD>
			<input name="SMSB" type="text" id="SMSB" size="10" />	
		</TD>				
		<TD>
			<input name="SMSH" type="text" id="SMSH" size="10" />	
		</TD>				
		<TD>
			<select name="SMSGSM">
				<? foreach($opOKNOK as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>													
			</select>
		</TD>				
		<TD colspan=2>
			<select name="SMSUMTS">
				<? foreach($opOKNOK as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>													
			</select>
		</TD>				
		
					
		
	</TR>
	<TR>
		<TH >
			VideoLlamada
		</TH>
	  	<TD>
			<input name="VLA" type="text" id="VLA" size="10" />	
		</TD>		
	  	<TD>
			<input name="VLB" type="text" id="VLB" size="10" />	
		</TD>				
		<TD>
			<input name="VLH" type="text" id="VLH" size="10" />	
		</TD>				
		<TD>
			<select name="VLGSM">
				<? foreach($opOKNOK as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>													
			</select>
		</TD>				
		<TD colspan=2>			
			<select name="VLUMTS">
				<? foreach($opOKNOK as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>													
			</select>
		</TD>				
		
	</TR>
	<TR>
		<TH >
			Llamar a fijo
		</TH>
	  	<TD>
			<input name="LFA" type="text" id="LFA" size="10" />	
		</TD>		
	  	<TD>
			<input name="LFB" type="text" id="LFB" size="10" />	
		</TD>				
		<TD>
			<input name="LFH" type="text" id="LFH" size="10" />	
		</TD>				
		<TD>
			<select name="LFGSM">
				<? foreach($opOKNOK as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>													
			</select>
		</TD>				
		<TD colspan=2>
			<select name="LFUMTS">
				<? foreach($opOKNOK as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>													
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
			<input name="NIH" type="text" id="NIH" size="10" />	
		</TD>				
		
		<TD>
			<select name="NIGSM">
				<? foreach($opOKNOK as $opcion){
				  echo "<option value='$opcion'>$opcion</option>";
			  }?>													
			</select>
		</TD>
		<TD>
			Baj.<input name="NIUMTSB" type="text" id="NIUMTSB" size="10" />	
		</TD>
		<TD>
			Sub. <input name="NIUMTSS" type="text" id="NIUMTSS" size="10" />	
		</TD>				
		<TD>
			Baj. <input name="NILTEB" type="text" id="NILTEB" size="10" />	
		</TD>				
		<TD>
			Sub. <input name="NILTES" type="text" id="NILTES" size="10" />	
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
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			BAJANTE DE ATERRAMIENTO
		</TD>				
			
		<TD>
			<select name="RFBA">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			CAMINO DE ACCESO
		</TD>
		<TD>
			<select name="RFCA">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			GRUPO GENERADOR
		</TD>				
			
		<TD>
			<select name="RFGG">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			DETALLE PUERTA
		</TD>
		<TD>
			<select name="RFDP">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			BARRAS DE TIERRA
		</TD>				
			
		<TD>
			<select name="RFBT">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			VISTAS DE LA ESTRUCTURA
		</TD>
		<TD>
			<select name="RFVE">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			TRANSFORMADOR
		</TD>				
			
		<TD>
			<select name="RFT">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			VISTA FRONTAL LOZA
		</TD>
		<TD>
			<select name="RFVF">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			EQUIPOS DE TX
		</TD>				
			
		<TD>
			<select name="RFET">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			GABINETES ABIERTOS
		</TD>
		<TD>
			<select name="RFGA">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			DETALLE PUERTOS DE TX
		</TD>				
			
		<TD>
			<select name="RFDPTX">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			ANTENAS DE ENLACES
		</TD>
		<TD>
			<select name="RFAE">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			AZIMUTHs DESDE ANTENA SECTORIAL
		</TD>				
			
		<TD>
			<select name="RFAA">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			VISTA 360 DESDE PLATAFORMA
		</TD>
		<TD>
			<select name="RFVDP">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			CONEXIONES DE ANTENA SECTORIAL
		</TD>				
			
		<TD>
			<select name="RFCAS">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			TILTs MECANICOS
		</TD>
		<TD>
			<select name="RFTM">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			BANCO DE BATERIAS
		</TD>				
			
		<TD>
			<select name="RFBB">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			VISTA POSTERIOR LOZA
		</TD>
		<TD>
			<select name="RFVP">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			DETALLE DE CAPACIDAD DE BATERIAS
		</TD>				
			
		<TD>
			<select name="RFDCB">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			TOP ABIERTO
		</TD>
		<TD>
			<select name="RFTP">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			PROTECTORES DE 1ER/2DO NIVEL
		</TD>				
			
		<TD>
			<select name="RFPN">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		
	</TR>		
	<TR>
		<TD>
			MEDIDOR
		</TD>
		<TD>
			<select name="RFM">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>				
		<TD>
			
		</TD>				
		<TD>
			OBSERVACIONES
		</TD>				
			
		<TD>
			<select name="RPO">
				<? foreach($opXNA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
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
			<input name="MPVIG" type="text" id="MPVIG" size="10" />	
		</TD>				
		<TD>
			<input name="MPOVIG" type="text" id="MPOVIG" size="30" />	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar la instalacion de la BBU y tarjetas
		</TD>
		<TD>
			<input name="MPVIB" type="text" id="MPVIB" size="10" />	
		</TD>				
		<TD>
			<input name="MPOVIB" type="text" id="MPOVIB" size="30" />	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar la limpieza fuera y dentro de gabinete
		</TD>
		<TD>
			<input name="MPLG" type="text" id="MPOLG" size="10" />	
		</TD>				
		<TD>
			<input name="MPOLG" type="text" id="MPOLG" size="30" />	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar el cable de aterramiento de gabinete
		</TD>
		<TD>
			<input name="MPVCAG" type="text" id="MPVCAG" size="10" />	
		</TD>				
		<TD>
			<input name="MPOVCAG" type="text" id="MPOVCAG" size="30" />	
		</TD>									
	</TR>		
	<TR>
		<TD>
			Verificar que los cables de energia y aterramiento no esten danados o rotos
		</TD>
		<TD>
			<input name="MPVCEAND" type="text" id="MPVCEAND" size="10" />	
		</TD>				
		<TD>
			<input name="MPOVCEAND" type="text" id="MPOVCEAND" size="30" />	
		</TD>									
	</TR>		
	<TR>
		<TD>
			Verificar la instalacion de las RRUs
		</TD>
		<TD>
			<input name="MPVIRRU" type="text" id="MPVIRRU" size="10" />	
		</TD>				
		<TD>
			<input name="MPOVIRRU" type="text" id="MPOVIRRU" size="30" />	
		</TD>							
	</TR>		
	<TR>
		<TD>
			Verificar que cables de energia no esten danados o rotos
		</TD>
		<TD>
			<input name="MPCVENDR" type="text" id="MPCVENDR" size="10" />	
		</TD>				
		<TD>
			<input name="MPOCVENDR" type="text" id="MPOCVENDR" size="30" />	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar que cables de aterramiento no esten danados o rotos
		</TD>
		<TD>
			<input name="MPVCANDR" type="text" id="MPVCANDR" size="10" />	
		</TD>				
		<TD>
			<input name="MPOVCANDR" type="text" id="MPOVCANDR" size="30" />	
		</TD>								
	</TR>		
	<TR>

		<TD>
			Verificar el vulcanizado
		</TD>
		<TD>
			<input name="MPVV" type="text" id="MPVV" size="10" />	
		</TD>				
		<TD>
			<input name="MPOVV" type="text" id="MPOVV" size="30" />	
		</TD>								
	</TR>		
	<TR>

		<TD>
			Verificar etiquetado de Antenas y RRUs
		</TD>
		<TD>
			<input name="MPVEANR" type="text" id="MPVEANR" size="10" />	
		</TD>				
		<TD>
			<input name="MPOVEANR" type="text" id="MPOVEANR" size="30" />	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar la instalacion de las Antenas
		</TD>
		<TD>
			<input name="MPVIA" type="text" id="MPVIA" size="10" />	
		</TD>				
		<TD>
			<input name="MPOVIA" type="text" id="MPOVIA" size="30" />	
		</TD>								
	</TR>		
	<TR>
		<TD>
			Verificar jumpers y clamps minimo cada 1.5 metros
		</TD>
		<TD>
			<input name="MPVJC" type="text" id="MPVJC" size="10" />	
		</TD>				
		<TD>
			<input name="MPOVJC" type="text" id="MPOVJC" size="30" />	
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
		<input name="VA1" type="text" id="VA1" size="30" />	
		</TD>
	  	<TD >
			<input name="UA1" type="text" id="UA1" size="30" />	
		</TD>
		<TD >
			<select name="S1">
				<? foreach($opSINONA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>
		<TD >
			<input name="OVA1" type="text" id="OVA1" size="30" />	
		</TD>						
	</TR>

	<TR>
	<TD >
		<input name="VA2" type="text" id="VA2" size="30" />	
		</TD>
	  	<TD >
			<input name="UA2" type="text" id="UA2" size="30" />	
		</TD>
		<TD >
			<select name="S2">
				<? foreach($opSINONA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>
		<TD >
			<input name="OVA2" type="text" id="OVA2" size="30" />	
		</TD>						
	</TR>
	<TR>
		<TD >
		<input name="VA3" type="text" id="VA3" size="30" />	
		</TD>
	  	<TD >
			<input name="UA3" type="text" id="UA3" size="30" />	
		</TD>
		<TD >
			<select name="S3">
				<? foreach($opSINONA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>
		<TD >
			<input name="OVA3" type="text" id="OVA3" size="30" />	
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

				<? foreach($opFNFNENA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>
		<TD >
			<input name="OVR1" type="text" id="OVR1" size="80" />	
		</TD>
	</TR>
<TR>
		<TD >
		    Bateria en descarga/Falla rectificador	
		</TD>
		<TD >
	  		<select name="E2">
	  			<? foreach($opFNFNENA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>
		<TD >
			<input name="OVR2" type="text" id="OVR2" size="80" />	
		</TD>
	</TR>
	<TR>
		<TD >
		    Corte de energia comercial	
		</TD>
		<TD >
	  		<select name="E3">
	  			<? foreach($opFNFNENA as $opcion){
					echo "<option value='$opcion'>$opcion</option>";
				}?>
			</select>
		</TD>
		<TD >
			<input name="OVR3" type="text" id="OVR3" size="80" />	
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
			<input name="OBS" type="text" id="OBS" size="120" />
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

