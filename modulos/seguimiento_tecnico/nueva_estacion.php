<form name="amper" method="post" action="<?=$link_modulo_r?>" onSubmit=" return VerifyOne ();">		
<input type="hidden" name="path" value="nueva_estacion_r.php" />
<div align="center" class="title"><br /></div>
<table width="600" align="center" class="table2">
<caption>Nueva Estacion</caption>
    <tbody>
    <tr>
        <th width="25%">Registrado por:</th>
        <td width="75%" class="resaltar"><?=$nombrec;?></td>
    </tr>
    <tr>
        <th> <span class="rojo">*</span>Nombre Estacion:</th>
        <td>
            <input id="nombre" name="nombre" type="text" class="Text_left" size="40" />
        </td>
    </tr>
    <tr>
        <th> <span class="rojo">*</span>Codigo:</th>
        <td>
            <input id="codigo" name="codigo" type="text" class="Text_left" size="12" />
        </td>
    </tr>

    <tr>
        <th> <span class="rojo">*</span>Centro:</th>
        <td>
            <select name="centro" class="Text_left">
                <option value="0" class="naranja" selected> Seleccionar ... </option>
                <?php
                $resultado  = mysqli_query($conexion, "SELECT idcentro, nombre FROM centro");
                while($dato = mysqli_fetch_array($resultado))
                { echo "<option value='".$dato['idcentro']."'>".$dato['nombre']."</option>"; }
                ?>
            </select>
        </td>
    </tr>

    <tr>
        <th> <span class="rojo">*</span>Tipo de Zona:</th>
        <td>
            <select name="zona" class="Text_left">
                <option value="" class="naranja" selected> Seleccionar ... </option>
                <option value="RURAL" class="naranja">RURAL </option>
                <option value="URBANA" class="naranja">URBANA</option>

            </select>
        </td>
    </tr>

    <tr>
        <th><span class="rojo"></span>Provincia:</th>
        <td>
            <input id="provincia" name="provincia" type="text" class="Text_left" size="20" />
        </td>
    </tr>

    </tbody>

    <tfoot>
	<tr>
	  <td colspan="2" align="center">

              <input name="nuevo" type="submit" value="Guardar" class="btn_dark" />
              <input onClick="location.href='<?=$mst?>ver_estaciones.php'" class="btn_dark" type="button" value="Cancelar">

      </td>
	</tr>
	</tfoot>

</table>
</form>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax.js"></script>
<script type="text/javascript" src="../../paquetes/autocompletar/ajax-dynamic-list.js"></script>
<link href="../../paquetes/autocompletar/ajax-dynamic-list.css" rel="stylesheet" type="text/css">
	
<SCRIPT src="../../js/epoch_classes.js" type=text/javascript></SCRIPT>
<LINK href="../../css/epochprime_styles.css" type=text/css rel=stylesheet>


  <SCRIPT src="../../js/validador.js" type=text/javascript></SCRIPT>
  <script type="text/javascript">
  function VerifyOne () {
    if( checkField( document.amper.nombre, isName, false ) &&
	    isNull( document.amper.codigo)){
			if(confirm("Verifica bien los datos antes de continuar?")){
			    return true;
			}else {
			    return false;
			}
    }else {
        return false;
     }
}
  </script>
