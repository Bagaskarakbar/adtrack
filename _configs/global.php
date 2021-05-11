<?
$AV_CONF=array();

$AV_CONF["db"]["type"]="mysqli";
$AV_CONF["db"]["user"]="root";
$AV_CONF["db"]["pass"]="";
$AV_CONF["db"]["name"]="dev_dokumen_tracking";
$AV_CONF["db"]["host"]="localhost";

// $AV_CONF["db"]["type"]="mssqlnative";
// $AV_CONF["db"]["user"]="sa";
// $AV_CONF["db"]["pass"]="qluhyd0q4u6y7";
// $AV_CONF["db"]["name"]="bayangkara_sirs_trn";
//$AV_CONF["db"]["host"]="103.8.79.52";
// $AV_CONF["db"]["host"]="192.168.1.20";


$AV_CONF["etc"]["login_satu_saja"]=true;
$AV_CONF["etc"]["session_time_out"]=15;
$AV_CONF["etc"]["password_expired"]=true;
$AV_CONF["etc"]["development"]=true;		// development flag, to track whether in development mode
$AV_CONF["etc"]["log_history"]=true;	//log history query utk function olah_tabel (update,delete,insert);
//$AV_CONF["smarty"]["active"]=true;
//$AV_CONF["smarty"]["template_dir"]="/_templates";
//$AV_CONF["smarty"]["compile_dir"]="/temp";
//$AV_CONF["smarty"]["configs_dir"]="/_lib/configs";
//$AV_CONF["smarty"]["smarty_dir"]="/_lib/smarty";
//$AV_CONF["smarty"]["trusted_dir"]="/_lib";

$AV_CONF["skin"]["name"]="default";

$AV_CONF["free_page"][]="/login.php";
$AV_CONF["free_page"][]="/login_act.php";
$AV_CONF["free_page"][]="/login1.php";
$AV_CONF["free_page"][]="/login1_act.php";



/*
$AV_CONF["dir"][""]="";
$AV_CONF["dir"][""]="";
$AV_CONF["dir"][""]="";
$AV_CONF["dir"][""]="";
*/

//echo "di dalam /_configs/global.php<br>\n";

// FTP
$AV_CONF["ftp"]["fModem"] = false;
$AV_CONF["ftp"]["strModemCon"] = "telkom";
$AV_CONF["ftp"]["strModemUsr"] = "telkomnet@instan";
$AV_CONF["ftp"]["strModemPas"] = "telkom";
$AV_CONF["ftp"]["strServer"] = "192.168.1.1";
$AV_CONF["ftp"]["numPort"] = "21";
$AV_CONF["ftp"]["numTimeOut"] = "90";
$AV_CONF["ftp"]["strFTPUser"] = "rsjiwa";
$AV_CONF["ftp"]["strFTPPass"] = "averin";
$AV_CONF["ftp"]["fFTPPasive"] = true;

?>
