<?php
require("../../funciones/funciones.php");


$responsable     = $_POST['responsable'];
$fechamantenimiento = $_POST['fechamantenimiento'];
$titulos       = $_POST['titulo'];
$ideventos     = $_POST['idevento'];
$tates= $_POST['tate'];

$tate= $_POST["tate"];
$idevento     = $_POST["idevento"];
$idformulario = $_POST["idformulario"];
$titulo       = $_POST["titulo"];
$params       = $_POST["params"];
$p01    = $_POST["p01"];
$p02    = $_POST["p02"];
$p03    = $_POST["p03"];
$p04    = $_POST["p04"];
$p05    = $_POST["p05"];

$size6    = $_POST["size6"];
$p06 = "";
for($i=1; $i < $size6; $i++ ){
    $p06 .= $_POST["p06$i"];
    if($i==6 || $i==12 || $i==18 || $i==24)
        $p06 .= '|';
    else{
        if($i<$size6-1)
            $p06 .= ';';
    }
}

$size7    = $_POST["size7"];
$p07 = "";
for($i=1; $i < $size7; $i++ ){
    $p07 .= $_POST["p07$i"];
    if($i==4)
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
    if($i==4 || $i==8 || $i==12  || $i==16  || $i==20  || $i==24  || $i==28  || $i==32 || $i==36 )
        $p08 .= '|';
    else{
        if($i<$size8-1)
            $p08 .= ';';
    }
}


$size11    = $_POST["size11"];
$p11 = "";
for($i=1; $i < $size11; $i++ ){
    $p11 .= $_POST["p11$i"];
    if($i==4 || $i==8 || $i==12 )
        $p11 .= '|';
    else{
        if($i<$size11-1)
            $p11 .= ';';
    }
}



$size9    = $_POST["size9"];
$p09 = "";
for($i=1; $i < $size9; $i++ ){
    $p09 .= $_POST["p09$i"];
    if($i==5 || $i==10 || $i==15 )
        $p09 .= '|';
    else{
        if($i<$size9-1)
            $p09 .= ';';
    }
}

$size10    = $_POST["size10"];
$p10 = "";
for($i=1; $i < $size10; $i++ ){
    $p10 .= $_POST["p10$i"];
   if($i==5 || $i==10 || $i==15  || $i==20  || $i==25  || $i==30  || $i==35  || $i==40 || $i==45 )
        $p10 .= '|';
    else{
        if($i<$size10-1)
            $p10 .= ';';
    }
}
$tatu=$titulo." ".$tate;
$tete=$titulos. ' ' .$tates;
$observaciones    = $_POST["observaciones"];
/** Nuevo Formulario Mtto. **/
if(isset($_POST['responsable']) and !empty($_POST['responsable']) and isset($_POST['fechamantenimiento']) and !empty($_POST['fechamantenimiento']) ){
if(!isset($_POST['idformtto'])){

$quer= mysql_query("SELECT MAX(id) FROM formulario_p001v");
$rowf= mysql_fetch_row($quer);
 $id = trim($rowf[0])+1;
    $consulta = "INSERT INTO formulario_p001v SET
    id           ='".$id."',
    idevento     ='".$idevento."',
    idformulario ='".$idformulario."',
    titulo ='".$tatu."',
    p01       ='".$p01."',
    p02       ='".$p02."',
    p03       ='".$p03."',
    p04       ='".$p04."',
    p05       ='".$p05."',
    p06       ='".$p06."',
    p07       ='".$p07."',
    p08       ='".$p08."',
    p11       ='".$p11."',
    p09       ='".$p09."',
    p10       ='".$p10."',
    observaciones       ='".$observaciones."'";

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{
    //print("Post editar: " . $_POST['idformtto']);
    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p001v SET
                    titulo ='".$tatu."',
                    p01    ='".$p01."',
                    p02    ='".$p02."',
                    p03    ='".$p03."',
                    p04    ='".$p04."',
                    p05    ='".$p05."',
                    p06    ='".$p06."',
                    p07    ='".$p07."',
                    p08    ='".$p08."',
                    p11    ='".$p11."',
                    p09    ='".$p09."',
                    p10    ='".$p10."',
                    observaciones       ='".$observaciones."'                    
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

}if(!isset($_POST['idformtto'])){

$query= mysql_query("SELECT MAX(id) FROM formulario_p001v");
$row = mysql_fetch_row($query);
$idm = $idm = trim($row[0]);;

$Hoy = date("Y-m-d H:i:s");
$srr = mysql_query("INSERT INTO p001v_formulario VALUES ('$idm','$ideventos','$responsable','$fechamantenimiento','$Hoy')");

    $res = mysql_query("INSERT INTO formulario_mtto_n VALUES(21,'$idm','P001v','Formulario Mtto. Preventivo Sitio','$tete','$ideventos')");
 }else{

  $sql =mysql_query("UPDATE p001v_formulario SET responsable = '$responsable', fechamantenimiento = '$fechamantenimiento' WHERE id = '$idformtto'");
  
  
    $sql =mysql_query("UPDATE formulario_mtto_n SET titulo = '$tete' WHERE id = '$idformtto'");
    
}

}    else echo "<b>Ocurrio un error, revise bien la información insertada!:: responsable y fecha de mantenimiento:campos oblogatorios::::</b>".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
?>

