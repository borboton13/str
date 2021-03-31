<?php
require("../../funciones/funciones.php");

$idevento     = $_POST["idevento"];
$idformulario = $_POST["idformulario"];
$titulo       = $_POST["titulo"];
$params       = $_POST["params"];
$nomEs       = $_POST["nomEs"];
//echo ($params);
$ESTACION=ltrim(rtrim($nomEs));
$IDEVENTO=ltrim(rtrim($_POST["IDEVENTO"]));
$TEGSM=ltrim(rtrim($_POST["TEGSM"]));
$TEUMTS=ltrim(rtrim($_POST["TEUMTS"]));
$TELTE=ltrim(rtrim($_POST["TELTE"]));
$EOGSM=ltrim(rtrim($_POST["EOGSM"]));
$EOUMTS=ltrim(rtrim($_POST["EOUMTS"]));

$EOLTE=ltrim(rtrim($_POST["EOLTE"]));
$TPGSM=ltrim(rtrim($_POST["TPGSM"]));
$TPUMTS=ltrim(rtrim($_POST["TPUMTS"]));
$TPLTE=ltrim(rtrim($_POST["TPLTE"]));
$PGSM=ltrim(rtrim($_POST["PGSM"]));
$PUMTS=ltrim(rtrim($_POST["PUMTS"]));
$PLTE=ltrim(rtrim($_POST["PLTE"]));
$SPGSM=ltrim(rtrim($_POST["SPGSM"]));
$SPUMTS=ltrim(rtrim($_POST["SPUMTS"]));
$SPLTE=ltrim(rtrim($_POST["SPLTE"]));
$MGGSM=ltrim(rtrim($_POST["MGGSM"]));
$MGUMTS=ltrim(rtrim($_POST["MGUMTS"]));
$MGLTE=ltrim(rtrim($_POST["MGLTE"]));
$RB11=ltrim(rtrim($_POST["RB11"]));
$RB12=ltrim(rtrim($_POST["RB12"])); 
$RB13=ltrim(rtrim($_POST["RB13"]));
$RB14=ltrim(rtrim($_POST["RB14"]));
$RB15=ltrim(rtrim($_POST["RB15"]));
$RB16=ltrim(rtrim($_POST["RB16"]));
$RB17=ltrim(rtrim($_POST["RB17"]));
$RB18=ltrim(rtrim($_POST["RB18"]));
$RB19=ltrim(rtrim($_POST["RB19"]));
$RB110=ltrim(rtrim($_POST["RB110"]));
$RB111=ltrim(rtrim($_POST["RB111"]));
$RB112=ltrim(rtrim($_POST["RB112"]));
$RB113=ltrim(rtrim($_POST["RB113"]));
$RB114=ltrim(rtrim($_POST["RB114"]));
$RB115=ltrim(rtrim($_POST["RB115"]));
$RB116=ltrim(rtrim($_POST["RB116"]));
$RB117=ltrim(rtrim($_POST["RB117"]));
$RB21=ltrim(rtrim($_POST["RB21"]));
$RB22=ltrim(rtrim($_POST["RB22"]));
$RB23=ltrim(rtrim($_POST["RB23"]));
$RB24=ltrim(rtrim($_POST["RB24"]));
$RB25=ltrim(rtrim($_POST["RB25"]));
$RB26=ltrim(rtrim($_POST["RB26"]));
$RB27=ltrim(rtrim($_POST["RB27"]));
$RB28=ltrim(rtrim($_POST["RB28"]));
$RB29=ltrim(rtrim($_POST["RB29"]));
$RB210=ltrim(rtrim($_POST["RB210"]));
$RB211=ltrim(rtrim($_POST["RB211"]));
$RB212=ltrim(rtrim($_POST["RB212"]));
$RB213=ltrim(rtrim($_POST["RB213"]));
$RB214=ltrim(rtrim($_POST["RB214"]));
$RB215=ltrim(rtrim($_POST["RB215"]));
$RB216=ltrim(rtrim($_POST["RB216"]));
$RB217=ltrim(rtrim($_POST["RB217"]));
$RB31=ltrim(rtrim($_POST["RB31"]));
$RB32=ltrim(rtrim($_POST["RB32"]));
$RB33=ltrim(rtrim($_POST["RB33"]));
$RB34=ltrim(rtrim($_POST["RB34"]));
$RB35=ltrim(rtrim($_POST["RB35"]));
$RB36=ltrim(rtrim($_POST["RB36"]));
$RB37=ltrim(rtrim($_POST["RB37"]));
$RB38=ltrim(rtrim($_POST["RB38"]));
$RB39=ltrim(rtrim($_POST["RB39"]));
$RB310=ltrim(rtrim($_POST["RB310"]));
$RB311=ltrim(rtrim($_POST["RB311"]));
$RB312=ltrim(rtrim($_POST["RB312"]));
$RB313=ltrim(rtrim($_POST["RB313"]));
$RB314=ltrim(rtrim($_POST["RB314"]));
$RB315=ltrim(rtrim($_POST["RB315"]));
$RB316=ltrim(rtrim($_POST["RB316"]));
$RB317=ltrim(rtrim($_POST["RB317"]));
$RB41=ltrim(rtrim($_POST["RB41"]));
$RB42=ltrim(rtrim($_POST["RB42"]));
$RB43=ltrim(rtrim($_POST["RB43"]));
$RB45=ltrim(rtrim($_POST["RB45"]));
$RB46=ltrim(rtrim($_POST["RB46"]));
$RB47=ltrim(rtrim($_POST["RB47"]));
$RB48=ltrim(rtrim($_POST["RB48"]));
$RB49=ltrim(rtrim($_POST["RB49"]));
$RB410=ltrim(rtrim($_POST["RB410"]));
$RB411=ltrim(rtrim($_POST["RB411"]));
$RB412=ltrim(rtrim($_POST["RB412"]));
$RB413=ltrim(rtrim($_POST["RB413"]));
$RB414=ltrim(rtrim($_POST["RB414"]));
$RB415=ltrim(rtrim($_POST["RB415"]));
$RB416=ltrim(rtrim($_POST["RB416"]));
$RB417=ltrim(rtrim($_POST["RB417"]));
$RB51=ltrim(rtrim($_POST["RB51"]));
$RB52=ltrim(rtrim($_POST["RB52"]));
$RB53=ltrim(rtrim($_POST["RB53"]));
$RB54=ltrim(rtrim($_POST["RB54"]));
$RB55=ltrim(rtrim($_POST["RB55"]));
$RB56=ltrim(rtrim($_POST["RB56"]));
$RB57=ltrim(rtrim($_POST["RB57"]));
$RB58=ltrim(rtrim($_POST["RB58"]));
$RB59=ltrim(rtrim($_POST["RB59"]));
$RB510=ltrim(rtrim($_POST["RB510"]));
$RB511=ltrim(rtrim($_POST["RB511"]));
$RB512=ltrim(rtrim($_POST["RB512"]));
$RB513=ltrim(rtrim($_POST["RB513"]));
$RB514=ltrim(rtrim($_POST["RB514"]));
$RB515=ltrim(rtrim($_POST["RB515"]));
$RB516=ltrim(rtrim($_POST["RB516"]));
$RB517=ltrim(rtrim($_POST["RB517"]));
$RB61=ltrim(rtrim($_POST["RB61"]));
$RB62=ltrim(rtrim($_POST["RB62"]));
$RB63=ltrim(rtrim($_POST["RB63"]));
$RB64=ltrim(rtrim($_POST["RB64"]));
$RB65=ltrim(rtrim($_POST["RB65"]));
$RB66=ltrim(rtrim($_POST["RB66"]));
$RB67=ltrim(rtrim($_POST["RB67"]));
$RB68=ltrim(rtrim($_POST["RB68"]));
$RB69=ltrim(rtrim($_POST["RB69"]));
$RB610=ltrim(rtrim($_POST["RB610"]));
$RB611=ltrim(rtrim($_POST["RB611"]));
$RB612=ltrim(rtrim($_POST["RB612"]));
$RB613=ltrim(rtrim($_POST["RB613"]));
$RB614=ltrim(rtrim($_POST["RB614"]));
$RB615=ltrim(rtrim($_POST["RB615"]));
$RB616=ltrim(rtrim($_POST["RB616"]));
$RB617=ltrim(rtrim($_POST["RB617"]));
$RB71=ltrim(rtrim($_POST["RB71"]));
$RB72=ltrim(rtrim($_POST["RB72"]));
$RB73=ltrim(rtrim($_POST["RB73"]));
$RB74=ltrim(rtrim($_POST["RB74"]));
$RB75=ltrim(rtrim($_POST["RB75"]));
$RB76=ltrim(rtrim($_POST["RB76"]));
$RB77=ltrim(rtrim($_POST["RB77"]));
$RB78=ltrim(rtrim($_POST["RB78"]));
$RB79=ltrim(rtrim($_POST["RB79"]));
$RB710=ltrim(rtrim($_POST["RB710"]));
$RB711=ltrim(rtrim($_POST["RB711"]));
$RB712=ltrim(rtrim($_POST["RB712"]));
$RB713=ltrim(rtrim($_POST["RB713"]));
$RB714=ltrim(rtrim($_POST["RB714"]));
$RB715=ltrim(rtrim($_POST["RB715"]));
$RB716=ltrim(rtrim($_POST["RB716"]));
$RB717=ltrim(rtrim($_POST["RB717"]));
$RB81=ltrim(rtrim($_POST["RB81"]));
$RB82=ltrim(rtrim($_POST["RB82"]));
$RB83=ltrim(rtrim($_POST["RB83"]));
$RB84=ltrim(rtrim($_POST["RB84"]));
$RB85=ltrim(rtrim($_POST["RB85"]));
$RB86=ltrim(rtrim($_POST["RB86"]));
$RB87=ltrim(rtrim($_POST["RB87"]));
$RB88=ltrim(rtrim($_POST["RB88"]));
$RB89=ltrim(rtrim($_POST["RB89"]));
$RB810=ltrim(rtrim($_POST["RB810"]));
$RB811=ltrim(rtrim($_POST["RB811"]));
$RB812=ltrim(rtrim($_POST["RB812"]));
$RB813=ltrim(rtrim($_POST["RB813"]));
$RB814=ltrim(rtrim($_POST["RB814"]));
$RB815=ltrim(rtrim($_POST["RB815"]));
$RB816=ltrim(rtrim($_POST["RB816"]));
$RB817=ltrim(rtrim($_POST["RB817"]));
$RB91=ltrim(rtrim($_POST["RB91"]));
$RB92=ltrim(rtrim($_POST["RB92"]));
$RB93=ltrim(rtrim($_POST["RB93"]));
$RB94=ltrim(rtrim($_POST["RB94"]));
$RB95=ltrim(rtrim($_POST["RB95"]));
$RB96=ltrim(rtrim($_POST["RB96"]));
$RB97=ltrim(rtrim($_POST["RB97"]));
$RB98=ltrim(rtrim($_POST["RB98"]));
$RB99=ltrim(rtrim($_POST["RB99"]));
$RB910=ltrim(rtrim($_POST["RB910"]));
$RB911=ltrim(rtrim($_POST["RB911"]));
$RB912=ltrim(rtrim($_POST["RB912"]));
$RB913=ltrim(rtrim($_POST["RB913"]));
$RB914=ltrim(rtrim($_POST["RB914"]));
$RB915=ltrim(rtrim($_POST["RB915"]));
$RB916=ltrim(rtrim($_POST["RB916"]));
$RB917=ltrim(rtrim($_POST["RB917"]));
$LMA=ltrim(rtrim($_POST["LMA"]));
$LMB=ltrim(rtrim($_POST["LMB"]));
$LMH=ltrim(rtrim($_POST["LMH"]));
$LMGSM=ltrim(rtrim($_POST["LMGSM"]));
$LMUMTS=ltrim(rtrim($_POST["LMUMTS"]));
$SMSA=ltrim(rtrim($_POST["SMSA"]));
$SMSB=ltrim(rtrim($_POST["SMSB"]));
$SMSH=ltrim(rtrim($_POST["SMSH"]));
$SMSGSM=ltrim(rtrim($_POST["SMSGSM"]));
$SMSUMTS=ltrim(rtrim($_POST["SMSUMTS"]));
$VLA=ltrim(rtrim($_POST["VLA"]));
$VLB=ltrim(rtrim($_POST["VLB"]));
$VLH=ltrim(rtrim($_POST["VLH"]));
$VLGSM=ltrim(rtrim($_POST["VLGSM"]));
$VLUMTS=ltrim(rtrim($_POST["VLUMTS"]));
$LFA=ltrim(rtrim($_POST["LFA"]));
$LFB=ltrim(rtrim($_POST["LFB"]));
$LFH=ltrim(rtrim($_POST["LFH"]));
$LFGSM=ltrim(rtrim($_POST["LFGSM"]));
$LFUMTS=ltrim(rtrim($_POST["LFUMTS"]));
$NIH=ltrim(rtrim($_POST["NIH"]));
$NIGSM=ltrim(rtrim($_POST["NIGSM"]));
$NIUMTSB=ltrim(rtrim($_POST["NIUMTSB"]));
$NIUMTSS=ltrim(rtrim($_POST["NIUMTSS"]));
$NILTEB=ltrim(rtrim($_POST["NILTEB"]));
$NILTES=ltrim(rtrim($_POST["NILTES"]));
$RFVS=ltrim(rtrim($_POST["RFVS"]));
$RFBA=ltrim(rtrim($_POST["RFBA"]));
$RFCA=ltrim(rtrim($_POST["RFCA"]));
$RFGG=ltrim(rtrim($_POST["RFGG"]));
$RFDP=ltrim(rtrim($_POST["RFDP"]));
$RFBT=ltrim(rtrim($_POST["RFBT"]));
$RFVE=ltrim(rtrim($_POST["RFVE"]));
$RFT=ltrim(rtrim($_POST["RFT"]));
$RFVF=ltrim(rtrim($_POST["RFVF"]));
$RFET=ltrim(rtrim($_POST["RFET"]));
$RFGA=ltrim(rtrim($_POST["RFGA"]));
$RFDPTX=ltrim(rtrim($_POST["RFDPTX"]));
$RFAE=ltrim(rtrim($_POST["RFAE"]));
$RFAA=ltrim(rtrim($_POST["RFAA"]));
$RFVDP=ltrim(rtrim($_POST["RFVDP"]));
$RFCAS=ltrim(rtrim($_POST["RFCAS"]));
$RFTM=ltrim(rtrim($_POST["RFTM"]));
$RFBB=ltrim(rtrim($_POST["RFBB"]));
$RFVP=ltrim(rtrim($_POST["RFVP"]));
$RFDCB=ltrim(rtrim($_POST["RFDCB"]));
$RFTDP=ltrim(rtrim($_POST["RFTDP"]));
$RFPN=ltrim(rtrim($_POST["RFPN"]));
$RFM=ltrim(rtrim($_POST["RFM"]));
$RFOl=ltrim(trim($_POST["RFO"]));
$MPVIG=ltrim(rtrim($_POST["MPVIG"]));
$MPVIB=ltrim(rtrim($_POST["MPVIB"]));
//echo($MPVIB));
$MPLG=ltrim(rtrim($_POST["MPLG"]));
$MPVCAG=ltrim(rtrim($_POST["MPVCAG"]));
$MPVCEAND=ltrim(rtrim($_POST["MPVCEAND"]));
$MPVIRRU=ltrim(rtrim($_POST["MPVIRRU"]));
$MPCVENDR=ltrim(rtrim($_POST["MPCVENDR"]));
$MPVCANDR=ltrim(rtrim($_POST["MPVCANDR"]));
$MPVV=ltrim(rtrim($_POST["MPVV"]));
$MPVEANR=ltrim(rtrim($_POST["MPVEANR"]));
$MPVIA=ltrim(rtrim($_POST["MPVIA"]));
$MPVJC=ltrim(rtrim($_POST["MPVJC"]));
$MPOVIG=ltrim(rtrim($_POST["MPOVIG"]));
$MPOVIB=ltrim(rtrim($_POST["MPOVIB"]));
$MPOLG=ltrim(rtrim($_POST["MPOLG"]));
$MPOVCAG=ltrim(rtrim($_POST["MPOVCAG"]));
$MPOVCEAND=ltrim(rtrim($_POST["MPOVCEAND"]));
$MPOVIRRU=ltrim(rtrim($_POST["MPOVIRRU"]));
$MPOCVENDR=ltrim(rtrim($_POST["MPOCVENDR"]));
$MPOVCANDR=ltrim(rtrim($_POST["MPOVCANDR"]));
$MPOVV=ltrim(rtrim($_POST["MPOVV"]));
$MPOVEANR=ltrim(rtrim($_POST["MPOVEANR"]));
$MPOVIA=ltrim(rtrim($_POST["MPOVIA"]));
$MPOVJC=ltrim(rtrim($_POST["MPOVJC"]));
$VA1=ltrim(rtrim($_POST["VA1"]));
$UA1=ltrim(rtrim($_POST["UA1"]));
$S1=ltrim(rtrim($_POST["S1"]));
$OVA1=ltrim(rtrim($_POST["OVA1"]));
$VA2=ltrim(rtrim($_POST["VA2"]));
$UA2=ltrim(rtrim($_POST["UA2"]));
$S2=ltrim(rtrim($_POST["S2"]));
$OVA2=ltrim(rtrim($_POST["OVA2"]));
$VA3=ltrim(rtrim($_POST["VA3"]));
$UA3=ltrim(rtrim($_POST["UA3"]));
$S3=ltrim(rtrim($_POST["S3"]));
$OVA3=ltrim(rtrim($_POST["OVA3"]));
$VR1=ltrim(rtrim($_POST["VR1"]));
$E1=ltrim(rtrim($_POST["E1"]));
$OVR1=ltrim(rtrim($_POST["OVR1"]));
$VR2=ltrim(rtrim($_POST["VR2"]));
$E2=ltrim(rtrim($_POST["E2"]));
$OVR2=ltrim(rtrim($_POST["OVR2"]));
$VR3=ltrim(rtrim($_POST["VR3"]));
$E3=ltrim(rtrim($_POST["E3"]));
$OVR3=ltrim(rtrim($_POST["OVR3"]));
$OBS=ltrim(rtrim($_POST["OBS"]));

