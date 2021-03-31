<?php
require("../../funciones/motor.php");
require("../../funciones/funciones.php");


$responsable     = $_POST['responsable'];
$ideventos     = $_POST['idevento'];
$fechamantenimiento = $_POST['fechamantenimiento'];
$titulos       = $_POST['titulo'];
$tates= $_POST['tate'];

$tate= $_POST["tate"];
$idevento     = $_POST["idevento"];
$idformulario = $_POST["idformulario"];
$titulo       = $_POST["titulo"];
$params       = $_POST["params"];


$p13 = "";
$size13    = $_POST["size13"];
for($i=1; $i < $size13; $i++ ){
    $p13 .= $_POST["p13$i"];
    if($i==3 || $i==6 || $i==9 || $i==12)
        $p13 .= '|';
    else{
        if($i<$size13-1)
            $p13 .= ';';
    }
}

$p14 = "";
$size14    = $_POST["size14"];
for($i=1; $i < $size14; $i++ ){
    $p14 .= $_POST["p14$i"];
    if($i==4||$i==8)
        $p14 .= '|';
    else{
        if($i<$size14-1)
            $p14 .= ';';
    }
}

$p15 = "";
$size15    = $_POST["size15"];
for($i=1; $i < $size15; $i++ ){
    $p15 .= $_POST["p15$i"];
    if($i==3||$i==6)
        $p15 .= '|';
    else{
        if($i<$size15-1)
            $p15 .= ';';
    }
}

$p16 = "";
$size16    = $_POST["size16"];
for($i=1; $i < $size16; $i++ ){
    $p16 .= $_POST["p16$i"];
    if($i==7||$i==14||$i==21 ||$i==28)
        $p16 .= '|';
    else{
        if($i<$size16-1)
            $p16 .= ';';
    }
}


$p18 = "";
$size18    = $_POST["size18"];
for($i=1; $i < $size18; $i++ ){
    $p18 .= $_POST["p18$i"];
    if($i==3||$i==6||$i==9||$i==12||$i==15||$i==18)
        $p18 .= '|';
    else{
        if($i<$size18-1)
            $p18 .= ';';
    }
}

$p19 = "";
$size19    = $_POST["size19"];
for($i=1; $i < $size19; $i++ ){
    $p19 .= $_POST["p19$i"];
    if($i==4||$i==8||$i==12||$i==16||$i==20||$i==24)
        $p19 .= '|';
    else{
        if($i<$size19-1)
            $p19 .= ';';
    }
}

$p21 = "";
$size21    = $_POST["size21"];
for($i=1; $i < $size21; $i++ ){
    $p21 .= $_POST["p21$i"];
    if($i==2 || $i==4 || $i==6 || $i==8 || $i==10 || $i==12 || $i==14 || $i==16 || $i==18 || $i==20 || $i==22)
        $p21 .= '|';
    else{
        if($i<$size21-1)
            $p21 .= ';';
    }
}

$p22 = "";
$size22    = $_POST["size22"];
for($i=1; $i < $size22; $i++ ){
    $p22 .= $_POST["p22$i"];
    if($i==2 || $i==4 || $i==6 || $i==8 || $i==10 || $i==12 || $i==14 || $i==16 || $i==18 || $i==20 || $i==22)
        $p22 .= '|';
    else{
        if($i<$size22-1)
            $p22 .= ';';
    }
}


$p23 = "";
$size23    = $_POST["size23"];
for($i=1; $i < $size23; $i++ ){
    $p23 .= $_POST["p23$i"];
    if($i==3 || $i==6 || $i==9 || $i==12 || $i==15 || $i==18 || $i==21 || $i==24 )
        $p23 .= '|';
    else{
        if($i<$size23-1)
            $p23 .= ';';
    }
}

