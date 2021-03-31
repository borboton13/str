<?php
require("../../funciones/funciones.php");

$responsable     = $_POST['responsable'];
$fechamantenimiento = $_POST['fechamantenimiento'];
$ideventos     = $_POST['idevento'];



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

/** Nuevo Formulario Mtto. **/
if(isset($_POST['responsable']) and !empty($_POST['responsable']) and isset($_POST['fechamantenimiento']) and !empty($_POST['fechamantenimiento']) ){
if(!isset($_POST['idformtto'])){

    $id = incrementar_id("formulario_p004", "id");
    $consulta = "INSERT INTO formulario_p004 SET
    id           ='".$id."',
    idevento     ='".$idevento."',
    idformulario ='".$idformulario."',
    titulo ='".$titulo."',
    p01       ='".$p01."',
    p02       ='".$p02."',
    p03       ='".$p03."',
    p04       ='".$p04."',
    p05       ='".$p05."',
    p06       ='".$p06."'";

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{

    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p004 SET
                    titulo ='".$titulo."',
                    p01    ='".$p01."',
                    p02    ='".$p02."',
                    p03    ='".$p03."',
                    p04    ='".$p04."',
                    p05    ='".$p05."',
                    p06    ='".$p06."'
                  WHERE id = ".$idformtto;

    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}
if(!isset($_POST['idformtto'])){

$query= mysql_query("SELECT MAX(id) FROM formulario_p004");
$row = mysql_fetch_row($query);
$idm = $idm = trim($row[0]);;

$Hoy = date("Y-m-d H:i:s");
$srr = mysql_query("INSERT INTO p004_formulario VALUES ('$idm','$ideventos','$responsable','$fechamantenimiento','$Hoy')");
 }else

  $sql =mysql_query("UPDATE p004_formulario SET responsable = '$responsable', fechamantenimiento = '$fechamantenimiento' WHERE id = '$idformtto'");
  
  
}    else echo "<b>Ocurrio un error, revise bien la información insertada!:: responsable y fecha de mantenimiento:campos oblogatorios::::</b>".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
?>


