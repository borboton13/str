<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Listado de usuarios registrados en el Portal</title>
<link href="../../css/general.css" rel="stylesheet" type="text/css">
</head>
<body>

<?
require("../../funciones/motor.php");
include("../../funciones/class.paginado.php");
if (isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
}
?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr>
                <td height="31" class="title4"><br>
                  Historial de Accesos
                :  
</td>
              </tr>

<tr> 
<tr>
<td>
<table width="100%" cellspacing="0" bgcolor="#E0E0E0">
<tr>
		             <td>
                       <div align="right">
                         <?
$rs = new paginado($conexion);
$rs->pagina($pagina);
$rs->porPagina(20);
if(!$rs->query("SELECT id_st_registro_usuarios_fallo,date_format(fecha, '%d/%m/%y %H:%i:%s'),ip,isp,cuenta_ing,clave_ing FROM st_registro_usuarios_fallo ORDER BY fecha DESC"))
{    die( $rs->error() );
}
echo "Mostrando ".$rs->desde()." - ".$rs->hasta()." de un total de ".$rs->total()."<br>";
?>	 
    </div></td>
</tr>		
</table>
</td></tr>	  
              <tr>
              
                <td >
  
				  <table width="100%" class="table1">
						  <tr bgcolor="#485765">
						  <td width="5%" height="16" class="title3">ID</td>
			              	
						  <td  width="22%" class="title3">
              <div align="center"> FECHA Y HORA </div></td>	
			  <td  width="19%"class="title3"><div align="center">IP</div></td>
			  <td  width="19%"class="title3"><div align="center">ISP</div></td>
						  <td  width="17%" class="title3">
              <div align="center"> CUENTA </div></td>
						  <td  width="18%" class="title3"><div align="center">CONTRASE&Ntilde;A</div></td>
				    </tr>
						  
						  <?
  $i=0; 
  while($row = $rs->obtenerArray())
 {
 $nro=$row[0];
 $fecha=$row[1];
 $ip=$row[2];
 $isp=$row[3];
 $cuenta=$row[4];
 $clave=$row[5];
///////////
	 $i++;
	 if($i%2==0)
	{
	$rowt="#f6f7f8";
	}
	else
	{
	$rowt="#f1f1f1";
	}
	echo"<tr height='25' bgcolor='$rowt' onmouseover=\"setPointer(this, '#DADADA')\" onmouseout=\"setPointer(this, '$rowt')\"> 
            <td>$nro</td>			
			<td><DIV ALIGN='center'>$fecha</DIV></td>
			<td><DIV ALIGN='center'>$ip</DIV></td>
			<td><DIV ALIGN='center'>$isp</DIV></td>
			<td><span class='title5'>$cuenta</span></td>
			<td><span class='title5'>$clave</span></td>
			"; 
          echo"</tr>";
 }

?>
			      </table>
			    </td>
				  
              </tr>
			  <tr> 
		             <td colspan="4" bgcolor="#E0E0E0" id=pie>
                       <div align="right">
                         <?
echo $rs->anterior()." - ".$rs->nroPaginas()." - ".$rs->siguiente();
?>					 
                </div></td>
</tr>
              </tr>	
</table>
</body>
</html>
<SCRIPT src="../../js/general.js" type=text/javascript></SCRIPT>
