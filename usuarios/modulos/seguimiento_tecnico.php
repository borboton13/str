<?php
session_start(); 
require("../../funciones/motor.php");
require("../funciones/verificar_sesion.php");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
<TITLE>Sistema de Seguimiento Tecnico Dimesat</TITLE>
<!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<SCRIPT src="../../js/general.js" type=text/javascript></SCRIPT>
<script src="../../js/validatechar.js" type=text/javascript></script>
<link href="../../css/general.css" rel="stylesheet" type="text/css">
<link href="../../css/menu3.css" rel="stylesheet" type="text/css">
<link href="../../css/base.css" rel="stylesheet" type="text/css">

</HEAD>
<body>
<?php
//require("../../funciones/encabezado.php");
//require("../funciones/menu.php");

require("../funciones/menu3.php");
$modulo="seguimiento_tecnico";
$link_modulo=$modulo.".php";
$link_modulo_r=$modulo."_r.php";
?>
<div id="wrapper"><div id="main"><div class="content">
<?php
if (isset($_REQUEST['path'])){
$path=$_REQUEST['path'];
include("../../modulos/".$modulo."/".$path);
}
?>
</div></div></div>
<?php require("../../funciones/footer.php"); ?>
<?php /*require("../../funciones/pie.php"); */?>
</body>
</HTML>