//echo($TEGSM);

/*Incluimos el fichero de la clase*/
include("../../funciones/Db.class.php");


/*Creamos la instancia del objeto. Ya estamos conectados*/
$bd=Db::getInstance();

/*Creamos una query sencilla*/
$sql="SELECT 'COCHABAMBA' AS nombre ,COUNT(*) AS total FROM st_ticket
    WHERE  (fecha_inicio_rif BETWEEN '" . $fini ."'  AND '". $ffin ."')";

            //echo $sql;

/*Ejecutamos la query*/
//$stmt=$bd->ejecutar($sql);
//$numero_filas = mysql_num_rows($stmt);
//echo ($numero_filas);

if(!isset($_POST['idformtto'])){

    $stmt = $bd->ejecutar("CALL SP_INSFORM13(
    	'$idevento','$ESTACION','$TEGSM','$TEUMTS','$TELTE','$EOGSM','$EOUMTS','$EOLTE','$TPGSM','$TPUMTS','$TPLTE','$PGSM','$PUMTS','$PLTE','$SPGSM','$SPUMTS','$SPLTE','$MGGSM','$MGUMTS','$MGLTE','$RB11','$RB12','$RB13','$RB14','$RB15','$RB16','$RB17','$RB18','$RB19','$RB110','$RB111','$RB112','$RB113','$RB114','$RB115','$RB116','$RB117','$RB21','$RB22','$RB23','$RB24','$RB25','$RB26','$RB27','$RB28','$RB29','$RB210','$RB211','$RB212','$RB213','$RB214','$RB215','$RB216','$RB217','$RB31','$RB32','$RB33','$RB34','$RB35','$RB36','$RB37','$RB38','$RB39','$RB310','$RB311','$RB312','$RB313','$RB314','$RB315','$RB316','$RB317','$RB41','$RB42','$RB43','$RB45','$RB46','$RB47','$RB48','$RB49','$RB410','$RB411','$RB412','$RB413','$RB414','$RB415','$RB416','$RB417','$RB51','$RB52','$RB53','$RB54','$RB55','$RB56','$RB57','$RB58','$RB59','$RB5510','$RB511','$RB512','$RB513','$RB514','$RB515','$RB516','$RB517','$RB61','$RB62','$RB63','$RB64','$RB65','$RB66','$RB67','$RB68','$RB69','$RB610','$RB611','$RB612','$RB613','$RB614','$RB615','$RB616','$RB617','$RB71','$RB72','$RB73','$RB74','$RB75','$RB76','$RB77','$RB78','$RB79','$RB710','$RB711','$RB712','$RB713','$RB714','$RB715','$RB716','$RB717','$RB81','$RB82','$RB83','$RB84','$RB85','$RB86','$RB87','$RB88','$RB89','$RB810','$RB811','$RB812','$RB813','$RB814','$RB815','$RB816','$RB817','$RB91','$RB92','$RB93','$RB94','$RB95','$RB96','$RB97','$RB98','$RB99','$RB910','$RB911','$RB912','$RB913','$RB914','$RB915','$RB916','$RB917','$LMA','$LMB','$LMH','$LMGSM','$LMUMTS','$SMSA','$SMSB','$SMSH','$SMSGSM','$SMSUMTS','$VLA','$VLB','$VLH','$VLGSM','$VLUMTS','$LFA','$LFB','$LFH','$LFGSM','$LFUMTS','$NIH','$NIGSM','$NIUMTSB','$NIUMTSS','$NILTEB','$NILTES','$RFVS','$RFBA','$RFCA','$RFGG','$RFDP','$RFBT','$RFVE','$RFT','$RFVF','$RFET','$RFGA','$RFDPTX','$RFAE','$RFAA','$RFVDP','$RFCAS','$RFTM','$RFBB','$RFVP','$RFDCB','$RFTDP','$RFPN','$RFM','$RFO','$MPVIG','$MPVIB','$MPLG','$MPVCAG','$MPVCEAND','$MPVIRRU','$MPCVENDR','$MPVCANDR','$MPVV','$MPVEANR','$MPVIA','$MPVJC','$MPOVIG','$MPOVIB','$MPOLG','$MPOVCAG','$MPOVCEAND','$MPOVIRRU','$MPOCVENDR','$MPOVCANDR','$MPOVV','$MPOVEANR','$MPOVIA','$MPOVJC','$VA1','$UA1','$S1','$OVA1','$VA2','$UA2','$S2','$OVA2','$VA3','$UA3','$S3','$OVA3','$VR1','$E1','$OVR1','$VR2','$E2','$OVR2','$VR3','$E3','$OVR3','$OBS');");

    $id = incrementar_id("formulario_p013n", "id");
    $stmt = $bd->ejecutar("CALL SP_FORMULARIO_MTTO_I(19,$id,'P013n','Formulario Mtto. Preventivo Radio Bases Nuevo','Formulario Mtto. Preventivo Radio Bases Nuevo',$idevento    );");
    header("Location: ".$link_modulo."?path=prev_estacion.php$params");

    }else{

        $idformtto = $_POST['idformtto'];
        
        //$consulta =  "UPDATE formulario_p013 SET
        $stmt = $bd->ejecutar("CALL SP_INSFORM13_U(
        '$idevento','$ESTACION','$TEGSM','$TEUMTS','$TELTE','$EOGSM','$EOUMTS','$EOLTE','$TPGSM','$TPUMTS','$TPLTE','$PGSM','$PUMTS','$PLTE','$SPGSM','$SPUMTS','$SPLTE','$MGGSM','$MGUMTS','$MGLTE','$RB11','$RB12','$RB13','$RB14','$RB15','$RB16','$RB17','$RB18','$RB19','$RB110','$RB111','$RB112','$RB113','$RB114','$RB115','$RB116','$RB117','$RB21','$RB22','$RB23','$RB24','$RB25','$RB26','$RB27','$RB28','$RB29','$RB210','$RB211','$RB212','$RB213','$RB214','$RB215','$RB216','$RB217','$RB31','$RB32','$RB33','$RB34','$RB35','$RB36','$RB37','$RB38','$RB39','$RB310','$RB311','$RB312','$RB313','$RB314','$RB315','$RB316','$RB317','$RB41','$RB42','$RB43','$RB45','$RB46','$RB47','$RB48','$RB49','$RB410','$RB411','$RB412','$RB413','$RB414','$RB415','$RB416','$RB417','$RB51','$RB52','$RB53','$RB54','$RB55','$RB56','$RB57','$RB58','$RB59','$RB5510','$RB511','$RB512','$RB513','$RB514','$RB515','$RB516','$RB517','$RB61','$RB62','$RB63','$RB64','$RB65','$RB66','$RB67','$RB68','$RB69','$RB610','$RB611','$RB612','$RB613','$RB614','$RB615','$RB616','$RB617','$RB71','$RB72','$RB73','$RB74','$RB75','$RB76','$RB77','$RB78','$RB79','$RB710','$RB711','$RB712','$RB713','$RB714','$RB715','$RB716','$RB717','$RB81','$RB82','$RB83','$RB84','$RB85','$RB86','$RB87','$RB88','$RB89','$RB810','$RB811','$RB812','$RB813','$RB814','$RB815','$RB816','$RB817','$RB91','$RB92','$RB93','$RB94','$RB95','$RB96','$RB97','$RB98','$RB99','$RB910','$RB911','$RB912','$RB913','$RB914','$RB915','$RB916','$RB917','$LMA','$LMB','$LMH','$LMGSM','$LMUMTS','$SMSA','$SMSB','$SMSH','$SMSGSM','$SMSUMTS','$VLA','$VLB','$VLH','$VLGSM','$VLUMTS','$LFA','$LFB','$LFH','$LFGSM','$LFUMTS','$NIH','$NIGSM','$NIUMTSB','$NIUMTSS','$NILTEB','$NILTES','$RFVS','$RFBA','$RFCA','$RFGG','$RFDP','$RFBT','$RFVE','$RFT','$RFVF','$RFET','$RFGA','$RFDPTX','$RFAE','$RFAA','$RFVDP','$RFCAS','$RFTM','$RFBB','$RFVP','$RFDCB','$RFTDP','$RFPN','$RFM','$RFO','$MPVIG','$MPVIB','$MPLG','$MPVCAG','$MPVCEAND','$MPVIRRU','$MPCVENDR','$MPVCANDR','$MPVV','$MPVEANR','$MPVIA','$MPVJC','$MPOVIG','$MPOVIB','$MPOLG','$MPOVCAG','$MPOVCEAND','$MPOVIRRU','$MPOCVENDR','$MPOVCANDR','$MPOVV','$MPOVEANR','$MPOVIA','$MPOVJC','$VA1','$UA1','$S1','$OVA1','$VA2','$UA2','$S2','$OVA2','$VA3','$UA3','$S3','$OVA3','$VR1','$E1','$OVR1','$VR2','$E2','$OVR2','$VR3','$E3','$OVR3','$OBS');");

        
           header("Location: ".$link_modulo."?path=prev_estacion.php$params");
        //echo($MGUMTS);
        //echo($params);

        
}

