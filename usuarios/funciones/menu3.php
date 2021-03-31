<?php
require("../../funciones/motor.php");


$menu="../../paquetes/menu/";
$mclientes="../modulos/clientes.php?path=";
$musuarios="../modulos/usuarios.php?path=";
$mst="../modulos/seguimiento_tecnico.php?path=";
$repo="../modulos/repositorio.php";

$link_cotiza = "../../cotizacion/index.php";

if($nively=='1') $admin  = true; else $admin  = false;
if($nively=='2') $tech   = true; else $tech   = false;
if($nively=='3') $client = true; else $client = false;

if($nively=='1') $admin  = true; else $admin  = false;
if($nively=='2') $tech   = true; else $tech   = false;
if($nively=='3') $client = true; else $client = false;

?>
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/themes/icon.css">
    <link rel="stylesheet" type="text/css" href="http://www.jeasyui.com/easyui/demo/demo.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.1.min.js"></script> -->
    
    <script type="text/javascript" src="http://www.jeasyui.com/easyui/jquery.easyui.min.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Oswald:300' rel='stylesheet' type='text/css'>

<div align="center">
    <h1>Sistema de Seguimiento Tecnico</h1>

    <a href="<?=$mst?>ver.php" class="btn">Proyectos</a>
    <a href="<?=$mst?>cronograma_prev.php" class="btn">Mtto Preventivo</a>

    <a href="<?=$mst?>tickets.php" class="btn">Tickets</a>

    <a href="<?=$mst?>transacciones.php" class="btn">Transacciones</a>

    <a href="<?=$link_cotiza?>" class="btn">Cotiza</a>


    <? if($admin || $client){ ?>
    <!--<a href="<?/*=$mst*/?>actas.php" class="btn">Actas</a>-->
    <? } ?>

    <? if($admin){ ?>
    <!--<a href="<?/*=$mst*/?>ticketsn.php" class="btn">Tickets N.</a>-->
    <a href="<?=$mclientes?>ver_clientes.php" class="btn">Clientes</a>
    <? } ?>
    <? if($admin){ ?>
    <a href="<?=$musuarios?>ver_usuarios.php" class="btn">Usuarios</a>
    <? } else { ?>
    <!--<a href="#" class="btn">Usuarios</a>-->
    <? } ?>
    <!--
    <a href="<?/*=$mst*/?>estadisticas.php" class="btn">Estadisticas</a>
    <a href="<?/*=$mst*/?>estadisticas1.php" class="btn">ESTADIS/INDICA</a>
    -->

    <a href="../../salir.php" class="btn">Cerrar sesion</a>
</div>