<?
session_start();
if (!defined("LOGIN_PAGE")) define("LOGIN_PAGE",true);
include "_lib/function/db_login.php";
include "_lib/function/function.olah_tabel.php";
//$db->debug=true;

$txt_name=$_POST["txt_name"];
$txt_pass=$_POST["txt_pass"];
loadlib("class","Security");

$modulnya=array();
$sec=new Security($db,$txt_name,$txt_pass);

if ($sec->isValidUser()) {
	$modulnya=$sec->hakModul();

	if (count($modulnya)==1) {
		//$lokasi="kerangka.php?modul=".$modulnya[0];
		$lokasi="modul.php";
	} else {
		$lokasi="modul.php";
	}
	//$_SESSION['loginInfo']='loginInfo';
	// if (!session_is_registered("loginInfo")) {
		// session_register("loginInfo");
	// }
} else {
	$lokasi="index.php";
}

// end of logic layer ==========================================================================================================;
//die;
?>
<!-- presentation layer ------------------------------------------------------------------------------------------------------->
<html>
<head>
<title></title>
</head>
<body onload="window.location.href='<?=$lokasi?>';"><!--  -->
</body>
</html>
