<?php
$id_item=$_GET["id_item"];
$resultado=mysqli_query($conexion, "SELECT departamento,producto,marca,caracteristicas,sn,ubicacion,id_st_proyecto FROM st_trabajos WHERE id_item='".$id_item."'");
$dato=mysqli_fetch_array($resultado);
$nro=$dato['id_st_proyecto'];
 
 $dato_p=mysqli_fetch_array(mysqli_query($conexion, "SELECT descripcion FROM parametrica WHERE grupo='st_archivo' AND sub_grupo='".$dato['producto']."'"));
 $pro_key=$dato_p['descripcion'];
	 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<title>Actividades</title>
</head>
<body style="padding-top:5px;">

<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne();">		
<input type="hidden" name="path" value="trabajos_depositos_adicionar_r.php" />
<table width="100%" align="center" class="table2">
<caption>Inserte Nueva Transaccion</caption>
<tr>
<th colspan="2"><strong class="verde">Transaccion:</strong></th>
</tr>
    <tr>
        <th width="30%"><span class="rojo">*</span>Fecha:</th>
        <td width="70%"><input name="fecha" value="<?=date("d/m/Y");?>" type="text" class="Text_center" id="fecha" size="12"/>
            <img onclick=calendarb.toggle() src="../../img/cal.gif" alt="Seleccionar fecha incial" width="16" height="16">
        </td>
    </tr>

    <tr>
        <th width="30%"><span class="rojo">*</span>Importe:</th>
        <td width="70%"><input name="importe" type=text class="Text_left" id="importe" size="15" maxlength="250" autocomplete="off"></td>
    </tr>

    <tr>
        <th width="30%"><span class="rojo">*</span>Tipo Movimiento:</th>
        <td width="70%">
            <select name="tipo" class="selectbuscar" id="tipo">
                <option value="0" selected class="title7">Elija el movimiento...</option>
                <option value="I" class="title7">INGRESO (I)</option>
                <option value="E" class="title7">EGRESO (E)</option>
            </select>
        </td>
    </tr>

    <tr>
        <th width="30%"><span class="rojo">*</span>Glosa:</th>
        <td width="70%"><input name="glosa" type=text class="Text_left" id="glosa" size="50" maxlength="250" autocomplete="off"></td>
    </tr>

    <tr>
        <th width="30%"><span class="rojo">*</span>Cuenta:</th>
        <td width="70%">
            <select name="cuenta" class="selectbuscar" id="cuenta">
                <option value="0" selected class="title7">Elija una cuenta...</option>
                <?php
                $resultadox = mysqli_query($conexion, "select c.idcuenta, c.numero, c.moneda, b.codigo  
                                                       from cuenta c
                                                       join banco b on c.idbanco = b.idbanco");
                while($datox = mysqli_fetch_array($resultadox)){
                    echo'<option value="'.$datox['idcuenta'].'">'.$datox['numero']. '-'.$datox['moneda'].' ('.$datox['codigo'].')'.'</option>';
                }
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <th width="30%"  >No trans:</th>
        <td width="70%"><input name="notrans" type=text class="Text_left" id="notrans" size="15" maxlength="250" autocomplete="off"></td>
    </tr>

    <tr>
        <td colspan="2" align="center"><span class="rojo">(*) Campos Requeridos</span></td>
    </tr>


    <tfoot>
    <tr>
    <td colspan="2" align="center">
           <input type="hidden" name="id_item" value="<?=$id_item?>"/>
                  <input type="hidden" name="pro_key" value="<?=$pro_key?>"/>
                  <input type="hidden" name="id_st_proyecto" value="<?=$nro?>"/>
                <input name="Atras" type="button" id="Atras" value="Atras" onclick="javascript:history.back(1);" />
    <input type="submit" name="Submit" value="Adicionar" />
    </td>
    </tr>
    </tfoot>
</table>
</form>
</body>
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet>          
<SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
<SCRIPT type=text/javascript>
var calendar;
window.onload = function() {
	calendar = new Epoch('dp_cal','popup',document.getElementById('fecha'));
}

  function VerifyOne () {
      if( isNull( document.amper.fecha) &&
          isNull( document.amper.importe) &&
          isNull( document.amper.glosa) &&
          validarSelect(document.amper.cuenta,'Seleccione una cuenta') &&
          validarSelect(document.amper.tipo,'Seleccione un tipo de movimiento')) {
          return true;
      } else {
          return false;
      }
  }

</script>
</html>
