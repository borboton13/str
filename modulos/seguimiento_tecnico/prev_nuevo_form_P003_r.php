<?php
require("../../funciones/funciones.php");
require("../../funciones/motor.php");

$responsable     = $_POST['responsable'];
$fechamantenimiento = $_POST['fechamantenimiento'];
$p13     = $_POST['p13'];
$p14     = $_POST['p14'];
$observaciones     = $_POST['observaciones'];
$ideventos     = $_POST['idevento'];
$forma     = $_POST['idformtto'];



$idevento     = $_POST["idevento"];
$idformulario = $_POST["idformulario"];
$titulo       = $_POST["titulo"];
$params       = $_POST["params"];
$p01    = $_POST["p01"];
$p02    = $_POST["p02"];
$p03    = $_POST["p03"];
$p04    = $_POST["p04"];
$p05    = $_POST["p05"];
$p06    = $_POST["p06"];
$p07    = $_POST["p07"];
$p08    = $_POST["p08"];
$p09    = $_POST["p09"];
$p10    = $_POST["p10"];
$p11    = $_POST["p11"];
$p12    = $_POST["p12"];

/** Nuevo Formulario Mtto. **/
if(isset($_POST['responsable']) and !empty($_POST['responsable']) and isset($_POST['fechamantenimiento']) and !empty($_POST['fechamantenimiento']) ){
if(!isset($_POST['idformtto'])){

    $id = incrementar_id("formulario_p003", "id");
    $consulta = "INSERT INTO formulario_p003 SET
    id           ='".$id."',
    idevento     ='".$idevento."',
    idformulario ='".$idformulario."',
    titulo ='".$titulo."',
    p01       ='".$p01."',
    p02       ='".$p02."',
    p03       ='".$p03."',
    p04       ='".$p04."',
    p05       ='".$p05."',
    p06       ='".$p06."',
    p07       ='".$p07."',
    p08       ='".$p08."',
    p09       ='".$p09."',
    p10       ='".$p10."',
    p11       ='".$p11."',
    p12       ='".$p12."'";

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{

    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p003 SET
                    titulo ='".$titulo."',
                    p01    ='".$p01."',
                    p02    ='".$p02."',
                    p03    ='".$p03."',
                    p04    ='".$p04."',
                    p05    ='".$p05."',
                    p06    ='".$p06."',
                    p07    ='".$p07."',
                    p08    ='".$p08."',
                    p09    ='".$p09."',
                    p10    ='".$p10."',
                    p11    ='".$p11."',
                    p12    ='".$p12."'
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
else echo "<b>Ocurrio un error, revise bien la informaci�n insertada!::</b>".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}
if(!isset($_POST['idformtto'])){

$query= mysql_query("SELECT MAX(id) FROM formulario_p003");
$row = mysql_fetch_row($query);
$idm = $idm = trim($row[0]);;

$Hoy = date("Y-m-d H:i:s");
$srr = mysql_query("INSERT INTO p003_formulario VALUES ('$idm','$ideventos','$responsable','$fechamantenimiento','$p13','$p14','$observaciones','$Hoy')");
 }else

  $sql =mysql_query("UPDATE p003_formulario SET responsable = '$responsable', fechamantenimiento = '$fechamantenimiento', p13 = '$p13', p14 = '$p14', observaciones = '$observaciones'  WHERE id = '$idformtto'");
  
  
}    else echo "<b>Ocurrio un error, revise bien la informaci�n insertada!:: responsable y fecha de mantenimiento:campos oblogatorios::::</b>".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
?>