//$stmt->bind_param(1,$TEGSM);
//$stmt->execute();
//$stmt->close();
//$bd->close();


/** Nuevo Formulario Mtto. 
if(!isset($_POST['idformtto'])){

    $id = incrementar_id("formulario_p013", "id");
    $consulta = "INSERT INTO formulario_p013 SET
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
    p12       ='".$p12."',
    p13       ='".$p13."',
    p14       ='".$p14."',
    p15       ='".$p15."',
    p16       ='".$p16."',
    p17       ='".$p17."',
    p18       ='".$p18."'"; 

    $resultado = mysql_query($consulta);

    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la informacion insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";

Editar Formulario Mtto. 
}else{

    $idformtto = $_POST['idformtto'];
    $consulta =  "UPDATE formulario_p013 SET
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
                    p12       ='".$p12."',
                    p13       ='".$p13."',
                    p14       ='".$p14."',
                    p15       ='".$p15."',
                    p16       ='".$p16."',
                    p17       ='".$p17."',
                    p18       ='".$p18."'
                  WHERE id = ".$idformtto."
                    ";
    $resultado=mysql_query($consulta);
    if($resultado) {
        header("Location: ".$link_modulo."?path=prev_estacion.php$params");
    }
    else echo "<b>Ocurrio un error, revise bien la información insertada!</b><br>Notrifiue de este error al administrador del Sistema: ".mysql_error()."<br><a href='javascript:history.back(1);'>[RETORNAR]</a>";
}    **/


?>