$p24 = "";
$size24    = $_POST["size24"];
for($i=1; $i < $size24; $i++ ){
    $p24 .= $_POST["p24$i"];
    if($i==3 || $i==6 || $i==9 || $i==12 || $i==15 || $i==18 || $i==21 || $i==24 || $i==27 || $i==30 || $i==33 || $i==36 || $i==39 || $i==42 )
        $p24 .= '|';
    else{
        if($i<$size24-1)
            $p24 .= ';';
    }
}

$p25 = "";
$size25    = $_POST["size25"];
for($i=1; $i < $size25; $i++ ){
    $p25 .= $_POST["p25$i"];
    if($i==1 || $i==2 || $i==3 || $i==4 || $i==5 || $i==6  )
        $p25 .= '|';
    else{
        if($i<$size25-1)
            $p25 .= ';';
    }
}

$p26 = "";
$size26    = $_POST["size26"];
for($i=1; $i < $size26; $i++ ){
    $p26 .= $_POST["p26$i"];
    if($i==6 || $i==12 || $i==18 || $i==24 || $i==30 || $i==36 || $i==42 || $i==48 )
        $p26 .= '|';
    else{
        if($i<$size26-1)
            $p26 .= ';';
    }
}

$observaciones    = $_POST["observaciones"];
$tatu=$titulo." ".$tate;
$tete=$titulos. ' ' .$tates;
/** Nuevo Formulario Mtto. **/
if(isset($_POST['responsable']) and !empty($_POST['responsable']) and isset($_POST['fechamantenimiento']) and !empty($_POST['fechamantenimiento']) ){
if(!isset($_POST['idformtto'])){
    
$quer= mysql_query("SELECT MAX(id) FROM formulario_p013v");
$rowf= mysql_fetch_row($quer);
 $id = trim($rowf[0])+1;
    $consulta = "INSERT INTO formulario_p013v SET
    id           ='".$id."',
    idevento     ='".$idevento."',
    idformulario ='".$idformulario."',
    titulo ='".$tatu."',
    p13       ='".$p13."',
    p14       ='".$p14."',
    p15       ='".$p15."',
    p16       ='".$p16."',
    p18       ='".$p18."',
    p19       ='".$p19."',
    p21       ='".$p21."',
    p22       ='".$p22."',
    p23       ='".$p23."',
    p24       ='".$p24."',
    p25       ='".$p25."',
    p26       ='".$p26."',
    observaciones       ='".$observaciones."'";


    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

/** Editar Formulario Mtto. **/
}else{

    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p013v SET
                    titulo ='".$tatu."',
                    p13       ='".$p13."',
                    p14       ='".$p14."',
                    p15       ='".$p15."',
                    p16       ='".$p16."',
                    p18       ='".$p18."',
                    p19       ='".$p19."',
                    p21       ='".$p21."',
                    p22       ='".$p22."',
                    p23       ='".$p23."',
                    p24       ='".$p24."',
                    p25       ='".$p25."',
                    p26       ='".$p26."',
                    observaciones       ='".$observaciones."'
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}
if(!isset($_POST['idformtto'])){

$query= mysql_query("SELECT MAX(id) FROM formulario_p013v");
$row = mysql_fetch_row($query);
$idm = $idm = trim($row[0]);;

$Hoy = date("Y-m-d H:i:s");
$srr = mysql_query("INSERT INTO p013v_formulario VALUES ('$idm','$ideventos','$responsable','$fechamantenimiento','$Hoy')");


    $res = mysql_query("INSERT INTO formulario_mtto_n VALUES(22,'$idm','P013v','Formulario Mtto. Preventivo Estructura','$tete','$ideventos')");
 }else

  $sql =mysql_query("UPDATE p013v_formulario SET responsable = '$responsable', fechamantenimiento = '$fechamantenimiento' WHERE id = '$idformtto'");
  
  
    $sql =mysql_query("UPDATE formulario_mtto_n SET titulo = '$tete' WHERE id = '$idformtto'");

    
}    else echo "<b>Ocurrio un error, revise bien la información insertada!:: responsable y fecha de mantenimiento:campos oblogatorios::::</b>".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
?>


