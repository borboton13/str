<?php
    if($nively=='1'){ $adm=1;}
?>

<br />
<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne();">
    <input type="hidden" name="path" value="nuevo_transferencia_r.php" />
    <table width="70%" align="center" class="table2">
        <caption>Nueva Transferencia</caption>
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
            <th width="30%"><span class="rojo">*</span>Cuenta origen:</th>
            <td width="70%">
                <select name="cuenta" class="selectbuscar" id="cuenta">
                    <option value="0" selected class="title7">Elija una cuenta...</option>
                    <?php
/*                    $resultadox = mysqli_query($conexion, "select c.idcuenta, c.numero, c.moneda, b.codigo
                                                       from cuenta c
                                                       join banco b on c.idbanco = b.idbanco");
                    while($datox = mysqli_fetch_array($resultadox)){
                        echo'<option value="'.$datox['idcuenta'].'">'.$datox['numero']. '-'.$datox['moneda'].' ('.$datox['codigo'].')'.'</option>';
                    }
                    */?>
                    <?php
                    $resultadox = mysqli_query($conexion, "select c.idcuenta, c.numero, c.moneda, c.descripcion, b.codigo  
                                                           from cuenta c
                                                           join banco b on c.idbanco = b.idbanco");
                    while($datox = mysqli_fetch_array($resultadox)){
                        echo'<option value="'.$datox['idcuenta'].'">'.$datox['numero']. ' '.' ('.$datox['descripcion'].')'.'</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <th width="30%"><span class="rojo">*</span>Cuenta destino:</th>
            <td width="70%">
                <select name="cuentaDest" class="selectbuscar" id="cuentaDest">
                    <option value="0" selected class="title7">Elija una cuenta...</option>
                    <?php
                    $resultadox = mysqli_query($conexion, "select c.idcuenta, c.numero, c.moneda, c.descripcion, b.codigo  
                                                           from cuenta c
                                                           join banco b on c.idbanco = b.idbanco");
                    while($datox = mysqli_fetch_array($resultadox)){
                        echo'<option value="'.$datox['idcuenta'].'">'.$datox['numero']. ' '.' ('.$datox['descripcion'].')'.'</option>';
                    }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <th width="30%"><span class="rojo">*</span>Importe:</th>
            <td width="70%"><input name="importe" type=text class="Text_left" id="importe" size="15" maxlength="250" autocomplete="off"></td>
        </tr>

        <!--<tr>
            <th width="30%"><span class="rojo">*</span>Tipo Movimiento:</th>
            <td width="70%">
                <select name="tipo" class="selectbuscar" id="tipo">
                    <option value="0" selected class="title7">Elija el movimiento...</option>
                    <option value="I" class="title7">INGRESO (I)</option>
                    <option value="E" class="title7">EGRESO (E)</option>
                </select>
            </td>
        </tr>-->

        <tr>
            <th width="30%"><span class="rojo">*</span>Glosa:</th>
            <td width="70%"><input name="glosa" type=text class="Text_left" id="glosa" size="50" maxlength="250" autocomplete="off"></td>
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
                <input name="Atras" type="button" id="Atras" value="Atras" onclick="javascript:history.back(1);" />
                <input type="submit" name="Submit" value="Adicionar" />
            </td>
        </tr>
        </tfoot>
    </table>
</form>

<br />

<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css">


<script src="../../js/epoch_classes.js" type=text/javascript></script>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet>
<script src="../../paquetes/nicEdit/nicEdit.js" type="text/javascript"></script>

<SCRIPT type=text/javascript>
var calendar;
var calendarb;
window.onload = function() {
	calendar = new Epoch('dp_cal','popup',document.getElementById('fecha_n'));
	calendarb = new Epoch('dp_cal','popup',document.getElementById('fecha'));
}

</script>  

  <SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
  <script type="text/javascript">
  function VerifyOne () {

      if(
          validarSelect( document.amper.producto, "Seleccionar Producto!!!") &&
          validarSelect( document.amper.idareatrabajo, "Seleccionar Area!!!") &&
          validarSelect( document.amper.idestacion, "Seleccionar Estacion!!!") &&
          validarSelect( document.amper.idtipofalla, "Seleccionar Falla!!!") &&
          isNull( document.amper.fecha_n) &&
          isNull( document.amper.hora_n) &&
          isNull( document.amper.fecha) &&
          isNull( document.amper.hora_p) &&
          validarSelect( document.amper.tecnico, "Seleccionar Tecnico Responsable!!!")
      ){
			if(confirm("Verifica bien los datos antes de continuar?")){
			    return true;
			}else {
			    return false;
			}
      }else {
            return false;
      }
}


    function showFalla(){

        var falla = document.getElementById("idtipofalla");
        var texto = falla.options[falla.selectedIndex].text;
        document.getElementById('caracteristicas').value = texto;

    }

  </script>
