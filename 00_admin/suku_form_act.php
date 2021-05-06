<?
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");
//$db->debug=true;

$id_dd_user=$loginInfo["id_dd_user"];
//echo "$kode_bagian"; 
//$kode_dokter=baca_tabel('tc_registrasi','kode_dokter',"where no_registrasi=$no_registrasi");
$date=date("Y-m-d H:i:s");

unset($suku);
$suku["suku"] = $nama_suku;
$suku["input_id"] = $id_dd_user;
$suku["input_tgl"] = $date;


if($validasi=="1"){
	$result = insert_tabel("dc_suku", $suku);	
}else if($validasi=="2"){
	$result = update_tabel("dc_suku", $suku, "WHERE id_dc_suku=$id_dc_suku");	
}else{
	$result = delete_tabel("dc_suku", "WHERE id_dc_suku=$id_dc_suku");	
}
//die;

if($result){
	$data['code']=200;
}else{
	$data['code']=500;
}
echo json_encode($data);
?>
