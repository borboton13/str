<?php
require("../../funciones/motor.php");
require("../../funciones/funciones.php");
//require_once ('../../paquetes/jpgraph/jpgraph.php');
//require_once ('../../paquetes/jpgraph/jpgraph_canvas.php');
//require_once ('../../paquetes/jpgraph/jpgraph_barcode.php');
//$encoder = BarcodeFactory::Create(ENCODING_CODE39);
$encoder = '0';

function convertfecha_($fecha,$separador){
    $var = explode($separador,$fecha);
    $fecha=$var[2]."-".$var[1]."-".$var[0];
    return $fecha;
}

$nro                = $_POST['nro'];
$producto           = $_POST['producto'];
$idareatrabajo      = $_POST['idareatrabajo'];
$marca              = $_POST['marca'];
$caracteristicas    = $_POST['caracteristicas'];
$departamento       = $_POST['departamento'];
$sn         = $_POST['sn']; // vacio
$ubicacion  = $_POST['ubicacion']; // vacio
$tecnico = $_POST["tecnico"];


// printf("----->" . $id_st_proyecto);

$fecha_not = convertfecha_($_POST['fecha_n'],"/")." ".$_POST["hora_n"].":00";
$fecha = convertfecha($_POST['fecha'],"/");
$hora_p = $_POST["hora_p"];
$tecnico = $_POST["tecnico"];
//$id_st_proyecto = $_POST["id_st_proyecto"];

$id_st_proyecto = $nro;

$idestacion  = "NULL";
$idtipofalla = "NULL";
if (isset($_POST['idestacion']))  $idestacion  = $_POST['idestacion'];
if (isset($_POST['idtipofalla'])) $idtipofalla = $_POST['idtipofalla'];

$resultado=mysqli_query($conexion, "SELECT idestacion, nombre FROM estacion WHERE idestacion = $idestacion");
$dato=mysqli_fetch_array($resultado);
$nombreEstacion = $dato['nombre'];
$ubicacion = $nombreEstacion;

$consulta="INSERT INTO st_trabajos(id_st_proyecto,departamento,producto,marca,caracteristicas,sn,ubicacion, idtipofalla, idestacion, idareatrabajo) 
           VALUES('$nro','$departamento','$producto','$marca','$caracteristicas','$sn','$ubicacion','$idtipofalla', '$idestacion', '$idareatrabajo'); ";
$resultado=mysqli_query($conexion, $consulta);
$id_item = mysqli_insert_id($conexion);

$pro_key = "f001";
if ($producto == "Trabajo Extra")
    $pro_key = "f002";

$detalles = $caracteristicas;

$dato_st=mysqli_fetch_array(mysqli_query($conexion, "SELECT id_cliente FROM st_proyecto WHERE id_st_proyecto='".$id_st_proyecto."'"));
$id_cliente = $dato_st["id_cliente"];

mysqli_query($conexion, "INSERT INTO st_cronograma_informes_".$pro_key." (id_st_proyecto,id_cliente,id_usuario,detalles,id_item,fecha,hora_programada,periodo,p1)
    VALUES('$id_st_proyecto','$id_cliente','$tecnico','$detalles',$id_item,'$fecha','$hora_p', 1,'$fecha_not')");
$id_st = mysqli_insert_id($conexion);
mkdir ("../../archivos_st/".$id_st_proyecto."/".$pro_key."_".$id_st, 0777);

/*
$e = BackendFactory::Create(BACKEND_IMAGE,$encoder);
$e ->HideText(true);
$e -> SetHeight(56);
$e->Stroke("ST".strtoupper($pro_key).str_pad($id_st, 4, "0", STR_PAD_LEFT),"../../archivos_st/".$id_st_proyecto."/".$pro_key."_".$id_st."/barcode.png");
*/

if($resultado)
    header("Location: ".$link_modulo."?path=trabajos_ver_correlativo.php&nro=".$nro);
else
    echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notifique de este error al administrador del Sistema: ".mysqli_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

?>

