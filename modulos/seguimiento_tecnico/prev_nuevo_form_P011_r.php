<?php
require("../../funciones/funciones.php");
require("../../funciones/motor.php");

$responsable     = $_POST['responsable'];
$fechamantenimiento = $_POST['fechamantenimiento'];
$ideventos     = $_POST['idevento'];

$idevento     = $_POST["idevento"];
$idformulario = $_POST["idformulario"];
$titulo       = $_POST["titulo"];
$params       = $_POST["params"];


$size1    = $_POST["size1"];
$p01 = "";
for($i=1; $i < $size1; $i++ ){
    $p01 .= $_POST["p01$i"];
    if($i==12||$i==24||$i==36)
        $p01 .= '|';
    else{
        if($i<$size1-1)
            $p01 .= ';';
    }
}

$size2    = $_POST["size2"];
$p02 = "";
for($i=1; $i < $size2; $i++ ){
    $p02 .= $_POST["p02$i"];
    if($i==6)
        $p02 .= '|';
    else{
        if($i<$size2-1)
            $p02 .= ';';
    }
}

$size3    = $_POST["size3"];
$p03 = "";
for($i=1; $i < $size3; $i++ ){
    $p03 .= $_POST["p03$i"];
    if($i==9||$i==18||$i==27||$i==36)
        $p03 .= '|';
    else{
        if($i<$size3-1)
            $p03 .= ';';
    }
}

$size4    = $_POST["size4"];
$p04 = "";
for($i=1; $i < $size3; $i++ ){
    $p04 .= $_POST["p04$i"];
    if($i==3||$i==6)
        $p04 .= '|';
    else{
        if($i<$size4-1)
            $p04 .= ';';
    }
}

$size5    = $_POST["size5"];
$p05 = "";
for($i=1; $i < $size5; $i++ ){
    $p05 .= $_POST["p05$i"];
    if($i==5)
        $p05 .= '|';
    else{
        if($i<$size5-1)
            $p05 .= ';';
    }
}

$size6    = $_POST["size6"];
$p06 = "";
for($i=1; $i < $size6; $i++ ){
    $p06 .= $_POST["p06$i"];
    if($i==7||$i==14||$i==21||$i==28)
        $p06 .= '|';
    else{
        if($i<$size6-1)
            $p06 .= ';';
    }
}

$size7    = $_POST["size7"];
$p07 = "";
for($i=1; $i < $size6; $i++ ){
    $p07 .= $_POST["p07$i"];
    if($i==5)
        $p07 .= '|';
    else{
        if($i<$size7-1)
            $p07 .= ';';
    }
}

$size8    = $_POST["size8"];
$p08 = "";
for($i=1; $i < $size8; $i++ ){
    $p08 .= $_POST["p08$i"];
    if($i==7||$i==14||$i==21||$i==28||$i==35||$i==42||$i==49)
        $p08 .= '|';
    else{
        if($i<$size8-1)
            $p08 .= ';';
    }
}


$size9    = $_POST["size9"];
$p09 = "";
for($i=1; $i < $size6; $i++ ){
    $p09 .= $_POST["p09$i"];
    if($i==5||$i==10||$i==15||$i==20)
        $p09 .= '|';
    else{
        if($i<$size9-1)
            $p09 .= ';';
    }
}


/** Nuevo Formulario Mtto. **/
if(isset($_POST['responsable']) and !empty($_POST['responsable']) and isset($_POST['fechamantenimiento']) and !empty($_POST['fechamantenimiento']) ){
if(!isset($_POST['idformtto'])){


    $id = incrementar_id("formulario_p011", "id");
    $consulta = "INSERT INTO formulario_p011 SET
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
    p09       ='".$p09."'";

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{

    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p011 SET
                    titulo ='".$titulo."',
                    p01       ='".$p01."',
                    p02       ='".$p02."',
                    p03       ='".$p03."',
                    p04       ='".$p04."',
                    p05       ='".$p05."',
                    p06       ='".$p06."',
                    p07       ='".$p07."',
                    p08       ='".$p08."',
                    p09       ='".$p09."'
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informaci�n insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}
if(!isset($_POST['idformtto'])){

$query= mysql_query("SELECT MAX(id) FROM formulario_p011");
$row = mysql_fetch_row($query);
$idm = $idm = trim($row[0]);;

$Hoy = date("Y-m-d H:i:s");
$srr = mysql_query("INSERT INTO p011_formulario VALUES ('$idm','$ideventos','$responsable','$fechamantenimiento','$Hoy')");
 }else

  $sql =mysql_query("UPDATE p011_formulario SET responsable = '$responsable', fechamantenimiento = '$fechamantenimiento' WHERE id = '$idformtto'");
  
  
}    else echo "<b>Ocurrio un error, revise bien la informaci�n insertada!:: responsable y fecha de mantenimiento:campos oblogatorios::::</b>".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
?>