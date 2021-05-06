<?
set_time_limit(0);
session_start();
require_once("../_lib/function/db_login.php");
$db->debug=true;
require_once("../_lib/function/function.olah_tabel.php");
//$input = json_decode(file_get_contents('php://input'),true); /*Untuk WS*/
$DataUpdate['flag_bayar']=1;
$result = update_tabel("tc_registrasi",$DataUpdate,"where no_registrasi='$no_registrasi'");

echo json_encode($arrSlot);
?>