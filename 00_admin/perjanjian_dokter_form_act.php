<?
session_start();
require_once("../_lib/function/db.php");
require_once '../_lib/function/function.variabel.php';
loadlib("function","function.olah_tabel");
//$db->debug=true;


//echo "$kode_bagian"; 
//$kode_dokter=baca_tabel('tc_registrasi','kode_dokter',"where no_registrasi=$no_registrasi");
$date=date("Y-m-d H:i:s");

unset($perjanjian);
$perjanjian["nomer_str"] = $nomer_str;
$perjanjian["nomer_kontrak"] = $nomer_kontrak;
$perjanjian["massa_berlaku"] = $massa_berlaku;
$perjanjian["kode_dokter"] = $kode;
$perjanjian["tgl_input"] = $date;


if($validasi=="1"){
	$result = insert_tabel("mt_perjanjian_dokter", $perjanjian);	
}else if($validasi=="2"){
	$result = update_tabel("mt_perjanjian_dokter", $perjanjian, "WHERE id_mt_perjanjian_dokter=$id_mt_perjanjian_dokter");	
}else{
	$result = delete_tabel("mt_perjanjian_dokter", "WHERE id_mt_perjanjian_dokter=$id_mt_perjanjian_dokter");	
}
//die;
$db->CommitTrans($result!== false);

if($result){
	$data['code']=200;
}else{
	$data['code']=500;
}
echo json_encode($data);
?>
